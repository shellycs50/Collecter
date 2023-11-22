<?php
require_once 'src/Entities/Car.php';
class MakeModel
{
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function addMake(string $make_name) : bool
    {   //add make
        $query = $this->db->prepare("INSERT into `make`(`name`) VALUES (:inputmake);");
        $query->bindParam(':inputmake', $make_name);
        return $query->execute();
        //would like to crossreference makes with a list of actual makes, or make a database of cars for the user to select from.
    }
    
    public function getIdByName(string $make_name) : int
    {
        $query = $this->db->prepare("SELECT `id` FROM `make` WHERE `make`.`name` = :inputmake");
        $query->bindParam(':inputmake', $make_name);
        $query->execute();
        $res = $query->fetch();
        return $res['id'];
    }

    public function checkDistinct($column, $value)
    {
        $query = $this->db->prepare("SELECT COUNT(:column) as 'count' FROM `make` WHERE :column = :value;");
        $query->execute([":column" => $column, ":value" => $value]);
        
        $res = $query->fetch();
        
        if ($res['count'] != 0)
        {
            return false;
        }
        return true;
    }
}

//make add methods return query execute. 
//returns bool, only redirect if it worked. otherwise error page. 

// index.php?message=Success!
