<?php

namespace JasonKaz\FormBuild;

/**
 * Creates a general button
 */
class Button extends FormInput  {
    public function __construct($Label='Button', $Attribs=array('class'=>'btn', 'type'=>'submit')){
        $this->Attribs=$Attribs;

        //Add default classes that may have gotten overridden
        if (!$this->checkClassValue('btn'))
            $Attribs['class']='btn '.$Attribs['class'];

        $this->build($Label, $Attribs);
    }

    protected function build($Label, $Attribs){
        $this->Code.='<button ';
        $this->Code.=parent::parseAttribs($Attribs);
        $this->Code.='>'.$Label.'</button>';

        $this->Attribs=$Attribs;
    }
}
?>
