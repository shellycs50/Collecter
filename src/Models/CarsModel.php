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

    public function getCarById(int $inputid) : Car 
    {
        $query = $this->db->prepare("SELECT `cars`.`id`, `cars`.`model`, `cars`.`image`, `cars`.`make_id`, `cars`.`bodytype_id`, `cars`.`year`, `bodytype`.`name` as `bodytype`, `make`.`name` as `make` FROM `cars` 
        JOIN `bodytype` ON `cars`.`bodytype_id` = `bodytype`.`id`
        JOIN `make` ON `cars`.`make_id` = `make`.`id` WHERE `cars`.`id` = :input_id;");
        $query->execute([':input_id' => $inputid]);
        $car = $query->fetch();
        
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

    public function checkDistinct(string $column, string $value) : bool
    {
        $query = $this->db->prepare("SELECT COUNT(:column) as 'count' FROM `cars` WHERE :column = :value;");
        $query->execute([":column" => $column, ":value" => $value]);
        $res = $query->fetch();
        
        if ($res['count'] != 0)
        {
            return false;
        }
        return true;
    }

    public function insertCar(string $model, string $image_link, int $make_id, string $bodytype, int $year) : bool
    {
        $query = $this->db->prepare("INSERT into `cars`(`model`, `image`, `make_id`, `bodytype_id`, `year`) VALUES (:inputmodel, :inputimage, :inputmake_id, :inputbodytype_id, :inputyear);");
        return $query->execute([":inputmodel" => $model, ":inputimage" => $image_link, ":inputmake_id" => $make_id, ":inputbodytype_id" => $bodytype, ":inputyear" => $year, ]);
    }

    public function moveToJunk(int $input_id) : bool
    {
        $query = $this->db->prepare("SELECT * FROM `cars` WHERE `id` = :inputid");
        $success = $query->execute([":inputid" => $input_id]);
        if (!$success)
        {
            return false;
        }
        $res = $query->fetch();
        var_dump($res);
        
        $query2 = $this->db->prepare("INSERT into `junk`(`id`, `model`, `image`, `make_id`, `bodytype_id`, `year`) VALUES (:inputid, :inputmodel, :inputimage, :inputmake_id, :inputbodytype_id, :inputyear)");
        $success2 = $query2->execute([':inputid' => $res['id'], ':inputmodel' => $res['model'], ':inputimage' => $res['image'], ':inputmake_id' => $res['make_id'], ':inputbodytype_id' => $res['bodytype_id'], ':inputyear' => $res['year']]);
        if (!$success2)
        {
            return false;
        }
        $query3 = $this->db->prepare("DELETE FROM `cars` WHERE `id` = :inputid");
        return $query3->execute([":inputid" => $input_id]);
    }
}


