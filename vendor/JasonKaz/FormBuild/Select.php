<?php


namespace JasonKaz\FormBuild;


class Select extends FormElement
{
    public function __construct($Options = [], $SelectedOption = null, $Attribs = [])
    {
        $this->Attribs = $Attribs;
        $this->setAttributeDefaults(['class' => 'form-control']);

        $this->Code .= '<select';
        $this->Code .= $this->parseAttribs($this->Attribs);
        $this->Code .= '>';

        //Convert $SelectedOption to array if necessary
        if (!is_array($SelectedOption)) {
            $SelectedOption = (array)$SelectedOption;
        }

        foreach ($Options as $key => $val) {
            $this->Code .= '<option value="' . $key . '"';

            if (in_array($key, $SelectedOption, true)) {
                $this->Code .= ' selected';
            }

            $this->Code .= '>' . $val . '</option>';
        }

        $this->Code .= '</select>';
    }
}
