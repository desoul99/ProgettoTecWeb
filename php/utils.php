<?php

class Utils{
    #https://www.labnol.org/code/19266-php-templates
    public static function bind_to_template($replacements, $template){
        return preg_replace_callback('/{{(.+?)}}/m',
            function($matches) use ($replacements) {
                return $replacements[$matches[1]];
        },$template);
    }
}
?>