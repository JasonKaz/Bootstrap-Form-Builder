<?php
namespace JasonKaz\FormBuild;

class Label extends FormElement {
    public function __construct($Text, $Attribs=array(), $ScreenReaderOnly=false){
        $this->Code='<label '.$this->parseAttribs($Attribs).'>'.$Text.'</label>';
    }
}
