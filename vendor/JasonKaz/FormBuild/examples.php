<?php

namespace JasonKaz\FormBuild;

/**
 * Wrapper function for creating various input buttons
 * Use other classes (Submit, Reset, etc) to create specific input buttons
 */
class InputButton extends FormUtils {
    private $Code='';

    protected function build($Label='Button', $Attribs=array()){
        $this->Attribs=$Attribs;

        //Add default classes that may have gotten overridden
        if (!$this->checkClassValue('btn'))
            $Attribs['class']='btn '.$Attribs['class'];

        $this->Code.='<input value="'.$Label.'"';
        $this->Code.=parent::parseAttribs($Attribs);
        $this->Code.=' />';

        $this->Attribs=$Attribs;
    }

    function render(){
        return $this->Code;
    }
}
?>