<?php
$host = "localhost";
$user = "root";
$password = "";
$base = "my dashboard";

$conn = mysqli_connect($host, $user, $password);
$sqls = mysqli_select_db($conn, $base);
if ($sqls) {
} else {
    header("Location: install.php#t1");
}
include '../Asset/traitement/login.php';
if (isset($_SESSION['id_users'])) { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>list machine</title>
        <link rel="stylesheet" href="../Css/maintence.css">
        <link rel="stylesheet" href="../Css/reservation.css">
        <link rel="stylesheet" href="../Outils Html/icomoon/style.css">
    </head>

    <body>
        <div class="h">
            <a href="maintenance.php" class="go"><span class="icon-arrow-left"></span>
                <p class="p">my dashboard</p>
            </a>
            <div class="text">machines</div>
        </div>
        <div class="list_mach">
            <?php
            if (isset($_GET['id_salle'])) {
                $id_sl = $_GET['id_salle'];
            }
            $sqlmach = "SELECT * FROM ordinateurs WHERE id_salle = '$id_sl'";
            $reqmach = mysqli_query($conn, $sqlmach);
            $numac = mysqli_num_rows($reqmach);
            if ($numac == 0) {
                echo '<p class="nmac">Aucune machine dans cette salle</p>';
            } else {
                while ($rowmach = mysqli_fetch_assoc($reqmach)) {
                    echo '
                    <div class="mach">
                        <div class="lo"><img src="../Images/logo Pc.png"</span></div>
                        <div class="div">
                            <table>
                                <tr>
                                    <td><p>Nom :</td><td class="up">' . $rowmach['nom_ordi'] . '</p></td>
                                </tr>
                                <tr>
                                    <td><p>SE :</td><td>' . $rowmach['Systeme_E'] . '</p></td>
                                </tr>
                                <tr>
                                    <td><p>Ram :</td><td>' . $rowmach['ram'] . ' Go</p></td>
                                </tr>
                                <tr>
                                    <td><p>Disque dur :</td><td>' . $rowmach['Disque'] . ' Go</p></td>
                                </tr>
                                <tr>
                                    <td><p>Processeur :</td><td>' . $rowmach['proces'] . '</p></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                ';
                }
            }
            ?>
            <div class="boop">
                <a href="#addsalle">
                    <div class="right"><span class="icon-plus"></span>
                        add computer
                    </div>
                </a>
            </div>
        </div>
        <div class="formres" id="addsalle">
            <form action="<?php if (isset($_GET['mod'])) {
                                echo " ../Asset/traitement/mod.php?id_Re=$idd";
                            } else {
                                echo '../Asset/traitement/computer.php';
                            } ?>" method="post">

                <div class="hed">
                    <p>salle</p><a href="#"><span class="icon-close"></span></a>
                </div>
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><span class="icon-warning"></span>
                        <?php echo $_GET['error']; ?>
                    </p>
                <?php } ?>
                <div class="top"></div>
                <table>
                    <tr>
                        <td><label for="nom">nom machine</label></td>
                        <td><input type="text" name="nom" id="nom" class="it it2"
                                value="<?php if (isset($_GET['mod'])) {
                                            echo $rowmod['nom_us'];
                                        } else {
                                            echo "";
                                        } ?>"></td>
                    </tr><br>
                    <tr>
                        <td><label for="se">SE</label> </td>
                        <td><input type="text" name="se" id="se" class="it it2"
                                value="<?php if (isset($_GET['mod'])) {
                                            echo $rowmod['nom_us'];
                                        } else {
                                            echo "";
                                        } ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="dd">disque dur</label> </td>
                        <td><input type="number" name="dd" id="dd" class="it it2"
                                value="<?php if (isset($_GET['mod'])) {
                                            echo $rowmod['nom_us'];
                                        } else {
                                            echo "";
                                        } ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="ra">ram</label> </td>
                        <td><input type="number" name="ra" id="ra" class="it it2"
                                value="<?php if (isset($_GET['mod'])) {
                                            echo $rowmod['nom_us'];
                                        } else {
                                            echo "";
                                        } ?>"></td>
                    </tr>
                    <input type="hidden" name="id" value="<?php echo $_GET['id_salle'] ?>">
                    <tr>
                        <td><label for="pr">Processeur</label> </td>
                        <td><input type="text" name="pr" id="pr" class="it it2"
                                value="<?php if (isset($_GET['mod'])) {
                                            echo $rowmod['nom_us'];
                                        } else {
                                            echo "";
                                        } ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="date">date de maintenance</label> </td>
                        <td><input type="date" name="date" id="date" class="it it2"
                                value="<?php if (isset($_GET['mod'])) {
                                            echo $rowmod['nom_us'];
                                        } else {
                                            echo "";
                                        } ?>"></td>
                    </tr>
                </table>
                <div class="bot">
                    <?php if (isset($_GET['mod'])) {
                        echo '<a href="#" class="anl">annuler</a><input type="submit" value="modifier" name="mod">';
                    } else {
                        echo '<a href="#" class="anl">suprimer</a><input type="submit" value="ajouter" name="send">';
                    } ?>
                </div>

            </form>
        </div>
    </body>

    </html>
<?php } else {
    header("Location: login.php");
} ?>