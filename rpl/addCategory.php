<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

$category_name = $_POST['categoryname'];
$user_id = $_SESSION['user']['user_id'];
mysqli_query($connection, "INSERT INTO categories VALUES ('','$user_id', '$category_name')");
header("Location: todolist.php");

?>

            