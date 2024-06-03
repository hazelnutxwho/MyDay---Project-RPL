<?php
session_start();

if( !isset($_SESSION["login"]) ){
    header("Location: login.php");
    exit;
}

include('config.php');

//ambil task_id
$category_id = $_GET['category_id'];
//cek apakah dalam kategori ada tasks
$rowtasks = mysqli_query($connection, "SELECT * FROM tasks WHERE category_id = '$category_id'");
if(mysqli_num_rows($rowtasks)>0){
    echo "<script>alert('Masih ada task dalam kategori ini!');
                    document.location.href ='todolist.php'</script>";
}else if(mysqli_num_rows($rowtasks)== 0){
    mysqli_query($connection, "DELETE FROM categories WHERE category_id = '$category_id'");
    header("Location: todolist.php");
}

?>