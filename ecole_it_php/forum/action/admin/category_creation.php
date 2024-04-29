<?php

require("traitement_create_catg.php");
require('bar_nav_forum.php');
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/style_create_category.css">
    <title>create category</title>
</head>
<body>
    
<header id= "head"> Creation of Category</header>                           
 <form  class="form_create"   method="POST"  enctype= "multipart/form-data" >
<div class="data">
            <p><?php if(isset($error_msg)) {echo  $error_msg ; }?><p>
            <label for="category ">category : </label>
            <input type="text" name= "category" placeholder="please insert category" maxlength="100" minlength="4"  >
            <label >CREATE BY : </label>
            <input id=btn_sub type ="submit" value= create name="create_category"> 
            <a href="All_caregory.php"> all categories</a>

            </div>
 </form>

</body>

</html>
