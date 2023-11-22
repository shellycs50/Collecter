<?php

require_once 'src/ViewHelpers/CarsViewHelper.php';
require_once 'src/Entities/Car.php';
use PHPUnit\Framework\TestCase;

class CarsViewHelperTest extends TestCase
{
    public function test_displayAllCars_success(): void
    {
        $testObjs = [];
        $testCar = new Car(1, 'Testcar', 5, 'Testmake', 100, 'Testbodytype', 2000);
        $testObjs[] = $testCar;
        $result = CarsViewHelper::displayAllCars($testObjs);
        
        $this->assertEquals("<div class='car-grid'><div class='car-wrapper'><p class='car-title'>Testmake Testcar</p><p class='car-year'>2000</p><img src='' alt='car image'/><p>Type: Testbodytype</p></div></div>", $result);
    }
}



