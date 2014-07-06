<?php
namespace JasonKaz\FormBuild;

class Textarea extends FormElement
{
    public function __construct($Content = '', $Attribs = array())
    {
        $this->Attribs = $Attribs;
        $this->setAttributeDefaults(['class' => 'form-control']);

        $this->Code = '<textarea' . $this->parseAttribs($this->Attribs) . '>' . $Content . '</textarea>';
    }
}
