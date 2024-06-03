<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

$user_id = $_SESSION['user']['user_id'];
$q = mysqli_query($connection, "SELECT * FROM tasks WHERE user_id = '$user_id'");
$row = mysqli_fetch_assoc($q);

$q2 = mysqli_query($connection, "SELECT * FROM categories");
$cnt = mysqli_num_rows($q2);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="todo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>MyDay | Task-List</title>
</head>

<body>
    <div class="myday">
        <div class="side-navbar">
            <div class="profile">
            </div>
            <h1>MyDay</h1>
            <div class="features">
                <li><a href="index.php">Home</a></li>
                <li><a href="notes.php">Notes</a></li>
                <li><a href="todolist.php">To-Do List</a></li>
            </div>
            <div class="logout">
                <p><a href="signout.php" style="color:#14346A;">Logout</a></p>
            </div>
    </div>
        <div class="jarak"></div>
        <div class="content-page">
            <div class="backgroundsvg">
                <img src="units/todo.svg"> 
            </div>
            <div class="add-task">
                <form action="addCategory.php" method="post" class="add-task-box">
                    <button><i class="fas fa-plus"></i></button>
                    <input type="text" name="categoryname" placeholder="Add Task Category" required>
                </form>
            </div>
            <div class="task-list">
                <?php $cat = mysqli_query($connection, "SELECT * FROM categories WHERE user_id = '$user_id'"); ?>
                <?php mysqli_data_seek($cat, 0);
                $i = 1; ?>

                <?php while ($category = mysqli_fetch_assoc($cat)): ?>
                    <?php $catid = $category['category_id'] ?>
                    <div class="task-list-box">
                        <div class="judul-box">
                            <h2 class="text-center" style="color: #CFE1F4;">
                                <?= $category['category_name'] ?>
                            </h2>
                        </div>
                        <div class="konten-box">
                            <div class="isi-list">
                                <?php
                                $ta = mysqli_query($connection, "SELECT * FROM tasks WHERE category_id = '$catid' AND user_id = '$user_id'");

                                while ($tasks = mysqli_fetch_assoc($ta)):
                                    if ($tasks['status'] == 1) {
                                        $isitask = '<p style="text-decoration: line-through;">' . $tasks['task'] . '</p>';
                                    } else {
                                        $isitask = '<p>' . $tasks['task'] . '</p>';
                                    }
                                ?>
                                    <div class="isi-list-box">
                                        <a href="doneTask.php?task_id=<?= $tasks['task_id'] ?>" style="text-decoration: none; color:#CFE1F4;"><i class="fa-regular fa-square-check"></i></a>
                                        <?=$isitask?>
                                        <a  href="deleteTask.php?task_id=<?= $tasks['task_id'] ?>" style="text-decoration: none; color:#CFE1F4;" ><i class="fa-regular fa-trash-can"></i></a>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                                <div class="form-wrap" id="<?php echo $i ?>" style="display: none;">
                                    <form class="task-form" action="addTask.php?category_id=<?= $catid ?>" method="post">
                                        <input type="text" name="task" placeholder="Create a new list" required>
                                    </form>
                                </div>
                            <div class="button-wrap">
                                <div class="add-list-button" style="background-color: #CFE1F4;">
                                    <button onclick="showInput('<?php echo $i ?>')"><i class="fa-solid fa-plus"></i></button>
                                </div>
                                <div class="add-list-button" style="background-color: #CFE1F4;" >
                                    <button><a href="deleteCategory.php?category_id=<?= $category['category_id'] ?>" style="text-decoration: none; color:#14346A;"><i class="fa-regular fa-trash-can"></i></a></button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php $i++; ?>
                <?php endwhile; ?>
            </div>
            <div class="blank"></div>
        
        </div>
    </div>
    <script>
        function showInput(containerId) {
            var inputContainer = document.getElementById(containerId);
            inputContainer.style.display = 'block';
        }
    </script>
</body>

</html>