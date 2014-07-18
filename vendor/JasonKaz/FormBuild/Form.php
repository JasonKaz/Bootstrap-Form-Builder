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
        $Args         = func_get_args();
        $ArgCount     = sizeof($Args);
        $Start        = 0;
        $ArgClass     = get_class($Args[0]);
        $DoFormGroup  = (($ArgClass === "JasonKaz\\FormBuild\\Checkbox" || $ArgClass === "JasonKaz\\FormBuild\\Radio") && $this->FormType === FormType::Horizontal) || $ArgClass !== "JasonKaz\\FormBuild\\Checkbox";
        $DoInputWidth = false;

        if ($DoFormGroup) {
            $this->Code .= '<div class="form-group">';
        }

        //Add the "for" attribute for inputs if there is only 1 and it has an id
        if ($ArgCount === 2 && $Args[1]->hasAttrib("id")) {
            $Args[0]->setAttrib("for", $Args[1]->getAttrib("id"));
        }

        for ($i = $Start; $i < $ArgCount; $i++) {
            $ArgClass     = gettype($Args[$i]) !== "string" ? get_class($Args[$i]) : "";
            $DoInputWidth = $this->FormType === FormType::Horizontal && $ArgClass !== "JasonKaz\\FormBuild\\Checkbox" && $ArgClass !== "JasonKaz\\FormBuild\\Radio";

            if ($DoInputWidth && $i === 1) {
                $this->Code .= '<div class="col-sm-' . $this->InputWidth . '">';
            }

            if (gettype($Args[$i]) === "string") {
                $this->Code .= '<p class="help-block">' . $Args[$i] . '</p>';
            } elseif (is_object($Args[$i]) && method_exists($Args[$i], 'render')) {
                $this->Code .= $Args[$i]->render();
            }

            if ($DoInputWidth && $i === $ArgCount - 1) {
                $this->Code .= '</div>';
            }
        }

        $ArgClass    = get_class($Args[0]);
        $DoFormGroup = (($ArgClass === "JasonKaz\\FormBuild\\Checkbox" || $ArgClass === "JasonKaz\\FormBuild\\Radio") && $this->FormType === FormType::Horizontal) || $ArgClass !== "JasonKaz\\FormBuild\\Checkbox";
        if ($DoFormGroup) {
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
     * @param       $Text
     * @param       $Inline
     * @param array $Attribs
     *
     * @return Checkbox
     */
    public function radio($Text, $Inline, $Attribs = [])
    {
        return new radio($Text, $Inline, $Attribs, $this->FormType, $this->LabelWidth);
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
