<header>
    <div class="title-bar show-for-small-only">
        <div class="menu-icon-container ">
            <button class="menu-icon float-left" type="button" data-toggle="offCanvas"></button>
        </div>
        <div class="logo-container">
            <a href="https://www.vaporamv.de" title="Home" class="logo">
                <img alt="Navigation Logo" title="Home" src="assets/images/nav-logo.png">
            </a>
        </div>
        <div class="menu float-right">
            <p class="h2"><?php echo $results['pageTitle'] ?></p>
        </div>
    </div>


    <div class="top-bar show-for-medium" id="header-menu">
        <div class="top-bar-left">
            <a href="/" title="Home" class="logo">
                <img alt="Navigation Logo" title="Home" src="assets/images/nav-logo.png">
            </a>
        </div>
        <div class="top-bar-right">
            <nav class="nav-main">
                <ul class="menu">
                    <?php if( $results['pageTitle'] != "Admin Login") { ?>
                        <li class="menu-item">
                            <a href="admin.php" <?php if( $results['pageTitle'] == "Dashboard") { echo 'class="is-active"';} ?> >Dashboard</a>
                        </li>
                        <li class="menu-item">
                            <a href="admin.php?action=newSong" <?php if( $results['pageTitle'] == "New Song" || $results['pageTitle'] == "Edit Song") { echo 'class="is-active"';} ?> >Add Song</a>
                        </li>
                        <li class="menu-item">
                            <a href="admin.php?action=newAlbum" <?php if( $results['pageTitle'] == "New Album" || $results['pageTitle'] == "Edit Album") { echo 'class="is-active"';} ?> >Add Album</a>
                        </li>
                        <li class="menu-item">
                            <a href="admin.php?action=logout">
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>

    <div class="off-canvas position-left" id="offCanvas" data-off-canvas data-transition="overlap">
        <!-- Your menu or Off-canvas content goes here -->
        <button class="close-button" type="button" data-toggle="offCanvas">
            <span aria-hidden="true">&times;</span>
        </button>
        <hr>
        <ul class="vertical menu">
        <?php if( $results['pageTitle'] != "Admin Login") { ?>
            <li class="menu-item">
                <a href="admin.php" <?php if( $results['pageTitle'] == "Dashboard") { echo 'class="is-active"';} ?> >Dashboard</a>
            </li>
            <li class="menu-item">
                <a href="admin.php?action=newSong" <?php if( $results['pageTitle'] == "Add Song") { echo 'class="is-active"';} ?> >Add Song</a>
            </li>
            <li class="menu-item">
                <a href="admin.php?action=newAlbum" <?php if( $results['pageTitle'] == "Add Album") { echo 'class="is-active"';} ?> >Add Album</a>
            </li>
            <li class="menu-item">
                <a href="admin.php?action=logout">
                    Logout <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        <?php } ?>
        </ul>
    </div>

    <section class="blur <?php blurSection($blur);?>">
        <div id="particles-js"></div>
        <div class="row show-for-medium">
            <div class="column small-12">
                <h1 class="h2 headline text-center"><?php echo $results['pageTitle'] ?></h1>
            </div>
        </div>
    </section>

</header>