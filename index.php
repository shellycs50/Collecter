<?php
require_once 'src/ViewHelpers/CarsViewHelper.php';
require_once 'src/Models/CarsModel.php';
require_once 'src/Entities/Car.php';

$db = new PDO('mysql:host=db; dbname=Cars', 'root', 'password');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$cars_model = new CarsModel($db);

if (isset($_GET['delete']))
{
    $id_to_delete = $_GET['delete'];
    unset($_GET['delete']);
    $cars_model->moveToJunk($id_to_delete);
}
// put this on a new page ^ redirect back to index or error respectively. 

$all_cars = $cars_model->getAllCars();
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
    </nav>
<h1 class='header'>Your Car Collection</h1>
<?php
    echo CarsViewHelper::displayAllCars($all_cars);
?>
</body>
</html>

