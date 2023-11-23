<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='index.css'>
    <title>Cars</title>
</head>
<body>
    <nav>
        <a href='index.php'>Home</a>
        <a href='add.php'>Add a Car</a>
    </nav>
<h1 class='header'>Error: <?php
if (isset($_GET['error']))
{
    echo $_GET['error'];
}
else 
{
    echo "Unknown";
}
?>
</h1> 