<?php
namespace JasonKaz\FormBuild;

class File extends GeneralInput
{
    public function __construct($Attribs = [])
    {
        $this->Attribs = $Attribs;

        parent::__construct('file', $this->Attribs);
    }
}
