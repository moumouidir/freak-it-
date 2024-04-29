<?php
     require("includes/bar_nav_forum.php") ;
     require("../forum/action/users/traitement_sign-up.php") ;
?>
<!DOCTYPE html>
<html lang="en">
<?php
     require("/wamp64/www/ecole_it_php/forum/includes/head_sign-up.php");
     ?> 


<body>
    <section>
        <div class="img-fond">
            <img src="./assets/img_forum/picture.jpeg" alt="image de personne en costume">
        </div>
        <div class=content-box>
            <div class="form-box">
            
                <form  method="POST">
                    <h2>LOGIN</h2>
                 

                    
                    <div class="input-box">
                        <span>Email</span>
                        <input type="email" placeholder=" please insert your address mail" name ="email">
                        <p><?php  if(isset($msg_email)) {echo  $msg_email; }?></p>
                        <i id ="icone-user" class='bx bx-user'></i>
                        
                    </div>

                    <div class="input-box">
                        <span>Password</span>
                        <input type="password" placeholder="password"  name ="pwd" value="<?php  if(isset( $_COOKIE ['email'])) {echo  $_COOKIE['email'] ; }?>" >
                        <p> <?php  if(isset($msg_pwd)) {echo  $msg_pwd; }?></p>
                        <i  id ="icone-lock" class='bx bxs-lock'></i>
                    </div>
                    
                    <div class="remenber-forget"> 
                        <label><input type="checkbox" name = "remenber_me" value= "<?php  if(isset( $_COOKIE ['pwd'])) {echo  $_COOKIE['pwd'] ;}?>"> Remenber me</label>
                        <a href="password.php">forgot password ? </a>
                    </div>
                    <div class="input-box">
                    <input type="submit" value= "sign-up" name="sign-up">
                    </div>
                    <div class="register-link ">
                        <p> Dont have an account ?<a href="register.php">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>