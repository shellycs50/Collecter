<?php
require_once 'src/Models/CarsModel.php';

if (isset($_GET['delete']))
{
    $db = new PDO('mysql:host=db; dbname=Cars', 'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $cars_model = new CarsModel($db);
    $id_to_delete = $_GET['delete'];
    $success = $cars_model->moveToJunk($id_to_delete);
    if (!$success)
    {
        return header('Location: index.php?error=failed to delete');
    }
    return header('Location: index.php');
}