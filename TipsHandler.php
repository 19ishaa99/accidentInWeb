<?php
require 'connection.php';
$docName = $_POST['name'];
$tip = $_POST['tip'];
$topic = $_POST['topic'];

require 'connection.php';
$sql = "SELECT id FROM usertable WHERE Name  = :docName";
$query = $connection -> prepare($sql);
$query-> bindParam(':docName',$docName,PDO::PARAM_STR);
// $query -> bindParam(':city', $city, PDO::PARAM_STR);
// $city = "New York";
$query -> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);

 if($query -> rowCount() > 0)
 {
 foreach($results as $result)
 {
    
    $id = $result -> id .", ";
// echo $result -> Name . ", ";
// echo $result -> Address . ", ";
// echo $result -> Gender .",";
// echo $result -> PhoneNo . ", ";
// echo $result -> Email . ", ";
$sql = "INSERT INTO `firstaidtechnique`(`Doc_id`, `Topic`, `Tips`) VALUES (:id,:topic,:tips)";
$query= $connection->prepare($sql);
$query->bindParam(":id",$id,PDO::FETCH_OBJ);
$query->bindParam(":topic",$topic,PDO::FETCH_OBJ);
$query->bindParam(":tips",$tip,PDO::FETCH_OBJ);
//$query->execute();
}
}

?>
