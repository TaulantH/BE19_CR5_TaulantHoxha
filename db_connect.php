<?php

    $localhost = "localhost";
    $username = "root";
    $password = "";
    $dbname = "be19_cr5_animal_adoption_taulanthoxha" ;

    // create connection
    $connect = mysqli_connect($localhost, $username, $password, $dbname);

    // check connection
    if (!$connect) {
    die ("Connection failed");
    }
