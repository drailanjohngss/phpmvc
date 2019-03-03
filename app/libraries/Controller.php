<?php
    /*
     * Base Controller
     * Loads the model and views
     */

    class Controller {
        // Load Model
        public function model($model) {
            // require model file
            require_once '../app/models' . $model . '.php';

            // Instantiate model
            return new $model();
        }

        // Load views
        public function view($view, $data = [] ){
            // Check for the view file
            if(file_exists('../app/views/' . $view . '.php')) {
                require_once '../app/views/' . $view . '.php';
            } else {
                // View does not exists
                die('View does not exists');
            }
        }
    }
