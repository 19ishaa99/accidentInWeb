<?php

require 'connection.php';

$sql = "SELECT * FROM usertable";
$query = $connection -> prepare($sql);
// $query -> bindParam(':city', $city, PDO::PARAM_STR);
// $city = "New York";
$query -> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
foreach($results as $result)
{

echo $result -> Name . ", ";
echo $result -> Address . ", ";
echo $result -> Gender .",";
echo $result -> PhoneNo . ", ";
echo $result -> Email . ", ";
}
}
?>