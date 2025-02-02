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
        include '../Asset/traitement/login.php';
        $id_p = $_SESSION['id_users'];
if(isset($_SESSION['id_users'])){?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/style.css">
    <link rel="stylesheet" href="../Css/help.css">
    <link rel="stylesheet" href="../Outils Html/icomoon/style.css">
    <title>help</title>
</head>
<body>
    <nav class="box-bar">
        <ul>
            <li>
                <a href="home.php">
                    <div class="logo">
     
                        <img src="../Images/IA.PNG" alt="error">
                        <p>my dashboard</p>
    
                    </div>
                </a>
            </li>
            <li>
                <span class="search_bar">
                    <form action="search.php" method="get">
                        <input type="search" name="search" class="search" placeholder="faites vos recherche ici">
                    </form>
                </span>
            </li>
            <li>
                <?php 
                            include "../Asset/traitement/config.php";
                            $sqlnot = "SELECT * FROM reservation WHERE status = 'on' ";
                            $resnot = mysqli_query($conn,$sqlnot);
                            $numnot = mysqli_num_rows($resnot);
                            $sql = "SELECT * FROM users WHERE id_users = '$id_p'";
                            $res = mysqli_query($conn,$sql);
                            $rows = mysqli_fetch_assoc($res);
                        ?>
                <div class="menu_us">
                <span class="icon-align-justify2" id="btn"></span>
                <a href="notification.php?vue"><span class="icon-bell" id="<?php if($numnot > 0){echo "noton";}else{
                    echo "notof";
                } ?>">
                    
                    <?php if($numnot > 0){echo '<div class="num"><p>'.$numnot.'</p></div>';}else{ echo ' ';} ?>
                </span></a>
                <img src="<?php echo '../images/pp_users/'.@$rows['pp'] ?>" alt="" class="pp">
            </div>
            </li>
        </ul>
    </nav>
    <div class="menu" id="menu">
    <ul><?php if($rows['status'] == 1){
       echo' 
            <li><a href="reservation.php" class="lk"><span class="icon-laptop"></span> reservation</a></li>
            <li><a href="maintenance.php" class="lk"><span class="icon-desktop"></span> maintenace</a></li>
            <li><a href="service.php" class="lk"><span class="icon-clipboard2"></span> services</a></li>
            <li><a href="stock.php" class="lk"><span class="icon-layers2"></span> stock</a></li>
            <li><a href="help.php" class="lk"><span class="icon-question"></span> help</a></li>
        ';
         }else if($rows['status'] == 2){
            echo' <li><a href="reservation.php" class="lk"><span class="icon-laptop"></span> reservation</a></li>
            <li><a href="maintenance.php" class="lk"><span class="icon-desktop"></span> maintenace</a></li>
            <li><a href="help.php" class="lk"><span class="icon-question"></span> help</a></li>
        ';}else{
            echo' <li><a href="reservation.php" class="lk"><span class="icon-laptop"></span> reservation</a></li>
            <li><a href="help.php" class="lk"><span class="icon-question"></span> help</a></li>
        ';}?></ul>
    </div>

    <div class="boxaide">
        <div class="ll box">
            <h1 class="hea">comment programmer une reservation ?</h1>
            <ol>
                <li><p>aller sur la page reservation <br><img src="../Images/page_reservation.png" alt=""></p></li>
                <li><p>aller sur le boutton reservation <br> <img src="../Images/btn_res.PNG" alt=""></p></li>
            </ol>
        </div>
        <div class="box">
            <h1 class="hea">comment suprimer une reservation ?</h1>
            <ol>
                <li><p>aller sur la page reservation <br><img src="../Images/page_reservation.png" alt=""></p></li>
                <li><p>aller sur le boutton suprimer <br> <img src="../Images/btn_sup.PNG" alt=""></p></li>
                <li><p>confirmer la supression <br> <img src="../Images/btn_c_sup.PNG" alt=""></p></li>
            </ol>
        </div>
        <div class="box">
            <h1 class="hea">comment suprimer une reservation ?</h1>
            <ol>
                <li><p>aller sur la page reservation <br><img src="../Images/page_reservation.png" alt=""></p></li>
                <li><p>aller sur le boutton reservation <br> <img src="../Images/btn_res.PNG" alt=""></p></li>
            </ol>
        </div>
        <div class="box">
            <h1 class="hea">comment revenir a la page d'acceuil</h1>
            <ol>
                <li><p>clicker sur le logo de l'application <br><img src="../Images/acceuil.png" alt=""></p></li>
            </ol>
        </div>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>
<?php } 
else{
    header("Location: login.php");
} ?>