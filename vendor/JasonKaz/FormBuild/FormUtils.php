<?php
namespace JasonKaz\FormBuild;

class FormUtils {
    protected function setAttributeDefaults($SourceAttribs, $DefaultAttribs){
        foreach($DefaultAttribs as $k=>$v){
            if (!array_key_exists($k, $SourceAttribs)){
                $SourceAttribs[$k]=$v;
            }else{
                $SourceAttribs[$k].=' '.$v;
            }
        }

        return $SourceAttribs;
    }

    protected function classExists($ClassString, $ClassToCheck){
        return in_array($ClassToCheck, explode(" ", $ClassString));
    }

    protected function addClass($ClassString, $ClassToAdd){
        if (!self::classExists($ClassString, $ClassToAdd)){
            return $ClassString.' '.$ClassToAdd;
        }

        return $ClassString;
    }

    protected function parseAttribs($Attribs=array()){
        $Str="";

        foreach ($Attribs as $key=>$val){
            $Str.=' '.$key.'="'.$val.'"';
        }

        return $Str;
    }
}
