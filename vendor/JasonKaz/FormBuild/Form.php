<?php
namespace JasonKaz\FormBuild;

final class FormType
{
    const Normal     = 0;
    const Inline     = 1;
    const Horizontal = 2;

    private function _construct()
    {
    }
}

class Form extends FormElement
{
    private $FormType, $LabelWidth = 2, $InputWidth = 10;

    /**
     * @param string $Action
     * @param string $Method
     * @param int    $FormType
     * @param array  $Attribs
     *
     * @return $this
     */
    public function init($Action = "#", $Method = "POST", $FormType = FormType::Normal, $Attribs = array())
    {
        $this->Attribs = $Attribs;
        $this->Code    = '<form role="form" action="' . $Action . '" method="' . $Method . '"';

        $this->FormType = $FormType;

        if ($this->FormType === FormType::Horizontal) {
            $this->setAttributeDefaults(array('class' => 'form-horizontal'));
        }

        if ($this->FormType === FormType::Inline) {
            $this->setAttributeDefaults(array('class' => 'form-inline'));
        }

        $this->Code .= $this->parseAttribs($this->Attribs) . '>';

        return $this;
    }

    /**
     * @param $LabelWidth
     * @param $InputWidth
     */
    public function setWidths($LabelWidth, $InputWidth)
    {
        $this->LabelWidth = $LabelWidth;
        $this->InputWidth = $InputWidth;
    }

    /**
     * @return $this
     */
    public function group()
    {
        $Args     = func_get_args();
        $ArgCount = sizeof($Args);
        $Start    = 0;

        if ((get_class($Args[0]) === "JasonKaz\\FormBuild\\Checkbox" && $this->FormType === FormType::Horizontal) || get_class($Args[0]) !== "JasonKaz\\FormBuild\\Checkbox") {
            $group_class = array("form-group");
            if (is_array($Args[$ArgCount - 1]) && isset($Args[$ArgCount - 1]['class'])) {
                $group_class = array_merge($group_class, explode(' ', $Args[$ArgCount - 1]['class']));
            }
            $this->Code .= '<div class="' . implode(' ', $group_class) . '">';
        }

        //Add the "for" attribute for inputs if there is only 1 and it has an id
        if ($ArgCount === 2 && $Args[1]->hasAttrib("id")) {
            $Args[0]->setAttrib("for", $Args[1]->getAttrib("id"));
        }

        for ($i = $Start; $i < $ArgCount; $i++) {
            if ($this->FormType == FormType::Horizontal && $i === 1 && get_class($Args[$i]) !== "JasonKaz\\FormBuild\\Checkbox") {
                $this->Code .= '<div class="col-sm-' . $this->InputWidth . '">';
            }

            if (gettype($Args[$i]) === "string") {
                $this->Code .= '<p class="help-block">' . $Args[$i] . '</p>';
            } else {
                $this->Code .= $Args[$i]->render();
            }

            if ($this->FormType == FormType::Horizontal && $i === $ArgCount - 1 && get_class($Args[$i]) !== "JasonKaz\\FormBuild\\Checkbox") {
                $this->Code .= '</div>';
            }
        }

        if ((get_class($Args[0]) === "JasonKaz\\FormBuild\\Checkbox" && $this->FormType === FormType::Horizontal) || get_class($Args[0]) !== "JasonKaz\\FormBuild\\Checkbox") {
            $this->Code .= '</div> ';
        }

        return $this;
    }

    /**
     * Generates the HTML required for a label
     *
     * @param string $Text
     * @param array  $Attribs
     * @param bool   $ScreenReaderOnly
     *
     * @return Label
     */
    public function label($Text, $Attribs = [], $ScreenReaderOnly = false)
    {
        return new Label($Text, $Attribs, $ScreenReaderOnly, $this->FormType, $this->LabelWidth);
    }

    /**
     * @param       $Text
     * @param       $Inline
     * @param array $Attribs
     *
     * @return Checkbox
     */
    public function checkbox($Text, $Inline, $Attribs = [])
    {
        return new Checkbox($Text, $Inline, $Attribs, $this->FormType, $this->LabelWidth);
    }

    /**
     * Defines hidden inputs within the form
     * Can accept a single array to create one input or a multidimensional array to create many inputs
     *
     * @param $Inputs        array        An array of arrays or an associative array that sets the inputs attributes
     *
     * @return Form
     */
    public function hidden($Inputs = [])
    {
        foreach ($Inputs as $i) {
            if (is_array($i)) {
                $this->Code .= '<input type="hidden"' . $this->parseAttribs($i) . ' />';
            } else {
                $this->Code .= '<input type="hidden"' . $this->parseAttribs($Inputs) . ' />';
                break;
            }
        }

        return $this;
    }
}
