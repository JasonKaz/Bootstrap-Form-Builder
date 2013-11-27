<?php
namespace JasonKaz\FormBuild;

class FormElement extends FormUtils {
    protected $Code="";

    public function render(){
        return $this->Code;
    }
}
