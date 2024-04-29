

<?php  session_start();
require(__DIR__."/action/connection_BDO.php");

require("includes/bar_nav_forum.php");


if (isset($_SESSION['ID_USER'])){
    // je recupere mes categorie 
    $all_categorie = $bdd->query('SELECT * FROM  categories');

    // verification pour la creation d un topic
    if (isset($_POST["publish"])) {
            if (!empty($_POST["title"]) && !empty($_POST["description"])) {

            //  je recupere mes donnes insertions dans des variables 
                $title_topic = htmlspecialchars($_POST["title"]);
                $id_category=$_POST["category"];
                $message =htmlspecialchars($_POST["description"]);
                $date=date('Y/m/d h:m:s');
                $author_publish=$_SESSION['ID_USER'];
                $name_publish= $_SESSION['pseudo'];
              
                $message = htmlspecialchars($_POST['description']);

            // requete insertion dans tables des topic
                $requete_topic=$bdd->prepare('INSERT INTO sujets(ID_CATEGORY,TITLE,ID_USER,PSEUDO_USER,DATE_CREATE)VALUES(:id_category,:title,:id_user,:pseudo_user,:date_create)');
                $requete_topic->bindValue(':id_category',$id_category);
                $requete_topic->bindValue(':title', $title_topic);
                $requete_topic->bindValue(':id_user',$author_publish);
                $requete_topic->bindValue(':date_create',$date);
                $requete_topic->bindValue(':pseudo_user',$name_publish);
                $requete_topic->execute();
                $result_topic= $requete_topic->fetch();
                $id_topic = $bdd->lastInsertId();
            // requete insertion dans la table messages 
                $requete_message = $bdd->prepare("INSERT INTO messages (ID_TOPIC, ID_USER,PSEUDO_USER,CONTENU, DATE_CREATE)
                VALUES (:id_topic, :id_user,:pseudo_user,:fmessage, :date_create)");

                $requete_message->bindValue(':id_topic', $id_topic); 
                $requete_message->bindValue(':id_user', $author_publish); 
                $requete_message->bindValue(':fmessage', $message);
                $requete_message->bindValue(':date_create', $date); 
                $requete_message->bindValue(':pseudo_user',$name_publish); 
                $requete_message->execute();
                $error_msg = "publish sussful";

            }else{
            // dans le cas ou les champs sont vides
                $error_msg = "please complete all fields correctly";
            }

        }


}else{     
    echo  "<script type=\"text/javascript\">alert('to access this page you must be authenticated');
        document.location.href='/ecole_it_php/forum/sign-up';
        </script>";
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style_publish_qu.css">
    <title>Publish Question</title>
    
</head>

  
<body>
    <div class="contenair">
        <form  class="forum_publis"   method="POST" enctype= "multipart/form-data">
           

            <tr>
            </tr><h2> <?php  if(isset($error_msg)) {echo  $error_msg ; }?></h2>
          
            <div class="data">
            <label for="Tilte Publication"> Tilte  of Publication : </label>
            <input type="text" name= "title" placeholder="please insert your title" maxlength="33" minlength="2" >
            </div>

            <label for="category" > Category</label>
            
            <select name="category" class="selection">
           <?php  
                while($contenu_cat = $all_categorie->fetch()) {
                    ?>
                <option value="<?php echo $contenu_cat['ID_CATEGORY']?>"><?php echo $contenu_cat['NAME_CATEGORY']?></option>


                    <?php
                }
           ?>
            </select> 

            <div class="data">
            <label for="message">Message:</label>
            <textarea name="description" id="text_banner" cols="62" rows="4" ></textarea>
            </div>

            <div class="btn">
            <input type="submit"  id="btn_register"    value= "Publish" name="publish" >
            <input type="reset"   id= "btn_effecer"     value= "Effacer">
            </div>
            
        </form>


</body>
</html>