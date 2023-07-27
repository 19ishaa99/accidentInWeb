<?php

session_start(); //start a session
$loggedInUser = $_SESSION['loggedin_user'];

if ($loggedInUser == null) {
    //redirect to the login page
    header('location:index.php');
}
