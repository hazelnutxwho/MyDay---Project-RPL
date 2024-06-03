<?php
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

include('config.php');

//ambil task_id
$task_id = $_GET['task_id'];
$q = mysqli_query($connection, "SELECT * FROM tasks WHERE task_id = '$task_id'");
$check = mysqli_fetch_assoc($q);
if($check['status']==1){
    mysqli_query($connection, "UPDATE tasks SET status='0' WHERE task_id = '$task_id'");

}else{
    mysqli_query($connection, "UPDATE tasks SET status='1' WHERE task_id = '$task_id'");
}
header("Location: todolist.php");
?>