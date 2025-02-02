<?php
include "config.php";
    if($_POST['send']){
        if($_POST['nom']){
            $nom = $_POST['nom'];
        }
        if($_POST['numero']){
            $numero = $_POST['numero'];
        }
        if($_POST['date']){
            $date = $_POST['date'];
        }
        if($_POST['heuredeb']){
            $heuredeb = $_POST['heuredeb'];
        }
        if($_POST['heurefin']){
            $heurefin = $_POST['heurefin'];
        }
        if($_POST['salle']){
            $salle = $_POST['salle'];
        }
        if ($nom == "" || $numero == "" || $date == "" || $heuredeb == "" || $heurefin == "" || $salle == "") {
            $error = "veuillez renseigner tous les champs";
            header("Location: ../../php/reservation.php?error=$error#reservation");
        }else{
           $sql = "INSERT INTO reservation (nom_us,date_res,nom_salle,tel,debh,debf,status) VALUES ('$nom','$date','$salle','$numero','$heuredeb','$heurefin','on')" ;
           $req = mysqli_query($conn,$sql);
            if($req){
                header("Location: ../../php/reservation.php");
            }else{
                $error = "erreur lors de l´enregistrement";
                header("Location: ../../php/reservation.php?error=$error#reservation");   
            }
        }
    }
        
    
?>