<?php
namespace JasonKaz\FormBuild;

class Text extends FormElement {
    public function __construct($Attribs=array()){
        $this->Attribs=$Attribs;
        $Attribs=$this->setAttributeDefaults(array('class'=>'form-control'));

        $this->Code='<input type="text"'.$this->parseAttribs($Attribs).' />';
    }
}
