<?php
class MiscViewHelper
{
    public static function DisplayError(string $message) : string 
    {
        $output = '';
        $output .= "<p class='error-message'>";
        $output .= 'Error: ';
        $output .= $message;
        $output .= "</p>";

        return $output;
    }
}