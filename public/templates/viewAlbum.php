<?php include "templates/include/head.php" ?>
<?php include "templates/include/header.php" ?>

<main>
    <section>
        <div class="row album-list">
            <div class='column small-12 medium-8'>
                <?php foreach ($resultsSongs['songs'] as $song) {
                if ($song->album == $results['album']->title) {?>
                        <div class="thumbnail video-list-item">
                            <a href=".?action=viewSong&amp;songId=<?php echo $song->id?>" class="video-link" title="<?php echo htmlspecialchars( $song->title )?>">
                                <div class="row">
                                    <div class="small-6 medium-12 large-6 song-thumbnail">
                                        <img alt="<?php echo htmlspecialchars( $song->title )?>" src="assets/images/thumbnails/<?php echo htmlspecialchars( $song->thumbnail ) ?>" title="<?php echo htmlspecialchars( $song->title )?>">
                                    </div>
                                    <div class="small-6 medium-12 large-6 song-info">
                                        <h3><?php echo htmlspecialchars( $song->title )?></h3>
                                        <ul class='song-info-list'>
                                            <li class='datum'>Veröffentlicht am <?php echo date('j F Y', $song->publicationDate)?></li>
                                        </ul>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php }
                }?>
            </div>
            <div class="hide-for-small-only column medium-4">
                <div>
                    <img alt="<?php echo htmlspecialchars( $results['album']->title )?>" src="assets/images/albums/<?php echo htmlspecialchars( $results['album']->cover ) ?>" title="<?php echo htmlspecialchars( $results['album']->title )?>">
                </div>
            </div>
        </div>
    </section>
</main>

<?php include "templates/include/footer.php" ?>