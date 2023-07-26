<?php
session_start();
if(isset($_SESSION['btn_sign'])){
    header('location:AccidentDashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="viewport" content="width=device-width,initial-scale=1">

        <title>log in</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <script src="assets/js/pace.min.js"></script>
    </head>
        
        
        <body>
            
        <div class="container">
            <div class="card" style="background-color: blue; margin-top: 60px; margin-left: 25%; margin-right: 30%; padding: 5%;">
            <form class="form-horizontal" action="IndexHandler.php" method="post">
                    <div class="form-group"><h2 style="text-align:center; color:white;">ACCIDENT PUSH</h2></div>
                    <div class="form-group"> <img src="assets/images/emerg.jpg" alt="" width="50px" height="50px" style="margin-left: 45%;"></div>
                    <div class="form-group"><h4 style="text-align:center; color:white;">SIGN IN</h4></div>
                    <div class="form-group">
                        <div class="position-relative has-icon-left">
                            <input name="Uname" type="text" style="width: 100%;" placeholder="User_name" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="position-relative has-icon-left">  <input  type="password" name="password" id="" placeholder="password" style="width: 100%;"></div>
                    </div>
                    <div class="position-relative">
                        <label for="display-none"></label>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit" name ="login">SIGN IN</button>
                    </div>
                    <?php
            if(isset($_SESSION['login_error'])){
                ?>
                <p style="color: white;"><?=$_SESSION['login_error']; ?></p>
            <?php } ?>
                    <span style="display:inline;">
                    <div style="text-align:right;color:white;"><h5 >Don't have an account?</h5><a href="register.php"><h5 style="color:white;">register_now</h5></a></div>
                    </span>
            </form>

            <div class="text-center" style="padding-top: 20px;">
                <h6 style="color:white;">Copyright © ACCIDENT PUSH NOTIFICATION</h6>
              </div>
        </div>

    </div>
        </body>
</html>