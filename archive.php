<?php
require_once 'src/ViewHelpers/CarsViewHelper.php';
require_once 'src/Models/CarsModel.php';
require_once 'src/Entities/Car.php';
require_once 'src/Models/MakeModel.php';
require_once 'src/ViewHelpers/MakeViewHelper.php';

$db = new PDO('mysql:host=db; dbname=Cars', 'root', 'password');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$cars_model = new CarsModel($db);
$all_cars = $cars_model->getAllCars();

$make_model = new MakeModel($db);
$makes = $make_model->getAllMakes();

?>

<?php
require_once 'src/ViewHelpers/CarsViewHelper.php';
require_once 'src/Models/CarsModel.php';

$db = new PDO('mysql:host=db; dbname=Cars', 'root', 'password');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$cars_model = new CarsModel($db);
$deleted_cars = $cars_model->getAllDeletedCars();
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
    <nav>
        <a href='index.php'>Home</a>
        <a href='add.php'>Add a Car</a>
        <a href='archive.php'>Your Archive</a>
    </nav>
<h1 class='header'>Archive</h1>
    <?php
                if (isset($_GET['error']))
                {
                    echo "<p class='error-message'>";
                    echo 'Error: ';
                    echo $_GET['error'];
                    echo "</p>";
                } 
    
    
        echo CarsViewHelper::displayAllDeletedCars($deleted_cars);
    
?>
</body>
</html>

