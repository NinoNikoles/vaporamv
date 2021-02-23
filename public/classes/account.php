<?php

/**
 * Class to handle albums
 */

class account
{
// Properties

    /**
     * @var int The account ID
     */
    public $id = null;

    /**
     * @var string Firstname of the account
     */
    public $firstname = null;

    /**
     * @var string Lastname of the account
     */
    public $lastname = null;

    /**
     * @var string Username of the account
     */
    public $username = null;

    /**
     * @var string Email of the account
     */
    public $email = null;

    /**
     * @var string Password of the account
     */
    public $password = null;

    /**
     * Sets the object's properties using the values in the supplied array
     *
     * @param assoc The property values
     */

    public function __construct( $data=array() ) {
        if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
        if ( isset( $data['firstname'] ) ) $this->firstname = $data['firstname'];
        if ( isset( $data['lastname'] ) ) $this->lastname = $data['lastname'];
        if ( isset( $data['username'] ) ) $this->username = $data['username'];
        if ( isset( $data['email'] ) ) $this->email = $data['email'];
        if ( isset( $data['password'] ) ) $this->password = $data['password'];
    }

    /**
     * Sets the object's properties using the edit form post values in the supplied array
     *
     * @param assoc The form post values
     */

    public function storeFormValues ( $params ) {

        // Store all the parameters
        $this->__construct( $params );

    }

    /**
     * Returns an account object matching the given account ID
     *
     * @param int The account ID
     * @return Account|false The account object, or false if the record was not found or there was a problem
     */

    public static function getById( $id ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT * FROM accounts WHERE id = :id";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":id", $id, PDO::PARAM_INT );
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ( $row ) return new Account( $row );
    }

    /**
     * Returns all (or a range of) account objects in the DB
     *
     * @param int Optional The number of rows to return (default=all)
     * @return Array|false A two-element array : results => array, a list of account objects; totalRows => Total number of accounts
     */

    public static function getList( $numRows=1000000 ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM accounts
            ORDER BY id DESC LIMIT :numRows";

        $st = $conn->prepare( $sql );
        $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
        $st->execute();
        $list = array();

        while ( $row = $st->fetch() ) {
            $account = new Account( $row );
            $list[] = $account;
        }

        // Now get the total number of articles that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query( $sql )->fetch();
        $conn = null;
        return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
    }

    /**
     * Inserts the current account object into the database, and sets its ID property.
     */

    public function insert() {

        // Does the Album object already have an ID?
        if ( !is_null( $this->id ) ) trigger_error ( "Account::insert(): Attempt to insert an Account object that already has its ID property set (to $this->id).", E_USER_ERROR );
        if ( !is_null( $this->username ) ) {
            header( "Location: admin.php?error=usernameAlreadyExist" );
            return;
        }
        if ( !is_null( $this->email ) ) {
            header( "Location: admin.php?error=emailAlreadyExist" );
            return;
        }

        // Insert the Album
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "INSERT INTO accounts ( firstname, lastname, username, email, password ) 
                VALUES ( :firstname, :lastname, :username, :email, :password )";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":firstname", $this->firstname, PDO::PARAM_STR );
        $st->bindValue( ":lastname", $this->lastname, PDO::PARAM_STR );
        $st->bindValue( ":username", $this->username, PDO::PARAM_STR );
        $st->bindValue( ":email", $this->email, PDO::PARAM_STR );
        $st->bindValue( ":password", password_hash($this->password, PASSWORD_DEFAULT), PDO::PARAM_STR );
        $st->execute();
        $this->id = $conn->lastInsertId();
        $conn = null;
    }

    /**
     * Updates the current account object in the database.
     */

    public function update() {

        // Does the Album object have an ID?
        if ( is_null( $this->id ) ) trigger_error ( "Account::update(): Attempt to update an Account object that does not have its ID property set.", E_USER_ERROR );

        // Update the Article
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "UPDATE accounts SET  firstname=:firstname, lastname=:lastname, username=:username, email=:email, password=:password WHERE id = :id";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
        $st->bindValue( ":firstname", $this->firstname, PDO::PARAM_STR );
        $st->bindValue( ":lastname", $this->lastname, PDO::PARAM_STR );
        $st->bindValue( ":username", $this->username, PDO::PARAM_STR );
        $st->bindValue( ":email", $this->email, PDO::PARAM_STR );
        $st->bindValue( ":password", password_hash($this->password, PASSWORD_DEFAULT), PDO::PARAM_STR );
        $st->execute();
        $conn = null;
    }

    /**
     * Deletes the current Account object from the database.
     */

    public function delete() {

        // Does the Account object have an ID?
        if ( is_null( $this->id ) ) trigger_error ( "Account::delete(): Attempt to delete an Account object that does not have its ID property set.", E_USER_ERROR );

        // Delete the Account
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $st = $conn->prepare ( "DELETE FROM accounts WHERE id = :id LIMIT 1" );
        $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
        $st->execute();
        $conn = null;
    }
}

?>