<?php
namespace JasonKaz\FormBuild;

/**
 * Creates a checkbox input
 */
class Checkbox extends FormInput   {
    /**
     * Initializes the checkbox
     *
     * @param string $Label Text associated with the checkbox
     * @param array $Attribs
     * @param bool $Inline If true, appears on the same line as other checkboxes in the group
     */
    public function __construct($Label='', $Attribs=array(), $Inline=false){
        $this->Code.='<label class="checkbox';
        if ($Inline)
            $this->Code.=' inline';
        $this->Code.='"><input type="checkbox"';
        $this->Code.=parent::parseAttribs($Attribs);
        $this->Code.=' />'.$Label.'</label>';

        $this->Attribs=$Attribs;
    }
}
?>
