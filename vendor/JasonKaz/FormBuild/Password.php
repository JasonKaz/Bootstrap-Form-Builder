<?php
namespace JasonKaz\FormBuild;

/**
 * Creates a password input
 */
class Password extends FormInput    {
    public function __construct($Attribs=array()){
        $this->Code.=parent::getPend1($Attribs);
        $this->Code.='<input type="password"'.parent::parseAttribs($Attribs).' />';
        $this->Code.=parent::getPend2($Attribs);

        $this->Attribs=$Attribs;
    }
}
?>
