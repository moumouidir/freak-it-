
<?php 


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href=/ecole_it_php/forum/assets/navbar.css>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
  
  <div class="general">

    <img class="logo" src="assets\img_forum\logo.png" alt="freakIT Forum">
    <header class= "element_nav_bar">
    <h1> Forum</h1>
    <form action="../forum/recherche.php" method="GET">
     <nav>
      
      <a id="accuiel" href="\ecole_it_php\forum\index.php"> Home </a>
      <a id="Question" href= "\ecole_it_php\forum\publish_question.php"> Questions </a>
      <a id="Myprofil" href="\ecole_it_php\forum\Myprofil.php"> My Profil</a>
      <a  id="btn_logout"     href="\ecole_it_php\forum\logout.php"><i class='bx bx-log-out'></i></a>
      <a id ='btn_admin'  href= \ecole_it_php\forum\action\admin\administrateur.php> <i class='bx bx-cog'></i> </a>
       
      
   
      
      <input type="search" id="input_search" name="search"     placeholder="Entrez votre recherche ici ">
      <form action="sign-up.php">
      <button type="submit" id="btn_search"> <i class='bx bx-search'></i></button>
      
     
      
      <input type="submit"  id="btn_connection" value= "Login"  formaction="../forum/sign-up.php">
      </form>
   
    </nav>
    </header>
    
  </div>
</html>
