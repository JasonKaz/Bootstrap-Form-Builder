<?php
namespace JasonKaz\FormBuild;

/**
 * Creates a email input
 * HTML5 Input Type
 * @link http://www.w3schools.com/html/html5_form_input_types.asp
 */
class Email extends GeneralInput {
    public function __construct($Attribs=array()){
    	parent::__construct('email', $Attribs);
    }
}
?>
