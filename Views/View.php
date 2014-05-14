<?php

// Validation.php
// By Harry Winser 10016143
// 
// Finds the correct view to output to the user, such as the correct JSON

class View {

    public function DisplayView($viewName) {
        $fullViewName = $this->_findVew($viewName);
        $this->_buildView($fullViewName);
    }

    public function DisplayFragment($viewName){
        $fullViewName = $this->_findVew($viewName);

        if (isset($_SESSION["userID"])) {
            try{

                include $fullViewName;

            }catch(Exception $ex){
                $this->DisplayJSONErrorView($ex);
            }
        }
    }

    public function DisplayJSONView($viewName) {
        $fullJsonName = $this->_findJSONView($viewName);
        $this->_buildJSONView($fullJsonName);
    }

    public function DisplayJSONErrorView($exception){
        header("Content-type: application/json");
        try{
            // Differnet headers based on the code given
            $this->_setErrorHeader($exception->getCode());


            $_SESSION["exception"] = $exception;
            require "../Views/Errors/JsonError.php";
        }catch(Exception $ex){
            echo $ex->getMessage();
        }
    }

    public function DisplayImage($src, $extension){
        header('Content-Type: image/'.$extension);
        readfile($src);
        exit;
    }

    private function _setErrorHeader($errorCode){
        switch($errorCode){
            case 400:
                header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request', true, 401);
                break;
            case 401:
                header($_SERVER['SERVER_PROTOCOL'] . ' 401 Unauthorized', true, 401);
                break;
            case 404:
                header($_SERVER['SERVER_PROTOCOL'] . ' 404 Resource Not Found', true, 404);
                break;
            case 500:
                header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
                break;
            default:
                header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
                break;
        }
    }

    private function _findVew($viewName) {
        return "../Views/PartialViews/" . $viewName;
    }

    private function _buildView($fullViewName) {
        try{
            include "../Views/Fragments/HeaderFragment.php";

            include $fullViewName;

            include "../Views/Fragments/FooterFragment.php";
        }catch(Exception $ex){
            $this->DisplayJSONErrorView($ex);
        }
    }

    private function _findJSONView($viewName) {
        return "../Views/JSONViews/" . $viewName;
    }

    private function _buildJSONView($fullViewName) {
        header("Content-type: application/json");
        include $fullViewName;
    }

}
