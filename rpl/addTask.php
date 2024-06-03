<?php 
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

include('config.php');

//ambil data
$user_id = $_SESSION['user']['user_id'];

$q2 = mysqli_query($connection, "SELECT * FROM categories");
$category_id = $_GET['category_id'];
$task = $_POST['task'];
$datetime = date("Y-m-d H:i:s");

mysqli_query($connection, "INSERT INTO tasks VALUES ('','$user_id', '$category_id', '$task', '$datetime','')");
header("Location: todolist.php")


?>