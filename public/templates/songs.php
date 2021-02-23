<?php include "templates/include/head.php" ?>
<?php include "templates/include/header.php" ?>

<main>
    <section>
        <div class="row">
            <div class="column small-12">
                <ul class="accordion" data-accordion data-multi-expand="true" data-allow-all-closed="true">
                    <li class="accordion-item video-list is-active" data-accordion-item>

                        <a href="#" class="h3 category-title accordion-title">Neu</a>

                        <div class="video-list accordion-content" data-tab-content>
                            <div class="row video-list-item-container">
                                <?php $a=0; foreach ( $resultsNewSongs['songs'] as $song ) { ?>
                                        <?php if( $a == 12 ) {
                                                break;
                                            }
                                        ?>

                                        <div class='small-6 medium-4 large-2'>
                                            <div class='thumbnail video-list-item'>
                                                <a href=".?action=viewSong&amp;songId=<?php echo $song->id?>"  class="album-link" title="<?php echo htmlspecialchars( $song->title )?>">
                                                    <img alt="<?php echo htmlspecialchars( $song->title )?>" src="assets/images/thumbnails/<?php echo htmlspecialchars( $song->thumbnail ) ?>" title="<?php echo htmlspecialchars( $song->title )?>">
                                                    <h3><?php echo htmlspecialchars( $song->title )?></h3>
                                                </a>
                                            </div>
                                          </div>
                                <?php $a++; } ?>
                            </div>
                        </div>
                    </li>

                    <?php foreach ( $resultsAlbums['albums'] as $album ) { ?>
                    <?php if ($album->id == 0 || $album->id == null) { break;}?>
                    <li class="accordion-item video-list is-active" data-accordion-item>

                        <a href="#" class="h3 category-title accordion-title"><?php echo htmlspecialchars( $album->title )?></a>

                        <div class="video-list accordion-content" data-tab-content>
                            <div class="row video-list-item-container">
                                <?php $i = 0; foreach ( $results['songs'] as $song ) { ?>
                                    <?php if ($song->album == $album->title) {?>

                                        <div class='small-6 medium-4 large-2'>
                                            <div class='thumbnail video-list-item'>
                                                <a href=".?action=viewSong&amp;songId=<?php echo $song->id?>"  class="album-link" title="<?php echo htmlspecialchars( $song->title )?>">
                                                    <img alt="<?php echo htmlspecialchars( $song->title )?>" src="assets/images/thumbnails/<?php echo htmlspecialchars( $song->thumbnail ) ?>" title="<?php echo htmlspecialchars( $song->title )?>">
                                                    <h3><?php echo htmlspecialchars( $song->title )?></h3>
                                                </a>
                                            </div>
                                        </div>
                                    <?php $i++;}
                                } ?>
                                <?php if ($i == 0) {?>
                                    <div class='small-12'>
                                        <p>Keine Songs verfügbar!</p>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </section>
</main>

<?php include "templates/include/footer.php" ?>