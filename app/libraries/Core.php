<?php
    /*
     * App Core Class
     * Creates URL and loads core controller
     * URL Format - /controller/method/params
     */

    class Core {
        protected $currentController = 'PagesController';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct() {
            // print_r($this->getUrl());
            $url = $this->getUrl();
            $getController = '../app/controllers/' . ucwords($url[0]) . 'Controller.php';

            // Look in controllers for first value of the array.
            if(file_exists($getController)) {
                // If exists set this as the current controller
                $this->currentController = ucwords($url[0]). 'Controller';
                // Unset 0 index
                unset($url[0]);
            }

            // Require the controller
            require_once '../app/controllers/'. $this->currentController . '.php';

            //Instantiate controller class
            $this->currentController = new $this->currentController;

            // Chec for second part of url
            if(isset($url[1])) {
                // Check to see if method exists in controller
                if(method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    // Unset 1 Index
                    unset($url[1]);
                }
            }

            // Get params
            $this->params = $url ? array_values($url) : [];
            // call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl() {
            if(isset($_GET['url'])) {
                // remove '/' at the end of the url
                $url = rtrim($_GET['url'], '/');
                // remove unecessary elements inside the url
                $url = filter_var($url, FILTER_SANITIZE_URL);
                // make the url an array for segregation
                $url = explode('/', $url);
                return $url;
            }
        }
    }
