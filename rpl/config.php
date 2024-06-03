
<?php
    $server = "localhost";
    $user = "root";
    $password ="";
    $database = "rplproject";

    $connection = mysqli_connect($server,$user,$password,$database) or die(mysqli_error($koneksi));
?>