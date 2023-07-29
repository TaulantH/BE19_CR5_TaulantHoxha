<?php
require_once "../db_connect.php";
require_once "../file_upload.php";

$name = $location = $description = $size = $age = $vaccinated = $breed = '';

if (isset($_POST["create"])) {
    $name = $_POST["name"];
    $location = $_POST["location"];
    $description = $_POST["description"];
    $size = $_POST["size"];
    $age = $_POST["age"];
    $vaccinated = $_POST["vaccinated"];
    $breed = $_POST["breed"];
    $picture = fileUpload($_FILES["picture"]);
    $sql = "INSERT INTO animals (name, location, description, size, age, vaccinated, breed, picture) VALUES ('$name', '$location', '$description', '$size', '$age', '$vaccinated', '$breed', '{$picture[0]}')";
    if (mysqli_query($connect, $sql)) {
        echo "<div class='alert alert-success' role='alert'>
            New record has been created, {$picture[1]}
          </div>";
        header("refresh: 3; url= index.php");
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
    <section class="vh-100 gradient-custom">
        <div class="container py-0 " style="opacity: 0.9;">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-md-4">
                            <h2>New animals</h2>
                            <form method="post" autocomplete="off" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label for="name" class="form-label">Name </label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= $name ?>">

                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label for="location" class="form-label">location</label>
                                            <input type="text" class="form-control" id="location" name="location" placeholder="Location" value="<?= $location ?>">

                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 d-flex align-items-center">

                                        <div class="form-outline datepicker w-100">
                                            <label for="description" class="form-label">Description</label>
                                            <input type="Text" class="form-control" id="description" name="description" value="<?= $description ?>">

                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4 pb-2">

                                            <div class="form-outline">
                                                <label for="size" class="form-label">size</label>
                                                <input type="text" class="form-control" id="size" name="size" placeholder="size" value="<?= $size ?>">
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4 pb-2">

                                            <div class="form-outline">
                                                <label for="age" class="form-label">age</label>
                                                <input type="age" class="form-control" id="age" name="age" placeholder="age" value="<?= $age ?>">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4 pb-2">

                                            <div class="form-outline">
                                                <label for="vaccinated" class="form-label">vaccinated</label>
                                                <input type="text" class="form-control" id="vaccinated" name="vaccinated" placeholder="vaccinated" value="<?= $vaccinated ?>">
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4 pb-2">

                                            <div class="form-outline">
                                                <label for="breed" class="form-label">breed</label>
                                                <input type="breed" class="form-control" id="breed" name="breed" placeholder="breed" value="<?= $breed ?>">
                                            </div>

                                        </div>
                                    </div>
                    
                                    <div class="mb-3">
                <label for="picture" class="form-label">picture</label>
                <input type = "file" class="form-control" id="picture" aria-describedby="picture"   name="picture">
            </div>
                                    <button name="create" type="submit" class="btn btn-primary">New animal</button>
                                    <a href="index.php" class="btn btn-warning">Back to home page</a>
                            </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>