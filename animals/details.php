<?php
    require_once "../db_connect.php";

    session_start();

    if(isset($_SESSION["user"])){
        header("Location: ../home.php");
    }

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: ../login.php");
    }


    $id = $_GET["x"];

    $sql = "SELECT * FROM animals WHERE  id = $id";
    $result = mysqli_query($connect, $sql);

    $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="create.php">Put another animal</a>
            </li>
        </ul>
        
        </div>
    </div>
    </nav>
    <div class="container" >
    <div class="card mb-3" style="max-width: 900px;">
  <div class="row no-gutters">
    <div class="col-md-4">
    <p><img src="../pictures/<?= $row["picture"] ?>"></p>
    </div>   <div class="col-md-8">
      <div class="card-body">
                <p>Name: <?= $row["name"] ?></p>
                <p>Location: <?= $row["location"] ?></p>
                <p>Description: <?= $row["description"] ?></p>
                <p>Size: <?= $row["size"] ?></p>
                <p>Age: <?= $row["age"] ?></p>
                <p>Vaccinated: <?= $row["vaccinated"] ?></p>
                <p>Breed: <?= $row["breed"] ?></p>

            </div>
        </div>
    </div>
    </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>