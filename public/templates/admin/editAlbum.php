<?php include "templates/include/head.php" ?>
<?php include "templates/admin/include/header.php" ?>

<main>
    <section>
        <div class="row">
            <div class="column small-12">
                <form action="admin.php?action=<?php echo $results['formAction']?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="albumId" value="<?php echo $results['album']->id ?>"/>

                    <label for="title">Song Title</label>
                    <input type="text" name="title" id="title" placeholder="Name of the song" required autofocus value="<?php echo htmlspecialchars( $results['album']->title )?>" />

                    <?php if ($results['formAction'] == "newAlbum") { ?>
                        <label for="cover">Album Cover</label>
                        <input type="file" name="cover" class="button" id="cover" placeholder="The HTML content of the song" required value="<?php echo htmlspecialchars( $results['album']->cover) ?>">
                    <?php } ?>

                    <label for="publicationDate">Publication Date</label>
                    <input type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" required value="<?php echo $results['album']->publicationDate ? date( "Y-m-d", $results['album']->publicationDate ) : "" ?>" />

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
