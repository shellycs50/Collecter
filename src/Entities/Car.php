<?php
class Car 
{
    public int $id;
    public string $model;
    public int $make_id;
    public string $make;
    public int $bodytype_id;
    public string $bodytype;
    public int $year;
    public ?string $image;
    
    public function __construct(
        int $id, 
        string $model, 
        int $make_id,
        string $make,
        int $bodytype_id,
        string $bodytype,
        int $year,
        ?string $image = null,
    )
    {
        $this->id = $id;
        $this->model = $model;
        $this->make_id = $make_id;
        $this->make = $make;
        $this->bodytype_id = $bodytype_id;
        $this->bodytype = $bodytype;
        $this->year = $year;
        $this->image = $image;
    }
}
?>
