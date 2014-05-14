<?php
/**
 * Created by PhpStorm.
 * User: Harry
 * Date: 11/05/14
 * Time: 10:41
 */

require_once "Controller.php";

class HomeController extends Controller {

    public function index(){

        $this->view->DisplayView("HomeView.php");
    }
} 