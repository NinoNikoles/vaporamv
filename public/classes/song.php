<?php

/**
 * Class to handle songs
 */

class song
{
// Properties

    /**
     * @var int The song ID from the database
     */
    public $id = null;

    /**
     * @var int When the song was published
     */
    public $publicationDate = null;

    /**
     * @var string Full title of the song
     */
    public $title = null;

    /**
     * @var string The url of the song
     */
    public $url = null;

    /**
     * @var string The url of the song
     */
    public $urlid = null;

    /**
     * @var string The cover of the song
     */
    public $cover = null ;

    /**
     * @var string The thumbnail of the song
     */
    public $thumbnail = null ;

    /**
     * @var string The Album of the song
     */
    public $album = null ;

    /**
     * Sets the object's properties using the values in the supplied array
     *
     * @param assoc The property values
     */

    public function __construct( $data=array() ) {
        if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
        if ( isset( $data['publicationDate'] ) ) $this->publicationDate = (int) $data['publicationDate'];
        if ( isset( $data['title'] ) ) $this->title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['title'] );
        if ( isset( $data['url'] ) ) $this->url = $data['url'];
        if ( isset( $data['urlid'] ) ) $this->urlid = $data['urlid'];
        if ( isset( $data['cover'] ) ) $this->cover = $data['cover'];
        if ( isset( $data['thumbnail'] ) ) $this->thumbnail = $data['thumbnail'];
        if ( isset( $data['album'] ) ) $this->album = $data['album'];
    }

    /**
     * Sets the object's properties using the edit form post values in the supplied array
     *
     * @param assoc The form post values
     */

    public function storeFormValues ( $params ) {

        // Store all the parameters
        $this->__construct( $params );
        $this->url = '<iframe id="player" width="560" height="315" src="https://www.youtube.com/embed/' . $this->urlid . '?enablejsapi=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

        if(!empty($_FILES['cover']))
        {
            $path = "assets/images/cover/";
            $path = $path . basename( $_FILES['cover']['name']);

            if(move_uploaded_file($_FILES['cover']['tmp_name'], $path)) {
                echo "The file ".  basename( $_FILES['cover']['name']).
                    " has been uploaded";
            } else{
                echo "There was an error uploading the file, please try again!";
            }
        }

        $this->cover = basename( $_FILES['cover']['name']);

        if(!empty($_FILES['thumbnail']))
        {
            $path = "assets/images/thumbnails/";
            $path = $path . basename( $_FILES['thumbnail']['name']);

            if(move_uploaded_file($_FILES['thumbnail']['tmp_name'], $path)) {
                echo "The file ".  basename( $_FILES['thumbnail']['name']).
                    " has been uploaded";
            } else{
                echo "There was an error uploading the file, please try again!";
            }
        }

        $this->thumbnail = basename( $_FILES['thumbnail']['name']);

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
     * Returns an song object matching the given song ID
     *
     * @param int The song ID
     * @return Song|false The song object, or false if the record was not found or there was a problem
     */

    public static function getById( $id ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM songs WHERE id = :id";
        $st = $conn->prepare( $sql );
        $st->bindValue( ":id", $id, PDO::PARAM_INT );
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ( $row ) return new Song( $row );
    }

    /**
     * Returns all (or a range of) Song objects in the DB
     *
     * @param int Optional The number of rows to return (default=all)
     * @return Array|false A two-element array : results => array, a list of Song objects; totalRows => Total number of songs
     */

    public static function getList( $numRows=1000000 ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM songs
            ORDER BY id ASC LIMIT :numRows";

        $st = $conn->prepare( $sql );
        $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
        $st->execute();
        $list = array();

        while ( $row = $st->fetch() ) {
            $song = new Song( $row );
            $list[] = $song;
        }

        // Now get the total number of songs that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query( $sql )->fetch();
        $conn = null;
        return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
    }

    public static function getListNew( $numRows=12 ) {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM songs
            ORDER BY publicationDate DESC LIMIT :numRows";

        $st = $conn->prepare( $sql );
        $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
        $st->execute();
        $list = array();

        while ( $row = $st->fetch() ) {
            $song = new Song( $row );
            $list[] = $song;
        }

        // Now get the total number of songs that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query( $sql )->fetch();
        $conn = null;
        return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
    }

    /**
     * Inserts the current song object into the database, and sets its ID property.
     */

    public function insert() {

        // Does the Album object already have an ID?
        if ( !is_null( $this->id ) ) trigger_error ( "Song::insert(): Attempt to insert an Song object that already has its ID property set (to $this->id).", E_USER_ERROR );

        // Insert the Album
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "INSERT INTO songs ( publicationDate, title, url, urlid, cover, thumbnail, album ) VALUES ( FROM_UNIXTIME(:publicationDate), :title, :url, :urlid, :cover, :thumbnail, :album )";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":publicationDate", $this->publicationDate, PDO::PARAM_INT );
        $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
        $st->bindValue( ":url", $this->url, PDO::PARAM_STR );
        $st->bindValue( ":urlid", $this->urlid, PDO::PARAM_STR );
        $st->bindValue( ":cover", $this->cover, PDO::PARAM_STR );
        $st->bindValue( ":thumbnail", $this->thumbnail, PDO::PARAM_STR );
        $st->bindValue( ":album", $this->album, PDO::PARAM_STR );
        $st->execute();
        $this->id = $conn->lastInsertId();
        $conn = null;

    }

    /**
     * Updates the current song object in the database.
     */

    public function update() {

        // Does the Song object have an ID?
        if ( is_null( $this->id ) ) trigger_error ( "Song::update(): Attempt to update an Song object that does not have its ID property set.", E_USER_ERROR );

        // Update the Song
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $sql = "UPDATE songs SET publicationDate=FROM_UNIXTIME(:publicationDate), title=:title, url=:url, urlid=:urlid, album=:album WHERE id = :id";
        $st = $conn->prepare ( $sql );
        $st->bindValue( ":publicationDate", $this->publicationDate, PDO::PARAM_INT );
        $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
        $st->bindValue( ":url", $this->url, PDO::PARAM_STR );
        $st->bindValue( ":urlid", $this->urlid, PDO::PARAM_STR );
        $st->bindValue( ":album", $this->album, PDO::PARAM_STR );
        $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
        $st->execute();
        $conn = null;
    }

    /**
     * Deletes the current song object from the database.
     */

    public function delete() {

        // Does the Album object have an ID?
        if ( is_null( $this->id ) ) trigger_error ( "Song::delete(): Attempt to delete an Song object that does not have its ID property set.", E_USER_ERROR );

        // Delete the Album
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        $st = $conn->prepare ( "DELETE FROM songs WHERE id = :id LIMIT 1" );
        $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
        $st->execute();
        $conn = null;
    }
}

?>