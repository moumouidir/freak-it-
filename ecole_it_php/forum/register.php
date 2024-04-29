<?php  
     require("../forum/action/users/traitement_register.php") ;
     require("includes/bar_nav_forum.php");
?> 

<!DOCTYPE html>
<html lang="en">
<?php
     require("/wamp64/www/ecole_it_php/forum/includes/head_register.php");
     ?> 

<body>
    <div class="contenair">
        <form          class="forum_reg"   method="POST" enctype= "multipart/form-data" »>
            <legend>Formulaire d inscription </legend>

            <tr>
            </tr><p id="error" > <?php  if(isset($error_msg)) {echo  $error_msg ; }?></p>
          
            <div class="data">
            <label for="Pseudo"> Pseudo : </label>
            <input type="text" name= "pseudo" placeholder="please insert Pseudo" maxlength="33" minlength="2" >
            </div>


            <div class="data">
            <label for="Name"> Name: </label>
            <input type="text" name= "fname" placeholder="please insert name" maxlength="33" minlength="2" >
            </div>

            <div class="data">
            <label for="Firstname"> Firstname: </label>
            <input type="text" name= "firstname" placeholder="please insert firstname" maxlength="33" minlength="2"  required>
            </div>

            <div class="data">
            <label for=" AddressEmail " >AddressEmail : </label>
            <input type="email" name ="email" placeholder="please insert your email" maxlength="33" minlength="2" required >
            </div>

            <div class="data">
            <label for=" password ">Password : </label>
            <input type="password" name = "pwd" placeholder="please insert password" maxlength="33" minlength="8"  required >
            </div>

            <div class="data">
            <label for="confirm_pwd">Password Confirmation: </label>
            <input type="password" name="confirm_pwd" placeholder=" password Confirmation " required>
            </div>

            <div class="data">
            <label for="date of birth"> Date of Birth : </label>
            <input type="date" name="date"  >

            </div>
            <div class="data">
            <label for="photo-profil">Photo de profil : </label>
            <input type="file" name="photo_profil" id="photo-profil" accept="image/png, image/jpeg" max-size="4000000" >




            <div class="data">
            <label for="banner">Banner:</label>
            <textarea name="description" id="text_banner" cols="62" rows="2"  ></textarea>

            </div>

            <div >
            <input type="hidden"  name ="role" value ="user"  >
            </div>

            

            
            <div class="btn">

            <input type="reset"   id= "btn_effecer"     value= "Effacer">
            <input type="submit"  id="btn_register"    value= "register" name="sent" >
            
            </div>
            
        </form>
    </div>
  

</body>
</html>