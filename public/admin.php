<?php

require( "config.php" );
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";

if ( $action != "login" && $action != "logout" && !$username ) {
    login();
    exit;
}

switch ( $action ) {
    case 'login':
        login();
        break;
    case 'newAccount':
        newAccount();
        break;
    case 'logout':
        logout();
        break;
    case 'newSong':
        newSong();
        break;
    case 'newAlbum':
        newAlbum();
        break;
    case 'editAccount':
        editAccount();
        break;
    case 'editSong':
        editSong();
        break;
    case 'editAlbum':
        editAlbum();
        break;
    case 'deleteSong':
        deleteSong();
        break;
    case 'deleteAlbum':
        deleteAlbum();
        break;
    case 'deleteAccount':
        deleteAccount();
        break;
    case 'listAccounts':
        listAccounts();
        break;
    case 'listAlbums':
        listAlbums();
        break;
    case 'listSongs':
        listSongs();
        break;
    default:
        backend();
}

function login() {

    $results = array();
    $results['pageTitle'] = "Admin Login";
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $blur = "blue";

    if ( isset( $_POST['login'] ) ) {

        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM accounts WHERE username = '$username'";
        $result = $conn->query($sql);

        foreach ( $result as $row) {
            $db_username = $row['username'];
            $db_password = $row['password'];
        }

        // User has posted the login form: attempt to log the user in
        if ( isset($db_username) && isset($db_password) && $_POST['username'] == $db_username && password_verify($password, $db_password ))
        {
            // Login successful: Create a session and redirect to the admin homepage
            $_SESSION['username'] = $db_username;
            header( "Location: admin.php" );


        } else {
            // Login failed: display an error message to the user
            $results['errorMessage'] = "Incorrect username or password. Please try again.";
            require( TEMPLATE_PATH . "/admin/loginForm.php" );
        }

    } else {

        // User has not posted the login form yet: display the form
        require( TEMPLATE_PATH . "/admin/loginForm.php" );
    }

}


function logout() {
    unset( $_SESSION['username'] );
    header( "Location: admin.php" );
}

function newAccount() {

    $results = array();
    $results['pageTitle'] = "Register";
    $results['formAction'] = "newAccount";
    $blur = 'blue';

    if ( isset( $_POST['saveChanges'] ) ) {

        // User has posted the article edit form: save the new article
        $account = new account;
        $account->storeFormValues( $_POST );
        $account->insert();

    } elseif ( isset( $_POST['cancel'] ) ) {

        // User has cancelled their edits: return to the article list
        header( "Location: admin.php" );
    } else {

        // User has not posted the article edit form yet: display the form
        $results['account'] = new Account;
        require( TEMPLATE_PATH . "/admin/editAccount.php" );
    }
}

function newSong() {

    $results = array();
    $results['pageTitle'] = "New Song";
    $results['formAction'] = "newSong";
    $resultsAlbum = array();
    $data = Album::getList();
    $resultsAlbum['albums'] = $data['results'];
    $resultsAlbum['totalRows'] = $data['totalRows'];
    $blur = 'green';

    if ( isset( $_POST['saveChanges'] ) ) {

        // User has posted the article edit form: save the new article
        $song = new song;
        $song->storeFormValues( $_POST );
        $song->insert();
        header( "Location: admin.php?status=songChangesSaved" );

    } elseif ( isset( $_POST['cancel'] ) ) {

        // User has cancelled their edits: return to the article list
        header( "Location: admin.php" );
    } else {

        // User has not posted the article edit form yet: display the form
        $results['song'] = new Song;
        require( TEMPLATE_PATH . "/admin/editSong.php" );
    }

}

function newAlbum() {

    $results = array();
    $results['pageTitle'] = "New Album";
    $results['formAction'] = "newAlbum";
    $blur = 'red';

    if ( isset( $_POST['saveChanges'] ) ) {

        // User has posted the article edit form: save the new article
        $album = new album;
        $album->storeFormValues( $_POST );
        $album->insert();
        header( "Location: admin.php?status=albumChangesSaved" );

    } elseif ( isset( $_POST['cancel'] ) ) {

        // User has cancelled their edits: return to the article list
        header( "Location: admin.php" );
    } else {

        // User has not posted the article edit form yet: display the form
        $results['album'] = new Album;
        require( TEMPLATE_PATH . "/admin/editAlbum.php" );
    }

}

function editAccount() {

    $results = array();
    $results['pageTitle'] = "Edit Account";
    $results['formAction'] = "editAccount";
    $blur = 'blue';

    if ( isset( $_POST['saveChanges'] ) ) {

        // User has posted the article edit form: save the article changes

        if ( !$account = Account::getById( (int)$_POST['accountId'] ) ) {
            header( "Location: admin.php?error=accountNotFound" );
            return;
        }

        $account->storeFormValues( $_POST );
        $account->update();
        header( "Location: admin.php?status=accountChangesSaved" );

    } elseif ( isset( $_POST['cancel'] ) ) {

        // User has cancelled their edits: return to the article list
        header( "Location: admin.php" );
    } else {

        // User has not posted the article edit form yet: display the form
        $results['account'] = Account::getById( (int)$_GET['accountId'] );
        require( TEMPLATE_PATH . "/admin/editAccount.php" );
    }

}

function editSong() {

    $results = array();
    $results['pageTitle'] = "Edit Song";
    $results['formAction'] = "editSong";
    $resultsAlbum = array();
    $data = Album::getList();
    $resultsAlbum['albums'] = $data['results'];
    $resultsAlbum['totalRows'] = $data['totalRows'];
    $blur = 'green';

    if ( isset( $_POST['saveChanges'] ) ) {

        // User has posted the article edit form: save the article changes

        if ( !$song = Song::getById( (int)$_POST['songId'] ) ) {
            header( "Location: admin.php?error=songNotFound" );
            return;
        }

        $song->storeFormValues( $_POST );
        $song->update();
        header( "Location: admin.php?status=songChangesSaved" );

    } elseif ( isset( $_POST['cancel'] ) ) {

        // User has cancelled their edits: return to the article list
        header( "Location: admin.php" );
    } else {

        // User has not posted the article edit form yet: display the form
        $results['song'] = Song::getById( (int)$_GET['songId'] );
        require( TEMPLATE_PATH . "/admin/editSong.php" );
    }

}

function editAlbum() {

    $results = array();
    $results['pageTitle'] = "Edit Album";
    $results['formAction'] = "editAlbum";
    $blur = 'red';

    if ( isset( $_POST['saveChanges'] ) ) {

        // User has posted the article edit form: save the article changes

        if ( !$album = Album::getById( (int)$_POST['albumId'] ) ) {
            header( "Location: admin.php?error=albumNotFound" );
            return;
        }

        $album->storeFormValues( $_POST );
        $album->update();
        header( "Location: admin.php?status=albumChangesSaved" );

    } elseif ( isset( $_POST['cancel'] ) ) {

        // User has cancelled their edits: return to the article list
        header( "Location: admin.php" );
    } else {

        // User has not posted the article edit form yet: display the form
        $results['album'] = Album::getById( (int)$_GET['albumId'] );
        require( TEMPLATE_PATH . "/admin/editAlbum.php" );
    }

}

function deleteAccount() {

    if ( !$account = Account::getById( (int)$_GET['accountId'] ) ) {
        header( "Location: admin.php?error=accountNotFound" );
        return;
    }

    $account->delete();
    header( "Location: admin.php?status=accountDeleted" );
}

function deleteSong() {

    if ( !$song = Song::getById( (int)$_GET['songId'] ) ) {
        header( "Location: admin.php?error=songNotFound" );
        return;
    }

    $song->delete();
    header( "Location: admin.php?status=songDeleted" );
}

function deleteAlbum() {

    if ( !$album = Album::getById( (int)$_GET['albumId'] ) ) {
        header( "Location: admin.php?error=albumNotFound" );
        return;
    }

    $album->delete();
    header( "Location: admin.php?status=albumDeleted" );
}

function listAccounts() {
    $results = array();
    $data = Account::getList();
    $results['accounts'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "All Accounts";

    if ( isset( $_GET['error'] ) ) {
        if ( $_GET['error'] == "accountNotFound" ) $results['errorMessage'] = "Error: Account not found.";
    }

    if ( isset( $_GET['status'] ) ) {
        if ( $_GET['status'] == "accountChangesSaved" ) $results['statusMessage'] = "Your Account changes have been saved.";
        if ( $_GET['status'] == "accountDeleted" ) $results['statusMessage'] = "Account deleted.";
    }
    require( TEMPLATE_PATH . "/admin/listAccounts.php" );
}

function listSongs() {
    $results = array();
    $data = Song::getList();
    $results['songs'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "All Songs";

    if ( isset( $_GET['error'] ) ) {
        if ( $_GET['error'] == "songNotFound" ) $results['errorMessage'] = "Error: Song not found.";
    }

    if ( isset( $_GET['status'] ) ) {
        if ( $_GET['status'] == "songChangesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
        if ( $_GET['status'] == "songDeleted" ) $results['statusMessage'] = "Song deleted.";
    }
    require( TEMPLATE_PATH . "/admin/listSongs.php" );
}

function listAlbums() {
    $results = array();
    $data = Album::getList();
    $results['albums'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "All Albums";

    if ( isset( $_GET['error'] ) ) {
        if ( $_GET['error'] == "albumNotFound" ) $results['errorMessage'] = "Error: Album not found.";
    }

    if ( isset( $_GET['status'] ) ) {
        if ( $_GET['status'] == "albumChangesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
        if ( $_GET['status'] == "albumDeleted" ) $results['statusMessage'] = "Album deleted.";
    }
    require( TEMPLATE_PATH . "/admin/listAlbums.php" );
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

function backend() {
    $resultsSongs = array();
    $dataSongs = Song::getList();
    $resultsSongs['songs'] = $dataSongs['results'];
    $resultsSongs['totalRows'] = $dataSongs['totalRows'];
    $resultsSongs['pageTitle'] = "All Songs";

    $resultsAlbums = array();
    $dataAlbums = Album::getList();
    $resultsAlbums['albums'] = $dataAlbums['results'];
    $resultsAlbums['totalRows'] = $dataAlbums['totalRows'];
    $resultsAlbums['pageTitle'] = "All Albums";

    $resultsAccounts = array();
    $dataAccounts = Account::getList();
    $resultsAccounts['accounts'] = $dataAccounts['results'];
    $resultsAccounts['totalRows'] = $dataAccounts['totalRows'];
    $resultsAccounts['pageTitle'] = "All Accounts";

    if ( isset( $_GET['error'] ) ) {
        if ( $_GET['error'] == "songNotFound" ) $resultsSongs['errorMessage'] = "Error: Song not found.";

        if ( $_GET['error'] == "albumNotFound" ) $resultsAlbums['errorMessage'] = "Error: Album not found.";

        if ( $_GET['error'] == "accountNotFound" ) $resultsAccounts['errorMessage'] = "Error: Account not found.";
        if ( $_GET['error'] == "usernameAlreadyExist" ) $resultsAccounts['errorMessage'] = "Error: Username already exist.";
        if ( $_GET['error'] == "emailAlreadyExist" ) $resultsAccounts['errorMessage'] = "Error: Email already exist.";
    }

    if ( isset( $_GET['status'] ) ) {
        if ( $_GET['status'] == "songChangesSaved" ) $resultsSongs['statusMessage'] = "Your Song changes have been saved.";
        if ( $_GET['status'] == "songDeleted" ) $resultsSongs['statusMessage'] = "Song deleted.";

        if ( $_GET['status'] == "albumChangesSaved" ) $resultsAlbums['statusMessage'] = "Your Album changes have been saved.";
        if ( $_GET['status'] == "albumDeleted" ) $resultsAlbums['statusMessage'] = "Album deleted.";

        if ( $_GET['status'] == "accountChangesSaved" ) $resultsAccounts['statusMessage'] = "Your Account changes have been saved.";
        if ( $_GET['status'] == "accountDeleted" ) $resultsAccounts['statusMessage'] = "Account deleted.";
    }

    $results['pageTitle'] = "Dashboard";
    $blur = 'red';
    require( TEMPLATE_PATH . "/admin/backend.php" );
}

?>