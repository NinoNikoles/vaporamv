<?php

/**
 * Class to handle albums
 */

class album
{
// Properties

    /**
     * @var int The album ID from the database
     */
    public $id = null;

    /**
     * @var int When the album was published
     */
    public $publicationDate = null;

    /**
     * @var string Full title of the album
     */
    public $title = null;

    /**
     * @var string The Image of the album
     */
    public $cover = null ;

    /**
     * Sets the object's properties using the values in the supplied array
     *
     * @param assoc The property values
     */

    public function __construct( $data=array() ) {
        if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
        if ( isset( $data['publicationDate'] ) ) $this->publicationDate = (int) $data['publicationDate'];
        if ( isset( $data['title'] ) ) $this->title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['title'] );
        if ( isset( $data['cover'] ) ) $this->cover = $data['cover'];
    }

    /**
     * Sets the object's properties using the edit form post values in the supplied array
     *
     * @param assoc The form post values
     */

    public function storeFormValues ( $params ) {

        // Store all the parameters
        $this->__construct( $params );

        if(!empty($_FILES['cover']))
        {
            $path = "assets/images/albums/";
            $path = $path . basename( $_FILES['cover']['name']);

            if(move_uploaded_file($_FILES['cover']['tmp_name'], $path)) {
                echo "The file ".  basename( $_FILES['cover']['name']).
                    " has been uploaded";
            } else{
                echo "There was an error uploading the file, please try again!";
            }
        }

        $this->cover = basename( $_FILES['cover']['name']);

        // Parse and store the publication date
        if ( isset($params['publicationDate']) ) {
            $publicationDate = explode ( '-', $params['publicationDate'] );

            if ( count($publicationDate) == 3 ) {
                list ( $y, $m, $d ) = $publicationDate;
                $this->publicationDate = mktime ( 0, 0, 0, $m, $d, $y );
            }
        }
    }

    /**
     * Returns an Album object matching the given album ID
     *
     * @param int The album ID
     * @return Album|false The album object, or false if the record was not found or there was a problem
     */

    public static function getById( $id ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM albums WHERE id = :id";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":id", $id, PDO::PARAM_INT );
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ( $row ) return new Album( $row );
    }

    /**
     * Returns all (or a range of) album objects in the DB
     *
     * @param int Optional The number of rows to return (default=all)
     * @return Array|false A two-element array : results => array, a list of album objects; totalRows => Total number of albums
     */

    public static function getList( $numRows=1000000 ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM albums
            ORDER BY publicationDate DESC LIMIT :numRows";

        $st = $conn->prepare( $sql );
        $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
        $st->execute();
        $list = array();

        while ( $row = $st->fetch() ) {
            $album = new Album( $row );
            $list[] = $album;
        }

        // Now get the total number of articles that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query( $sql )->fetch();
        $conn = null;
        return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
    }

    /**
     * Inserts the current album object into the database, and sets its ID property.
     */

    public function insert() {

        // Does the Album object already have an ID?
        if ( !is_null( $this->id ) ) trigger_error ( "Album::insert(): Attempt to insert an Album object that already has its ID property set (to $this->id).", E_USER_ERROR );

        // Insert the Album
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "INSERT INTO albums ( publicationDate, title, img ) VALUES ( FROM_UNIXTIME(:publicationDate), :title, :cover )";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":publicationDate", $this->publicationDate, PDO::PARAM_INT );
        $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
        $st->bindValue( ":cover", $this->cover, PDO::PARAM_STR );
        $st->execute();
        $this->id = $conn->lastInsertId();
        $conn = null;
    }

    /**
     * Updates the current album object in the database.
     */

    public function update() {

        // Does the Album object have an ID?
        if ( is_null( $this->id ) ) trigger_error ( "Album::update(): Attempt to update an Album object that does not have its ID property set.", E_USER_ERROR );

        // Update the Article
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "UPDATE articles SET publicationDate=FROM_UNIXTIME(:publicationDate), title=:titles WHERE id = :id";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":publicationDate", $this->publicationDate, PDO::PARAM_INT );
        $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
        $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
        $st->execute();
        $conn = null;
    }

    /**
     * Deletes the current album object from the database.
     */

    public function delete() {

        // Does the Album object have an ID?
        if ( is_null( $this->id ) ) trigger_error ( "Album::delete(): Attempt to delete an Album object that does not have its ID property set.", E_USER_ERROR );

        // Delete the Album
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $st = $conn->prepare ( "DELETE FROM albums WHERE id = :id LIMIT 1" );
        $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
        $st->execute();
        $conn = null;
    }
}

?>