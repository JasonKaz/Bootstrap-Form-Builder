<?php
namespace JasonKaz\FormBuild;

/**
 * Creates a submit input button
 */
class Submit extends InputButton {
    public function __construct($Label='Submit',$Attribs=array('class'=>'btn')){
        $Attribs['type']='submit';
        parent::build($Label, $Attribs);
    }
}
?>
