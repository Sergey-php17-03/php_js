<?php

namespace App\helpers;

class HtmlHelper 
{    
    static public function getHtmlOptions( $args = [] ) 
    {
        $html = '<option value="0"></option>';
        foreach ( $args as $arg ){           
            
            $html .= '<option value="' . $arg->ter_id . '">' . $arg->ter_name . '</option>';
        }

        return $html;
    }
}
