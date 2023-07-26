<?php
session_start();
require_once '../store/db.php';



$pdo = connection();

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


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // OGIN FUNCTION COMES HERE
    if (isset($_POST['login'])) {
        if (!isset($_POST['usernsme']) && !isset($_POST['password'])) {
            $pdo = null;
            $_SESSION['login_error'] = 'Tafadhali ingiza username na password';
            header('location:../index.php');
        }else {
            $username = $_POST['usernsme'];
            $password = htmlspecialchars($_POST['password']);
            $stmt = $pdo->prepare('SELECT * FROM user WHERE username=:username');
            $stmt->execute(['username'=>$username]);
        
            if ($stmt->rowCount() == 1) {
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $rows = $stmt->fetchAll();
    
                foreach ($rows as $value) {
                    $firstname = $value['fname'];
                    $lastname = $value['lname'];
                    $usernm = $value['username'];
                    $email = $value['email'];
                    $role = $value['role'];
                    $pass = $value['password'];
                }

    
                if (password_verify($password, $pass)) {
                    $pdo = null;
                    $_SESSION['login_success'] = 'Hongera na karibu '.$firstname.' katika mfumo!.';
                    $_SESSION['login_user']['firstname'] = $firstname;
                    $_SESSION['login_user']['lastname'] = $lastname;
                    $_SESSION['login_user']['username'] = $usernm;
                    $_SESSION['login_user']['email'] = $email;
                    $_SESSION['login_user']['role'] = $role;
                    $_SESSION['is_login'] = true;
    
    
                    if ($role == 'admin') {
                        header('location:../dashboard.php');    
                    }else {
                        header('location:../dashboard.php');     
                    }
    
                }else {
                    $pdo = null;
                    $_SESSION['login_error'] = 'Umeingiza nywila sio sahihi!';
                    header('location:../index.php');
                }
            }else {
                $pdo = null;
                $_SESSION['login_error'] = 'Mtumiaji hapatikani katika mfumo';
                header('location:../index.php');
            }
        }
        // kuregister wafanyakazi by admin na kuingiza kwenye database
    }else if (isset($_POST['submit_user'])) {
         if (isset($_POST['gender']) && isset($_POST['firstname']) && isset($_POST['Lname']) && isset($_POST['useremail']) && isset($_POST['role']) && isset($_POST['username']) && isset($_POST['userpassword'])) {
            $gender = $_POST['gender'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['Lname'];
            $useremail = $_POST['useremail'];
            $role = $_POST['role'];
            $gender = $_POST['gender'];
            $username = $_POST['username'];
            $password = $_POST['userpassword'];
            $password1 = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare('INSERT INTO user(fname, lname, email, gender,role, username, password) VALUE(:fname, :lname, :email, :gender, :role, :username, :password)');
            $result = $stmt->execute(['fname'=>$firstname, 'lname'=>$lastname, 'email'=>$useremail, 'role'=>$role, 'username'=>$username, 'password'=>$password1, 'gender' => $gender]);

            if ($result) {
                $pdo = null;
                $_SESSION['register_success'] = 'Mtumiaji amehifadhiwa kikamilifu!.';
                //Create an instance; passing `true` enables exceptions
                // require './PHPMailer/vendor/autoload.php';
            //    include('./SendEmail.php');
                header('location:../registration.php');

                
            }else {
                $pdo = null;
                $_SESSION['register_error'] = 'Tafadhali jaza fomu yote!.';
                header('location:../registration.php');
            }
        }else {
            
        }
    }elseif (isset($_POST['submit_material'])) {
        if (!isset($_POST['invoice']) && !isset($_POST['totalMaterial']) && !isset($_POST['totalprice']) && !isset($_POST['Mname']) && !isset($_POST['Prprice']) && !isset($_POST['quantity']) && !isset($_POST['od']) && !isset($_POST['suplier_id'])) {
            $_SESSION['import_error'] = 'Hakikisha umejaza fomu yote';
            header('location:../import.php');
        }else {
            if (isset($_SESSION['login_user']['email'])) {
                $uMail= $_SESSION['login_user']['email'];
            }
            if ($_POST['invoice'] != null && $_POST['totalMaterial'] != null && $_POST['totalprice'] != null && $_POST['Mname'] != null && $_POST['Prprice'] != null && $_POST['quantity'] != null && $_POST['od'] != null && $_POST['suplier_id'] != null) {
                $invoice = $_POST['invoice'];
                $totalMaterial = $_POST['totalMaterial'];
                $totalprice = $_POST['totalprice'];
                $Mname = $_POST['Mname'];
                $Prprice = $_POST['Prprice'];
                $quantity = $_POST['quantity'];
                $od = $_POST['od'];
                $suplier = $_POST['suplier_id'];

                $stmt = $pdo->prepare('INSERT INTO import(supplier_id, order_date, invoice_number, total_item,total_price) VALUE(:supplier_id, :order_date, :invoice_number, :total_item, :total_price)');
                $result = $stmt->execute(['supplier_id'=>$suplier, 'order_date'=>$od, 'invoice_number'=>$invoice, 'total_item'=>$totalMaterial, 'total_price'=>$totalprice]);
                

                
                if ($result) {
                

                // KUPATA ID YA IMPORT TULIO IHIFADHI MDUDA MCHACHE ULIO PITA
                $last_id = $pdo->lastInsertId();
                
                // QUERY YA KUPATA ID YA USER ALIE INGIA KATIKA MFUMO
                $stmt = $pdo->prepare('SELECT id FROM user WHERE email=:email');
                 $stmt->execute(['email'=>$uMail]);
                 $user_id = 0;
                 if ($stmt->rowCount() == 1) {
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $rows = $stmt->fetch();
        
                    // foreach ($rows as $value) {
                    //     $user_id = $value;
                    // }
                }
                // echo $user_id;

                // QUERY YA KUINGIZA ITEM KATIKA MFUMO PAMOJA
                for ($i=0; $i < sizeof($Mname); $i++) { 
                        $stmt = $pdo->prepare('INSERT INTO item(import_id, item_name, quantity, price, user_id) VALUE(:import_id, :item_name, :quantity, :price, :user_id)');
    
                        $result = $stmt->execute(['import_id'=>$last_id, 'item_name'=>$Mname[$i], 'quantity'=>$quantity[$i], 'price'=>$Prprice[$i], 'user_id'=>$user_id]);
                        // echo $Mname[$i]. ' '.$Prprice[$i].' '.$quantity[$i].'<br/>';
                    }
                    if ($result) {
                        $pdo = null;
                        $_SESSION['import_success'] = 'Bidhaa imeingizwa kikamilifu!.';
                        header('location:../import.php');

                    } else {
                        $pdo = null;
                        $_SESSION['import_error'] = 'Tafadhali jaribu tena baadae kuna hitilafu imejitokeza!.';
                        header('location:../import.php');
                    }
                }else {
                    $pdo = null;
                    $_SESSION['import_error'] = 'Tafadhali jaribu tena baadae kuna hitilafu imejitokeza!.';
                    header('location:../import.php');
                }
            }else {
                $_SESSION['import_error'] = 'Hakikisha umejaza fomu yote';
                header('location:../import.php');
            }
        }
       }elseif (isset($_POST['submit_new_supplier'])) {
       if (!isset($_POST['Sname']) && !isset($_POST['address']) && !isset($_POST['email']) && !isset($_POST['phonenumber']) && !isset($_POST['tin'])) {
            $_SESSION['supplier_error'] = 'Hakikisha umejaza fomu yote';
            header('location:../new-suplier.php');
       }else {
           if ($_POST['Sname'] != null && $_POST['address'] != null && $_POST['email'] != null && $_POST['phonenumber'] != null && $_POST['tin'] != null) {
                $Sname = $_POST['Sname'];
                $address = $_POST['address'];
                $email = $_POST['email'];
                $phonenumber = $_POST['phonenumber'];
                $tin = $_POST['tin'];

                // kuangalia km email alioingiza ni sahuhu(validation)
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['supplier_error'] = 'Umeingiza barua pepe isio sahihi';
                    header('location:../new-suplier.php');
                }

                    // kuangalia namba za samu km zimetimia tisa au kumi(validation)
                if (!preg_match('/^[0-9]{10}+$/', $phonenumber)) {
                    $_SESSION['supplier_error'] = 'Umeingiza nambari ya simu isio sahihi';
                    header('location:../new-suplier.php');
                }

                $stmt = $pdo->prepare('INSERT INTO supplier(name, email, phone_number, address, tin_number  ) VALUE(:name, :email, :phone_number, :address, :tin_number)');

                $result = $stmt->execute(['name'=>$Sname, 'email'=>$email, 'address'=>$address, 'phone_number'=>$phonenumber, 'tin_number'=>$tin]);

            if ($result) {
                $pdo = null;
                $_SESSION['supplier_success'] = 'Msambazaji amehifadhiwa kikamilifu!.';
                header('location:../new-suplier.php');
            }else {
                $pdo = null;
                $_SESSION['supplier_error'] = 'Tafadhali jaribu tena baadae, kuna hitilafu imetokea!.';
                header('location:../new-suplier.php');
            }

            }else {
                $_SESSION['supplier_error'] = 'Hakikisha umejaza fomu yote';
                header('location:../new-suplier.php');
            }
       }
    }elseif(isset($_POST['submit'])){
        if(!isset($_POST['expname']) && !isset($_POST['expquantity']) && !isset($_POST['school']) && !isset($_POST) && !isset($_POST['dp']) && !isset($_POST['schooladdress']) && !isset($_POST['purpose'])){
            $_SESSION['export_error'] = 'hakikisha umejaza fomu yote';
            header('location:../export.php');
        }else{
            $item = $_POST['expname'];
            $quantity = $_POST['expquantity'];
            $skl =  $_POST['school'];
            $depart = $_POST['dp'];
            $skladd = $_POST['schooladdress'];
            $pp = $_POST['purpose'];

            $stmt = $pdo->prepare('INSERT INTO item(item_name) VALUE(:item_name)');
            $stmt->execute(array('item_name'=>$item));
            $itemID = $pdo->lastInsertId();

            $stmt = $pdo->prepare('INSERT INTO export(`item_id`,`quantity`, `description`) VALUE(:item_id,:quantity, :description)');
            $stmt->execute(array(':item_id'=>$itemID,':quantity'=>$quantity,':description'=>$pp));
            $exportID = $pdo->lastInsertId();
            

            $stmt = $pdo->prepare('INSERT INTO school(`export_id`, `name`, `department`, `address`) VALUE(:export_id,:name, :department, :address)');
            $stmt->execute(array(':export_id'=>$exportID,':name'=>$skl,':department'=>$depart,':address'=>$skladd));
                if($stmt){
                $pdo = null;
                    $_SESSION['export_successfull'] = 'Utoaji  bidhaa umekamilika';
                    header('location: ../export.php');
                }else{
                    $pdo = null;
                    $_SESSION['export_error'] = 'hakikisha umejaza fomu yote';
                header('location:../export.php');
                }
        }
    }
    
}