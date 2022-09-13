<?php
    require 'connections.php';
    require 'sanitize.php';

    $conn = mysqli_connect($servername, $username, $password, $blogdb);

    if(!$conn){
        die("Connection Failed." . mysqli_connect_error());
    }
    echo "Connected Successfully<br>";


    //Create Database
    // if(!mysqli_query($conn, "CREATE DATABASE $blogdb")){
    //     die("Database Creation Failed." . mysqli_error($conn));
    // }
    // echo "Database Created Successfully"


    //CREATE TABLES
    $sql_post = "CREATE TABLE $poststab (
        id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        id_user INT(3),
        titulo VARCHAR(50) NOT NULL,
        autor VARCHAR(50) NOT NULL,
        post VARCHAR(200) NOT NULL,
        data_criado DATETIME NOT NULL,
        data_atualizado DATETIME,
        categoria VARCHAR(50) NOT NULL
    )";

    $sql_user = "CREATE TABLE $usertab ( 
        id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
        senha VARCHAR(10) NOT NULL,
        admn BOOLEAN NOT NULL,
        id_comentario INT(3)
     )";

     $sql_com = "CREATE TABLE $commenttab ( 
        id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        id_user INT(3),
        postId INT(3),
        comentario VARCHAR(200),
        data_criado DATETIME NOT NULL
      )";

    if(mysqli_query($conn, $sql_com)){
        echo "<br>Database created successfully";
    } else {
        echo "<br>Error creating database: " . mysqli_error($conn);
    }


    mysqli_close($conn);
