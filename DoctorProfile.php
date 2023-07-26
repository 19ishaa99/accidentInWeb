<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Dashboard.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>DoctorProfile</title>
</head>
<body>
    <div class="jumbotron">
    <div id="mysidenav" class="sidenave">
        <p class="logo"><span>ACCIDENT</span>PUSH</p>
        <a href="Dashboard.php"icon-a><i class="fa fa-desktop icons"></i>&nbsp;&nbsp;DASHBOARD</a>
        <a href="AddDoctor.php" class="icon-a"><i class="fa fa-user icons"></i>&nbsp;&nbsp;ADD DOCTOR</a>
        <a href="AddTips.php" class="icon-a"><i class="fa fa-desktop icons"></i>&nbsp;&nbsp;ADD TIPS</a>
        <a href="ViewTips.php"icon-a><i class="fa fa-desktop icons"></i>&nbsp;&nbsp;VIEW TIPS</a>
        <a href="Report.php"icon-a><i class="fa fa-desktop icons"></i>&nbsp;&nbsp;REPORT</a>
        <a href="DoctorProfile.php"icon-a><i class="fa fa-desktop icons"></i>&nbsp;&nbsp;DOCTOR'S PROFILE</a>
        <a href="AdminProfile.php"icon-a><i class="fa fa-desktop icons"></i>&nbsp;&nbsp;ADMIN PROFILE</a>
    </div>

    <div id="main">
        <div class="head">
            <div class="col-div-6">
                <label style="font-weight: bold; font-size: 20px; text-align: center; color: white; padding-left: 10px; padding-top: 10px;">STATE UNIVERSITY OF ZANZIBAR</label>
            </div>
            <div class="col-div-6">
                <div class="profile">
                <img src="pic1.jpg" class="pro-img">
                <p><i class="fa fa-power-off"></i> &nbsp;&nbsp;</p>
            </div>
        </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="clearfix"></div>
        <br/><br/>
        <div class="col-div-8" style="margin-top: 9px;">
            <div class="box-8">
                <div class="content-box">
                   <form  class = '' action="" method="post">
                    <h4>DOCTOR PROFILE</h4>
                    <div class="form-control"><label for="">Name:</label>
                    <input type="text" placeholder="enter name" name="name">
                    </div>
                    <div class="form-control"><label for="">Address:</label>
                        <input type="text" placeholder="enter name" name="address">
                        </div>
                        <div class="form-control"><label for="">Gender:</label>
                            <input type="text" placeholder="enter name" name="gender">
                            </div>
                            <div class="form-control"><label for="">Phone Number:</label>
                                <input type="text" placeholder="enter name" name="phoneNo">
                                </div>
                                <div class="form-control"><label for="">E-mail:</label>
                                    <input type="text" placeholder="enter name" name="email">
                                    </div>
                                    <div class="form-control"><label for="">PASSWORD:</label>
                                        <input type="password" placeholder="enter name" name="password">
                                        </div>
                                    <div>

                                        <button class="btn btn-primary">EDIT</button>
                                        <button class="btn btn-primary btn-success">SAVE</button>
                                     </div>
                   </form>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
</body>
</html>