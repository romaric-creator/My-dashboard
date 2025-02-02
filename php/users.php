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
        $sql = "SELECT * FROM users WHERE id_users = '$id_p'";
        $res = mysqli_query($conn,$sql);
        $rows = mysqli_fetch_assoc($res);
if(isset($_SESSION['id_users'])){?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users</title>
    <link rel="stylesheet" href="../Outils Html/icomoon/style.css">
    <link rel="stylesheet" href="../css/users.css">
    <link rel="stylesheet" href="../css/reservation.css">
</head>

<body>
    <div class="header">
        <duv class="title"><a href="home.php"><span class="icon-arrow-left"></span></a>setting</duv>
        <div class="logo">
            <p>my dashboard</p> <a href="#pp"><img src="<?php echo '../images/pp_users/'.@$rows['pp'] ?>" alt=""></a>
        </div>
    </div>
    <div class="param">
        <ul>
            <li class="ct"><?php echo 'Bienvenu Mr '.@$rows['nom'] ?></li>
            <li class="lip"><a href="?mod#reservation">modifer le profile</a></li>
            <div class="formres" id="reservation">
                <?php 
            if (isset($_GET['mod'])) {
                $id = $_GET['mod'];
                $sqlmod = "SELECT * FROM users WHERE id_users = '$id_p'";
                $resmod = mysqli_query($conn,$sqlmod);
                $rowmod = mysqli_fetch_assoc($resmod);
            }
         ?>
                <form action="../Asset/traitement/upusers.php" method="post" enctype="multipart/form-data">

                    <div class="hed">
                        <p>modifier le profile</p><a href="#"><span class="icon-close"></span></a>
                    </div>
                    <?php if(isset($_GET['error'])){?>
                    <p class="error"><span class="icon-warning"></span>
                        <?php echo $_GET['error'] ; ?>
                    </p>
                    <?php } ?>
                    <div class="top"></div>
                    <label for="nom">nom </label> <input type="text" name="nom" id="nom"
                        value="<?php if(isset($_GET['mod'])){echo $rowmod['nom'];}else{}?>" class="date"><br>

                    <label for="email">votre email</label> <input type="email" name="email" id="email" class="it"
                        value="<?php if(isset($_GET['mod'])){echo $rowmod['email'];}else{echo "";} ?>"><br>

                    <label for="numero">votre numero</label><input type="text" name="numero" id="numero" class="it"
                        value="<?php if(isset($_GET['mod'])){echo $rowmod['numero'];}else{echo "";} ?>"><br>

                    <label for="password">mot de passe</label><input type="password" name="password" id="password"
                        class="it" value=""><br>
                    <input type="hidden" name="hid"
                        value="<?php if(isset($_GET['mod'])){echo $rowmod['id_users'];}else{echo "";} ?>">

                    <a href="?#mdp" class="modmdp">modifier le mot passe?<a></p>
                            <div class="bot">
                                <a href="?#" class="anl">annuler</a><input type="submit" value="modifier" name="send">
                            </div>

                </form>
            </div>

            <!-- mot de passe  deb -->
            <div class="formres" id="mdp">
                <?php 
                $sqlmodn = "SELECT * FROM users WHERE id_users = '$id_p'";
                $resmodn = mysqli_query($conn,$sqlmodn);
                $rowmodn = mysqli_fetch_assoc($resmodn);
         ?>
                <form action="../Asset/traitement/mdp.php" method="post" enctype="multipart/form-data">

                    <div class="hed">
                        <p>reinitialiser le mot de passe</p><a href="#"><span class="icon-close"></span></a>
                    </div>
                    <?php if(isset($_GET['error'])){?>
                    <p class="error"><span class="icon-warning"></span>
                        <?php echo $_GET['error'] ; ?>
                    </p>
                    <?php } ?>
                    <div class="top"></div>
                    <label for="mdp">mot de passe actuele</label> <input type="password" name="passwordA" id="mdp"
                        value="" class="it"><br>
                    <label for="mdpn">nouveau mot de passe</label> <input type="password" name="passwordN" id="mdpn"
                        value="" class="it"><br>
                    <input type="hidden" name="hid" value="<?php echo @$rowmodn['id_users']; ?>">
                    <div class="bot">
                        <a href="?#" class="anl">annuler</a><input type="submit" value="modifier" name="send">
                    </div>

                </form>
            </div>
            <!-- mot de passe fin  -->
            <div class="formres" id="pp">
                <?php 
                $sqlmodn = "SELECT * FROM users WHERE id_users = '$id_p'";
                $resmodn = mysqli_query($conn,$sqlmodn);
                $rowmodn = mysqli_fetch_assoc($resmodn);
         ?>
                <form action="../Asset/traitement/uppp.php" method="post" enctype="multipart/form-data">

                    <div class="hed">
                        <p>changer de profil</p><a href="#"><span class="icon-close"></span></a>
                    </div>
                    <?php if(isset($_GET['error'])){?>
                        <p class="error"><span class="icon-warning"></span>
                            <?php echo $_GET['error'] ; ?>
                        </p>
                    <?php } ?>
                    <div class="ppc">
                    <div class="top"></div>
                        <img src="<?php echo '../images/pp_users/'.@$rows['pp'] ?>" alt="" class="ppIMg">
                        <label for="pp2" class="bocp"><span class="icon-camera"></span></label><input type="file" name="pp2" id="pp2">
                    </div>
                    <input type="hidden" name="hid" value="<?php echo @$rowmodn['id_users']; ?>">

                    <div class="bot">
                        <a href="?#" class="anl">annuler</a><input type="submit" value="modifier" name="send">
                    </div>

                </form>
            </div>
            <?php if($rowmodn['status'] == 1){?>
            <li class="lip"><a href="?#addUs">ajouter un utilisateurs</a></li>
<?php        } ?>
<li class="lip"><a href="logout.php">se deconnectr</a></li>

            <div class="formres" id="addUs">
                <?php 
            if (isset($_GET['mod'])) {
                $id = $_GET['mod'];
                $sqlmod = "SELECT * FROM reservation WHERE id_reservation = '$id'";
                $resmod = mysqli_query($conn,$sqlmod);
                $rowmod = mysqli_fetch_assoc($resmod);
            }
            $idd = @$rowmod['id_reservation'];
            if (isset($_GET['mod'])) {
                $ids = $_GET['mod'];
                $sqlmods = "SELECT * FROM salle WHERE id_salle = '$ids'";
                $resmods = mysqli_query($conn,$sqlmods);
                $rowmods = mysqli_fetch_assoc($resmods);
            }
         ?>
                <form action="../Asset/traitement/addus.php" method="post" enctype="multipart/form-data">

                    <div class="hed">
                        <p>ajouter un utilisateurs</p><a href="#"><span class="icon-close"></span></a>
                    </div>
                    <?php if(isset($_GET['error'])){?>
                    <p class="error"><span class="icon-warning"></span>
                        <?php echo $_GET['error'] ; ?>
                    </p>
                    <?php } ?>
                    <div class="top"></div>
                    <label for="nom">nom </label> <input type="text" name="nom" id="nom" class="it"><br> 
                    <label for="email">votre email</label> <input type="email" name="email" id="email" class="it"><br>
                    <label for="password">votre mot de passe</label> <input type="password" name="password" id="password" class="it"><br>
                    <label for="numero">votre numero</label><input type="text" name="numero" id="numero" class="it"><br>
                    <label for="pp">profil </label> <input type="file" name="pp" id="pp" class="it"><br>
                    <div class="sel">
                        <label for="salle">droits</label>
                        <select name="status" id="salle">
                            <option value="admin" name="admin">admin</option>
                            <option value="stand" name="stand">standars</option>
                            <option value="inviter" name="inviter">inviter</option>
                        </select><br>
                    </div>
                    <div class="bot">
                        <a href="?#" class="anl">suprimer</a><input type="submit" value="ajouter" name="send">
                    </div>
                </form>
            </div>
            <?php if($rowmodn['status'] == 1){?>
            <li class="ct">liste des utilisateurs</li>
            <p>se connecter a un compte</p>
            <div class="lisus">
                <?php 
                    $sqlmods = "SELECT * FROM users WHERE id_users != '$id_p'";
                    $resmods2 = mysqli_query($conn,$sqlmods);
                    
                    while($rowmods2 = mysqli_fetch_assoc($resmods2)){
                        echo '<span class="ppusl"><a href="../Asset/traitement/changecompte.php?set_id='.$rowmods2['id_users'].'"><img src="../images/pp_users/'.$rowmods2['pp'].'" alt=""></a></span>';
                    }
                    if(isset($_GET['set_id'])){
                        $_SESSION['id_users'] = $_GET['set_id'];
                    }
                 ?>
                
            </div>
            <?php } ?>
        </ul>
    </div>
</body>

</html>
<?php } 
else{
    header("Location: login.php");
} ?>