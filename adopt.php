<?php
session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: login.php");
    exit;
}

require_once "db_connect.php";

if (isset($_GET["pet_id"])) {
    $pet_id = $_GET["pet_id"];
    $user_id = $_SESSION["user"];
    $sql = "SELECT COUNT(*) as count FROM pet_adoption WHERE user_id = $user_id AND pet_id = $pet_id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row["count"] == 0) {
        $sql = "INSERT INTO pet_adoption (user_id, pet_id, adoption_date) VALUES ($user_id, $pet_id, NOW())";
        if (mysqli_query($connect, $sql)) {

            $updateStatusQuery = "UPDATE animals SET status = 'unavailable' WHERE id = $pet_id";
            if (mysqli_query($connect, $updateStatusQuery)) {

                header("Location: home.php?pet_id=$pet_id");
                exit;
            } else {
                echo "Error updating pet status: " . mysqli_error($connect);
                exit;
            }
        } else {
            echo "Error adopting the pet: " . mysqli_error($connect);
            exit;
        }
    } else {
        echo "You have already adopted this pet.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>
