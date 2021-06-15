<?php

class Utils{
    public static function template($replace, $template){
        return preg_replace_callback('/{{(.+?)}}/m',
            function($match) use ($replace) {
                return $replace[$match[1]];
        },$template);
    }
    public static function cleanInput($value, $stripTags = true){
        //elimino spazi
        $value = trim($value);
        //rimuovo tag html
        if($stripTags){
            $value = strip_tags($value);
        }
        return $value;
    }
}
?>