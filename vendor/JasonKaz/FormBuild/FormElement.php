<?php
namespace JasonKaz\FormBuild;

class FormElement extends FormUtils
{
    protected $Code = "", $Attribs = array();

    public function render()
    {
        return $this->Code;
    }

    protected function setAttributeDefaults($DefaultAttribs){
        foreach($DefaultAttribs as $k=>$v){
            if (!array_key_exists($k, $this->Attribs)){
                $this->Attribs[$k]=$v;
            }else{
                $this->Attribs[$k].=' '.$v;
            }
        }

        return $this->Attribs;
    }

    protected function hasAttrib($Attrib)
    {
        return isset($this->Attribs[$Attrib]) && $this->Attribs[$Attrib] != "";
    }

    protected function getAttrib($Attrib)
    {
        return $this->Attribs[$Attrib];
    }

    protected function setAttrib($Attrib, $Value)
    {
        $this->Attribs[$Attrib] = $Value;
    }

    protected function addAttrib($Attrib, $Value)
    {
        $this->Attribs[$Attrib] .= " " . $Value;
    }
}
