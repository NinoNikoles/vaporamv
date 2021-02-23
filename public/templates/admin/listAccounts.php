<?php foreach ( $resultsAccounts['accounts'] as $account ) { ?>
    <tr>
        <td>
            <?php echo $account->username?>
        </td>
        <td>
            <?php echo $account->email?>
        </td>
        <td>
            <a href='?action=editAccount&amp;accountId=<?php echo $account->id?>'>
                <i class="fas fa-edit"></i>
            </a>
        </td>
        <td>
            <a href='?action=deleteAccount&amp;accountId=<?php echo $account->id?>'>
                <i class="fas fa-trash"></i>
            </a>
        </td>
    </tr>
<?php } ?>