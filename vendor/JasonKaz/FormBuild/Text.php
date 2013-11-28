<?php
namespace JasonKaz\FormBuild;

class Text extends FormElement
{
    public function __construct($Attribs = [])
    {
        $this->Attribs = $Attribs;
        $this->setAttributeDefaults(['class' => 'form-control']);

        $this->Code = '<input type="text"' . $this->parseAttribs($this->Attribs) . ' />';
    }
}
