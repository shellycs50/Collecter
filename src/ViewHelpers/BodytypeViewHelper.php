<?php
class BodytypeViewHelper
{
    public static function optionList(array $bodytypes)
    {
        if (count($bodytypes) === 0)
        {
            return "";
            // No error needed here, just don't display any bodytypes. could throw exception.
        }
        $output = '';
        foreach($bodytypes as $bodytype)
        {
            $output .= "<option value='{$bodytype->id}'>{$bodytype->name}</option>";
        }
        return $output;
    }
}