<?php foreach ( $resultsAlbums['albums'] as $album ) { ?>
    <tr>
        <td>
            <img src='assets/images/albums/<?php echo $album->cover?>' title='<?php echo $album->title?>' alt='<?php echo $album->title?>'>
        </td>
        <td>
            <?php echo $album->title?>
        </td>
        <td>
            <?php echo date('j M Y', $album->publicationDate)?>
        </td>
        <td>
            <a href='?action=editAlbum&amp;albumId=<?php echo $album->id?>'>
                <i class="fas fa-edit"></i>
            </a>
        </td>
        <td>
            <a href='?action=deleteAlbum&amp;albumId=<?php echo $album->id?>'>
                <i class="fas fa-trash"></i>
            </a>
        </td>
    </tr>
<?php } ?>