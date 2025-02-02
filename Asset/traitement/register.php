<?php 
include "config.php";
    if (isset($_POST['send'])) {
        if (isset($_POST['nom'])) {
            $nom = $_POST['nom'];
        }
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }
        if (isset($_FILES['pp'])) {
            $pp_name = $_FILES['pp']['name'];
            $pp_tmpname = $_FILES['pp']['tmp_name'];
        }
        if (isset($_POST['password'])) {
            $password = $_POST['password'];
        }
        if (isset($_POST['number'])) {
            $number = $_POST['number'];
        }
        if($email == "" || $nom == "" || $password == "" || $number == "" || $pp_name == ""){
            $error = "renseignez tous les champs";
            header("Location: ../../php/install.php?error=$error#t3");
        }else{
               function securate($data){
                    $data = htmlspecialchars(trim($data));;
                    return $data;
               }
               $pp_name = securate($pp_name);
            $email = securate($email);
            $password = securate($password);
            $number = securate($number);
            $nom = securate($nom);
             if(move_uploaded_file($pp_tmpname,"../../Images/pp_users/".$pp_name)){
                    $sql = "INSERT INTO users (nom,email,pass,numero,status,pp) VALUE ('$nom','$email','$password','$number','1','$pp_name')";
                $res = mysqli_query($conn,$sql);
                if ($res) {
                    $sqls = "SELECT * FROM users WHERE email = '$email' AND pass = '$password'";
                    $ress = mysqli_query($conn,$sqls);
                    $rows = mysqli_fetch_assoc($ress);
                    $_SESSION['id_users'] = $rows['id_users'];
                    header("location: ../../php/home.php");
                }else{
                    $error = "erreur lors de l'enregistrement";
                    header("Location: ../../php/install.php?error=$error#t3");
                }
             }else{
                $error = "impossible d'enregistrer le profil ";
                header("Location: ../../php/install.php?error=$error#t3"); 
             }
               
            }

    }
?>