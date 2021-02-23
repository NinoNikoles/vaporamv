<?php include "templates/include/head.php" ?>
<?php include "templates/admin/include/header.php" ?>

<main>
    <section>
        <div class="row">
            <div class="column small-12">
                <form action="admin.php?action=<?php echo $results['formAction']?>" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="songId" value="<?php echo $results['song']->id ?>"/>

                    <label for="title">Song Title</label>
                    <input type="text" name="title" id="title" placeholder="Name of the song" required autofocus value="<?php echo htmlspecialchars( $results['song']->title )?>" />

                    <label for="urlid">Video ID</label>
                    <input type="text" name="urlid" id="urlid" placeholder="Brief description of the song" required value="<?php echo htmlspecialchars( $results['song']->urlid ) ?>">

                    <?php if ($results['formAction'] == "newSong") { ?>
                        <label for="cover">Song Cover</label>
                        <input type="file" name="cover" class="button" id="cover" placeholder="The HTML content of the song" required value="<?php echo htmlspecialchars( $results['song']->cover) ?>">


                        <label for="thumbnail">Song Thumbnail</label>
                        <input type="file" name="thumbnail" class="button" id="thumbnail" placeholder="The HTML content of the song" required value="<?php echo htmlspecialchars( $results['song']->thumbnail) ?>" >
                    <?php } ?>

                    <label for="publicationDate">Publication Date</label>
                    <input type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" required value="<?php echo $results['song']->publicationDate ? date( "Y-m-d", $results['song']->publicationDate ) : "" ?>" />

                    <label for="album">Song Album</label>
                    <select name ="album" id="album"required>
                        <option selected="selected" disabled="disabled"></option>
                        <?php foreach ( $resultsAlbum['albums'] as $album ) {?>

                            <option <?php if ($results['song']->album == $album->title) {
                                echo 'selected="selected"';
                            }?> value="<?php echo $album->title ;?>"><?php echo $album->title ;?></option>
                        <?php }
                        ?>
                    </select>

                    <div class="buttons">
                        <input type="submit" name="saveChanges" class="button success" value="Save Changes" />
                        <a href="admin.php" class="button alert">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </section>
</main>

<?php include "templates/include/footer.php" ?><?php
