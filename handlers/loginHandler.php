<?php
session_start();
require_once("../connection.php"); //include connection string
// echo "hello me";
echo "<br>";
//check if the login button is clicked
if (isset($_POST['login'])) {
    print_r($_POST);
    echo "<br>";

    $username = htmlspecialchars($_POST['username']); //!sanitize this data
    $password = $_POST['password'];

    try {
        //now check if the username and passord matches
        $sql = "select * from usertable where Name=:username";
        $query = $connection->prepare($sql);
        $query->bindValue(":username", $_POST['username']);
        //$query->execute(array( 'username'     =>     $_POST["username"]));
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        print_r($user);
        echo "<br>";

        if ($user != null) {
            //user found
            echo "user found";
            echo "<br>";

            //now check the password
            echo $password ." <br> " . $user['Password'] . " <br>";
            if (password_verify($password, $user['Password'])) {
                //login success, redirect to the dashboard
                //set logged in user details and session timeout to 30 seconds
                $_SESSION["loggedin_user"] = array("Name" => $user['Name'], 'Role' => $user['Role'], 'PhoneNo' => $user['PhoneNo'], 'MemberSince' => $user['MemberSince'], "Email" => $user['Email']);
                //check the role and redirect user based on the role, NOTE: this is bad idea, the best way to implement this is to show or hide feature based on user role
                header('location:../Dashboard.php');
            } else {
                //login failed

                $_SESSION['error_message'] = "Login Failed! Invalid username or password";
                echo "Login failed! Invalid username or password => hash validation failed";
                echo "<br>";
                //redirect back to login page
                //header('location:../index.php');
            }
        } else {
            echo "Login failed! Invalid username or password";
            echo "<br>";
        }
    } catch (PDOException $error) {
        $message = $error->getMessage();
        print_r($message);
    }
} else {
    //go back to login page
    header('location:../index.php');
}

// function validAccount($username,$passowrd) {
//     $response = 
// }