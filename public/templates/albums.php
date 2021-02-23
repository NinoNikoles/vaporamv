<?php include "templates/include/head.php" ?>
<?php include "templates/include/header.php" ?>

<main>
    <section>
        <div class="row video-list">
            <div class="column small-12 video-list-item-container">
                <div class="row">
                    <?php foreach ( $results['albums'] as $album ) { ?>
                        <div class='small-6 medium-4 large-2'>
                            <div class='thumbnail video-list-item'>
                                <a href=".?action=viewAlbum&amp;albumId=<?php echo $album->id?>"  class="video-link" title="<?php echo htmlspecialchars( $album->title )?>">
                                    <img alt="<?php echo htmlspecialchars( $album->title )?>" src="assets/images/albums/<?php echo htmlspecialchars( $album->cover ) ?>" title="<?php echo htmlspecialchars( $album->title )?>">
                                    <h3><?php echo htmlspecialchars( $album->title )?></h3>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include "templates/include/footer.php" ?>
