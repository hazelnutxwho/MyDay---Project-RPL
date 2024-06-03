<?php
session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

include 'config.php';

if(isset($_POST['signin'])){
    //ambil data
    $username = strtolower(htmlspecialchars($_POST['username']));
    $password = $_POST['password'];

    //buat query
    $q = mysqli_query($connection, "SELECT * FROM users WHERE username = '$username'");
    if(mysqli_num_rows($q) === 1){
        //cek pw
        $data = mysqli_fetch_assoc($q);
        if(password_verify($password, $data['password'])){
            //start session
            $_SESSION["user"] = $data;
            $_SESSION["login"] = true;

            header("Location: index.php");

            exit; //keluar fungsi if
        }
    }

    $error = true;
    if ( isset($error) ){
        echo "<script>alert('Username/Password salah!');
        document.location.href ='login.php'</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>MyDay Login</title>
  </head>

  <style>
    .babyblue {
        background-color: #CFE1F4;
        background-image: url('units/elements.png'); 
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;

    }

    .card {
        background-color: #4D7CBF;
        border-radius: 20px;
    }

    .form {
      font-family: "Poppins", sans-serif
    }

    .btn{
        font-family: "Poppins", sans-serif;
        font-size: 18px;
        font-weight: 800;
        background: #F5B195;
        width: 150px;
        padding: 5px;
        text-align: center;
        text-decoration: none;
        text-transform: uppercase;
        color: #FFF9EF;
        border-radius: 50px;
        cursor: pointer;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        -webkit-transition-duration: 0.3s;
        transition-duration: 0.3s;
        -webkit-transition-property: box-shadow, transform;
        transition-property: box-shadow, transform;
    }

    .btn:hover, .btn:focus, .btn:active {
        box-shadow: 0 0 20px rgba(0,0,0,0.5);
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
    
  </style>

  <body>
    <section>
      <main class = "form-signin">
        <div class="container-fluid babyblue">
          <div class="row align-items-center" style="height: 100vh;">
            <div class="col-12 col-sm-5 col-md-4 m-auto">
              <div class="card border-0 shadow">
                <div class="card-body">

                  <form method="post">
                      <div class="mb-1 d-flex justify-content-center">
                         <img src="units/userr.png" height="80">
                      </div>
                      <div class="mb-3">
                          <label for="input2" class="form-label" style="color: #FFF9EF; font-weight:bold; font-size: 18px">Username</label>
                          <input type="text" class="form-control" name="username" style="background-color: #CFE1F4;" id="floatingInput"  placeholder="Your Username">
                        </div>
                      <div class="mb-4">
                          <label for="" class="form-label" style="color: #FFF9EF; font-weight:bold; font-size: 18px">Password</label>
                          <input type="password" name="password" class="form-control" style="background-color: #CFE1F4;" id="floatingPassword" placeholder="Password">
                      </div>
                      <div class="text-center mb-3">
                          <button class="btn" id="signin" type="submit" name="signin">Login </button>
                      </div>
                  </form>
                  <p class="text-center" style="color:#FFF9EF;">Not register yet? <a href="register.php" style="font-weight: bold; color: #F5B195; text-decoration: none;">Sign Up</a></p>


                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </section>
<!-- 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script> -->
  </body>
</html>
