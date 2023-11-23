<?php
require_once 'src/Entities/Make.php';
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
    
    public function getIdByName(string $make_name) : ?int
    {
        $query = $this->db->prepare("SELECT `id` FROM `make` WHERE `make`.`name` = :inputmake");
        $query->bindParam(':inputmake', $make_name);
        $query->execute();
        $res = $query->fetch();
        if (!$res)
        {
            return null;
        }
        return $res['id'];
    }

    public function checkDistinct($column, $value) : bool
    {
        $query = $this->db->prepare("SELECT COUNT(:column) as 'count' FROM `make` WHERE :column = :value;");
        $query->execute([":column" => $column, ":value" => $value]);
        
        $res = $query->fetch();
        
        return ($res['count'] === 0);
      
    }

    public function getAllMakes() : array
    {
        $query = $this->db->prepare("SELECT * FROM `make`");
        $query->execute();
        $res = $query->fetchAll();
        $makeObjs = [];
        foreach($res as $make)
        {
            $makeObjs[] = new Make($make['id'], $make['name']);
        }
        return $makeObjs;
    }

}

//make add methods return query execute. 
//returns bool, only redirect if it worked. otherwise error page. 

// index.php?message=Success!
