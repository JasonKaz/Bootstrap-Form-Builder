<?php
namespace JasonKaz\FormBuild;

class FormUtils
{
    protected function classExists($ClassString, $ClassToCheck)
    {
        return in_array($ClassToCheck, explode(" ", $ClassString));
    }

    protected function addClass($ClassString, $ClassToAdd)
    {
        if (!self::classExists($ClassString, $ClassToAdd)) {
            return $ClassString . ' ' . $ClassToAdd;
        }

        return $ClassString;
    }

    protected function parseAttribs($Attribs = [])
    {
        $Str = "";

        $Properties = ['disabled', 'readonly', 'multiple', 'checked', 'required', 'autofocus'];

        foreach ($Attribs as $key => $val) {
            if (in_array($key, $Properties)) {
                if ($val === true) {
                    $Str .= ' ' . strtolower($key);
                }
            } else {
                $Str .= ' ' . $key . '="' . $val . '"';
            }
        }

        return $Str;
    }
}
