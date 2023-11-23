<?php
class MakeViewHelper
{
    public static function optionList($makes) : string 
    {
        if (count($makes) === 0)
        {
            return "<option value='fail'>FAIL</option>";
            // No error needed here, just don't display any makes. could throw exception.
        }
        $output = '';
        foreach($makes as $make)
        {
            $output .= "<option value='{$make->id}'>{$make->name}</option>";
        }
        return $output;
    }
}