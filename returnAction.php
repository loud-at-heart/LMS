<?php

session_start();
$con = mysqli_connect("localhost", "root", "", "library");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$id = $_GET['id'];
$sql = "UPDATE `books` SET `Availibility`='Yes' WHERE `bookID`=$id";

$result = mysqli_query($con, $sql);
$sql = "DELETE FROM `issued_books` WHERE `bookID` = $id";

$result = mysqli_query($con, $sql);
if (mysqli_affected_rows($con) > 0) {
    $_SESSION["ret"] = $result;
    header("location: ./return.php");
} else {
    echo "Affected rows: " . $mysqli -> affected_rows;
}
//header("location: ./issue.php");
mysqli_close($con);
?>