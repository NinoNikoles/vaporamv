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
                    <li class="menu-item">
                        <a href="/" title="Home" <?php if( $results['pageTitle'] == "Home") { echo 'class="is-active"';} ?> >Home</a>
                    </li>
                    <li class="menu-item">
                        <a href=".?action=songs" <?php if( $results['pageTitle'] == "Songs") { echo 'class="is-active"';} ?> title="Songs">Songs</a>
                    </li class="menu-item">
                    <li class="menu-item">
                        <a href=".?action=albums" title="Alben" <?php if( $results['pageTitle'] == "Alben") { echo 'class="is-active"';} ?> >Alben</a>
                    </li>
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
            <li><a href="/" <?php if( $results['pageTitle'] == "Home") { echo 'class="is-active"';} ?> title="Home">Home</a></li>
            <li><a href=".?action=songs" <?php if( $results['pageTitle'] == "Songs") { echo 'class="is-active"';} ?> title="Songs">Songs</a></li>
            <li><a href=".?action=albums" <?php if( $results['pageTitle'] == "Alben") { echo 'class="is-active"';} ?> title="Alben">Alben</a></li>
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