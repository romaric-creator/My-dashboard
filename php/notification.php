<?php 
$host = "localhost";
$user = "root";
$password = "";
$base = "my dashboard";

$conn = mysqli_connect($host, $user, $password);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sqls = mysqli_select_db($conn, $base);
if (!$sqls) {
    header("Location: install.php#t1");
    exit();
}

include "../Asset/traitement/config.php";
include '../Asset/traitement/login.php';

session_start();
if (!isset($_SESSION['id_users'])) {
    header("Location: login.php");
    exit();
}

$id_p = $_SESSION['id_users'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/style.css">
    <link rel="stylesheet" href="../Css/notification.css">
    <link rel="stylesheet" href="../Outils Html/icomoon/style.css">
    <title>notification</title>
</head>
<body>
<?php 
if (isset($_GET['search'])) {
    echo '
        <div class="box-search">
        <h1 class="tx">resultats de la recherche</h1>
        <div class="boxno">
    ';
    $search = trim($_GET['search']);
    if ($search !== "") {
        $mots = explode(" ", $search);
        $cl = array_map(function($mot) {
            return "nom_us LIKE '%" . $mot . "%'";
        }, $mots);
        $sqlnot = "SELECT * FROM reservation WHERE " . implode(' OR ', $cl);
        $resnot = mysqli_query($conn, $sqlnot);
        if (mysqli_num_rows($resnot) == 0) {
            echo '<p class="rec"> Aucune resultat trouvé </p>';
        } else {
            while ($rowsnot = mysqli_fetch_assoc($resnot)) {
                echo '<p><a href="reservation.php#' . $rowsnot['id_reservation'] . '">Nouvelle salle réservée par Mr ' . $rowsnot['nom_us'] . ' le ' . $rowsnot['date_res'] . ' de ' . $rowsnot['debh'] . ' à ' . $rowsnot['debf'] . '</a></p>';
            }
        }
    }
    echo '
        </div>
        </div>
    ';
}
?>
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
                <form action="notification.php" method="get">
                    <input type="search" name="search" class="search" placeholder="faites vos recherche ici">
                </form>
            </span>
        </li>
        <li>
            <?php 
            $sqlnot = "SELECT * FROM reservation WHERE status = 'on'";
            $resnot = mysqli_query($conn, $sqlnot);
            $numnot = mysqli_num_rows($resnot);
            $sql = "SELECT * FROM users WHERE id_users = '$id_p'";
            $res = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_assoc($res);
            ?>
            <div class="menu_us">
                <span class="icon-align-justify2" id="btn"></span>
                <a href="notification.php?vue"><span class="icon-bell" id="<?php echo ($numnot > 0) ? 'noton' : 'notof'; ?>">
                    <?php if ($numnot > 0) { echo '<div class="num"><p>' . $numnot . '</p></div>'; } ?>
                </span></a>
                <img src="<?php echo '../images/pp_users/' . @$rows['pp']; ?>" alt="" class="pp">
            </div>
        </li>
    </ul>
</nav>
<div class="menu" id="menu">
    <ul>
        <?php 
        if ($rows['status'] == 1) {
            echo '
                <li><a href="reservation.php" class="lk"><span class="icon-laptop"></span> reservation</a></li>
                <li><a href="maintenance.php" class="lk"><span class="icon-desktop"></span> maintenance</a></li>
                <li><a href="service.php" class="lk"><span class="icon-clipboard2"></span> services</a></li>
                <li><a href="stock.php" class="lk"><span class="icon-layers2"></span> stock</a></li>
                <li><a href="help.php" class="lk"><span class="icon-question"></span> help</a></li>
            ';
        } elseif ($rows['status'] == 2) {
            echo '
                <li><a href="reservation.php" class="lk"><span class="icon-laptop"></span> reservation</a></li>
                <li><a href="maintenance.php" class="lk"><span class="icon-desktop"></span> maintenance</a></li>
                <li><a href="help.php" class="lk"><span class="icon-question"></span> help</a></li>
            ';
        } else {
            echo '
                <li><a href="reservation.php" class="lk"><span class="icon-laptop"></span> reservation</a></li>
                <li><a href="help.php" class="lk"><span class="icon-question"></span> help</a></li>
            ';
        }
        ?>
    </ul>
</div>
<div class="boxno">
    <?php 
    $sqlnot = "SELECT * FROM reservation ORDER BY id_reservation DESC";
    $resnot = mysqli_query($conn, $sqlnot);
    if (mysqli_num_rows($resnot) == 0) {
        echo '<p> Aucune notification </p>';
    } else {
        while ($rowsnot = mysqli_fetch_assoc($resnot)) {
            echo '<p><a href="reservation.php#' . $rowsnot['id_reservation'] . '">Nouvelle salle réservée par Mr ' . $rowsnot['nom_us'] . ' le ' . $rowsnot['date_res'] . ' de ' . $rowsnot['debh'] . ' à ' . $rowsnot['debf'] . '</a></p>';
        }
    }
    if (isset($_GET['vue'])) {
        $squp = "UPDATE reservation SET status = 'off'";
        $resup = mysqli_query($conn, $squp);
        header("Location: notification.php");
        exit();
    }
    ?>
</div>

<script src="../js/script.js"></script>
</body>
</html>