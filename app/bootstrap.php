<?php
// Load Config
require_once 'config/config.php';

//Load Helpers
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';
require_once 'helpers/jdf.php';
require_once "helpers/class.phpmailer.php";
require_once "helpers/class.smtp.php";

// Autoload Core Libraries
spl_autoload_register(function ($className){
    require_once 'libraries/'.$className.'.php';
});
