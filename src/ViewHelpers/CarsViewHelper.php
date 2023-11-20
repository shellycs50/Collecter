<?php
require_once 'src/Models/CarsModel.php';
class CarsViewHelper
{
    public static function displayAllBooks(array $carObjs)
    {
        foreach($carObjs as $car)
        {
            $output .= '<div>';
            $output .= "<h1>$car->model</h1>";
            $output .= "<img src='$car->image' />";
            $output .= "<p>$car->make</p>";
            $output .= '</div>';
        }
    }
}