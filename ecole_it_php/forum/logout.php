<?php
session_start();
if ($_SESSION){
    session_unset(); //permet de deruire tous le variable de sessions courante 
    session_destroy(); 
    header("location:home.php");
}else{
        echo "vous etes pas conncter!!!";
}


?>