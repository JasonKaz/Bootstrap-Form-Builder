<?php


namespace JasonKaz\FormBuild;


class Checkbox extends FormElement
{
    private $Text, $FormType, $Inline, $LabelWidth;

    public function __construct($Text, $Inline, $Attribs = array(), $FormType, $LabelWidth)
    {
        $this->Attribs    = $Attribs;
        $this->Text       = $Text;
        $this->FormType   = $FormType;
        $this->Inline     = $Inline;
        $this->LabelWidth = $LabelWidth;
    }

    public function render()
    {
        $Code = '';

        if ($this->FormType === FormType::Horizontal) {
            $Code .= '<div class="col-sm-offset-' . $this->LabelWidth . ' col-sm-' . (12 - $this->LabelWidth) . '">';
        }

        $Code .= '<div class="checkbox"><label><input type="checkbox"' . $this->parseAttribs($this->Attribs) . ' /> ' . $this->Text . '</label></div> ';

        if ($this->FormType === FormType::Horizontal) {
            $Code .= '</div>';
        }

        return $Code;
    }
}
