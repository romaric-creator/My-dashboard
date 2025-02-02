<?php
include "config.php";
    if($_POST['send']){
        if($_POST['nom']){
            $nom = $_POST['nom'];
        }
        if($_POST['tel']){
            $tel = $_POST['tel'];
        }
        if($_POST['co']){
            $co = $_POST['co'];
        }
        echo $nom.''.$tel.' '.$co;
        if ($nom == "" || $tel == "" || $co == "" ) {
            $error = "veuillez renseigner tous les champs";
            header("Location: ../../php/service.php?error=$error#addsalle");
        }else{
           $sql = "INSERT INTO service (nom_us,tel,contenu) VALUES (\"$nom\",\"$tel\",\"$co\")" ;
           $req = mysqli_query($conn,$sql);
            if($req){
                header("Location: ../../php/service.php");
            }else{
                $error = "erreur lors de l´enregistrement";
                header("Location: ../../php/service.php?error=$error#addsalle");   
            }
        }
    }
?>