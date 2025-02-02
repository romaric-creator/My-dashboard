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
        <link rel="stylesheet" href="../Outils Html/icomoon/style.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/maintence.css">
        <link rel="stylesheet" href="../css/reservation.css">
        <title>service</title>
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
                    $resnot = mysqli_query($conn, $sqlnot);
                    $numnot = mysqli_num_rows($resnot);
                    $sql = "SELECT * FROM users WHERE id_users = '$id_p'";
                    $res = mysqli_query($conn, $sql);
                    $rows = mysqli_fetch_assoc($res);
                    ?>
                    <div class="menu_us">
                        <span class="icon-align-justify2" id="btn"></span>
                        <a href="notification.php?vue"><span class="icon-bell" id="<?php if ($numnot > 0) {
                                                                                        echo "noton";
                                                                                    } else {
                                                                                        echo "notof";
                                                                                    } ?>">

                                <?php if ($numnot > 0) {
                                    echo '<div class="num"><p>' . $numnot . '</p></div>';
                                } else {
                                    echo ' ';
                                } ?>
                            </span></a>
                        <a href="users.php?id_us=<?php echo $id_p ?>" class="use"><img src="<?php echo '../images/pp_users/' . @$rows['pp'] ?>" alt="" class="pp"></a>
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
        <div class="list_mach">
            <?php
            $sqlmach = "SELECT * FROM service";
            $reqmach = mysqli_query($conn, $sqlmach);
            $numac = mysqli_num_rows($reqmach);
            if ($numac == 0) {
                echo '<p class="nmac">Aucun service</p>';
            } else {
                while ($rowmach = mysqli_fetch_assoc($reqmach)) {
                    echo '
                    <div class="mach2">
                         <td class="up"> Demande de service effectué par <h2>Mr ' . $rowmach['nom_us'] . '</h2> </td>
                        <table>
                        <tr><td><p>telephone:</td><td><p>' . $rowmach['tel'] . '</p></td></tr>
                        <tr><td><p>description:</p></td><td><p class="co1">' . $rowmach['contenu'] . '</p></td></tr>
                        </table>
                    </div>
                ';
                }
            }
            ?>
            <div class="boop">
                <a href="#addsalle">
                    <div class="right"><span class="icon-plus"></span>
                        add service
                    </div>
                </a>
            </div>
        </div>
        <div class="formres" id="addsalle">
            <form action="../Asset/traitement/service.php" method="post">

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
                        <td><label for="nom">Nom utilisateur</label></td>
                        <td><input type="text" name="nom" id="nom" class="it it2"></td>
                    </tr><br>
                    <tr>
                        <td><label for="tel">telephone</label> </td>
                        <td><input type="text" name="tel" id="tel" class="it it2"></td>
                    </tr>
                    <tr>
                        <td><label for="co">description</label> </td>
                        <td> <textarea class="it it2" id="co" name="co"></textarea></td>
                    </tr>
                </table>
                <div class="bot">
                    <a href="?#" class="anl">annuler</a><input type="submit" value="soumettre" name="send">'
                </div>

            </form>
        </div>
        <script src="../js/script.js"></script>
    </body>

    </html>
<?php } else {
    header("Location: login.php");
} ?>