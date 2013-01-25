<?php
namespace JasonKaz\FormBuild;


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
                        $Code.=' checked';
                    break;

                case 'autocomplete':
                    if (!$val)
                        $Code.=' autocomplete="off"';
                    break;

                case 'required':
                    if ($val)
                        $Code.=' required';
                    break;

                case 'multiple':
                    if ($val)
                        $Code.=' multiple';
                    break;
					
				case 'readonly':
					if ($val)
						$Code.=' readonly';
					break;
					
				case 'autofocus':
					if ($val)
						$Code.=' autofocus';
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
?>
