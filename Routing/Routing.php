<?php
/**
 * Created by PhpStorm.
 * User: Harry
 * Date: 11/05/14
 * Time: 10:37
 */

//Calls the correct controller based on what's given in the URL
session_start();

$controllerName = $_GET["controller"];
$action = $_GET["action"];
include '../Controllers/'.$controllerName.'Controller.php';

$controllerFull = $controllerName."Controller";
$controller = new $controllerFull();
$controller->PerformResponse($action);