<?php
require_once 'src/ViewHelpers/CarsViewHelper.php';
require_once 'src/Models/CarsModel.php';
require_once 'src/Entities/Car.php';

$db = new PDO('mysql:host=db; dbname=Cars', 'root', 'password');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$cars_model = new CarsModel($db);
$allCars = $cars_model->getAllCars();

echo '<pre>';


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='index.css'>
    <title>Cars</title>
</head>
<body>
    
<?php
    var_dump($allCars);
    // CarsViewHelper::displayAllBooks($cars_model->getAllCars());
?>
</body>
</html>