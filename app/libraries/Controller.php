<?php
/*
 * Base Controller
 * Loads the models and views
 */
date_default_timezone_set("Asia/Tehran");
class Controller{
    public function model($model,$dir=null)
    {
        // Require model file
        require_once '../app/models/'.$dir.$model.'.php';

        // Instantiate model
        return new $model();
    }

    //Load View
    public function View($view,$data=[])
    {
        //Check for View file
        if (file_exists('../app/views/'.$view.'.php')){
            require_once '../app/views/'.$view.'.php';
        }else{
            // View does not exist
            redirect('not');
        }
    }
    public function createUserSession($user)
    {
        $_SESSION['user_id']=$user->u_id;
        $_SESSION['user_email']=$user->email;
        $_SESSION['user_username']=$user->username;
        $_SESSION['user_type']=$user->type;
        $token= md5(uniqid(rand()));
        $_SESSION['csrf_token'] = $token ;
        if ($_SESSION['user_type']=="user"){
            redirect('users/dashboard');
        }elseif ($_SESSION['user_type']=="admin"){
            redirect('admin/dashboard');
        }elseif ($_SESSION['user_type']=="master"){
            redirect('master/dashboard');
        }elseif ($_SESSION['user_type']=="booster"){
            redirect('booster/dashboard');
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_username']);
        unset($_SESSION['user_type']);
        unset($_SESSION['csrf_token']);
        session_destroy();
        redirect('users/login');
    }

    public function userIsLoggedIn()
    {
        if (isset($_SESSION['user_id'])&& $_SESSION['user_type']=='user'){
            return true;
        }else{
            return false;
        }
    }

    public function adminIsLoggedIn()
    {
        if (isset($_SESSION['user_id'])&& $_SESSION['user_type']=='admin'){
            return true;
        }else{
            return false;
        }
    }

    public function Master()
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_type']=='master'){
            return true;
        }else{
            return false;
        }
    }

    public function boosterIsLoggedIn()
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_type']=='booster'){
            return true;
        }else{
            return false;
        }
    }


}