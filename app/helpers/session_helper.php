<?php
session_start();

// Flash message helper
function flash($name='',$message='',$class='alert alert-success'){
    if (!empty($name)){
        if (!empty($message) && empty($_SESSION[$name])){
            if (!empty($_SESSION[$name])){
                unset($_SESSION[$name]);
            }
            if (!empty($_SESSION[$name.'_class'])){
                unset($_SESSION[$name.'_class']);
            }
            $_SESSION[$name]=$message;
            $_SESSION[$name.'_class']=$class;
        }elseif (empty($message) && !empty($_SESSION[$name])){
            $class=!empty($_SESSION[$name.'_class'])? $_SESSION[$name.'_class']:'';
            echo '<div class="'.$class.' alert-dismissible fade show" id="msg-flash" style="text-align:center;">'.$_SESSION[$name].'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button></div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name.'_class']);
        }
    }
}

