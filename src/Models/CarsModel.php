<?php
require_once 'src/Entities/Car.php';
class CarsModel
{
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllCars()
    {
        var_dump('called');
        $query = $this->db->prepare("SELECT `cars`.`id`, `cars`.`model`, `cars`.`image`, `cars`.`make_id`, `cars`.`bodytype_id`, `bodytype`.`name` as `bodytype`, `make`.`name` as `make` FROM `cars` 
        JOIN `bodytype` ON `cars`.`bodytype_id` = `bodytype`.`id`
        JOIN `make` ON `cars`.`make_id` = `make`.`id`;");
        $query->execute();
        $cars = $query->fetchAll();
        var_dump($cars);
        $carObjs = [];
        foreach ($cars as $car) {
            $carObjs[$car['model']] = new Car(
                $car['id'], 
                $car['model'], 
                $car['make_id'],
                $car['make'],
                $car['bodytype_id'],
                $car['bodytype'],
                $car['image']
            );
        return $carObjs;
    }
}

    public function getCarsByMakeId(int $make_id)
    {
        $query = $this->db->prepare("SELECT * FROM `cars`
        JOIN `make` ON `cars`.`make_id` = `make`.`id");
        $cars = $query->fetchAll();
        return $cars;
    }



}