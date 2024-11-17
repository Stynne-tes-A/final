<?php
require_once "core/init.php";
require "shared/header.php";

$title = "Page not found + Momento";
$keywords = "error,404,document was mot found,share your moments with momento";


?>
<header class="error--header">
    <div class="error--header--content">
        <div class="error--header--left">
            <a href="<?php echo url_for('index'); ?>" class="header__home-error">
                <img src="<?php echo url_for('public/assets/images/logo/logo.png'); ?>" alt="site logo">
            </a>
        </div>
        <div class="error--header-right">
            <?php if (loggedIn()) {
                ?>
                <a href="<?php echo url_for('profile'); ?>" class="profile_button">
                    Profile Page
                </a>
                <a href="<?php echo url_for('index'); ?>" class="error--link">
                    try Going to Home page
                </a>
                <?php
            } else {
                ?>
                <a href="<?php echo url_for('login'); ?>" class="error--link">
                    Login
                </a>
                <a href="<?php echo url_for('register'); ?>" class="error--link">
                    Register
                </a>
            <?php } ?>

        </div>
    </div>


</header>

<div class="error--container">
    <div class="error-content">
        <h1>Sorry this page isn't available</h1>
        <p>the page maybe you followed maybe broken,or the page may have been removed <a
                href="<?php echo url_for('index'); ?>">Go back to momento</a></p>
        <img src="<?php echo url_for('public/assets/images/logo/404.jpg'); ?>" alt="404">
    </div>
</div>