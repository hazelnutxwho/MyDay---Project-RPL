<?php
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

include('config.php');

//ambil task_id
$note_id = $_GET['note_id'];
mysqli_query($connection, "DELETE FROM notes WHERE note_id = '$note_id'");
header("Location: notes.php")
?>