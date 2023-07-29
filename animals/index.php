<?php
    require_once "../db_connect.php";

    session_start();

    if(isset($_SESSION["user"])){
        header("Location: ../home.php");
    }

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: ../login.php");
    }

    $sql = "SELECT * FROM `animals`";
    $result = mysqli_query($connect, $sql);

    $layout = "";
 
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $layout .= "<div class='col-sm-4'>
            <div class='card'>
              <div class='image'>
                <img src='../pictures/{$row["picture"]}' class='card-img-top'  height=250px; alt='...'>
                </div>
                <div class='card-body'>
                <h5 class='card-title'>{$row["name"]}</h5>
                <p class='card-text'>{$row["location"]}</p>
                <a href='details.php?x={$row["id"]}' class='btn btn-primary'>Details</a>
                <a href='update.php?x={$row["id"]}' class='btn btn-warning'>Update</a>
                <a href='delete.php?x={$row["id"]}' class='btn btn-danger'>Delete</a>
                </div>
                </div>
          </div>";
        }
    }else {
        $layout .= "No Results";
    }
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
            <a class="nav-link active" aria-current="page" href="../dashboard.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="create.php">New animal</a>
            </li>
        </ul>
        
        </div>
    </div>
    </nav>

    <div class="container">
        <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-xs-1">
            <?= $layout ?>
        </div>
    </div>
   


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>