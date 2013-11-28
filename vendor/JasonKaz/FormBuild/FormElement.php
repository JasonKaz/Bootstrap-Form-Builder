<?php
namespace JasonKaz\FormBuild;

class FormElement extends FormUtils
{
    protected $Code = "", $Attribs = [];

    /**
     * @return string
     */
    public function render()
    {
        return $this->Code;
    }

    /**
     * @param $DefaultAttribs
     *
     * @return array
     */
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

    /**
     * @param $Attrib
     *
     * @return bool
     */
    protected function hasAttrib($Attrib)
    {
        return isset($this->Attribs[$Attrib]) && $this->Attribs[$Attrib] != "";
    }

    /**
     * @param $Attrib
     *
     * @return mixed
     */
    protected function getAttrib($Attrib)
    {
        return $this->Attribs[$Attrib];
    }

    /**
     * @param $Attrib
     * @param $Value
     */
    protected function setAttrib($Attrib, $Value)
    {
        $this->Attribs[$Attrib] = $Value;
    }

    /**
     * @param $Attrib
     * @param $Value
     */
    protected function addAttrib($Attrib, $Value)
    {
        $this->Attribs[$Attrib] .= " " . $Value;
    }
}
