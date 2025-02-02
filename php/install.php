<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/install.css">
    <link rel="stylesheet" href="../Outils Html/icomoon/style.css">
    <title>install</title>
</head>

<body>
    <div class="install">
        <div class="b1" id="t1">
            <div class="c1">
                <div class="box-le">
                    <img src="../Images/IA.png">
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
                <div class="precedent">
                    <a href="#t1" id="left" onclick="window.close()">annuler</a>
                </div>
                <div class="suivant">
                    <a href="#t2" id="right">suivant</a>
                </div>
            </div>
        </div>
        <div class="b1" id="t3">
            <div class="c1">
                <div class="box-le">
                    <img src="../Images/IA.png">
                </div>
                <div class="box-right">
                    <h1>REGISTER</h1>
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="error"><span class="icon-warning"></span> <?php echo $_GET['error']; ?></p>
                    <?php } ?>
                    <form action="../Asset/traitement/register.php" method="post" enctype="multipart/form-data">
                        <input type="text" class="it" name="nom" placeholder="entrez votre nom" autocomplete="off">
                        <input type="email" class="it" name="email" placeholder="entrez votre email" autocomplete="off">
                        <input type="tel" class="it" name="number" placeholder="entrez votre numero de telephone" autocomplete="off">
                        <input type="password" class="it" name="password" placeholder="entrez votre mot de passe" autocomplete="off">
                        <input type="file" class="it" name="pp" id="pp" style="display: none;">
                        <div class="it"><label for="pp" style="cursor: pointer;">choise profil</label></div>
                        <input type="reset" value="annuler" class="its2">
                        <input type="submit" value="s'enregister" class="its1" name="send" id="ter">
                    </form>
                </div>
            </div>
            <div class="direction">
                <div>
                </div>
                <div class="suivant">
                    <a href="#t2" id="right"><label for="ter" id="ters">terminer</label></a>
                </div>
            </div>
        </div>
        <div class="b1" id="t2">
            <div class="c1">
                <div class="box-le">
                    <img src="../Images/IA.PNG">
                </div>
                <div class="box-right">
                    <h1>my dashboard</h1>
                    <?php
                    if (isset($_GET['Go'])) {
                        $host = "localhost";
                        $user = "root";
                        $password = "";
                        $base = "my dashboard";

                        $conn = mysqli_connect($host, $user, $password);
                        $sqldel = "DELETE DATABASE my dashboard";
                        $resdel = mysqli_query($conn, $sqldel);
                        $sqlba = "CREATE DATABASE `my dashboard`";
                        $res = mysqli_query($conn, $sqlba);
                        if ($res) {
                            $conn = mysqli_connect($host, $user, $password, $base);
                            echo "debut de la creation de la base de donnee<br>";
                            $sqlto = "CREATE TABLE `ordinateurs` (
                                    `id_ordinateur` int(11) NOT NULL AUTO_INCREMENT PRiMARY KEY,
                                    `id_salle` int(11) NOT NULL,
                                    `nom_ordi` varchar(255) NOT NULL,
                                    `Systeme_E` varchar(255) NOT NULL,
                                    `proces` varchar(255) NOT NULL,
                                    `Disque` int(11) NOT NULL,
                                    `ram` int(11) NOT NULL,
                                    `date_maint` date NOT NULL
                                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
                                ";
                            $resto = mysqli_query($conn, $sqlto);
                            if ($resto) {
                                echo "premiere table creer avec succes </br>";
                            } else {
                                echo "erreur lors de la creation de la premiere table </br>";
                            }

                            $sqlus = "CREATE TABLE `users` (
                                        `id_users` int(11) NOT NULL AUTO_INCREMENT PRiMARY KEY,
                                        `nom` varchar(115) NOT NULL,
                                        `email` varchar(115) NOT NULL,
                                        `pass` varchar(115) NOT NULL,
                                        `numero` int(11) NOT NULL,
                                        `status` varchar(110) NOT NULL,
                                        `pp` varchar(115) NOT NULL
                                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
                            $resus = mysqli_query($conn, $sqlus);
                            if ($resus) {
                                echo "duexieme table creer avec succes </br>";
                            } else {
                                echo "erreur lors de la creation de la duexieme table</br>";
                            }


                            $sqlsal = "CREATE TABLE `salle` (
                                        `id_salle` int(11) NOT NULL AUTO_INCREMENT PRiMARY KEY,
                                        `nom_salle` varchar(100) NOT NULL,
                                        `capacite` int(11) NOT NULL,
                                        `disponibilite` varchar(100) NOT NULL
                                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
                            $resal = mysqli_query($conn, $sqlsal);
                            if ($resal) {
                                echo "troixieme table creer avec succes </br>";
                            } else {
                                echo "erreur lors de la creation de la troixieme table</br>";
                            }


                            $sqlres = "CREATE TABLE `reservation` (
                                        `id_reservation` int(11) NOT NULL AUTO_INCREMENT PRiMARY KEY,
                                        `nom_us` varchar(100) NOT NULL,
                                        `date_res` date NOT NULL,
                                        `nom_salle` varchar(100) NOT NULL,
                                        `tel` int(11) NOT NULL,
                                        `debh` varchar(100) NOT NULL,
                                        `debf` varchar(100) NOT NULL,
                                        `status` varchar(3) NOT NULL
                                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
                                      ";
                            $resres = mysqli_query($conn, $sqlres);
                            if ($resres) {
                                echo "quatrieme table creer avec succes </br>";
                            } else {
                                echo "erreur lors de la creation de la quatrieme table</br>";
                            }
                            $stock = "CREATE TABLE `stock` (
                                        `id_stock` int(11) NOT NULL  AUTO_INCREMENT PRiMARY KEY,
                                        `nom_sordi` varchar(200) NOT NULL,
                                        `Systeme_E` varchar(200) NOT NULL,
                                        `proces` varchar(200) NOT NULL,
                                        `Disque` int(11) NOT NULL,
                                        `ram` int(11) NOT NULL,
                                        `date_ajout` date NOT NULL
                                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
                                      ";
                            $restok = mysqli_query($conn, $stock);
                            if ($restok) {
                                echo "cinquieme table creer avec succes </br>";
                            } else {
                                echo "erreur lors de la creation de la cinquieme table</br>";
                            }
                            $ser = "CREATE TABLE `service` (
                                            `id_service` int(11) NOT NULL AUTO_INCREMENT PRiMARY KEY,
                                            `nom_us` varchar(100) NOT NULL,
                                            `tel` int(11) NOT NULL,
                                            `contenu` varchar(200) NOT NULL
                                          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
                            $resres = mysqli_query($conn, $ser);
                            if ($resres) {
                                echo "sixieme table creer avec succes </br>";
                            } else {
                                echo "erreur lors de la creation de la sixieme table</br>";
                            }
                            $sql10 = "INSERT INTO salle (nom_salle,disponibilite) VALUES ('salle 1','disponible')";
                            $req10 = mysqli_query($conn, $sql10);
                            $sql11 = "INSERT INTO salle (nom_salle,disponibilite) VALUES ('salle 2','disponible')";
                            $req11 = mysqli_query($conn, $sql11);
                            $sql12 = "INSERT INTO salle (nom_salle,disponibilite) VALUES ('salle 3','disponible')";
                            $req12 = mysqli_query($conn, $sql12);
                            if ($resal && $resto && $resus && $resres) {
                                // $sys = ['windows 8','windows 7','windows 10','windows 7','windows 10'];
                                // $nom = ['ordi-salle1','ordi-salle2','ordi-salle3','ordi-salle2','ordi-salle3'];
                                // $capaciter = ['250','500','80','100'];
                                // $ram = ['2','4','8','4','8'];
                                // $processeur = ['intel core i3','intel core i2','penthium','intel core i2','penthium'];
                                // $salle = ['1','2','3','1','2'];
                                //     for($i=0;$i<=2;$i++){
                                //         for($j=0;$j<=5;$j++){
                                //             $sql65[$j]= "INSERT INTO ordinateurs (id_salle,nom_ordi,Systeme_E,proces,Disque,ram) VALUES ('$salle[$j]','$nom[$j]','$sys[$j]','$processeur[$j]','$capaciter[$j]','$ram[$j]')" ;
                                //             $req = mysqli_query($conn,$sql65[$j]);
                                //         }
                                //     }
                                header("Location: install.php#t3");
                            } else {
                                echo "noo";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="direction">
                <div class="precedent">
                    <a href="install.php#t1">precedent</p>
                </div>
                <div class="suivant">
                    <a href="install.php?Go#t2">installation</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>