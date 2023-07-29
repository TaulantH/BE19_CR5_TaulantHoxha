<?php
    require_once "../db_connect.php";
    require_once "../file_upload.php";

    session_start();

    if(isset($_SESSION["user"])){
        header("Location: ../home.php");
    }

    if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
        header("Location: ../login.php");
    }

    $id = $_GET["x"];
    $sql = "SELECT * FROM animals WHERE id = $id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);


    $options = "";

 
    if(isset($_POST["update"])){
        $name = $_POST["name"];
        $location = $_POST["location"];
        $size = $_POST["size"];
        $age = $_POST["age"];
        $picture = fileUpload($_FILES["picture"], "product");

        if($_FILES["picture"]["error"] == 0){
            if($row["picture"] != "product.png"){
                unlink("../pictures/$row[picture]");
            }
            $sql = "UPDATE animals SET name='$name', location='$location', size='$size', age = '$age', picture='$picture[0]'  WHERE id = $id";
        } else {
            $sql = "UPDATE animals SET name='$name', location='$location', size='$size', age = '$age' WHERE id = $id";
        }
        if(mysqli_query($connect, $sql)){
            echo "<div class='alert alert-success' role='alert'>
                    Record has been updated, {$picture[1]}
                </div>";
            header("refresh: 3; url=index.php");
        } else {
            echo "<div class='alert alert-danger' role='alert'>
                    Error found, {$picture[1]}
                </div>";
        }

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
    <div class="container mt-5">
       <h2>Update details of animals</h2>
       <form method="POST" enctype="multipart/form-data"> 
           <div class="mb-3 mt-3">
               <label for="name" class= "form-label">Name</label>
               <input type="text" class="form-control" id="name" aria-describedby="name" name="name" value="<?= $row["name"] ?>">
            </div>
            <div class="mb-3">
                <label for="Location" class="form-label">Location</label>
                <input type="text" class="form-control"  id="Location"  aria-describedby="Location"  name="location" value="<?= $row["location"] ?>">
            </div>
            <div class="mb-3 mt-3">
               <label for="name" class= "form-label">Description</label>
               <input type="text" class="form-control" id="description" aria-describedby="description" name="description" value="<?= $row["description"] ?>">
            </div>
            <div class="mb-3">
    <label for="size" class="form-label">Size</label>
    <input type="text" class="form-control" id="size" aria-describedby="size" name="size" value="<?= $row["size"] ?>">
</div>

            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control"  id="age"  aria-describedby="age"  name="age" value="<?= $row["age"] ?>">
            </div>
           <div class="mb-3">
                <label for="picture" class="form-label">Picture</label>
                <input type="file" class="form-control" id="picture" aria-describedby="picture" name="picture">
            </div>
          
            <button name="update" type="submit" class="btn btn-primary">Update details of animals</button>
            <a href="index.php" class="btn btn-warning">Back to home page</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
