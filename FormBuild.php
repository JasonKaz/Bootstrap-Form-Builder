<?php
/**
 * Created by Jason Kaczmarsky
 * Date: 9/30/11 @ 12:58 AM
*/

class Form  {
    private $Method, $Action, $Attribs, $Code, $Multipart=false, $Stacked=false,
        $InputPrepend='<div class="clearfix">',
        $InputAppend='</div>';

    function init($Method, $Action, $Attribs=array()){
        return $this->_init($Method, $Action, $Attribs);
    }

    function init_multipart($Method, $Action, $Attribs=array()){
        return $this->_init($Method, $Action, $Attribs,true);
    }

    private function _init($Method, $Action, $Attribs=array(),$Multipart=false){
        $this->Method=strtolower($Method);
        $this->Action=$Action;
        $this->Attribs=$Attribs;
        $this->Multipart=$Multipart;
        return $this;
    }

    function setStacked($Value){
        $this->Stacked=$Value;
        return $this;
    }

    function setInputPrepend($Value){
        $this->InputPrepend=$Value;
        return $this;
    }

    function setInputAppend($Value){
        $this->InputAppend=$Value;
        return $this;
    }

    function render(){
        $Return='<form action="'.$this->Action.'" method="'.$this->Method.'"';

        if ($this->Multipart)
            $Return.=' enctype="multipart/form-data"';

        if ($this->Stacked && !isset($this->Attribs['class']))
            $Return.=' class="form-stacked"';

        foreach($this->Attribs as $key=>$value){
            if ($this->Stacked && $key=='class')
                $Return.=' class="form-stacked '.$value.'"';
            else
                $Return.=' '.$key.'="'.$value.'"';
        }

        $Return.='>
'.$this->Code.'
</form>';

        return $Return;
    }

    private function rowStart(){
        return $this->InputPrepend;
    }

    private function rowEnd(){
        return $this->InputAppend;
    }

    private function input($Type, $Label, $Attribs=array()){
        $Return=$this->rowStart();

        if ($Label)
            $Return.=$this->getLabel($Label,$Attribs);

        $Return.='<div class="input">
    <input type="'.$Type.'"';

        $Return.=$this->getAttribs($Attribs);

        $Return.=' />
    </div>'.$this->rowEnd()."\n";

        return $Return;
    }

    function text($Label, $Attribs=array()){
        $this->Code.=$this->input('text', $Label, $Attribs);

        return $this;
    }

    function password($Label, $Attribs=array()){
        $this->Code.=$this->input('password',$Label,$Attribs);

        return $this;
    }

    function submit($Attribs=array('class'=>'btn','value'=>'Submit')){
        $this->Code.=$this->input('submit','',$Attribs);

        return $this;
    }

    function select($Label, $Attribs=array(), $Values=array(), $SelectedValue=null){
        $this->Code.=$this->rowStart().$this->getLabel($Label,$Attribs);
        $this->Code.='<div class="input"><select'.$this->getAttribs($Attribs).'>';
        foreach($Values as $key=>$value){
            $this->Code.='<option value="'.$key.'"';
            if ($key==$SelectedValue)
                $this->Code.=' selected';
            $this->Code.='>'.$value.'</option>';
        }
        $this->Code.='</select></div>';
        $this->Code.=$this->rowEnd();

        return $this;
    }

    function checkbox($Label, $Attribs=array(), $Checked=false){
        if ($Checked)
            $Attribs['checked']='checked';
        $this->Code.=$this->input('checkbox',$Label,$Attribs);
        return $this;
    }

    function radio($Label, $Attribs=array()){
        $this->Code.=$this->input('radio',$Label,$Attribs);
        return $this;
    }

    function button($Label='Button', $Attribs=array('class'=>'btn')){
        $this->Code.=$this->rowStart().'<div class="input"><button'.$this->getAttribs($Attribs).'>'.$Label.'</button></div>'.$this->rowEnd ();
        return $this;
    }

    private function getAttribs($Attribs=array()){
        $Return='';
        foreach($Attribs as $key=>$value){
            switch($key){
                case 'required':
                    if ($value==true)
                        $Return.=' required="required"';
                    break;

                case 'autocomplete':
                    if ($value==false || $value==='off')
                        $Return.=' autocomplete="off"';
                    break;

                default:
                    $Return.=' '.$key.'="'.$value.'"';
                    break;
            }
        }
        return $Return;
    }

    private function getLabel($Label, $Attribs=array()){
        $Return='<label';

        if (isset($Attribs['id']))
            $Return.=' for="'.$Attribs['id'].'"';

        $Return.='>'.$Label.'</label>';
        return $Return;
    }
}

class AjaxForm  {

}
?>
