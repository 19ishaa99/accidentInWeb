<?php
  session_start();
//Database Configuration File
require('connection.php');

// print("hello there!");

header ('location:Dashboard.php');
//error_reporting(0);
  if(isset($_POST['login']))
  {
    // Getting username/ email and password
    $uname=$_POST['name'];
    $password=md5($_POST['password']);
    // Fetch data from database on the basis of username/email and password
    $sql ="SELECT Name,Email,Password FROM usertable WHERE (Name=:name || Email=:email) and (Password=:password)";
    $query= $connection -> prepare($sql);
    $query-> bindParam(':name', $uname, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    echo $uname;
    echo $password;
  if($query->rowCount() > 0)
  {
    $_SESSION['userlogin']=$_POST['username'];
    echo "<script type='text/javascript'> document.location = 'welcome.php'; </script>";
  } else{
    echo "<script>alert('Invalid Details');</script>";
  }
}
?>