<?php
require_once 'src/Entities/Bodytype.php';
class BodytypeModel
{
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllBodytypes() : array
    {
        $query = $this->db->prepare("SELECT `name`, `id` FROM bodytype;");
        $query->execute();
        $bodytypes = $query->fetchAll();
        $bodytypeObjs = [];
        foreach ($bodytypes as $bodytype) 
        {
            $bodytypeObjs[] = new Bodytype(
                $bodytype['id'], 
                $bodytype['name']
            );
        }
        return $bodytypeObjs;
    }
}