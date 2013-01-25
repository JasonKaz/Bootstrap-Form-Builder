<?php
namespace JasonKaz\FormBuild;

/**
 * Creates help text for an input
 */
class Help extends FormInput  {
    /**
     * Generates help text
     *
     * @param string $Text
     * @param bool $Block If true, help text appears on its own line
     */
    public function __construct($Text, $Block=true){
        $this->Code.='<span class="help-'.(($Block)?'block':'inline').'">'.$Text.'</span>';
    }
}
?>
