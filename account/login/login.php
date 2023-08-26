<?php 

if (!isset($_POST['username']) or !isset($_POST['password'])){
    die("We cannot log you in unless you fill all fields!");
} elseif (empty($_POST['username']) or empty($_POST['password'])) {
    header("Location: index.html");
}

require_once("../../trash.php");
require_once("../../sanitize.php");

$username = sanitize($_POST['username']);
$password = sanitize($_POST['password']);

 $sql = "SELECT username, password from clients_info WHERE username = '$username'";
 $resource = mysqli_query($conn, $sql);
 $rows = mysqli_num_rows($resource);
 $result = mysqli_fetch_array($resource);
 
 for ($i = 0; $i < $rows; $i++){
     $result['username'];
 }
 if (mysqli_errno($conn)){
     echo mysqli_error($conn);
 }
 //echo $mysqli_error();
 
?>