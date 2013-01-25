<?php

namespace JasonKaz\FormBuild;

/**
 * Creates a radio input
 */
class Radio extends FormInput  {
    /**
     * Initializes a radio button
     *
     * @param string $Label Text associated with the button
     * @param array $Attribs
     * @param bool $Inline If true, appears on the same line as other radio buttons in the same group
     */
    public function __construct($Label='', $Attribs=array(), $Inline=false){
        $this->Code.='<label class="radio';
        if ($Inline)
            $this->Code.=' inline';
        $this->Code.='"><input type="radio"';
        $this->Code.=parent::parseAttribs($Attribs);
        $this->Code.=' />'.$Label.'</label>';

        $this->Attribs=$Attribs;
    }
}
?>
