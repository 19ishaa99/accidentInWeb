<?php
require 'connection.php';
    session_start();

    if (isset($_SESSION['is_login'])) {
        session_unset();
        header("location:../index.php");
    }
?>