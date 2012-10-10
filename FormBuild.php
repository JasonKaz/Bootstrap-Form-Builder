<?php
/*
@author Jason Kaczmarsky
*/

class FormUtils {
    protected $Attribs=array();

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

    protected function getHelpText($HelpText){
        if ($HelpText)
            return '<p class="help-block">'.$HelpText.'</p>';
    }

    protected function getAttrib($AttributeName){
        return isset($this->Attribs[$AttributeName])?$this->Attribs[$AttributeName]:null;
    }
}

class Form extends FormUtils {
    private $Code='', $UseHead=false;

    public function init($Action='#', $Method='POST', $Attribs=array()){
        $this->Code.='<form action="'.$Action.'" method="'.strtoupper($Method).'"';
        $this->Code.=parent::parseAttribs($Attribs);
        $this->Code.='>';

        return $this;
    }

    public function head($Title){
        $this->UseHead=true;

        $this->Code.='<fieldset><legend>'.$Title.'</legend>';

        return $this;
    }

    public function group($Label=''){
        $this->Code.='<div class="control-group">';
        $Inputs=func_get_args();
        $Size=count($Inputs)-1;

        if ($Label){
            $this->Code.='<label class="control-label"';
            if ($Size==1 && $Inputs[1]->getAttrib('id')!=null)
                $this->Code.=' for="'.$Inputs[1]->getAttrib('id').'"';

            $this->Code.='>'.$Label.'</label>';
        }

        $this->Code.='<div class="controls">';

        for($i=1; $i<$Size+1; $i++)
            $this->Code.=$Inputs[$i]->render();

        $this->Code.='</div></div>';

        return $this;
    }

    public function actions(){
        $this->Code.='<div class="form-actions">';

        $Inputs=func_get_args();
        for($i=0, $Size=count($Inputs); $i<$Size; $i++){
            $this->Code.=$Inputs[$i]->render();
        }

        $this->Code.='</div>';

        return $this;
    }

    public function render(){
        if ($this->UseHead)
            $this->Code.='</fieldset>';
        $this->Code.='</form>';

        return $this->Code;
    }
}

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

class Checkbox extends FormUtils    {
    private $Code='';

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

class Radio extends FormUtils   {
    private $Code;

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

class Dropdown extends FormUtils    {
    private $Code='';

    public function __construct($Options=array(), $Selected=null, $Attribs=array()){
        $this->Code.='<select';
        $this->Code.=parent::parseAttribs($Attribs);
        $this->Code.='>';

        //Convert $Selected to array if necessary
        $Selected=(array)$Selected;

        foreach($Options as $key=>$val){
            $this->Code.='<option value="'.$key.'"';

            if (in_array($key, $Selected))
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

class Help  {
    private $Code='';

    public function __construct($Text){
        $this->Code.='<span class="help-block">'.$Text.'</span>';
    }

    function render(){
        return $this->Code;
    }
}

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

class Button extends FormUtils  {
    private $Code='';

    public function __construct($Label='', $Attribs=array()){
        $this->build($Label, $Attribs);
    }

    protected function build($Label='Button', $Attribs=array()){
        $this->Code.='<button type="'.$Attribs['type'].'"';
        $this->Code.=parent::parseAttribs($Attribs);
        $this->Code.='>'.$Label.'</button>';

        $this->Attribs=$Attribs;
    }

    function render(){
        return $this->Code;
    }
}

class Submit extends Button {
    public function __construct($Label='Submit',$Attribs=array('class'=>'btn btn-primary')){
        $Attribs['type']="submit";
        parent::build($Label, $Attribs);
    }
}

class Reset extends Button  {
    public function __construct($Label='Reset',$Attribs=array('class'=>'btn')){
        $Attribs['type']="reset";
        parent::build($Label, $Attribs);
    }
}

class ButtonGroup extends FormUtils   {
    private $Code='';

    public function __construct(){
        $this->Code.='<div class="btn-group">';

        $Inputs=func_get_args();
        for($i=0, $Size=count($Inputs); $i<$Size; $i++){
            $this->Code.=$Inputs[$i]->render();
        }

        $this->Code.='</div>';
    }

    public function render(){
        echo $this->Code;
    }
}

class BGButton extends FormUtils  {
    private $Code='';

    public function __construct($Icon='cog', $Attribs=array()){
        $this->Code.='<a class="btn" href="javascript:void(0)"';
        $this->Code.=parent::parseAttribs($Attribs);
        $this->Code.='><i class="icon-'.$Icon.'"></i></a>';
    }

    public function render(){
        return $this->Code;
    }
}

class ButtonDropdown extends FormUtils  {
    private $Code='';

    public function __construct($Label='', $Dropdown=array()){
        $this->Code.='<div class="btn-group"><a class="btn" href="javascript:void(0)">'.$Label.'</a><a class="btn dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)"><span class="caret"></span></a><ul class="dropdown-menu">';
        foreach($Dropdown as $i){
            $this->Code.='<li><a href="javascript:void(0)" id="'.$i[0].'">';
            if ($i[1])
                $this->Code.='<i class="icon-'.$i[1].'"></i>';
            $this->Code.=$i[2];
            $this->Code.='</a>';
        }
        $this->Code.='</ul></div>';
    }

    public function render(){
        return $this->Code;
    }
}
?>
