<?php

class JCController {

    function exportToJSON($data){

        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT );
        exit();
    }

    function get($var){

        return isset($_GET[$var]) ? $_GET[$var] : '';
    }

    function post($var){

        return isset($_POST[$var]) ? $_POST[$var] : '';
    }

    function request($var){

        return isset($_REQUEST[$var]) ? $_REQUEST[$var] : '';
    }

    function postAll(){

        return $_POST;
    }
}