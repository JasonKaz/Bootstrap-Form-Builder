<?php
/*
@author Jason Kaczmarsky
*/

/**
 * Some helper functions for forms and inputs
 */
class FormUtils {
    protected $Attribs=array();

    /**
     * Parses an associative array and returns proper HTML equivalent for tags
     *
     * @param array $Attribs
     * @return string
     */
    protected function parseAttribs($Attribs){
        $Code='';

        foreach($Attribs as $key=>$val){
            switch ($key){
                case 'checked':
                    if ($val)
                        $Code.=' checked="checked"';
                    break;

                case 'autocomplete':
                    if (!$val)
                        $Code.=' autocomplete="off"';
                    break;

                case 'required':
                    if ($val)
                        $Code.=' required="required"';
                    break;

                case 'multiple':
                    if ($val)
                        $Code.=' multiple="multiple"';
                    break;

                default:
                    if ($key!='prepend' && $key!='append')
                        $Code.=' '.$key.'="'.$val.'"';
            }
        }

        return $Code;
    }

    /**
     * Generates the proper Bootstrap prepend HTML if necessary
     *
     * @param array $Attribs
     * @return string
     */
    protected function getPend1($Attribs){
        $Code='';
        $Prepend=isset($Attribs['prepend'])?$Attribs['prepend']:null;
        $Append=isset($Attribs['append'])?$Attribs['append']:null;

        if ($Prepend || $Append){
            $Code='<div class="';

            if ($Prepend)
                $Code.='input-prepend';

            if ($Append){
                if ($Prepend)
                    $Code.=' ';

                $Code.='input-append';
            }

            $Code.='">';

            if ($Prepend){
                if (is_string($Prepend))
                    $Code.='<span class="add-on">'.$Prepend.'</span>';
                else
                    $Code.=$Prepend->render();
            }
        }

        return $Code;
    }

    /**
     * Generates the proper Bootstrap append HTML if necessary
     *
     * @param array $Attribs
     * @return string
     */
    protected function getPend2($Attribs){
        if (isset($Attribs['append'])){
            if (is_string($Attribs['append']))
                return '<span class="add-on">'.$Attribs['append'].'</span></div>';
            else
                return ($Attribs['append']->render()).'</div>';
        }

        if (isset($Attribs['prepend']))
            return '</div>';

    }

    /**
     * Gets a single attribute value by name
     *
     * @param string $AttributeName
     * @return bool|null
     */
    protected function getAttrib($AttributeName){
        return isset($this->Attribs[$AttributeName])?$this->Attribs[$AttributeName]:null;
    }

    /**
     * Checks if a class already exists within the "class" attribute
     *
     * @param string $Needle
     * @return bool
     */
    protected function checkClassValue($Needle){
        if (isset($this->Attribs['class']))
            return in_array($Needle, explode(" ", $this->Attribs['class']));

        return false;
    }
}

/**
 * Constructs the main form container and aggregates all generated HTML from the inputs
 */
class Form extends FormUtils {
    private $Code='', $UseHead=false, $UseControlGroups=true;

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
            $this->Code.=$Inputs[$i]->render();

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

/**
 * Creates a text input
 */
class Text extends FormUtils  {
    private $Code='';

    public function __construct($Attribs=array()){
        $this->Code.=parent::getPend1($Attribs);
        $this->Code.='<input type="text"'.parent::parseAttribs($Attribs).' />';
        $this->Code.=parent::getPend2($Attribs);

        $this->Attribs=$Attribs;
    }

    function render(){
        return $this->Code;
    }
}

/**
 * Creates a password input
 */
class Password extends FormUtils    {
    private $Code='';

    public function __construct($Attribs=array()){
        $this->Code.=parent::getPend1($Attribs);
        $this->Code.='<input type="password"'.parent::parseAttribs($Attribs).' />';
        $this->Code.=parent::getPend2($Attribs);

        $this->Attribs=$Attribs;
    }

    function render(){
        return $this->Code;
    }
}

/**
 * Creates a checkbox input
 */
class Checkbox extends FormUtils    {
    private $Code='';

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

    function render(){
        return $this->Code;
    }
}

/**
 * Creates a radio input
 */
class Radio extends FormUtils   {
    private $Code;

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

    function render(){
        return $this->Code;
    }
}

/**
 * Creates a select input
 */
class Select extends FormUtils    {
    private $Code='';

    /**
     * Initializes the select
     *
     * @param array $Options Available options for the input
     * @param null|array $Selected The default selected option. Can be a single option or an array of options. Options start with an index of 0
     * @param array $Attribs
     */
    public function __construct($Options=array(), $Selected=null, $Attribs=array()){
        $this->Code.='<select';
        $this->Code.=parent::parseAttribs($Attribs);
        $this->Code.='>';

        //Convert $Selected to array if necessary
        $Selected=(array)$Selected;

        foreach($Options as $key=>$val){
            $this->Code.='<option value="'.$key.'"';

            if (in_array($key, $Selected, true))
                $this->Code.=' selected';

            $this->Code.='>'.$val.'</option>';
        }

        $this->Code.='</select>';

        $this->Attribs=$Attribs;
    }

    function render(){
        return $this->Code;
    }
}

/**
 * Creates help text for an input
 */
class Help  {
    private $Code='';

    /**
     * Generates help text
     *
     * @param string $Text
     * @param bool $Block If true, help text appears on its own line
     */
    public function __construct($Text, $Block=true){
        $this->Code.='<span class="help-'.(($Block)?'block':'inline').'">'.$Text.'</span>';
    }

    function render(){
        return $this->Code;
    }
}

/**
 * Creates a file input
 */
class File extends FormUtils    {
    private $Code='';

    public function __construct($Attribs=array()){
        $this->Code.='<input type="file"';
        $this->Code.=parent::parseAttribs($Attribs);
        $this->Code.=' />';

        $this->Attribs=$Attribs;
    }

    function render(){
        return $this->Code;
    }
}

/**
 * Creates a general button
 */
class Button extends FormUtils  {
    private $Code='';

    public function __construct($Label='Button', $Attribs=array('class'=>'btn', 'type'=>'submit')){
        $this->Attribs=$Attribs;

        //Add default classes that may have gotten overridden
        if (!$this->checkClassValue('btn'))
            $Attribs['class']='btn '.$Attribs['class'];

        $this->build($Label, $Attribs);
    }

    protected function build($Label, $Attribs){
        $this->Code.='<button ';
        $this->Code.=parent::parseAttribs($Attribs);
        $this->Code.='>'.$Label.'</button>';

        $this->Attribs=$Attribs;
    }

    function render(){
        return $this->Code;
    }
}

/**
 * Wrapper function for creating various input buttons
 * Use other classes (Submit, Reset, etc) to create specific input buttons
 */
class InputButton extends FormUtils {
    private $Code='';

    protected function build($Label='Button', $Attribs=array()){
        $this->Attribs=$Attribs;

        //Add default classes that may have gotten overridden
        if (!$this->checkClassValue('btn'))
            $Attribs['class']='btn '.$Attribs['class'];

        $this->Code.='<input value="'.$Label.'"';
        $this->Code.=parent::parseAttribs($Attribs);
        $this->Code.=' />';

        $this->Attribs=$Attribs;
    }

    function render(){
        return $this->Code;
    }
}

/**
 * Creates a submit input button
 */
class Submit extends InputButton {
    public function __construct($Label='Submit',$Attribs=array('class'=>'btn')){
        $Attribs['type']='submit';
        parent::build($Label, $Attribs);
    }
}

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
