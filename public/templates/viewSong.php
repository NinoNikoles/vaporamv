<?php include "templates/include/head.php" ?>
<?php include "templates/include/header.php" ?>
<?php $video = 1?>

<section>
    <div class="row">
        <div class="column small-12 medium-12 large-8">
           <div class='video'>
                    <div class='responsive-embed widescreen'><?php echo $results['song']->url?></div>
                        <h2><?php echo htmlspecialchars( $results['song']->title )?></h2>
                        <div class="row video-info-list">
                                <div class='datum small-6'>Veröffentlicht am <?php echo date('j F Y', $results['song']->publicationDate)?></div>
                                <div class='album small-6 text-right'><?php echo $results['song']->album ?></div>
                        </div>                      
                </div>

        </div>
        <div class="column small-12 medium-12 large-4 album-list">
            <h3><?php echo $results['song']->album ?></h3>
            <?php $i = 0; foreach ($resultsSongs['songs'] as $song) {
                if ($song->album == $results['song']->album & $song->id != $results['song']->id) {?>
                    <div class='thumbnail video-list-item next-video'>
                        <a href=".?action=viewSong&amp;songId=<?php echo $song->id ?>" class="video-link" title="<?php echo $song->title ?>">
                            <div class="row">
                                <div class="small-6 song-thumbnail">
                                    <img alt="<?php echo $song->thumbnail ?>" src="assets/images/thumbnails/<?php echo $song->thumbnail ?>" title="<?php echo $song->title ?>">
                                </div>
                                <div class="small-6 song-info">
                                    <h3><?php echo $song->title ?></h3>
                                    <ul class='video-info-list'>
                                        <li class='datum'>Veröffentlicht am <?php echo date('j F Y', $song->publicationDate)?></li>
                                        <li class='album'><?php echo $song->album ?></li>
                                    </ul>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php $i++;}
            }?>
            <?php if ($i == 0) {
                echo "<p>Keine Songs verfügbar!</p>";
            }?>
        </div>
    </div>
</section>

<?php include "templates/include/footer.php" ?>