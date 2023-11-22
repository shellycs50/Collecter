<?php
require_once 'src/Models/CarsModel.php';
class CarsViewHelper
{
    public static function displayAllCars(array $carObjs)
    {
        if (count($carObjs) < 1)
        {
            return "<div class='all-cars-error-message'><p>We couldn't find any cars! Try adding one <a href='#'>here</p></div>";
        }
        $output = "<div class='car-grid'>";
        foreach($carObjs as $car)
        {
            $output .= "<div class='car-wrapper'>";
            $output .= "<p class='car-title'>$car->make $car->model</p>";
            $output .= "<p class='car-year'>$car->year</p>";
            $output .= "<img src='$car->image' alt='car image'/>";
            $output .= "<p>Type: $car->bodytype</p>";
            $output .= '</div>';
        }
        $output .= '</div>';
        return $output;
    }
}