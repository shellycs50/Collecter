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
        JOIN `make` ON `cars`.`make_id` = `make`.`id` WHERE `deleted` = 0;");
        $query->execute();
        $cars = $query->fetchAll();
        $carObjs = [];
        foreach ($cars as $car) 
        {
            $carObjs[] = new Car
            (
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

    public function getAllCarsFilter(int $makeid, ?string $search_term = null) : array
    {
        if ($search_term == null || $search_term == '')
        {
            $query = $this->db->prepare("SELECT `cars`.`id`, `cars`.`model`, `cars`.`image`, `cars`.`make_id`, `cars`.`bodytype_id`, `cars`.`year`, `bodytype`.`name` as `bodytype`, `make`.`name` as `make` FROM `cars` 
            JOIN `bodytype` ON `cars`.`bodytype_id` = `bodytype`.`id`
            JOIN `make` ON `cars`.`make_id` = `make`.`id` WHERE `deleted` = 0 AND `cars`.`make_id` = :inputid;");
            $query->execute([':inputid' => $makeid]);
        }
        else 
        {
        $search_termformat = "%{$search_term}%";
        $query = $this->db->prepare("SELECT `cars`.`id`, `cars`.`model`, `cars`.`image`, `cars`.`make_id`, `cars`.`bodytype_id`, `cars`.`year`, `bodytype`.`name` as `bodytype`, `make`.`name` as `make` FROM `cars` 
        JOIN `bodytype` ON `cars`.`bodytype_id` = `bodytype`.`id`
        JOIN `make` ON `cars`.`make_id` = `make`.`id` WHERE `deleted` = 0 AND `cars`.`make_id` = :inputid AND `cars`.`model` LIKE :inputsearch_term;");
        $query->execute([':inputid' => $makeid, ':inputsearch_term' => $search_termformat]);
        }
        
        $cars = $query->fetchAll();
        $carObjs = [];
        foreach ($cars as $car) 
        {
            $carObjs[] = new Car
            (
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

    public function getAllDeletedCars() : array
    {
        $query = $this->db->prepare("SELECT `cars`.`id`, `cars`.`model`, `cars`.`image`, `cars`.`make_id`, `cars`.`bodytype_id`, `cars`.`year`, `bodytype`.`name` as `bodytype`, `make`.`name` as `make` FROM `cars` 
        JOIN `bodytype` ON `cars`.`bodytype_id` = `bodytype`.`id`
        JOIN `make` ON `cars`.`make_id` = `make`.`id` WHERE `deleted` = 1;");
        $query->execute();
        $cars = $query->fetchAll();
        $carObjs = [];
        foreach ($cars as $car) 
        {
            $carObjs[] = new Car
            (
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

    public function getCarById(int $inputid) : ?Car 
    {
        $query = $this->db->prepare("SELECT `cars`.`id`, `cars`.`model`, `cars`.`image`, `cars`.`make_id`, `cars`.`bodytype_id`, `cars`.`year`, `bodytype`.`name` as `bodytype`, `make`.`name` as `make` FROM `cars` 
        JOIN `bodytype` ON `cars`.`bodytype_id` = `bodytype`.`id`
        JOIN `make` ON `cars`.`make_id` = `make`.`id` WHERE `cars`.`id` = :input_id;");
        $success = $query->execute([':input_id' => $inputid]);
        
        $car = $query->fetch();
        if (!$car)
        {
            return null;
        }
        
            $output = new Car
            (
                $car['id'], 
                $car['model'], 
                $car['make_id'],
                $car['make'],
                $car['bodytype_id'],
                $car['bodytype'],
                $car['year'],
                $car['image']
            );
        
    return $output;
    }

    public function getCarsByMakeId(int $make_id) : array
    {
        $query = $this->db->prepare("SELECT * FROM `cars`
        JOIN `make` ON `cars`.`make_id` = `make`.`id");
        $cars = $query->fetchAll();
        return $cars;
    }

    public function getIdByModel(string $model) : ?int
    {
        $query = $this->db->prepare("SELECT `id` FROM `cars` WHERE `model` = :inputmodel");
        $success = $query->execute([':inputmodel' => $model]);
        if (!$success)
        {
            return null;
        }
        $output = $query->fetch();
        return $output['id'];
    }

    public function checkDistinct(string $column, string $value) : bool
    {
        $query = $this->db->prepare("SELECT COUNT(:column) as 'count' FROM `cars` WHERE :column = :value;");
        $query->execute([":column" => $column, ":value" => $value]);
        $res = $query->fetch();
        
        return ($res['count'] === 0);
        
    }

    public function insertCar(string $model, string $image_link, int $make_id, string $bodytype, int $year) : bool
    {
        $query = $this->db->prepare("INSERT into `cars`(`model`, `image`, `make_id`, `bodytype_id`, `year`, `deleted`) VALUES (:inputmodel, :inputimage, :inputmake_id, :inputbodytype_id, :inputyear, 0);");
        return $query->execute([":inputmodel" => $model, ":inputimage" => $image_link, ":inputmake_id" => $make_id, ":inputbodytype_id" => $bodytype, ":inputyear" => $year, ]);
    }

    public function restoreCar(int $id)
    {
        $query = $this->db->prepare("UPDATE `cars` SET `deleted` = 0 WHERE `id` = :inputid");
        return $query->execute([':inputid' => $id]);
    }

    public function moveToJunk(int $input_id) : bool
    {
        $query = $this->db->prepare("UPDATE `cars` SET `deleted` = 1 WHERE `id` = :inputid");
        return $success = $query->execute([':inputid' => $input_id]);
    }
    public function editCarAll(int $id, string $model, string $image_link, int $make_id, int $bodytype_id, int $year) : bool
    {
        $query = $this->db->prepare("UPDATE `cars` SET `model` = :inputmodel, `image` = :inputimage, `make_id` = :inputmake_id, `bodytype_id` = :inputbodytype_id, `year` = :inputyear WHERE `id` = :inputid");
        return $query->execute([':inputmodel' => $model, ':inputimage' => $image_link, ':inputmake_id' => $make_id, ':inputbodytype_id' => $bodytype_id, ':inputyear' => $year, ':inputid' => $id]);
    }

    public function dummyCar()
    {
        return new Car(1000, 'No Car Selected', 1, 'No Car Selected', 1, 'No Car Selected', 1900);
    }
}


