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
    <title>reservation</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/reservation.css">
    <link rel="stylesheet" href="../css/maintence.css">
    <link rel="stylesheet" href="../Outils Html/icomoon/style.css">
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
                <a href="users.php?id_us=<?php echo $id_p ?>" class="use"><img src="<?php echo '../images/pp_users/'.@$rows['pp'] ?>" alt="" class="pp"></a>
            </div>
        </li>
    </ul>
</nav>
    <div class="ff formres" id="salle">
        <?php 
            if (isset($_GET['mod'])) {
                $id = $_GET['mod'];
                $sqlmod = "SELECT * FROM reservation WHERE id_reservation = '$id'";
                $resmod = mysqli_query($conn,$sqlmod);
                $rowmod = mysqli_fetch_assoc($resmod);
            }
            $idd = @$rowmod['id_reservation'];
         ?>
        <form action="<?php if(isset($_GET['mod'])){echo "../Asset/traitement/modsalle.php?id_Re=$idd";}else{ echo '../Asset/traitement/maintenance.php';} ?>" method="post">
            
            <div class="hed">
                <p>reservation</p><a href="#"><span class="icon-close"></span></a>
            </div>
            <?php if(isset($_GET['error'])){?>
                <p class="error"><span class="icon-warning"></span> <?php echo $_GET['error'] ; ?></p>
            <?php } ?>
            <div class ="top"></div>
            <label for="nomsalle">non de la salle</label> <input type="text" name="nomsalle" id="nomsalle"
                value="<?php if(isset($_GET['mod'])){echo $rowmod['date_res'];}else{echo '';} ?>" class="it"><br>
            <div class="sel">
            <label for="disponibilite">disponibilite</label>
                <select name="disponibilite" id="disponibilite">
                    <option>disponible</option>
                    <option>indisponible</option>
                </select>
            </div>
            <div class="bot">
            <?php if(isset($_GET['mod'])){echo '<a href="#" class="anl">annuler</a><input type="submit" value="modifier" name="mod">';}else{echo '<a href="#" class="anl">suprimer</a><input type="submit" value="creer" name="send">';} ?>
            </div>

        </form>
    </div>
    
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

    <div class="maint">
        <?php 
         $sqlreq = "SELECT * FROM salle";
         $reqma = mysqli_query($conn,$sqlreq);
            while($rowmai = mysqli_fetch_assoc($reqma)){
                $id_sal = $rowmai['id_salle'];
                $sqlms = "SELECT*FROM ordinateurs WHERE id_salle = '$id_sal'";
                $reams = mysqli_query($conn,$sqlms);
                $num = mysqli_num_rows($reams);
                echo '
                    <div class="box-sal">
                        <div class="te">
                            <div class="salle-img">
                                <img src="../Images/logo salle informatique.png"/>
                            </div>
                            <div class="name_p">
                                    <p>'.$rowmai['nom_salle'].'</p><br>
                                    <p>'.$num.' Machines</p><br>
                                    <a href="list_machine.php?id_salle='.$rowmai['id_salle'].'" class="open_mach">voir toutes les machines </a>
                            </div>
                        </div>
                        <div class="delete"><a href="../Asset/traitement/dropsalle.php?delete='.$id_sal.'"><span class="icon-trash"></span></a></div>
                    </div>
                    ';   

            }
            if(isset($_GET['delete'])){
                $id_s = $_GET['delete'];
                $sqlse = "DELETE FROM salle WHERE id_salle = '$id_s'";
                $resea = mysqli_query($conn,$sqlse);
                    if(!$resea){
                       ?>
                       <script>
                        alert('imposible de suprimer la salle');
                       </script>
                       <?php
                    }else{
                        header("Location: ../index.php");
                    }
            }
         ?>
    </div>
    <div class="conhea">
        <div class="cox">
            <div class="bntres">
                <a href="maintenance.php#salle"><span class="icon-plus"></span>add salle</a>
            </div>
        </div>
    </div>

    <?php include '../footer.php'; ?>
    <script src="../js/script.js"></script>
</body>

</html>
<?php } 
else{
    header("Location: login.php");
} ?>