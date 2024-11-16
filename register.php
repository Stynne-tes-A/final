<?php
require_once "core/init.php";
require_once "shared/register_handler.php";
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
                <form action="<?= h($_SERVER['PHP_SELF']); ?>" method="POST" class="form">
                    <div class="siteLogoContainer">
                        <img src="public/assets/images/logo/logo.png" alt="Momento">
                    </div>
                    <input type="email" placeholder="Email" class="form--input" name="email" autocomplete="off" value="<?= escape(Input::get('email')); ?>">
                    <input type="text" placeholder="Full Name" class="form--input" name="full_name" autocomplete="off" value="<?= escape(Input::get('full_name'));?>">
                    <input type="text" placeholder="Username" class="form--input" name="username" autocomplete="off" value="<?= escape(Input::get('username'));?>">
                  
                    <div class="passwordContainer">
                    <input type="password" placeholder="password" class="form--input" name="password" id=
                    "password" autocomplete= "new-password">
                    <span class="show_hide_text cursor-pointer" id="show_hide_password">Show</span>
                    </div>
                    <button type="submit" class="button cursor-pointer" name="submitButton">Register</button>
                    <span class="separator">or</span>
                    <span class="terms">By signing up you agree to our <a href="#">Terms & Conditions</a></span>
                </form>
                <footer class="form--footer">
                    <span> Have an account? <a href="login">Login</a></span>
                </footer>
            </article>
        </main>
    </section>

    <script src="public/js/common.js"></script>
</body>
</html>