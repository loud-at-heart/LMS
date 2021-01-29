<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "library");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$id = $_GET['id'];
$sql = "UPDATE `books` SET `Availibility`='No' WHERE `bookID`=$id";

$result = mysqli_query($con, $sql);
$sql = "SELECT * FROM `books` WHERE `bookID`=$id";

$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['bookName'];
}
//echo strval($name);
$sql = "INSERT INTO `issued_books`(`bookID`, `Issuer`, `bookName`, `issueDate`, `returnDate`) VALUES ($id,'User','$name',CURRENT_TIMESTAMP,Date_ADD(`issueDate`, INTERVAL +7 day))";
$result = mysqli_query($con, $sql);
if (mysqli_affected_rows($con) > 0) {
    $_SESSION["up"] = $result;
    header("location: ./issue.php");
} else {
    echo "Affected rows: " . mysqli_affected_rows($con);
}
//header("location: ./issue.php");
mysqli_close($con);
?>