<?php
namespace JasonKaz\FormBuild;

/**
 * Creates a general input using the following HTML:
 * 	<input type="[input type]" />
 */
class GeneralInput extends FormInput {
    protected function __construct($Type, $Attribs=array()){
        $this->Code.=parent::getPend1($Attribs);
        $this->Code.='<input type="'.$Type.'"'.parent::parseAttribs($Attribs).' />';
        $this->Code.=parent::getPend2($Attribs);
        $this->Attribs=$Attribs;
    }
}
?>
