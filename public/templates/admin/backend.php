<?php include "templates/include/head.php" ?>
<?php include "templates/admin/include/header.php" ?>

<main>
    <section>
        <div class="row">
            <div class="column small-12">
                <div id="adminHeader">
                    <div class="callout">
                        <p>You are logged in as
                            <b><?php echo htmlspecialchars( $_SESSION['username']) ?></b>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if (isset( $resultsSongs['errorMessage'] ) || isset( $resultsSongs['statusMessage'] ) ) {?>
        <?php if ( isset( $resultsSongs['errorMessage'] ) ) { ?>
            <section>
                <div class="row">
                    <div class="column small-12">
                        <div class="callout alert">
                            <p class="errorMessage"><?php echo $resultsSongs['errorMessage'] ?></p>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>

        <?php if ( isset( $resultsSongs['statusMessage'] ) ) { ?>
            <section>
                <div class="row">
                    <div class="column small-12">
                        <div class="callout success">
                            <p class="statusMessage"><?php echo $resultsSongs['statusMessage'] ?></p>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
    <?php } ?>

    <?php if (isset( $resultsAlbums['errorMessage'] ) || isset( $resultsAlbums['statusMessage'] ) ) {?>
        <?php if ( isset( $resultsAlbums['errorMessage'] ) ) { ?>
            <section>
                <div class="row">
                    <div class="column small-12">
                        <div class="callout alert">
                            <p class="errorMessage"><?php echo $resultsAlbums['errorMessage'] ?></p>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>

        <?php if ( isset( $resultsAlbums['statusMessage'] ) ) { ?>
            <section>
                <div class="row">
                    <div class="column small-12">
                        <div class="callout success">
                            <p class="statusMessage"><?php echo $resultsAlbums['statusMessage'] ?></p>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
    <?php } ?>

    <?php if (isset( $resultsAccounts['errorMessage'] ) || isset( $resultsAccounts['statusMessage'] ) ) {?>
        <?php if ( isset( $resultsAccounts['errorMessage'] ) ) { ?>
            <section>
                <div class="row">
                    <div class="column small-12">
                        <div class="callout alert">
                            <p class="errorMessage"><?php echo $resultsAccounts['errorMessage'] ?></p>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>

        <?php if ( isset( $resultsAccounts['statusMessage'] ) ) { ?>
            <section>
                <div class="row">
                    <div class="column small-12">
                        <div class="callout success">
                            <p class="statusMessage"><?php echo $resultsAccounts['statusMessage'] ?></p>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
    <?php } ?>

    <section>
        <div class="row">
            <div class="column small-12">
                <ul class="tabs dashboard-tabs row" data-active-collapse="true" data-tabs id="collapsing-tabs">
                    <li class="tabs-title small-12 medium-4 columns">
                        <a href="#panel1c" aria-selected="true">
                            <i class="fas fa-cogs"></i>
                            <p>Settings</p>
                        </a>
                    </li>
                    <li class="tabs-title small-12 medium-4 columns">
                        <a href="#panel2c">
                            <i class="fas fa-music"></i>
                            <p>Songs</p>
                        </a>
                    </li>
                    <li class="tabs-title small-12 medium-4 columns">
                        <a href="#panel3c">
                            <i class="fas fa-compact-disc"></i>
                            <p>Alben</p>
                        </a>
                    </li>
                </ul>
                <div class="tabs-content" data-tabs-content="collapsing-tabs">
                    <div class="tabs-panel" id="panel1c">
                        <div class="row">
                            <div  class="column small-12">
                                <a href="?action=newAccount" class="button alert">Neuer Account</a>
                            </div>
                        </div>
                        <div class="row">
                            <div  class="column small-12">
                                <table id="album-table">
                                    <tr>
                                        <td>Username</td>
                                        <td>Email</td>
                                        <td>Edit</td>
                                        <td>Delete</td>
                                    </tr>

                                    <?php include "templates/admin/listAccounts.php" ?>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tabs-panel" id="panel2c">
                        <div class="row">

                            <?php include "templates/admin/listSongs.php" ?>

                        </div>
                    </div>
                    <div class="tabs-panel" id="panel3c">
                        <div class="row">
                            <div  class="column small-12">
                                <table id="album-table">
                                    <tr>
                                        <td>Cover</td>
                                        <td>Title</td>
                                        <td>Datum</td>
                                        <td>Edit</td>
                                        <td>Delete</td>
                                    </tr>

                                        <?php include "templates/admin/listAlbums.php" ?>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include "templates/include/footer.php" ?>