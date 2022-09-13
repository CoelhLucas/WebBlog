<?php
require 'connections.php';
require 'sanitize.php';


$conn = mysqli_connect($servername, $username, $password, $blogdb);
if (!$conn) {
    die("Problemas ao conectar com o BD!<br>" .
        mysqli_connect_error());
}

$email = $senha = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST["email"]);
    $senha = test_input($_POST["senha"]);


    $email = mysqli_real_escape_string($conn, $email);
    $senha = mysqli_real_escape_string($conn, $senha);

    $sql = "SELECT * FROM $usertab WHERE email='$email' AND senha='$senha'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
            header("Location: blog.php/?email=$email&senha=$senha");
            exit();
    } else {
        echo "0 results";
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
    <title>Login</title>
</head>

<body>
    <div id="controles">
        <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <label for="login">Email:</label><br>
                <input type="text" name="email" required><br>
                <label for="senha">Senha:</label><br>
                <input type="password" name="senha" required><br>
                <input type="submit" name="singIn"><br><br>
            </form>
        </div>
        <div>
            <form action="createAccount.php" method="get">
                <input type="submit" value="Criar Conta" name="Submit" id="frm1_submit" />
            </form>
        </div>
    </div>
</body>
</html>