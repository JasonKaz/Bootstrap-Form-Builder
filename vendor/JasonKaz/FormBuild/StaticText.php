<?php


namespace JasonKaz\FormBuild;


class StaticText extends FormElement
{
    public function __construct($Text, $Attribs = [])
    {
        $this->Attribs = $Attribs;
        $this->setAttributeDefaults(['class' => 'form-control-static']);

        $this->Code = '<p' . $this->parseAttribs($this->Attribs) . '>' . $Text . '</p>';
    }
}
