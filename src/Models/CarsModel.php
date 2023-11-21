<?php
require_once 'src/Entities/Car.php';
class CarsModel
{
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllCars() : array
    {
        $query = $this->db->prepare("SELECT `cars`.`id`, `cars`.`model`, `cars`.`image`, `cars`.`make_id`, `cars`.`bodytype_id`, `cars`.`year`, `bodytype`.`name` as `bodytype`, `make`.`name` as `make` FROM `cars` 
        JOIN `bodytype` ON `cars`.`bodytype_id` = `bodytype`.`id`
        JOIN `make` ON `cars`.`make_id` = `make`.`id`;");
        $query->execute();
        $cars = $query->fetchAll();
        $carObjs = [];
        foreach ($cars as $car) 
        {
            $carObjs[] = new Car(
                $car['id'], 
                $car['model'], 
                $car['make_id'],
                $car['make'],
                $car['bodytype_id'],
                $car['bodytype'],
                $car['year'],
                $car['image']
            );
        }
    return $carObjs;

    }
    public function getCarsByMakeId(int $make_id) : array
    {
        $query = $this->db->prepare("SELECT * FROM `cars`
        JOIN `make` ON `cars`.`make_id` = `make`.`id");
        $cars = $query->fetchAll();
        return $cars;
    }
}