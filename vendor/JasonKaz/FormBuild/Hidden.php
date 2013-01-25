<?php
namespace JasonKaz\FormBuild;

/**
 * Creates a hidden input within the form
 * 
 * @deprecated 1.0.0 	Use Form->hidden(...) to now specify hidden inputs within the form
 */
class Hidden extends FormInput {
    public function __construct($Attribs=array()){
        $this->Code.='<input type="hidden"'.parent::parseAttribs($Attribs).' />';

        $this->Attribs=$Attribs;
    }
}
?>
