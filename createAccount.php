<?php
require 'connections.php';
require 'sanitize.php';

$conn = mysqli_connect($servername, $username, $password, $blogdb);
if (!$conn) {
    die("Problemas ao conectar com o BD!<br>" .
        mysqli_connect_error());
}

$email = $senha = $nome = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST["email"]);
    $senha = test_input($_POST["senha"]);
    $senha = test_input($_POST["senha"]);

    $email = mysqli_real_escape_string($conn, $email);
    $senha = mysqli_real_escape_string($conn, $senha);
    $nome  = mysqli_real_escape_string($conn, $nome);

    $sql = "INSERT INTO $usertab (email, senha, nome, admn)
                 VALUES ('$email', '$senha', '$email', 1)";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        $sql = "SELECT * FROM $usertab WHERE email='$email' AND senha='$senha'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "id: " . $row["id"] . " - Name: " . $row["nome"] . " " . $row["senha"] . "<br>";
            }
        } else {
            echo "0 results";
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<link href="style.css" rel="stylesheet">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta</title>
</head>

<body>
    <div id="controles">
        <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <label for="login">Email:</label><br>
                <input type="text" name="email" required><br>
                <label for="senha">Senha:</label><br>
                <input type="password" name="senha" required><br>
                <label for="nome">Nome:</label><br>
                <input type="text" name="nome" required><br>
                <input type="submit" name="singIn"><br><br>
            </form>
        </div>
        <div>
            <form action="index.php" method="get">
                <input type="submit" value="Fazer Login" name="Submit" id="frm1_submit" />
            </form>
        </div>
    </div>
</body>
</html>