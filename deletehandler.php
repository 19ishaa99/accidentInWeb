<?php
require_once '../store/db.php';

$pdo = connection();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['delete'])){


        if (!isset($_POST['inp'])) {
            $pdo = null;
            header("location:../supplier.php");
        }else {
            $sid = $_POST['inp'];
            
            $stmt = $pdo->prepare("DELETE FROM supplier WHERE id=:suppid");
            
           $res= $stmt->execute([":suppid"=>$sid]);
           if (!$res) {
               $pdo = null;
                header("location:../supplier.php"); 
           }else {
                $pdo = null;
                header("location:../supplier.php");
           }

        }
    
    
    
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!isset($_POST['dlt'])){
        $pdo null;
        header("location:../view.php");

    }else{
        $delete = ($_POST['dlt']);
        $str = $pdo->prepare("DELETE import.id as id, import.invoice_number as number, 
                            item.item_name as name, 
                            item.quantity as quantity, item.price as price, import.order_date as ordered, import.created_at as imported, user.fname, user.lname, user.email 
                            FROM import INNER JOIN item ON import.id = item.import_id 
                            INNER JOIN user ON user.id = item.user_id WHERE import.id=id");
                            $res = $str->execute(array(":id" => $delete));
                            if(!res){
                                $pdo null;
                            header("location:../view.php");
                            }else{
                                header("location:../view.php");
                            }
    }
}

?>