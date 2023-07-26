<?php
try {
    $connection = new PDO("mysql:host=localhost;dbname=accidentpush","root","");
    $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    echo"Connected successfully";
} catch (PDOException $e) {
    echo"Not connected";
}
// $var = ($_POST["btn"]);
// if(isset($_POST['btn'])){
//     echo 'correctly';
// header('location:indexHandler.php');
// }
?>
