<?php

/*
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT - /controller/method/params
 */

class Core
{
    protected $currentController = 'PagesController';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        //print_r($this->getUrl());
        $url = $this->getUrl();
        //Look in controllers for first value
        if (file_exists('../app/controllers/' . ucwords($url[0]) . 'Controller.php')) {
            //If exist, set as controller
            $this->currentController = ucwords($url[0]) . 'Controller';
            //unset 0 index
            unset($url[0]);
        } else {
            if (isset($url[0])) {
                $this->currentController = 'PagesController';
                //unset 0 index
                require_once '../app/controllers/' . $this->currentController . '.php';
                if (method_exists($this->currentController, $url[0])) {
                    $this->currentMethod = $url[0];

                    // Unset 1 index
                    unset($url[0]);
                }else{
                    $this->currentController = 'NotController';
                }

                // Unset 1 index
            }
        }

        /* if (file_exists('../app/controllers/' . ucwords($url[1]) . 'Controller.php')) {
             //If exist, set as controller
             $this->currentController = ucwords($url[1]).'Controller';
             //unset 0 index
             unset($url[1]);
         }*/
        //Require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        //Instantiate controller class
        $this->currentController = new $this->currentController;
        // Check for second part of url
        if (isset($url[1])) {
            //Check to see if method exists in controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];

                // Unset 1 index
                unset($url[1]);
            }
        }
        if (isset($url[2])) {
            //Check to see if method exists in controller
            if (method_exists($this->currentController, $url[2])) {
                $this->currentMethod = $url[2];

                // Unset 2 index
                unset($url[2]);
            }
        }
        /*
                if (isset($url[3])) {
                    //Check to see if method exists in controller
                    if (method_exists($this->currentController, $url[3])) {
                        $this->currentMethod = $url[3];

                        // Unset 3 index
                        unset($url[3]);
                    }
                }*/
        // Get params
        $this->params = $url ? array_values($url) : [];
        // Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }

    }
}