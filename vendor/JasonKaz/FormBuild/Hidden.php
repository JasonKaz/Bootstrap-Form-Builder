<?php
namespace JasonKaz\FormBuild;

class Hidden extends FormInput {
    public function __construct($Attribs=array()){
        $this->Code.='<input type="hidden"'.parent::parseAttribs($Attribs).' />';

        $this->Attribs=$Attribs;
    }
}
?>