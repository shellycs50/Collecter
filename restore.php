<?php
require_once 'src/Models/CarsModel.php';


if (!isset($_GET['restore']))
{
    header('Location: archive.php?error=No Car Selected');
}
$id = $_GET['restore'];

$db = new PDO('mysql:host=db; dbname=Cars', 'root', 'password');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$cars_model = new CarsModel($db);

if ($cars_model->restoreCar($id))
{
    return header('Location: archive.php');
}
else 
{
    return header('Location: archive.php?error=Sorry But We Had Some Trouble Restoring That!');
}