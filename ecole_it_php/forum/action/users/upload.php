<?php
 require("../forum/action/connection_BDO.php");


if (isset($_FILES['photo_profil']) && $_FILES['photo_profil']['error'] === 0) {

    $tableau = [
        "jpg"=> "image/jpeg",
        "jpeg"=> "image/jpeg",
        "png"=> "image/png",
    ] ;
    $photo_name = $_FILES["photo_profil"]["name"];
    $photo_type = $_FILES["photo_profil"]["type"];
    $photo_size = $_FILES["photo_profil"]["size"];

    $extension =strtolower(pathinfo($photo_name, PATHINFO_EXTENSION));
    // on verifie l absence de l extension dans les cles 
    if(!array_key_exists($extension, $tableau) || !in_array($photo_type, $tableau)) {

        die ( $error_msg="Error: format is incorrect ");
    }
    if ($photo_size>400000){
        die ($error_msg="Error: image size is large");
    }
    // on genere un nom unique  
   
    $new_name= md5(uniqid());

    // genere un chemeien 
    $photo_profil_new_name = "img_profil/$new_name.$extension";
    // on deplace le image 
    if (!move_uploaded_file($_FILES["photo_profil"]["tmp_name"], $photo_profil_new_name)){
        die ($error_msg="Error upload failed");
    }
    // les permitions pour le fichier :
    chmod($photo_profil_new_name,0777);
    $req_register_user_bdd->bindValue(':photo_profil',$photo_profil_new_name); 

}else{

    if(empty($_FILES['photo_profil'] ['name'])) {
              $photo_profil ='avatar_defaut.png';
              $req_register_user_bdd->bindvalue(':photo_profil',$photo_profil);
    }

}






?>