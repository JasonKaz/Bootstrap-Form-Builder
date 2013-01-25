<?php
namespace JasonKaz\FormBuild;

/**
 * Creates a select input
 */
class Select extends FormInput   {
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
}
?>
