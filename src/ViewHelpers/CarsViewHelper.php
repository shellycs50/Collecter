<?php
require_once 'src/Models/CarsModel.php';
class CarsViewHelper
{
    public static function displayAllCars(array $carObjs)
    {
        if (count($carObjs) === 0)
        {
            return "<div class='all-cars-error-message'><p>We couldn't find any cars! Try adding one <a href='add.php'>here</p></div>";
        }
        $output = "<div class='car-grid'>";
        foreach($carObjs as $car)
        {
            $output .= "<div class='car-wrapper'>";
            $output .= "<p class='car-title'>{$car->make} {$car->model}</p>";
            $output .= "<p class='car-year'>{$car->year}</p>";
            $output .= "<img src='{$car->image}' alt='car image'/>";
            $output .= "<p>Type: {$car->bodytype}</p>";
            $output .= "<a href='edit.php?edit_id={$car->id}'>Edit</a>";
            $output .= "<a href='delete.php?delete={$car->id}'>Delete</a>";
            $output .= '</div>';
        }
        $output .= '</div>';
        return $output;
    }

    public static function displayAllDeletedCars(array $carObjs) : string
    {
        if (count($carObjs) === 0)
        {
            return "<div class='all-cars-error-message'><p>No Cars In Your Archive! If you'd like to add one do so by clicking the delete button <a href='index.php'>here</p></div>";
        }
        $output = "<div class='car-grid'>";
        foreach($carObjs as $car)
        {
            $output .= "<div class='car-wrapper'>";
            $output .= "<p class='car-title'>{$car->make} {$car->model}</p>";
            $output .= "<p class='car-year'>{$car->year}</p>";
            $output .= "<img src='{$car->image}' alt='car image'/>";
            $output .= "<p>Type: {$car->bodytype}</p>";
            $output .= "<a href='restore.php?restore={$car->id}'>restore</a>";
            $output .= '</div>';
        }
        $output .= '</div>';
        return $output;
    }
}