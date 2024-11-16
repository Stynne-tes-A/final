<?php

require_once "core/init.php";
if(!loggedIn()){
    Redirect::to("login.php");
}

$user_id = $_SESSION["user_id"];

?>

<header class="global-header">
    <nav class="global-header__content">
        <div class="global-header__content__buttons">
            <a href="<?php echo url_for('index'); ?>" class="header__home"></a>
        </div>
    </nav>
</header>