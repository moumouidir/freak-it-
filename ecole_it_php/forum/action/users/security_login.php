<?php 
session_start();
if (!isset($_SESSION["auth"])) {
    header('location:..\www\ecole_it_php\forum\sign-up.php');
}
?>