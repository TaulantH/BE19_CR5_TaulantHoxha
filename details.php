<?php
require_once "db_connect.php";

session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: login.php");
    exit();
}

$id = $_GET["x"];

$sql = "SELECT * FROM animals WHERE id = $id";
$result = mysqli_query($connect, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    header("Location: home.php");
    exit();
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details <?= $row["name"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
        crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <img src="pictures/<?= $row["picture"] ?>" alt="user pic" width="30" height="24">
            </a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="logout.php?logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="card mb-3" style="max-width: 900px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="pictures/<?= $row["picture"] ?>" alt="<?= $row["name"] ?>" class="img-fluid">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row["name"] ?></h5>
                        <p class="card-text">Location: <?= $row["location"] ?></p>
                        <p class="card-text">Description: <?= $row["description"] ?></p>
                        <p class="card-text">Size: <?= $row["size"] ?></p>
                        <p class="card-text">Age: <?= $row["age"] ?></p>
                        <p class="card-text">Vaccinated: <?= $row["vaccinated"] ?></p>
                        <p class="card-text">Breed: <?= $row["breed"] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>
