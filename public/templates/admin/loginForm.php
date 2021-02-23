<?php include "templates/include/head.php" ?>
<?php include "templates/admin/include/header.php" ?>

<main>
    <?php if ( isset( $results['errorMessage'] ) ) { ?>
        <section>
            <div class="row">
                <div class="column small-12">
                    <div class="callout alert">
                        <p class="errorMessage"><?php echo $results['errorMessage'] ?></p>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <section>
        <div class="row">
            <div class="column small-12">
                <form action="admin.php?action=login" method="post">
                    <input type="hidden" name="login" value="true" />



                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Your admin username" required autofocus maxlength="20" />

                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Your admin password" required maxlength="20" />

                    <div class="buttons">
                        <input type="submit" class="button" value="Login" />
                    </div>

                </form>
            </div>
        </div>
    </section>
</main>

<?php include "templates/include/footer.php" ?>