<?php
    require 'connections.php';




    $conn = mysqli_connect($servername, $username, $password, $blogdb);

    if(!$conn){
        die("Connection Failed." . mysqli_connect_error());
    }
    echo "Connected Successfully<br>";

    $sql = "CREATE TABLE $poststab (
        id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(50) NOT NULL,
        autor varchar(50) NOT NULL,
        post varchar(200) NOT NULL,
        data_criado DATETIME NOT NULL,
    )";

    if(mysqli_query($conn, $sql)){
        echo "<br>Database created successfully";
    } else {
        echo "<br>Error creating database: " . mysqli_error($conn);
    }
    mysqli_close($conn);
?>