<?php 

require_once "../init.php";

if(input::exists()){
if(isset($_POST["search"]) &&  !empty($_POST["search"])) {
    $search = escape($_POST["search"]);
    $users = $LoadFromUser->search($search);
    if(count($users)=== 0){
        echo '<ul>
        <li class="mention_individuals">
        <div>No results found</div>
        </li>
        </ul>';
    }
    if(!empty($users)){
        echo '<ul>';
        foreach($users as $user){
            echo '<li class="mention_individuals">
            <a href="'.url_for('profile/'.$user->username).'" class=mention-link">
            <img  class="mention-image" src=" '.url_for($user->profileimage).'" alt="'.$user->username.'">
            <div class="mention-name">'.$user->username.'</div>
            </a>
            </li>';
        }
    }
          
        echo' </ul>';

}
}


