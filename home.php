<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Library</title>
        <link rel="stylesheet" type="text/css" href="css/log_in_sup.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <style>
            .w3-bar,h1,h1,h2,h3,h4,h5,h6,button {font-family: "Montserrat", sans-serif}
            .center {
                text-align: center;
            }
            body {
                font-family: "Montserrat";
                transition: background-color .5s;
            }
            table {
                border-collapse: collapse;
                border-spacing: 0;
                width: 100%;
                border: 1px solid #ddd;
                font-family: "Montserrat"
            }
            input[type=text], input[type=password],input[type=email],input[type=number]{
                border: none;
                border-bottom: 1.3px solid #000;
                background: transparent;
                outline: none;
                height: 40px;
            }

            th, td {
                text-align: left;
                padding: 8px;
            }

            button{
                width: 10%;
                background-color:black;
                color: white;
                font-size:20px;
                padding: 5px 0px;
                margin: 4px 0;
                border: none;
                border-radius: 35px;
                cursor: pointer;
                margin-left:2%;
            }

            button:hover {
                background-color: grey;
            }

            tr:nth-child(even){background-color: #f2f2f2}

            .sidenav {
                height: 100%;
                width: 0;
                position: fixed;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: #111;
                overflow-x: hidden;
                transition: 0.5s;
                padding-top: 60px;
            }

            .sidenav a {
                padding: 8px 8px 8px 32px;
                text-decoration: none;
                font-size: 25px;
                color: #818181;
                display: block;
                transition: 0.3s;
            }

            .sidenav a:hover {
                color: #f1f1f1;
            }

            .sidenav .closebtn {
                position: absolute;
                top: 0;
                right: 25px;
                font-size: 36px;
                margin-left: 50px;
            }

            #main {
                transition: margin-left .5s;
                padding: 16px;
            }

            @media screen and (max-height: 450px) {
                .sidenav {padding-top: 15px;}
                .sidenav a {font-size: 18px;}
            }
        </style>
    </head>
    <body>
        <div id="main">
            <div class="w3-white w3-card" id="myNavbar">
                <a>&nbsp;&nbsp;</a>
                <a style="font-size:20px;cursor:pointer" onclick="openNav()">&#9776</a>
                <a href="home.php" class="w3-bar-item w3-button w3-wide">LMS | RUAS</a>
                <a href="login.php" class="w3-bar-item w3-button w3-wide" style="float:right">Log Out</a>
            </div>
            <?php
            $username = $_SESSION['username'];
            echo '<html><h1>Welcome ' . ucfirst($username) . ' to RUAS Library</h1></html>';
            ?>
            <form role="form" id="templatemo-preferences-form" name="registration" action="" method="post">
                <div class="center">
                    <input type="text" id="Search" placeholder="Search Books" name="name">
                    <button type="submit"  name="search" value="Search" >Search</button><br/>
                </div>
            </form>

            <div><center><h2>List of Available Books</h2></center></div>
            <?php
            $bookName = filter_input(INPUT_POST, 'name');



            $con = mysqli_connect("localhost", "root", "", "library");

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            if ($bookName . null) {
//                $sql = "SELECT * FROM books WHERE MATCH (`bookName`,`bookAuthor`) AGAINST ('$bookName' IN NATURAL LANGUAGE MODE) AND `Availibility`='Yes'";
                $bookName .= '%';
                $sql = "SELECT * FROM books WHERE `bookName` LIKE '$bookName' AND `Availibility`='Yes'";
            } else {
                $sql = "select * from books where `Availibility`='Yes'";
            }
            $result = mysqli_query($con, $sql);
            ?>
            <div class="table-responsive-sm">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><center>Book Id</center></th>
                    <th><center>Book Name</center></th>
                    <th><center>Book Author</center></th>
                    <th><center>Availability</center></th>													
                    </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0) { ?>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr id="<?php echo $row["bookID"]; ?>">
                                    <td><center><?php echo $row["bookID"]; ?></center></td>
                            <td><center><?php echo $row["bookName"]; ?></center></td>
                            <td><center><?php echo $row["bookAuthor"]; ?></center></td>
                            <td><center><?php echo $row["Availibility"]; ?></center></td>				   				   				  
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
                document.getElementById("main").style.marginLeft = "250px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("main").style.marginLeft = "0";
            }
        </script>
        <script>
            function myFunction(val) {

                document.getElementById("myDiv").innerHTML = val;

            }
        </script>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="home.php">Dashboard</a>
            <a href="issue.php">Issue Books</a>
            <a href="return.php">Return Books</a>
            <a href="booklist.php">Book List</a>
            <a href="#">Add Books</a>
        </div>
        
    </body>
</html>