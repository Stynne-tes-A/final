<?php

require_once "core/init.php";

if (!loggedIn()) {
    Redirect::to("login.php");
}


 $user=$LoadFromUser->getUserDataFromSession();
require "shared/header.php";


?>
<div class="profile-iser-id" data-userid="<?php echo $user->user_id; ?>"
data-profileid="<?php echo $user->user_id; ?>"></div>

<?php require "shared/global.header.php"; ?>
<script src="public/js/jquery.js"></script>              
<script src="public/js/important.js"></script>              