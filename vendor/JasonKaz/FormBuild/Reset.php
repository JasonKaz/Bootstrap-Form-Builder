<?php
namespace JasonKaz\FormBuild;

/**
 * Creates a reset input button
 */
class Reset extends InputButton  {
    public function __construct($Label='Reset',$Attribs=array('class'=>'btn')){
        $Attribs['type']='reset';
        parent::build($Label, $Attribs);
    }
}
?>
