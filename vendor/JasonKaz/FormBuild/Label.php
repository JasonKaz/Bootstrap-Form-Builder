<?php
namespace JasonKaz\FormBuild;

class Label extends FormElement
{
    private $Text, $ScreenReaderOnly;

    /**
     * @param string $Text
     * @param array  $Attribs
     * @param bool   $ScreenReaderOnly
     * @param        $FormType
     * @param        $LabelWidth
     */
    public function __construct($Text, $Attribs = [], $ScreenReaderOnly = false, $FormType, $LabelWidth)
    {
        $this->Attribs          = $Attribs;
        $this->Text             = $Text;
        $this->ScreenReaderOnly = $ScreenReaderOnly;

        if ($FormType === FormType::Horizontal) {
            $this->Attribs = $this->setAttributeDefaults(['class' => 'control-label col-sm-' . $LabelWidth]);
        }

        if ($FormType === FormType::Inline && $ScreenReaderOnly === true) {
            $this->Attribs = $this->setAttributeDefaults(['class' => 'sr-only']);
        }

        $this->Code='<label ' . $this->parseAttribs($this->Attribs) . '>' . $this->Text . '</label>';
    }
}
