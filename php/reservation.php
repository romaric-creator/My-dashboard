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
$id_p = $_SESSION['id_users'];
if (isset($_SESSION['id_users'])) { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>reservation</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/reservation.css">
        <link rel="stylesheet" href="../Outils Html/icomoon/style.css">
    </head>

    <body>
        <?php
        if (isset($_GET['search'])) {
            echo '<div class="rech">
            <h1>Resultat de la recherche</h1>
            <table>
                <tr>
                    <th>N°</th>
                    <th>nom</th>
                    <th>telephone</th>
                    <th>date</th>
                    <th>salle</th>
                    <th>debut</th>
                    <th>fin</th>
                    <th>modifier</th>
                    <th>suprimer</th>
                </tr>
                ';
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                if (!$search == "") {
                    // $mots=explode(" ",trim($search));
                    // for($i2=0;$i2<count($mots);$i2++)
                    //     $cl[$i2]="nom_us LIKE '%".$mots[$i2]."%' OR nom_salle = '".$mots[$i2]."'";
                    $sql = "SELECT * FROM reservation  WHERE nom_us LIKE '%" . $search . "%' OR nom_salle = '" . $search . "'";
                    $reqr = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($reqr);
                    $i = 0;
                    $afficher = "oui";
                }
            }
            if ($num == 0) {
                echo '<tr><td class="not" colspan="9">Aucun resultat</td></tr>';
            } else {
                while ($row = mysqli_fetch_assoc($reqr)) {
                    echo '
                    <tr class="re2 list" id="' . $row['id_reservation'] . '">';
                    $i = $i + 1;
                    echo '<td>' . $i . '</td>';
                    echo '
                    <td>' . $row['nom_us'] . '</td>
                    <td>' . $row['tel'] . '</td>
                    <td>' . $row['date_res'] . '</td>
                    <td>' . $row['nom_salle'] . '</td>
                    <td>' . $row['debh'] . '</td>
                    <td>' . $row['debf'] . '</td>
                    <td>
                        <a href="reservation.php?mod=' . $row['id_reservation'] . '#reservation"><span class="mod icon-pencil"></span></a>
                    </td>
                    <td>
                        <a href="reservation.php?sup=' . $row['id_reservation'] . '#confirm"><span class="sup icon-trash"></span></a>
                    </td>
                </tr>
            ';
                }
            }
            echo '</table>
         </div>';
        }
        ?>

<nav class="box-bar">
        <ul>
            <li>
                <a href="home.php">
                    <div class="logo">
                        <img src="../Images//IA.PNG" alt="Logo">
                        <p>my dashboard</p>
                    </div>
                </a>
            </li>
            <li>
                <div class="search_bar">
                    <form action="reservation.php" method="get">
                        <input type="search" name="search" class="search" placeholder="recherche nom ou salle...">
                        <input type="submit" value="search" id="search">
                        <label for="search"><span class="icon-search"></span></label>
                    </form>
                </div>
            </li>
            <li>
                <?php
                include "../Asset/traitement/config.php";
                $sqlnot = "SELECT * FROM reservation WHERE status = 'on'";
                $resnot = mysqli_query($conn, $sqlnot);
                $numnot = mysqli_num_rows($resnot);
                $sql = "SELECT * FROM users WHERE id_users = '$id_p'";
                $res = mysqli_query($conn, $sql);
                $rows = mysqli_fetch_assoc($res);
                ?>
                <div class="menu_us">
                    <span class="icon-align-justify2" id="btn"></span>
                    <a href="notification.php?vue">
                        <span class="icon-bell" id="<?php echo ($numnot > 0) ? 'noton' : 'notof'; ?>">
                            <?php if ($numnot > 0) {
                                echo '<div class="num"><p>' . $numnot . '</p></div>';
                            } ?>
                        </span>
                    </a>
                    <a href="users.php?id_us=<?php echo $id_p ?>" class="use">
                        <img src="<?php echo '../images/pp_users/' . @$rows['pp'] ?>" alt="User Profile" class="pp">
                    </a>
                </div>
            </li>
        </ul>
    </nav>

        <div class="menu" id="menu">
            <ul><?php if ($rows['status'] == 1) {
                    echo ' 
            <li><a href="reservation.php" class="lk"><span class="icon-laptop"></span> reservation</a></li>
            <li><a href="maintenance.php" class="lk"><span class="icon-desktop"></span> maintenace</a></li>
            <li><a href="service.php" class="lk"><span class="icon-clipboard2"></span> services</a></li>
            <li><a href="stock.php" class="lk"><span class="icon-layers2"></span> stock</a></li>
            <li><a href="help.php" class="lk"><span class="icon-question"></span> help</a></li>
        ';
                } else if ($rows['status'] == 2) {
                    echo ' <li><a href="reservation.php" class="lk"><span class="icon-laptop"></span> reservation</a></li>
            <li><a href="maintenance.php" class="lk"><span class="icon-desktop"></span> maintenace</a></li>
            <li><a href="help.php" class="lk"><span class="icon-question"></span> help</a></li>
        ';
                } else {
                    echo ' <li><a href="reservation.php" class="lk"><span class="icon-laptop"></span> reservation</a></li>
            <li><a href="help.php" class="lk"><span class="icon-question"></span> help</a></li>
        ';
                } ?></ul>
        </div>
        <div class="formres" id="reservation">
            <?php
            if (isset($_GET['mod'])) {
                $id = $_GET['mod'];
                $sqlmod = "SELECT * FROM reservation WHERE id_reservation = '$id'";
                $resmod = mysqli_query($conn, $sqlmod);
                $rowmod = mysqli_fetch_assoc($resmod);
            }
            $idd = @$rowmod['id_reservation'];
            if (isset($_GET['mod'])) {
                $ids = $_GET['mod'];
                $sqlmods = "SELECT * FROM salle WHERE id_salle = '$ids'";
                $resmods = mysqli_query($conn, $sqlmods);
                $rowmods = mysqli_fetch_assoc($resmods);
            }
            ?>
            <form action="<?php if (isset($_GET['mod'])) {
                                echo " ../Asset/traitement/mod.php?id_Re=$idd";
                            } else {
                                echo '../Asset/traitement/reservation.php';
                            } ?>" method="post">

                <div class="hed">
                    <p>reservation</p><a href="#"><span class="icon-close"></span></a>
                </div>
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><span class="icon-warning"></span>
                        <?php echo $_GET['error']; ?>
                    </p>
                <?php } ?>
                <div class="top"></div>
                <label for="date">Date </label> <input type="date" name="date" id="date"
                    value="<?php if (isset($_GET['mod'])) {
                                echo $rowmod['date_res'];
                            } else {
                                echo date('d-m-y');
                            } ?>"
                    class="date"><br>

                <label for="nom">votre nom</label> <input type="text" name="nom" id="nom" class="it"
                    value="<?php if (isset($_GET['mod'])) {
                                echo $rowmod['nom_us'];
                            } else {
                                echo "";
                            } ?>"><br>

                <label for="numero">votre numero</label><input type="text" name="numero" id="numero" class="it"
                    value="<?php if (isset($_GET['mod'])) {
                                echo $rowmod['tel'];
                            } else {
                                echo "";
                            } ?>"><br>
                <div class="sel">
                    <label for="salle">salle</label>
                    <select name="salle" id="salle">
                        <?php
                        $sqLSAL = "SELECT*FROM salle";
                        $ReqSal = mysqli_query($conn, $sqLSAL);
                        while ($rowsal = mysqli_fetch_assoc($ReqSal)) {
                            if (@$rowmods['nom_salle'] == $rowsal['nom_salle']) {
                                echo '<option selected>' . $rowmods['nom_salle'] . '</option>';
                            } else {
                                echo '<option>' . $rowsal['nom_salle'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <label for="heuredeb">debut</label>
                    <select name="heuredeb" id="heuredeb">
                        <?php
                        for ($i = 7; $i < 17; $i++) {
                            echo '<option>' . $i . 'h30</option>';
                        }
                        ?>
                    </select>
                    <label for="heurefin">fin</label>
                    <select name="heurefin" id="heurefin">
                        <?php
                        for ($i = 7; $i < 17; $i++) {
                            echo '<option>' . $i . 'h30</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="bot">
                    <?php if (isset($_GET['mod'])) {
                        echo '<a href="#" class="anl">annuler</a><input type="submit" value="modifier" name="mod">';
                    } else {
                        echo '<a href="#"  class="anl">suprimer</a><input type="submit" value="reservé" name="send">';
                    } ?>
                </div>

            </form>
        </div>
        <div class="con">
            <?php include '../footer.php'; ?>
            <div class="resre">
                <table>
                    <tr>
                        <th>N°</th>
                        <th>nom</th>
                        <th>telephone</th>
                        <th>date</th>
                        <th>salle</th>
                        <th>debut</th>
                        <th>fin</th>
                        <th>modifier</th>
                        <th>suprimer</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM reservation ORDER BY id_reservation DESC";
                    $reqr = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($reqr);
                    $i = 0;
                    if ($num == 0) {
                        echo '<tr><td class="not" colspan="9">aucun enregistrement.</td></tr>';
                    } else {
                        while ($row = mysqli_fetch_assoc($reqr)) {
                            echo '
                            <tr class="re2 list" id="' . $row['id_reservation'] . '">';
                            $i = $i + 1;
                            echo '<td>' . $i . '</td>';
                            echo '
                            <td>' . $row['nom_us'] . '</td>
                            <td>' . $row['tel'] . '</td>
                            <td>' . $row['date_res'] . '</td>
                            <td>' . $row['nom_salle'] . '</td>
                            <td>' . $row['debh'] . '</td>
                            <td>' . $row['debf'] . '</td>
                            <td>
                                <a href="reservation.php?mod=' . $row['id_reservation'] . '#reservation"><span class="mod icon-pencil"></span></a>
                            </td>
                            <td>
                                <a href="reservation.php?sup=' . $row['id_reservation'] . '#confirm"><span class="sup icon-trash"></span></a>
                            </td>
                        </tr>
                    ';
                        }
                    }
                    ?>
                </table>
            </div>
            <div class="conhea">
                <div class="cox">
                    <div class="bntres">
                        <a href="reservation.php#reservation"><span class="icon-plus"></span>reservation</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="confirm" id="confirm">
            <div class="ci">
                <div class="hed">
                    <p>confirmation</p><a href="#"><span class="icon-close"></span></a>
                </div>
                <?php
                if (isset($_GET['sup'])) {
                    $rowid = $_GET['sup'];
                }
                ?>
                <p>etes vous sur de vouloir supprimer la reservation ?</p>
                <?php echo '<a href="#" class="green">non</a> <a href="../Asset/traitement/mod.php?sup=' . @$rowid . '" class="red">oui</a>'; ?>
            </div>
        </div>
        </form>
        <script src="../js/script.js"></script>
    </body>

    </html>
<?php } else {
    header("Location: login.php");
} ?>