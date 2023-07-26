<?php
require 'connection.php';
$text = $_POST["topic"];
$tips = $_POST["tips"];
$name = $_POST["user"];



echo $text;
echo " ";
echo $tips;

$sql = ('INSERT INTO `firstaidtechnique`(`Doc_id`, `Topic`, `Topics`) VALUES (:docID,:topic,:tips)');
$query = $connection->prepare($sql);

$sql1 = ("SELECT id FROM adddoctor WHERE Name = ':user' ");
$query->bindParam(':user',$name,PDO::PARAM_STR);
echo $name; 
$query =$connection->prepare($sql1);
$query->execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);


$query->bindParam(":docID",$results);
$query->bindParam(":topic",$text);
$query->bindParam(":tips",$tips);
$query->execute();
$lastInsertedId = $connection->lastInsertId();

?>