<?php

class Controller_search extends Controller {

    function __construct() {
        $this->model_search = new Model_Search();
        $this->view = new View();
    }

    function action_index() {
        var_dump($_GET);

        $countries_all = $this->model_search->countries_all();
        $categories_all = $this->model_search->categories_all();
        $vacancies_all = $this->model_search->vacancies_all($_GET);

        $this->view->generate(
            'search.php',
            'template.php',
            [
                'countries_all' => $countries_all,
                'categories_all' => $categories_all,
                'vacancies_all' => $vacancies_all,
            ]
        );
    }

    function action_ajax() {
        $method = $_POST['method'];
        $json = array(
            'status' => false,
            'answer' => false,
        );

        switch ($method) {
            case 'cities_all' :
                $cities_all = $this->model_search->cities_all($_POST['country_id']);
                if ($cities_all) {
                    $json = array(
                        'status' => true,
                        'answer' => $cities_all,
                    );
                }
                $this->_json_out($json);
                break;

            case 'subcategories_all' :
                $subcategories_all = $this->model_search->subcategories_all($_POST['category_id']);
                if ($subcategories_all) {
                    $json = array(
                        'status' => true,
                        'answer' => $subcategories_all,
                    );
                }
                $this->_json_out($json);
                break;

        }
    }

    public function _json_out($json) {
        header("Content-type: application/json; charset=utf-8");
        header("Pragma: no-cache");
        echo json_encode($json);
    }
}
