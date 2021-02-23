<?php include "templates/include/head.php" ?>
<?php include "templates/admin/include/header.php" ?>

    <main>
        <section>
            <div class="row">
                <div class="column small-12">
                    <form action="admin.php?action=<?php echo $results['formAction']?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="accountId" value="<?php echo $results['account']->id ?>"/>

                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="Name of the song" required autofocus value="<?php echo htmlspecialchars( $results['account']->username )?>" />

                        <label for="firstname">Name</label>
                        <input type="text" name="firstname" id="firstname" placeholder="Name of the song" required value="<?php echo htmlspecialchars( $results['account']->firstname )?>" />

                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" id="lastname" placeholder="Name of the song" required value="<?php echo htmlspecialchars( $results['account']->lastname )?>" />

                        <label for="email">email</label>
                        <input type="email" name="email" id="email" placeholder="Name of the song" required value="<?php echo htmlspecialchars( $results['account']->email )?>" />

                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Name of the song" required value="<?php echo htmlspecialchars( $results['account']->password )?>" />

                        <div class="buttons">
                            <input type="submit" name="saveChanges" class="button success" value="Register" />
                            <a href="admin.php" class="button alert">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </section>
    </main>

<?php include "templates/include/footer.php" ?><?php
