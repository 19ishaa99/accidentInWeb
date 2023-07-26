<?php
require 'connection.php';


// $connection = connection();

if (isset($_SESSION['login_error'])) {
    unset($_SESSION['login_error']);
}elseif (isset($_SESSION['register_error'])) {
    unset($_SESSION['register_error']);
}elseif (isset($_SESSION['register_success'])) {
    unset($_SESSION['register_success']);
}elseif (isset($_SESSION['import_error'])) {
   unset($_SESSION['import_error']);
}elseif (isset($_SESSION['supplier_error'])) {
    unset($_SESSION['supplier_error']);
}elseif (isset($_SESSION['supplier_success'])) {
    unset($_SESSION['supplier_success']);
}elseif (isset($_SESSION['export_error'])){
    unset($_SESSION['export_error']);
}elseif(isset($_SESSION['export_successfull'])){
    unset($_SESSION['export_successfull']);
}

       $Gender = $_POST['gender'];
       $Name = $_POST['name'];
       $Role = $_POST['role'];
       $Address = $_POST['address'];
       $PhoneNo = $_POST['phoneNo'];
       $Email = $_POST['email'];
       $password = $_POST['password'];
       $Password1 = password_hash($password, PASSWORD_DEFAULT);
       $stmt = $connection->prepare('INSERT INTO `usertable`(`Name`, `Role`, `PhoneNo`, `Address`, `Gender`, `Email`, `Password`) VALUES (:name,:role,:Phone,:address,:gender,:email,:password)'); 
       $result = $stmt->execute([':name'=>$Name,':role'=>$Role,':Phone'=>$PhoneNo,':address'=>$Address,':gender'=>$Gender,':email'=>$Email,':password'=>$Password1]);


?>