<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <style>
            h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
            .w3-bar,h1,button {font-family: "Montserrat", sans-serif}
            body{
                background: url("css/img/lms.jpg");
                background-size: cover;
                background-position: center;
                font-family: sans-serif;
                background-repeat: no-repeat;
                height:100%;
                min-height:100%;
            }
            html
            {
                height:100%;
            }
            .w3-bar .w3-button {
                padding: 10px;
            }
        </style>
        <title>Login Page</title>
        <link rel="stylesheet" type="text/css" href="css/log_in_sup.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="w3-top">
            <div class="w3-bar w3-white w3-card" id="myNavbar">
                <a href="#" class="w3-bar-item w3-button w3-wide">LMS | RUAS</a>
                </a>
            </div>
        </div>
    <center>
        <br></center>
    <!-- Page for Big screen -->
    <div class="loginbox w3-hide-small">
        <img src="css/img/user.png" class="avatar">
        <h1>Log In</h1>
        <?php
        session_start();
        ?>
        <?php
        if (isset($_SESSION['bres'])) {
            session_destroy();
            echo'<script language="javascript">alert("You are successfully registered. Login to enjoy the services.!")</script>';
        }
        ?>
        <?php
        // put your code here
        $name = $password = '';
        if (isset($_POST['staff_name'])) {
            $name = $_POST['staff_name'];

            $password = $_POST['staff_pwd'];


            $con = mysqli_connect("localhost", "root", "", "library");

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }


            $query = "SELECT * FROM `library_staff` WHERE `staff_Id` = '$name'AND `staff_pwd`='$password'";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    session_start();
                    $_SESSION['username'] = $row['staff_name'];
                    $_SESSION['email'] = $row['email_Id'];
                    header("Location: home.php");
                } else {
                    echo '<script language="javascript"> alert("Wrong Email or Password") </script>';
                }
            } else {
                echo '<script language="javascript"> alert("Wrong Email or Password") </script>';
            }
        } else {
            
        }
        ?>

        <form role="form" name="registration" action="" method="post">
            <div class="center">
                <label>NAME</label><br/>

                <input type="text" id="lastName" placeholder="Enter Name" name="staff_name" required> <br/>

                <label>PASSWORD</label><br/>

                <input type="password" id="lastName4" placeholder="Enter Password" name="staff_pwd" required><br/>
                <br/>
                <input type=submit name="logbutton" value="Login"/><br>
                <a href="index.php">Don't have an Account?</a>
            </div>
        </form>
    </div>
</body>

</html>
