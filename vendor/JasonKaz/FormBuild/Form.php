<?php
namespace JasonKaz\FormBuild;

class Form extends FormInput{
    private $UseHead=false, $UseControlGroups=true;

    /**
     * Generates the top HTML for the form
     *
     * @param string	$Action 	Where the form will go once submitted
     * @param string	$Method 	How the form will be submitted
     * @param array 	$Attribs 	HTML attributes for the form
     * @return Form
     */
    public function init($Action='#', $Method='POST', $Attribs=array()){
        $this->Attribs=$Attribs;

        $this->Code.='<form action="'.$Action.'" method="'.strtoupper($Method).'"';
        $this->Code.=parent::parseAttribs($Attribs);
        $this->Code.='>';

        if (!$this->checkClassValue('form-horizontal'))
            $this->UseControlGroups=false;

        return $this;
    }

    /**
     * Generates the form inputs within a fieldset and provides a title for the form
     * OPTIONAL FOR ALL FORMS
     *
     * @param string	$Title
     * @return Form
     */
    public function head($Title){
        $this->UseHead=true;

        $this->Code.='<fieldset><legend>'.$Title.'</legend>';

        return $this;
    }

    /**
     * Creates a grouping of inputs with a given $Label
     * A group can contain any number of inputs
     *
     * @param string			$Label	The text to label the group
     * @param form input object			Can be any form input object within the FormBuild package
     * @return Form
     */
    public function group($Label=''){
        $Inputs=func_get_args();
        if ($this->UseControlGroups)
        {
            $ValidationState = '';
            foreach ($Inputs as $index=>$Input) if($index > 0 && is_string($Input))
            {
                $ValidationState = $Input;
                unset($Inputs[$index]);
            }
            $this->Code.='<div class="control-group '.$ValidationState.'">';
            // Reset index
            $Inputs = array_values($Inputs);
        }
        $Size=count($Inputs)-1;

        if ($Label){
            $this->Code.='<label';
            if ($this->UseControlGroups)
                $this->Code.=' class="control-label"';
            if ($Size==1 && $Inputs[1]->getAttrib('id')!=null)
                $this->Code.=' for="'.$Inputs[1]->getAttrib('id').'"';

            $this->Code.='>'.$Label.'</label>';
        }
        if ($this->UseControlGroups)
            $this->Code.='<div class="controls">';

        for($i=1; $i<$Size+1; $i++)
            $this->Code.=$Inputs[$i]->render().' ';

        if ($this->UseControlGroups)
            $this->Code.='</div></div>';

        $this->Code.="\n";

        return $this;
    }

    /**
     * Creates a form-actions element that contains the form actions
     * The actions element can have any number of actions
     *
     * @param form input object		Can be any form input object within the FormBuild package, but should be some type of button
     * @return Form
     */
    public function actions(){
        $this->Code.='<div class="form-actions">';

        $Inputs=func_get_args();
        for($i=0, $Size=count($Inputs); $i<$Size; $i++){
            $this->Code.=$Inputs[$i]->render();
        }

        $this->Code.='</div>';

        return $this;
    }

    /**
     * Ends the form, returning the generated HTML for it
     *
     * @return string
     */
    public function render(){
        if ($this->UseHead)
            $this->Code.='</fieldset>';
        $this->Code.='</form>'."\n";

        return $this->Code;
    }
	
	/**
	 * Defines hidden inputs within the form
	 * Can accept a single array to create one input or a multidimensional array to create many inputs
	 * 
	 * @param $Inputs	array	An array of arrays or an associative array that sets the inputs attributes
	 * @return Form
	 */
	public function hidden($Inputs=array()){
		foreach($Inputs as $i){
			if (is_array($i)){
				$this->Code.='<input type="hidden"'.parent::parseAttribs($i).' />';
			}else{
				$this->Code.='<input type="hidden"'.parent::parseAttribs($Inputs).' />';
				break;
			}
		}

		return $this;
	}
}
?>
