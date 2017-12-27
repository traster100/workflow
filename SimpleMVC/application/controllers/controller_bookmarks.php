<?php

class Controller_Bookmarks extends Controller {

    function action_index() {
        $this->view->generate('bookmarks.php', 'template.php');
    }
}
