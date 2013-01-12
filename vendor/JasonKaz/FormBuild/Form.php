<?php
namespace JasonKaz\FormBuild;

class Form extends FormInput{
    private $UseHead=false, $UseControlGroups=true;

    /**
     * Generates the top HTML for the form
     *
     * @param string $Action Where the form will go once submitted
     * @param string $Method How the form will be submitted
     * @param array $Attribs HTML attributes
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
     * @param string $Title
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
     * @param string $Label
     * @param object
     * @return Form
     */
    public function group($Label=''){
        if ($this->UseControlGroups)
            $this->Code.='<div class="control-group">';
        $Inputs=func_get_args();
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
     * @param object
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
}
?>