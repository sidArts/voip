<?php

class Home extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $this->layout->render("frontend/about");
    }
    public function search() {
//        $this->layout->render();
    }
    public function contact() {

        $this->layout->render('frontend/contact_us');
    }
}

?>