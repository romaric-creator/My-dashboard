<?php
    if(isset($_GET['search'])){
        if(empty($_GET['search'])){
            header("Location: ../header.php");
        }
    }
?>