<?php

require( "config.php" );
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

switch ( $action ) {
    case 'albums':
        albums();
        break;
    case 'songs':
        songs();
        break;
    case 'viewAlbum':
        viewAlbum();
        break;
    case 'viewSong':
        viewSong();
        break;
    default:
        homepage();
}

function albums() {
    $results = array();
    $data = Album::getList();
    $results['albums'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "Alben";
    $blur = 'red';
    require( TEMPLATE_PATH . "/albums.php" );
}

function songs() {
    $results = array();
    $data = Song::getList();
    $results['songs'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "Songs";

    $resultsNewSongs = array();
    $dataNewSongs = Song::getListNew();
    $resultsNewSongs['songs'] = $dataNewSongs['results'];
    $resultsNewSongs['totalRows'] = $dataNewSongs['totalRows'];

    $resultsAlbums = array();
    $dataAlbums = Album::getList();
    $resultsAlbums['albums'] = $dataAlbums['results'];
    $resultsAlbums['totalRows'] = $dataAlbums['totalRows'];
    $blur = 'green';
    require( TEMPLATE_PATH . "/songs.php" );
}

function viewAlbum() {
    if ( !isset($_GET["albumId"]) || !$_GET["albumId"] ) {
        homepage();
        return;
    }

    $results = array();
    $results['album'] = Album::getById( (int)$_GET["albumId"] );
    $results['pageTitle'] = $results['album']->title;
    $resultsSongs =array();
    $data = Song::getList();
    $resultsSongs['songs'] = $data['results'];
    $blur = 'red';
    require( TEMPLATE_PATH . "/viewAlbum.php" );
}

function viewSong() {
    if ( !isset($_GET["songId"]) || !$_GET["songId"] ) {
        homepage();
        return;
    }

    $results = array();
    $results['song'] = Song::getById( (int)$_GET["songId"] );
    $results['pageTitle'] = $results['song']->title;
    $resultsSongs =array();
    $data = Song::getList();
    $resultsSongs['songs'] = $data['results'];
    $blur = 'green';
    require( TEMPLATE_PATH . "/viewSong.php" );
}

function homepage() {
    $results = array();
    $data = Song::getList( HOMEPAGE_NUM_SONGS );
    $results['songs'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "Home";
    $blur = 'blue';
    require( TEMPLATE_PATH . "/homepage.php" );
}

function blurSection($blur) {
    $sectionBlur = $blur;
    $blue = 'blue';
    $red = 'red';
    $green = 'green';
    $purple = 'purple';

    if ($sectionBlur == $blue) {
        echo 'blue-blur';
    }
    if ($sectionBlur == $red) {
        echo 'red-blur';
    }
    if ($sectionBlur == $green) {
        echo 'green-blur';
    }
    if ($sectionBlur == $purple) {
        echo 'purple-blur';
    }
}

?>