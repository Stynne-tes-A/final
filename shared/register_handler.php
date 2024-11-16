<?php

if(loggedIn()){
    Redirect::to("index.php");
}

if(Input::exists()){
   if(isset($_POST['submitButton'])){
       $form_errors = array();
       $required_fields = array('email', 'full_name', 'username', 'password');
       
       $form_errors = array_merge($form_errors,check_empty_fields($required_fields));


       $fields_to_check_length = array('full_name' =>4, 'username' =>3, 'password' =>5);

 
       $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

      // $form_errors = array_merge($form_errors, check_max_length($fields_to_check_length));
       
      $form_errors = array_merge($form_errors, check_email($_POST));

      $rules=[
          'email' =>array("unique"=>"users"),
          'username' =>array("unique"=>"users"),
          'password' =>array("max"=>30)
      ];

      $account->check($_POST,$rules);

      if($account->passed()){
        if(empty($form_errors)){
            $username = escape($_POST['username']);
            $email = escape($_POST['email']);
            $fullName = escape($_POST['full_name']);
            $password = escape($_POST['password']);

            $user_id = $account->register_user($username,$email,$fullName,$password);
           if($user_id){
               session_regenerate_id();
               $_SESSION['user_id'] = $user_id;
               Redirect::to(url_for("index"));
           }
        else{
           $form_errors=array_merge($form_errors,$account->errors());
        }
   }}
    
}
       

   
};
$title = "Register + Momento";
$keywords = "Share your moments with momento";