<?php
namespace JasonKaz\FormBuild;

/**
 * Wrapper class to handle code generation
 */
class FormInput extends FormUtils	{
	protected $Code='';
	
	protected function render(){
		return $this->Code;
	}
}
?>
