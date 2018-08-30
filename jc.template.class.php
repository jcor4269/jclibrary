<?php

class JCTemplate {

    var $body = "";
    var $customCSS = "";
    var $customJS = "";

    function addHTML($html){

        $this->body .= $html;
    }

    function startHTML(){

        ob_start();
    }

    function endHTML(){

        $html = ob_get_contents();
        ob_clean();
        $this->addHTML($html);
    }

    function output(){

        $template = $this;
        include_once('template.php');
    }

    function addCustomCSS($css){

        $this->customCSS .= ' '.$css;
    }

    function addCustomJS($js){

        $this->customJS .= ' '.$js;
    }
}