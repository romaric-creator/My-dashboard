<?php 
include "config.php";
    if (isset($_POST['send'])) {
        if (isset($_POST['nom'])) {
            $nom = $_POST['nom'];
        }
        if (isset($_POST['password'])) {
            $password = $_POST['password'];
        }
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }

        if (isset($_POST['hid'])) {
            $id = $_POST['hid'];
        }
        
        if (isset($_POST['numero'])) {
            $number = $_POST['numero'];
        }
        if($email == "" || $nom == "" || $password == "" || $number == ""){
            $error = "renseignez tous les champs";
            header("Location: ../../php/users.php?error=$error#reservation");
        }else{
               function securate($data){
                    $data = htmlspecialchars(trim($data));;
                    return $data;
               }
            $email = securate($email);
            $password = securate($password);
            $number = securate($number);
            $nom = securate($nom);
            $Sqlpa = "SELECT * FROM users WHERE id_users = '$id'";
            $resmdp = mysqli_query($conn,$Sqlpa);
            $resmdp = mysqli_fetch_assoc($resmdp);
            if($password != $resmdp['pass']){
                $error = "mot de passe incorect";
                header("Location: ../../php/users.php?error=$error#reservation");
            }else{
                $sql = "UPDATE users SET nom = '$nom',email = '$email',pass = '$password',numero = '$number' WHERE id_users = '$id'";
                    $res = mysqli_query($conn,$sql);
                if ($res) {
                    header("location: ../../php/users.php");
                }else{
                    $error = "erreur lors de l'enregistrement";
                    header("Location: ../../php/users.php?error=$error#reservation");
                }
            }

             }

    }
?>