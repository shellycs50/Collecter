<?php
require_once 'src/ViewHelpers/CarsViewHelper.php';
require_once 'src/Models/CarsModel.php';
require_once 'src/Entities/Car.php';
require_once 'src/Models/BodytypeModel.php';
require_once 'src/ViewHelpers/BodytypeViewHelper.php';
require_once 'src/ViewHelpers/MiscViewHelper.php';
$db = new PDO('mysql:host=db; dbname=Cars', 'root', 'password');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$bodytype_model = new BodytypeModel($db);
$bodytypes = $bodytype_model->getAllBodytypes();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='add.css'>
    <link rel='stylesheet' href='master.css'>
    <title>Add a Car</title>
</head>
<body>
    <nav>
        <a href='index.php'>Home</a>
        <a href='add.php'>Add a Car</a>
        <a href='archive.php'>Your Archive</a>
    </nav>

<h1 class='header'>Add a Car</h1>


    <?php
        if (isset($_GET['error']))
        {
            echo MiscViewHelper::DisplayError($_GET['error']);
        }
    ?>

   <form method="post" action='addHandling.php' id='add-form'>
   <label for="model">Model:</label>
   <input type="text" id="model" name="model" required>

   <label for="make">Make:</label>
   <input type="text" id="make" name="make" required>

   <label for="bodytype">Body Type:</label>
   <select id="bodytype" name="bodytype" required>
    <?php
        echo BodytypeViewHelper::optionList($bodytypes);
    ?>
   </select>

   <label for="year">Year:</label>
   <input type="number" id="year" name="year" min="1900" max="2099" required>

   <label for="image_link">Image Link:</label>
   <input type="text" id="image_link" name="image_link" required>

   <input type="submit" value="Submit">
</form>
    
</body>
</html>