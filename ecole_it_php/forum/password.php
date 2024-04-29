<?php
require("/wamp64/www/ecole_it_php/forum/includes/bar_nav_forum.php");
require(__DIR__."/action/users/traitement_pwd_forget.php");
require('action/connection_BDO.php')
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="assets/style_forget_pwd.css">
    <title>Forget password</title>
</head>
<body>
    <form class=general_pwd  action="password.php" method="POST" enctype="multipart/form"> 
        <div class="pwd_forget">
        <H2> Reinitialize Password</H2>
        <H3> <?php  if(isset($error_msg)) {echo  $error_msg ; }?></H3>
    
        <label for="">Email</label>
        <input  id= "email" type="email" placeholder="insert your email" name= "email">

        <a href="../sign-up.php">Retun to Login</a>
        <input  id=btn_rest_pwd  type="submit"  value="Reinitialize Password" name = "se_souvenir_pwd">
        <a href="./../register.php">  Need to Register ?</a>
        </div>



    </form>
</body>
</html>