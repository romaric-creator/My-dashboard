<?php
include 'config.php';
session_start();
    if (isset($_POST['send'])) {
        if (isset($_POST['password'])) {
            $password = $_POST['password'];
        }
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }
        if($email == "" || $password == ""){
            $error = "renseignez tous les champs";
            header("Location: ../../php/login.php?error=$error");
        }else{
               function securate($data){
                    $data = htmlspecialchars(trim($data));;
                    return $data;
               }
            $email = securate($email);
            $password = securate($password);
                $sql = "SELECT * FROM users WHERE email = '$email' AND pass = '$password'";
                $res = mysqli_query($conn,$sql);
                if (mysqli_num_rows($res) > 0) {
                    $rows = mysqli_fetch_assoc($res);
                    $_SESSION['id_users'] = $rows['id_users'];
                    header("location: ../../php/home.php");
                }else{
                    $error = "aucune corespondance";
                    header("Location: ../../php/login.php?error=$error");
                }
            }

    }
?>