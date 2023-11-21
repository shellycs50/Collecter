<?php

require_once 'src/ViewHelpers/CarsViewHelper.php';
require_once 'src/Entities/Car.php';
use PHPUnit\Framework\TestCase;

class CarsViewHelperTests extends TestCase
{
    public function test_displayAllCars_success(): void
    {
        $testArray = [0 => [1, 'Testcar', 5, 'Testmake', 100, 'Testbodytype', 2000]];
        CarsViewHelper::displayAllCars($testArray)->willReturn("<div class='car-wrapper'><p class='car-title'>Testmake Testcar</p><p class='car-year'>2000</p><p>Type: Testbodytype</p></div>");
    }
}