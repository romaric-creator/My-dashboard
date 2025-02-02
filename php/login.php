<?php 
        $host="localhost";
        $user="root";
        $password="";
        $base="my dashboard";
    
        $conn = mysqli_connect($host,$user,$password);
        $sqls = mysqli_select_db($conn,$base);
        if($sqls){
            
        }else{
            header("Location: install.php#t1");
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Outils Html/icomoon/style.css">
    <link rel="stylesheet" href="../Css/login.css">
    <title> login</title>
</head>

<body>
    <div class="contlog">
        <div class="form">
            <?php if(isset($_GET['error'])){?>
                <p class="error"><span class="icon-warning"></span> <?php echo $_GET['error'] ; ?></p>
            <?php } ?>
            <h1>my dashboard</h1>
            <form action="../Asset/traitement/login.php" method="post">
                <input type="email" name="email" placeholder="email" autocomplete="off">
                <input type="password" name="password" placeholder="password" autocapitalize="off">
                <input type="submit" value="connecter" name="send">
            </form>
        </div>
    </div>
</body>

</html>