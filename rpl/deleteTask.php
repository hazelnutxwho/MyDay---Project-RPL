<?php
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

include('config.php');

//ambil task_id
$task_id = $_GET['task_id'];
mysqli_query($connection, "DELETE FROM tasks WHERE task_id = '$task_id'");
header("Location: todolist.php")
?>