<?php
$host = "localhost";
$user = "root";
$password = "";
$base = "my dashboard";

$conn = mysqli_connect($host, $user, $password);
$sqls = mysqli_select_db($conn, $base);
if ($sqls) {
    header("Location: php/home.php");
} else {
    echo '<script>window.open("php/install.php#t1", "_blank");</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/install.css">
    <title>installation</title>
</head>

<body>
    <div class="install">
        <div class="bb">
            <div class="c1">
                <div class="box-le">
                    <img src="Images/IA.png">
                </div>
                <div class="box-right">
                    <h1>my dashboard</h1>
                    <p>
                        my dashboard est une aplication de gestion
                        des salles d'informatique concus pour le college
                        evangelique de new bell dans le but de gere la reservation et facilite l'utilisation et la
                        maintenance des ordinateur present dans les differnte salles.
                    </p>
                </div>
            </div>
            <div class="direction">
                <div>
                </div>
                <div class="suivant">
                    <a href="index.php" id="right">inatller</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>