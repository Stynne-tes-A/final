<?php
require_once "core/init.php";
require_once "shared/login_handler.php";
require "shared/header.php";
?>
    <section class="pageContainer">
        <main class="row">
            <div class="heroImg"></div>
            <div class="col-1">
            </div>
            <article class="col-2">
            <?php
                if(!empty($form_errors)){
                    echo show_errors($form_errors);
                }
                ?>
                <form  action="<?= h($_SERVER['PHP_SELF']); ?>" method="POST" class="form">
                    <div class="siteLogoContainer">
                        <img src="public/assets/images/logo/logo.png" alt="Momento">
                    </div>
                    <input type="text" placeholder="Email or Username" class="form--input" name="email_username" value="<?= escape(Input::get('email_username'));?>">
                    <div class="passwordContainer">
                    <input type="password" placeholder="password" class="form--input" name="password" id=
                    "password">
                    <span class="show_hide_text cursor-pointer" id="show_hide_password">Show</span>
                    </div>
                    <button type="submit" class="button cursor-pointer" name="submitButton">Login</button>
                    <span class="separator">or</span>
                    <a href="#" class="password_reset">Forgot Password></a>
                </form>
                <footer class="form--footer">
                    <span>Don't have an account? <a href="register">sign up</a></span>
                </footer>
            </article>
        </main>
    </section>

    <script src="public/js/common.js"></script>
    
</body>
</html>