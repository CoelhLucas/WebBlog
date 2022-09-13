<?php
require 'connections.php';
require 'sanitize.php';
// require 'index.php';
// require 'createAccount.php';

$conn = mysqli_connect($servername, $username, $password, $blogdb);

if (!$conn) {
    die("Connection Failed." . mysqli_connect_error());
}
echo "Connected Successfully<br>";
if (isset($_GET['email']))
    $email = $_GET['email'];

if (isset($_GET['senha']))
    $senha = $_GET['senha'];

$email = test_input($email);
$senha = test_input($senha);


$email = mysqli_real_escape_string($conn, $email);
$senha = mysqli_real_escape_string($conn, $senha);

$sql_user = "SELECT * FROM $usertab WHERE email='$email' AND senha='$senha'";
$result_user  = mysqli_query($conn, $sql_user);

$sql_post = "SELECT * from $poststab";
$result_post  = mysqli_query($conn, $sql_post);
while ($row = mysqli_fetch_assoc($result_post)) {
    $postid = $row['id'];
?>
    <div id="controles">
        <br><br><br>
        <h3><?php echo $row['titulo'];?></h3>
        <textarea rows="15" cols="150" id="post" readonly><?php echo $row['post']; ?></textarea><br>
        <button type="button" id="coment" onclick="createCom()">Adicionar Comentario</button>
    </div>
    <?php
    $sql_comment = "SELECT * FROM $commenttab WHERE postId='$postid'";
    $result_comment  = mysqli_query($conn, $sql_comment);
    while ($rowcom = mysqli_fetch_assoc(($result_comment))) {
    ?>
        <div id="comentario" id="controles"> 
            <h6></h6>
            <textarea rows="5" cols="150" id="post" readonly><?php echo $rowcom['comentario'];?></textarea><br>
        </div>
<?php
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<link href="style.css" rel="stylesheet">
<script src="jquery-3.2.1.min.js"></script>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
</head>

<body>
    <div>
        <!-- <h1>Posts</h1>
        <div>
            <textarea rows="15" cols="150" id="post"></textarea><br>
        </div>
        <div>
            <h3>Comentarios</h3>
            <textarea rows="15" cols="150" id="comentario"></textarea><br>
        </div> -->
    </div>
</body>
<script src="javaScript.js"></script>
</html>