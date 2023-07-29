<?php
session_start();

if (isset($_SESSION["adm"])) {
    header("Location: dashboard.php");
}

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: login.php");
}

require_once "db_connect.php";

function isPetAdopted($pet_id, $connect)
{
    $user_id = $_SESSION["user"];
    $sql = "SELECT COUNT(*) as count FROM pet_adoption WHERE user_id = $user_id AND pet_id = $pet_id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row["count"] > 0;
}

$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

if ($filter === 'senior') {
    $sqlAnimals = "SELECT * FROM animals WHERE age >= 8";
} else {
    $sqlAnimals = "SELECT * FROM animals";
}

$resultAnimals = mysqli_query($connect, $sqlAnimals);

$sql = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";

$result = mysqli_query($connect, $sql);

$row = mysqli_fetch_assoc($result);

$layout = "";

if (mysqli_num_rows($resultAnimals) > 0) {
    while ($rowAnimal = mysqli_fetch_assoc($resultAnimals)) {
        $isAdopted = isPetAdopted($rowAnimal["id"], $connect);
        $layout .= "<div class='col-sm-4'>
            <div class='card'>
                <div class='image'>
                    <img src='pictures/{$rowAnimal["picture"]}' class='card-img-top' height='250px' alt='...'>";
      
        if ($isAdopted) {
            $layout .= "<div class='adopted-banner'>Adopted</div>";
        }
        $layout .= "</div>
                <div class='card-body'>
                    <h5 class='card-title'>{$rowAnimal["name"]}</h5>
                    <p class='card-text'>{$rowAnimal["location"]}</p>
                    <a href='details.php?x={$rowAnimal["id"]}' class='btn btn-primary'>Details</a>";
        if ($rowAnimal["status"] === 'available' && !$isAdopted) {
            $layout .= "<a href='adopt.php?pet_id={$rowAnimal["id"]}' class='btn btn-primary'>Take me home</a>";
        } else if ($rowAnimal["status"] === 'Unavailable') {
            $layout .= "<p class='text-danger'>Already taken</p>";
        } else {
            $layout .= "<p class='text-success'>Adopted</p>";
        }

        $layout .= "</div>
            </div>
        </div>";
    }
} else {
    $layout .= "No results found!";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?= $row["first_name"] ?></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
        crossorigin="anonymous">

<style>
    .adopted-banner {
        position: absolute;
        top: 10px;
        left: 10px;
        padding: 5px;
        background-color: #f44336; 
        color: white;
        font-weight: bold;
        border-radius: 5px;
    }
</style>

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="pictures/<?= $row["picture"] ?>" alt="user pic" width="30" height="24">
            </a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="update.php?id=<?= $row["id"] ?>">Edit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php?logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <h2 class="text-center">Welcome <?= $row["first_name"] . " " . $row["last_name"] ?></h2>

    <div class="container">
        <div class="row">
            <div class="my-3">
                <a class="btn btn-primary" href="?filter=senior">Senior Animals</a>
                <a class="btn btn-secondary" href="home.php">Reset Filter</a>
            </div>
            <div class="container">
                <h2 class="text-center">Pets available</h2>
                <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-xs-1">

                    <?= $layout ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>
