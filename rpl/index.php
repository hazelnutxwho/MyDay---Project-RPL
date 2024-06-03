<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

//user id
$user_id = $_SESSION['user']['user_id'];

//data tasklist
$queryTask = mysqli_query($connection, "SELECT * FROM tasks JOIN categories ON tasks.category_id = categories.category_id WHERE tasks.user_id = '$user_id' ORDER BY tasks.datetime ASC");
mysqli_data_seek($queryTask, 0);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <script src="js/index.js" defer></script>
    <title>MyDay</title>
</head>

<body>
    <div class="myday">
        <div class="side-navbar">
            <div class="profile"></div>
            <h1>MyDay</h1>
            <div class="features">
                <li><a href="index.php">Home</a></li>
                <li><a href="notes.php">Notes</a></li>
                <li><a href="todolist.php">To-Do List</a></li>
            </div>
            <div class="logout">
                <p><a href="signout.php" style="color: #14346A;"><strong>Logout</strong></a></p>
            </div>
        </div>
        <div class="jarak"></div>
        <div class="content-page">
            <div class="backgroundsvg"></div>
            <div class="containerDatetime">
                <div class="date">Date</div>
                <div class="time">Time</div>
            </div>
                <div class="Tasklist">
                    <div class="container">
                        <div class="judul-task">
                            <h1>Tasks</h1>
                        </div>   
                        <div class="list-box">
                                <?php
                                $total = mysqli_num_rows($queryTask);
                                if ($total == 0) {
                                    echo '<p>Add your task!</p>';
                                } else {
                                    if ($total < 10) {
                                        $cnt = $total;
                                    } else {
                                        $cnt = 10;
                                    }
                                    for ($i = 0; $i < $cnt; $i++) {
                                        $task = mysqli_fetch_assoc($queryTask);
                                        if ($task['status'] == 0) {
                                            echo '<p>' . $task['task'] . ' -  '.$task['category_name'].'</p>';
                                        } else {
                                            $isitask = $task['task'];
                                        }
                                        
                                    }
                                }
                                ?>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>

    </div>


</body>


</html>