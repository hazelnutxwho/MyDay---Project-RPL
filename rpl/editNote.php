<?php
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

if(isset($_POST["hidden"])){
    $note_id = $_POST['hidden'];
    $note_title = $_POST['edittitle'];
    $note = $_POST['editnote'];
    $query = mysqli_query($connection,"UPDATE notes SET note_title = '$note_title', note = '$note' WHERE note_id = '$note_id'");
    header("Location: notes.php");
}


echo '<!-- Modal -->
<div
  class="modal fade"
  id="exampleModal"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Note</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            <form action="" method="post">
              <input type="hidden" name="hidden" id="hidden" />
              <label for="noteTitle" class="form-label">Title</label>
              <input
                type="text"
                class="noteTitle form-control"
                name="edittitle"
                id="edittitle"
              />
              <label for="note" class="form-label">Note</label>
              <textarea
                class="form-control"
                name="editnote"
                id="editnote"
                rows="3"
              ></textarea>
              <button class="btn btn-primary" type="submit">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
' ?>
