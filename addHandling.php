<?php
require_once 'src/Models/CarsModel.php';
require_once 'src/Models/MakeModel.php';
$allFieldsFilled = true;


if (!isset($_POST['model']) || empty($_POST['model'])) 
{
    $allFieldsFilled = false;
}

if (!isset($_POST['make']) || empty($_POST['make'])) 
{
    $allFieldsFilled = false;
}

if (!isset($_POST['bodytype']) || empty($_POST['bodytype'])) 
{
    $allFieldsFilled = false;
}

if (!isset($_POST['year']) || empty($_POST['year'])) 
{
    $allFieldsFilled = false;
}

if (!isset($_POST['image_link']) || empty($_POST['image_link'])) 
{
    $allFieldsFilled = false;
}

if (!$allFieldsFilled) 
{
    header('Location: add.php?error=fields not filled');
    exit();
}

$model = $_POST['model'];
$make = $_POST['make'];
$bodytype = $_POST['bodytype'];
$year = $_POST['year'];
$image_link = $_POST['image_link'];

if (strlen($model) > 100)
{
    header('Location: error.php?error=model name too long');
    exit();
}
elseif (strlen($image_link) > 500)
{
    header('Location: error.php?error=image link too long');
    exit();
}
elseif ($year < 1900 || $year > 2024)
{
    header('Location: error.php?error=incorrect year');
    exit();
}
else
{
    $db = new PDO('mysql:host=db; dbname=Cars', 'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $cars_model = new CarsModel($db);
    $make_model = new MakeModel($db);

    if (!$cars_model->checkDistinct('model', $model))
    {
        header('Location: add.php?error=model already in collection');
        exit();
    }

    if ($make_model->checkDistinct('name', $make))
    {
        if ($make_model->addMake($make) != true)
        {
            header('Location: error.php?error=could not add make');
        }
    }
    
    $make_id = $make_model->getIdByName($make);

    if ($cars_model->insertCar($model, $image_link, $make_id, $bodytype, $year) == true)
    {
        header('Location: index.php');
    }
    else
    {
        header('Location: error.php?error=failed to insert to database');
    }
    exit();
}
?>
