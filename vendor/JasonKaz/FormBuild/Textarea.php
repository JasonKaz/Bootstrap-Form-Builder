<?php
namespace JasonKaz\FormBuild;

class Textarea extends FormInput	{
	public function __construct($Value='', $Attribs=array()){
		$this->Code='<textarea'.parent::parseAttribs($Attribs).'>'.$Value.'</textarea>';
	}
}
?>
