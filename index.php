<?php
require_once 'src/ViewHelpers/CarsViewHelper.php';
require_once 'src/Models/CarsModel.php';
require_once 'src/Entities/Car.php';
require_once 'src/Models/MakeModel.php';
require_once 'src/ViewHelpers/MakeViewHelper.php';
require_once 'src/ViewHelpers/MiscViewHelper.php';

$db = new PDO('mysql:host=db; dbname=Cars', 'root', 'password');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$cars_model = new CarsModel($db);
$all_cars = $cars_model->getAllCars();

$make_model = new MakeModel($db);
$makes = $make_model->getAllMakes();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='index.css'>
    <link rel='stylesheet' href='master.css'>
    <title>Cars</title>
</head>
<body>
    <div id='wrapper'>
    <nav>
        <a href='index.php'>Home</a>
        <a href='add.php'>Add a Car</a>
        <a href='archive.php'>Your Archive</a>
    </nav>
<h1 class='header'>Your Car Collection</h1>
    <?php
                if (isset($_GET['error']))
                {
                    echo MiscViewHelper::DisplayError($_GET['error']);
                } 
    ?>
    <form method='get' id='filter-form'>
    <select id="make" name="make">
            <?php
                echo MakeViewHelper::optionList($makes);
            ?>
        </select>
        <label for='model'>Search:</label>
        <input type='text' id='model' name='model'>
        <input type='submit' value='Find'>
    </form>
    <?php 
       if (isset($_GET['make']))
       {
        echo "<form method='post' action='removefilter.php'><input type='submit' value='Remove Filter'></form>";
       }
    ?>

    <?php
    if (!isset($_GET['make']))
    {
        echo CarsViewHelper::displayAllCars($all_cars);
    }
    else
    {
        $selected_cars = $cars_model->getAllCarsFilter($_GET['make'], $_GET['model']);
        echo CarsViewHelper::displayAllCars($selected_cars);
    }
    
?>
</div>
</body>
</html>

