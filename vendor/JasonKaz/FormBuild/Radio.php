<?php
namespace JasonKaz\FormBuild;

class Radio extends FormElement
{
    public function __construct($Text, $Inline, $Attribs = array(), $FormType, $LabelWidth)
    {
        $this->Attribs = $Attribs;

        if ($FormType === FormType::Horizontal) {
            $this->Code .= '<div class="col-sm-offset-' . $LabelWidth . ' col-sm-' . (12 - $LabelWidth) . '">';
        }

        if ($Inline === true) {
            $this->Code .= '<label class="radio-inline"';
        } else {
            $this->Code .= '<div class="radio"><label';
        }

        $this->Code .= '><input type="radio"' . $this->parseAttribs($this->Attribs) . ' /> ' . $Text . '</label>';

        if ($Inline === false) {
            $this->Code .= '</div> ';
        }

        if ($FormType === FormType::Horizontal) {
            $this->Code .= '</div>';
        }
    }
}
