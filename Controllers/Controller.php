<?php
/**
 * Created by PhpStorm.
 * User: Harry
 * Date: 11/05/14
 * Time: 10:41
 */

require_once "../Views/View.php";

class Controller {

    protected $view;
    function __construct()
    {
        $this->view = new View();
    }

    public function PerformResponse($action)
    {
        $this->action = $action;
        $this->$action();
    }
} 