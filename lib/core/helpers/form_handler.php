<?php
bu::lib("opt/html_form_persister/lib/HTML/SemiParser", "opt/html_form_persister/lib/HTML/FormPersister"); 
//ob_start(array('HTML_FormPersister', 'ob_formPersisterHandler'));
/*
include('lib/html_form_persister.php');
echo HtmlFormPersister::parse($html, array('foo'=>'Бла-бла-бла'));
*/
class FormHandler{
    private function __construct(){}
    public static function parse($html='',$array=false){
        $savedPOST = $_POST;
        $_POST = $array;
        $data = HTML_FormPersister::ob_formPersisterHandler($html);
        $_POST = $savedPOST;
        return $data;
    }
}
?>
