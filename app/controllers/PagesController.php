<?php
    class PagesController extends Controller {
        public function __construct() {

        }

        public function index() {
            $data = ['title' => 'Welcome'];
            $this->view('pages/index', $data );
        }

        public function about() {
          $data = ['title' => 'This is the About Page'];
          $this->view('pages/about', $data );
        }


    }
