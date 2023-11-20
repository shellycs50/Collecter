<?php
class Car 
{
    public int $id;
    public string $model;
    public int $make_id;
    public string $make;
    public int $bodytype_id;
    public string $bodytype;
    public ?string $image = null;
    public int $year;
    
    public function __construct(
        int $id, 
        string $model, 
        int $make_id,
        string $make,
        int $bodytype_id,
        string $bodytype,
        ?string $image,
        int $year
    )
    {
        $this->id = $id;
        $this->model = $model;
        $this->make_id = $make_id;
        $this->make = $make;
        $this->bodytype_id = $bodytype_id;
        $this->bodytype = $bodytype;
        $this->image = $image;
        $this->year = $year;
    }
}
?>
