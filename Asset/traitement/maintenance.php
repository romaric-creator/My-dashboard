<?php
include "config.php";
    if($_POST['send']){
        if($_POST['nomsalle']){
            $nomsalle = trim($_POST['nomsalle']);
        }
        if($_POST['disponibilite']){
            $disponibilite = $_POST['disponibilite'];
        }
        if ($nomsalle == "" || $disponibilite == ""){
            $error = "veuillez renseigner tous les champs";
            header("Location: ../../php/maintenance.php?error=$error#salle");
        }else{
           $sql = "INSERT INTO salle (nom_salle,disponibilite) VALUES ('$nomsalle','$disponibilite')" ;
           $req = mysqli_query($conn,$sql);
            if($req){
                header("Location: ../../php/maintenance.php");
            }else{
                $error = "erreur lors de l´enregistrement";
                header("Location: ../../php/maintenance.php?error=$error#salle");   
            }
        }
    }
        
    
?>