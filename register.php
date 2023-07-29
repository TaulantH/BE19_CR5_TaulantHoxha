<?php
require_once "db_connect.php";
require_once "file_upload.php";

session_start();

if (isset($_SESSION["adm"])) {
    header("Location: dashboard.php");
}

if (isset($_SESSION["user"])) {
    header("Location: home.php");
}

$error = false;

$firstname = $lastname = $email = $date_of_birth = $email = $gender = $phone_number = "";
$firstnameError = $lastnameError = $dateError = $emailError = $passError = $genderError = $phoneError = $confirmPassError = "";

function cleanInput($param)
{
    $data = trim($param);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);

    return $data;
}

if (isset($_POST["sign-up"])) {
    $firstname = cleanInput($_POST["first_name"]);
    $lastname = cleanInput($_POST["last_name"]);
    $email = cleanInput($_POST["email"]);
    $password = $_POST["password"];
    $date_of_birth = cleanInput($_POST["date_of_birth"]);
    $gender = cleanInput($_POST["gender"]);
    $phone_number = $_POST["phone_number"];
    $picture = fileUpload($_FILES["picture"]);

    if (empty($firstname)) {
        $error = true;
        $firstnameError = "Please, enter your first name";
    } elseif (strlen($firstname) < 3) {
        $error = true;
        $firstnameError = "Name must have at least 3 characters.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $firstname)) {
        $error = true;
        $firstnameError = "Name must contain only letters and spaces.";
    }

    if (empty($lastname)) {
        $error = true;
        $lastnameError = "Please, enter your last name";
    } elseif (strlen($lastname) < 3) {
        $error = true;
        $lastnameError = "Name must have at least 3 characters.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $lastname)) {
        $error = true;
        $lastnameError = "Name must contain only letters and spaces.";
    }

    if (empty($date_of_birth)) {
        $error = true;
        $dateError = "Date of birth can't be empty!";
    }

    if (empty($gender)) {
        $error = true;
        $genderError = "Gender can't be empty!";
    } elseif (!in_array($gender, array("female", "male", "other"))) {
        $error = true;
        $genderError = "Invalid gender selection.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email address";
    } else {
        $query = "SELECT email FROM users WHERE email = '$email'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) != 0) {
            $error = true;
            $emailError = "Provided Email is already in use";
        }
    }

    if (empty($password)) {
        $error = true;
        $passError = "Password can't be empty!";
    } elseif (strlen($password) < 6) {
        $error = true;
        $passError = "Password must have at least 6 characters.";
    }

    $confirm_password = $_POST["confirm_password"];

    if (empty($confirm_password)) {
        $error = true;
        $confirmPassError = "Please confirm your password.";
    } elseif ($password !== $confirm_password) {
        $error = true;
        $confirmPassError = "Passwords do not match.";
    }
    if (!$error) {
        $password = hash("sha256", $password);
        $sql = "INSERT INTO `users`(`first_name`, `last_name`, `password`, `date_of_birth`, `email`, `gender`, `phone_number`, `picture`) VALUES ('$firstname','$lastname','$password','$date_of_birth','$email','$gender','$phone_number','$picture[0]') ";

        if (mysqli_query($connect, $sql)) {
            echo "<div class='alert alert-success'>
                      <p>New account has been created, $picture[1]</p>
                  </div>";
        } else {
            echo "<div class='alert alert-danger'>
                      <p>Something went wrong, please try again later ...</p>
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
    <nav>

    </nav>


    <section class="vh-100 gradient-custom">
        <div class="container py-0">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div lass="card bg-dark text-white"style="border-radius: 15px;">
                        <div class="card-body p-2 text-center" style="height: 615px;">
                            <h3 class="mb-0 pb-2 pb-md-0 mb-md-2">Registration Form</h3>
                            <form method="post" autocomplete="off" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label for="fname" class="form-label">First name </label>
                                            <input type="text" class="form-control" id="firstame" name="first_name" placeholder="First name" value="<?= $firstname ?>">
                                            <span class="text-danger"><?= $firstnameError ?></span>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label for="fname" class="form-label">Last name </label>
                                            <input type="text" class="form-control" id="lastame" name="last_name" placeholder="First name" value="<?= $lastname ?>">
                                            <span class="text-danger"><?= $lastnameError ?></span>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 d-flex align-items-center">

                                        <div class="form-outline datepicker w-100">
                                            <label for="date" class="form-label">Date of birth</label>
                                            <input type="date" class="form-control" id="date" name="date_of_birth" value="<?= $date_of_birth ?>">
                                            <span class="text-danger"><?= $dateError ?></span>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <h6 class="mb-2 pb-1">Gender: </h6>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="female" checked />
                                            <label class="form-check-label" for="femaleGender">Female</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="maleGender" value="male" />
                                            <label class="form-check-label" for="maleGender">Male</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="otherGender" value="other" />
                                            <label class="form-check-label" for="otherGender">Other</label>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4 pb-2">

                                            <div class="form-outline">
                                                <label for="email" class="form-label">Email address </label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $email ?>">
                                                <span class="text-danger"><?= $emailError ?></span>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4 pb-2">

                                            <div class="form-outline">
                                                <label for="phone" class="form-label">Phone number </label>
                                                <input type="phone" class="form-control" id="phoneNumber" name="phone_number" placeholder="Phone number" value="<?= $phone_number ?>">
                                                <span class="text-danger"><?= $phoneError ?></span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 pb-2">
                                        <div class="form-outline">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                            <span class="text-danger"><?= $passError ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 pb-2">
                                        <div class="form-outline">
                                            <label for="confirm_password" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                            <span class="text-danger"><?= $confirmPassError ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">

                                            <label for="picture" class="form-label">Profile picture </label>
                                            <input type="file" class="form-control" id="picture" name="picture">

                                        </div>
                                    </div>

                                    <div class="mt-4 pt-2">

                                        <button name="sign-up" type="submit" class="btn btn-primary btn-lg">Create account </button>
                                        <span>you have an account already? <a href="login.php" style="color: red;">sign in here </a></span>
                                    </div>

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