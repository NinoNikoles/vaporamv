<?php foreach ( $resultsAlbums['albums'] as $album ) { ?>
    <div class="column small-12">
        <h3><?php echo $album->title; ?></h3>
        <table id="video-table">
            <tr>
                <td>Cover</td>
                <td>Title</td>
                <td>Datum</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
            <?php foreach ( $resultsSongs['songs'] as $song ) { ?>
                <?php if ( $song->album == $album->title ) {?>
                <tr>
                    <td>
                        <img src="assets/images/cover/<?php echo $song->cover; ?>" title="<?php echo $song->title; ?>" alt="<?php echo $song->title; ?>">
                    </td>
                    <td><?php echo $song->title; ?></td>
                    <td><?php echo date('j M Y', $song->publicationDate)?></td>
                    <td>
                        <a href="?action=editSong&songId=<?php echo $song->id; ?>">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a href="?action=deleteSong&songId=<?php echo $song->id; ?>" onclick="return confirm('Delete This Song?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            <?php } ?>
        </table>
    </div>
<?php } ?>