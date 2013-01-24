<?php
namespace JasonKaz\FormBuild;

/**
 * Creates a email input
 * HTML5 Input Type
 * @link http://www.w3schools.com/html/html5_form_input_types.asp
 */
class Email extends FormInput {
    public function __construct($Attribs=array()){
        $this->Code.=parent::getPend1($Attribs);
        $this->Code.='<input type="email"'.parent::parseAttribs($Attribs).' />';
        $this->Code.=parent::getPend2($Attribs);
        $this->Attribs=$Attribs;
    }
}
?>
