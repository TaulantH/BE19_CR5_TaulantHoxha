<?php
session_start();
require_once "db_connect.php";


if (isset($_SESSION["adm"])) {
  header("Location: dashboard.php");
}

if (isset($_SESSION["user"])) {
  header("Location: home.php");
}

$email = $passError = $emailError = "";
$error = false;

function cleanInputs($input)
{
  $data = trim($input); 
  $data = strip_tags($data); 
  $data = htmlspecialchars($data); 

  return $data;
}

if (isset($_POST["login"])) {
  $email = cleanInputs($_POST["email"]);
  $password = $_POST["password"];

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
    $emailError = "Please enter a valid email address";
  }


  if (empty($password)) {
    $error = true;
    $passError = "Password can't be empty!";
  }

  if (!$error) {
    $password = hash("sha256", $password);

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) == 1) {
      if ($row["status"] == "user") {
        $_SESSION["user"] = $row["id"];
        header("Location: home.php");
      } else {
        $_SESSION["adm"] = $row["id"];
        header("Location: dashboard.php");
      }
    } else {
      echo "<div class='alert alert-danger'>
                <p>Wrong credentials, please try again ...</p>
              </div>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <style>
    .gradient-custom {
      background: #6a11cb;
      background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
      background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
    }
  </style>
</head>

<body>
  <section class="vh-100 gradient-custom">
    <div class="container py-1 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-2 text-center" style="height: 500px;">

              <div class="mb-md-5 mt-md-4 pb-5">

                <form method="post">
                  <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                  <p class="text-white-50 mb-5">Please enter your login and password!</p>

                  <div class="form-outline form-white mb-4">
                    <label for="email" class="form-label">Email address </label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $email ?>">
                    <span class="text-danger"><?= $emailError ?></span>
                  </div>

                  <div class="form-outline form-white mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <span class="text-danger"><?= $passError ?></span>
                  </div>

            
                    <button class="btn btn-outline-light btn-lg px-5" name="login" type="submit">Log
                      in</button>
                      <p class="mb-0">Don't have an account? <a href="register.php" class="text-white-50 fw-bold">Sign Up</a>
            

                </form>


              </div>
            </div>
          </div>
        </div>
      </div>
  </section>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>

</body>

</html>