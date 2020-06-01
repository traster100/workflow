<?php

class Controller_Offer extends Controller {

    function __construct() {
        $this->model = new Model_Offer();
        $this->view = new View();
    }

    function action_index() {
        $data = $this->model->get_data();
        $this->view->generate('offer.php', 'template.php', $data);
    }
}
