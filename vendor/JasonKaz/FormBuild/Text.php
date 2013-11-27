<?php
namespace JasonKaz\FormBuild;

class Text extends FormElement {
    public function __construct($Attribs=array()){
        $Attribs=$this->setAttributeDefaults($Attribs, array('class'=>'form-control'));

        $this->Code='<input type="text"'.$this->parseAttribs($Attribs).' />';
    }
}
