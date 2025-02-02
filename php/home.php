<?php
// Configuration de la base de données
$host = "localhost";
$user = "root";
$password = "";
$base = "my dashboard";

$conn = mysqli_connect($host, $user, $password);
$sqls = mysqli_select_db($conn, $base);

if (!$sqls) {
    header("Location: install.php#t1");
    exit();
}

include '../Asset/traitement/login.php';

// Vérification de la session utilisateur
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
    <link rel="stylesheet" href="../Outils Html/icomoon/style.css">
    <link rel="stylesheet" href="../Css/style.css">
    <link rel="icon" href="../Images/IA.PNG">
    <link rel="stylesheet" href="../Css/responcive.css">
    <title>Accueil</title>
</head>

<body>
    <nav class="box-bar">
        <ul>
            <li>
                <a href="home.php">
                    <div class="logo">
                        <img src="../Images/IA.PNG" alt="Logo">
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
                        <img src="<?php echo '../Images/pp_users/' . @$rows['pp'] ?>" alt="User Profile" class="pp">
                    </a>
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
                <li><a href="help.php" class="lk"><span class="icon-question"></span> help</a></li>';
            } elseif ($rows['status'] == 2) {
                echo '
                <li><a href="reservation.php" class="lk"><span class="icon-laptop"></span> reservation</a></li>
                <li><a href="maintenance.php" class="lk"><span class="icon-desktop"></span> maintenance</a></li>
                <li><a href="help.php" class="lk"><span class="icon-question"></span> help</a></li>';
            } else {
                echo '
                <li><a href="reservation.php" class="lk"><span class="icon-laptop"></span> reservation</a></li>
                <li><a href="help.php" class="lk"><span class="icon-question"></span> help</a></li>';
            }
            ?>
        </ul>
    </div>

    <main class="conte">
        <section class="baniere"></section>
        <section class="resre">
            <div class="caption">
                <p>reservation du jour</p>
                <a href="reservation.php">voir plus</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>nom</th>
                        <th>telephone</th>
                        <th>date</th>
                        <th>salle</th>
                        <th>debut</th>
                        <th>fin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $date = date('Y-m-d');
                    $sql = "SELECT * FROM reservation WHERE date_res = '$date'";
                    $reqr = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($reqr);
                    $i = 0;
                    if ($num == 0) {
                        echo '<tr><td class="not" colspan="7">aucun enregistrement.</td></tr>';
                    } else {
                        while ($row = mysqli_fetch_assoc($reqr)) {
                            $i++;
                            echo '
                            <tr class="list">
                                <td>' . $i . '</td>
                                <td>' . $row['nom_us'] . '</td>
                                <td>' . $row['tel'] . '</td>
                                <td>' . $row['date_res'] . '</td>
                                <td>' . $row['nom_salle'] . '</td>
                                <td>' . $row['debh'] . '</td>
                                <td>' . $row['debf'] . '</td>
                            </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <?php include '../footer.php'; ?>
    <script src="../js/script.js"></script>
</body>

</html>