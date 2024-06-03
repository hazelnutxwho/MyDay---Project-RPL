<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

include 'config.php';

//user id
$user_id = $_SESSION['user']['user_id'];

//data notes
$query = mysqli_query($connection, "SELECT * FROM notes WHERE user_id = '$user_id'");
$notes = mysqli_fetch_assoc($query);
if(mysqli_num_rows($query) < 1){
    $note_title = "Notes";
    $note = "Notes";
} else {
    $note_title = $notes['note_title'];
    $note = $notes['note'];

}

?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="note.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@800&family=Zen+Kaku+Gothic+New:wght@700&display=swap" rel="stylesheet">
  <title>MyDay | Notes</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>

<body>
  <?php include "editNote.php" ?>
  <div class="backgrounds"></div>
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
                  <p><a href="signout.php" style="color: #14346A;"><strong>Logout</strong></a></p>
                </div>
        </div>
  </div>

  <div class="taskBox">
      <div class="notesHead" style="font-weight: 700;
          font-size: 35px;
          line-height: 23px;
          text-align: center;
          margin-top: 30px;
          margin-left: 15px;
          margin-bottom: -30px;
          padding-top: 10px;
          color: #14346A; 
          text-decoration: none;">My Notes
      </div>
      <div class="container p-3">
          <div class="noteDisplay" style="height: 450px; overflow:auto; margin-bottom: -30px;">
              <?php $query = mysqli_query($connection, "SELECT * FROM notes WHERE user_id = '$user_id'")?>
              <?php mysqli_data_seek($query, 0)?>
              <div>
            <?php
              $noNotes = true;
              while ($note = mysqli_fetch_assoc($query)) {
              $noNotes = false;
              echo '
              <div class="mb-2 card" style="width: 30rem; border-radius: 8px;">
                <div class="card-body" style="background-color: #14346A;">
                    <h5 class="card-title" style="color: #CFE1F4; font-weight:600; font-size: 24px;">' . $note['note_title'] . '</h5>
                    <p class="card-text" style="color: #FFF9EF">' . $note['note'] . '</p>
                    <a class="btn btn-primary-custom edit" data-bs-toggle="modal" data-bs-target="#exampleModal" id="' . $note['note_id'] . '">Edit note</a>
                    <a class="btn btn-primary-custom" href="deleteNote.php?note_id=' . $note['note_id'] . '">Delete note</a>
                </div>
              </div>';
              }
              if ($noNotes) {
                echo '
                    <div class="mb-2 card" style="width: 30rem; border-radius: 8px;">
                        <div class="card-body" style="background-color: #14346A;">
                            <h5 class="card-title" style="color: #CFE1F4; font-weight:600; font-size: 24px;">Note</h5>
                            <p class="card-text" style="color: #FFF9EF">You do not have any saved notes</p>
                        </div>
                    </div>';
              }
            ?>
          </div>
        </div>
    </div>

      <style>
        .btn-primary-custom {
          background-color: #14346A;
          color: #CFE1F4;
          border: 2px solid #CFE1F4;
        }
      </style>

    <div class="addNote">
      <button type="button" class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#noteModal">Add Note</button>
      <div class="modal" id="noteModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Add New Note</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              <form action="addNote.php" method="post">
                <div class="mb-3">
                  <label for="noteTitle" class="form-label">New Title</label>
                  <input type="text" class="form-control" name="noteTitle">
                </div>
                <div class="mb-3">
                  <label for="note" class="form-label">New Note</label>
                  <textarea name="note" class="note form-control" cols="30" rows="3"></textarea>
                </div>
                <button class="btn btn-secondary">Add</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <style>
    .btn-primary-custom {
      background-color: #14346A;
      color: #CFE1F4;
      border: 2px solid #CFE1F4;
      margin-top: 25px;
    }
    </style>


    <style>
    .btn-primary-custom {
      background-color: #14346A;
      color: #CFE1F4;
      border: 2px solid #CFE1F4;
      margin-top: 25px;
    }
    </style>

  </div>

</body>

<script>
  const edit = document.querySelectorAll(".edit");
  const editTitle = document.getElementById("edittitle");
  const editNote = document.getElementById("editnote");
  const hiddenInput = document.getElementById("hidden");
  edit.forEach(element => {
    element.addEventListener("click", () => {
      const titleText = element.parentElement.children[0].innerText
      const noteText = element.parentElement.children[1].innerText
      editTitle.value = titleText;
      editNote.value = noteText;
      hiddenInput.value = element.id;
      console.log(hiddenInput)
    })
  })
</script>

</html>

