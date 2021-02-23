<section class="blur song-cover-listing">
    <div class="row">
        <?php $songs = $results['songs']; shuffle($songs); foreach ( $songs as $song ) { ?>
        <div class='column small-6 medium-4 large-3'>
            <div class='thumbnail-wrapper'>
                <a href=".?action=viewSong&amp;songId=<?php echo $song->id?>" class="thumbnail" title="<?php echo $song->title ?>">
                    <div>
                        <img alt="<?php echo $song->title ?>" src="assets/images/cover/<?php echo $song->cover ?>" title="<?php echo $song->title ?>">
                        <div class='thumbnail-slide'>
                            <div>
                                <span class='h4 small'><?php echo $song->title ?></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
          </div>
        <?php } ?>
    </div>
</section>
