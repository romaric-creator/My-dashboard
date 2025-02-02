<?php 
include "config.php";
    if (isset($_POST['send'])) {
        if (isset($_POST['passwordA'])) {
            $passwordA = $_POST['passwordA'];
        }
        if (isset($_POST['passwordN'])) {
            $passwordN = $_POST['passwordN'];
        }

        if (isset($_POST['hid'])) {
            $id = $_POST['hid'];
        }
        
        if($passwordN == "" || $passwordA == ""){
            $error = "renseignez tous les champs";
            header("Location: ../../php/users.php?error=$error#mdp");
        }else{
               function securate($data){
                    $data = htmlspecialchars(trim($data));;
                    return $data;
               }
            $passwordA = securate($passwordA);
            $passwordN = securate($passwordN);
            $Sqlpa = "SELECT * FROM users WHERE id_users = '$id'";
            $resmdp = mysqli_query($conn,$Sqlpa);
            $rowmdp = mysqli_fetch_assoc($resmdp);

            if($passwordA !== $rowmdp['pass']){
                $error = "mot de passe incorect";
                header("Location: ../../php/users.php?error=$error#mdp");
            }else{
                if($passwordA == $passwordN){
                    $error = "utiliser un autre mot de passe";
                    header("Location: ../../php/users.php?error=$error#mdp");
                }else{
                        $sql = "UPDATE users SET pass = '$passwordN' WHERE id_users = '$id'";
                        $res = mysqli_query($conn,$sql);
                    if ($res) {
                        header("location: ../../php/users.php");
                    }else{
                        $error = "erreur lors de l'enregistrement";
                        header("Location: ../../php/users.php?error=$error#mdp");
                    } 
                }
                
            }

        }

    }
?>