<?php
namespace JasonKaz\FormBuild;

final class FormType {
    private function _construct(){}

    const Normal=0;
    const Inline=1;
    const Horizontal=2;
}

class Form extends FormElement {
    private $FormType;

    public function init($Action="#", $Method="POST", $FormType=FormType::Normal, $Attribs=array()){
        $this->Code='<form role="form" action="'.$Action.'" method="'.$Method.'"';

        $this->FormType=$FormType;

        if ($this->FormType===FormType::Horizontal){
            $Attribs=$this->setAttributeDefaults($Attribs, array('class'=>'form-horizontal'));
        }

        if ($this->FormType===FormType::Inline){
            $Attribs=$this->setAttributeDefaults($Attribs, array('class'=>'form-inline'));
        }

        $this->Code.=$this->parseAttribs($Attribs).'>';

        return $this;
    }

    public function group($Label){
        $Args=func_get_args();
        $Start=0;

        $this->Code.='<div class="form-group">';

        /*if (gettype($Args[0])==="string"){
            $this->Code.=$Args[0];
            $Start=1;
        }*/

        for($i=$Start;$i<sizeof($Args);$i++){
            $this->Code.=$Args[$i]->render();
        }

        $this->Code.='</div>';

        return $this;
    }

    public function label($Text, $Attribs=array(), $ScreenReaderOnly=false){
        if ($this->FormType===FormType::Horizontal){
            $Attribs=$this->setAttributeDefaults($Attribs, array('class'=>'control-label'));
        }

        if ($this->FormType===FormType::Inline && $ScreenReaderOnly===true){
            $Attribs=$this->setAttributeDefaults($Attribs, array('class'=>'sr-only'));
        }

        return new Label($Text, $Attribs, $ScreenReaderOnly);
    }
}
