<?php
require_once 'src/ViewHelpers/CarsViewHelper.php';
require_once 'src/Models/CarsModel.php';
require_once 'src/Entities/Car.php';
require_once 'src/Models/BodytypeModel.php';
require_once 'src/ViewHelpers/BodytypeViewHelper.php';
require_once 'src/ViewHelpers/MiscViewHelper.php';

$db = new PDO('mysql:host=db; dbname=Cars', 'root', 'password');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$cars_model = new CarsModel($db);
$bodytype_model = new BodytypeModel($db);
$bodytypes = $bodytype_model->getAllBodytypes();

if (!isset($_GET['edit_id']))
{
    header("Location: index.php");
    exit(); 
}

$input_id = $_GET['edit_id'];
$car = $cars_model->getCarById($input_id);
// if id invalid, redirect to index. 
if (!$car)
{
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='edit.css'>
    <link rel='stylesheet' href='master.css'>
    <title>Edit Car</title>
</head>
    <body>
        <nav>
            <a href='index.php'>Home</a>
            <a href='add.php'>Add a Car</a>
            <a href='archive.php'>Your Archive</a>
        </nav>
    
        <h1 class='header'>Edit A Car</h1>

        <?php
            if (isset($_GET['error']))
            {
                echo MiscViewHelper::DisplayError($_GET['error']);
            }
        ?>
        
    <form method="post" action='editHandling.php' id='edit-form'>
        <input type="hidden" name="edit_id" value="<?php echo $input_id; ?>">
        <label for="model">Model: <p><?php echo $car->model;?></p></label>
        <input type="text" id="model" name="model" value='<?php echo "{$car->model}";?>'>

        <label for="make">Make: <p><?php echo $car->make;?></p></label>
        <input type="text" id="make" name="make" value='<?php echo "{$car->make}";?>' >

        <label for="bodytype">Body Type: <p><?php echo $car->make;?></p></label>
        <select id="bodytype" name="bodytype" selected='<?php echo "{$car->make_id}";?>'>
            <?php
                echo BodytypeViewHelper::optionList($bodytypes);
            ?>
        </select>

        <label for="year">Year: <p><?php echo $car->year;?></p></label>
        <input type="number" id="year" name="year" min="1900" max="2099" value='<?php echo "{$car->year}";?>'>

        <label for="image_link">Image Link:</label>
        <input type="text" id="image_link" name="image_link" value='<?php echo "{$car->image}";?>'>
        <img class='edit-image' src='<?php echo "$car->image";?>'>



        <input type="submit" value="Submit">
    </form>

    </body>
</html>

