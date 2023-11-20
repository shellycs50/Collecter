<?php
require_once 'src/Models/CarsModel.php';
class CarsViewHelper
{
    public static function displayAllCars(array $carObjs)
    {
        $output = '<div class="car-grid">';
        foreach($carObjs as $car)
        {
            $output .= '<div class="car-wrapper">';
            $output .= "<p class='car-title'>$car->make $car->model</p>";
            $output .= "<p class='car-year'>$car->year</p>";
            $output .= "<img src='$car->image' />";
            $output .= "<p>Type: $car->bodytype</p>";
            $output .= '</div>';
        }
        $output .= '</div>';
        return $output;
    }
}