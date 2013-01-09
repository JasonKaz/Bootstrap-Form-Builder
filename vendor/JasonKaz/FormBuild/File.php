<?php

namespace JasonKaz\FormBuild;

/**
 * Creates a file input
 */
class File extends FormUtils    {
    private $Code='';

    public function __construct($Attribs=array()){
        $this->Code.='<input type="file"';
        $this->Code.=parent::parseAttribs($Attribs);
        $this->Code.=' />';

        $this->Attribs=$Attribs;
    }

    function render(){
        return $this->Code;
    }
}
?>