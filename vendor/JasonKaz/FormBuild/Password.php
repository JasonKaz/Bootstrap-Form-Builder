<?php
namespace JasonKaz\FormBuild;

class Password extends GeneralInput
{
    public function __construct($Attribs = [])
    {
        $this->Attribs = $Attribs;
        $this->setAttributeDefaults(['class' => 'form-control']);

        parent::__construct('password', $this->Attribs);
    }
}
