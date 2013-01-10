<?php

namespace JasonKaz\FormBuild;

/**
 * Creates a way to insert any HTML into the form
 */
class Custom extends FormUtils   {
    private $Code;

    /**
     * Inserts the given code into the form
     *
     * @param string $Code	The code to be inserted
     */
    public function __construct($Code=''){
        $this->Code=$Code;
    }

    function render(){
        return $this->Code;
    }
}
?>