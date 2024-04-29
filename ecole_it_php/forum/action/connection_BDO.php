
<?php
$dsn='mysql:dbname=forum;host=localhost;charset=utf8mb4';
$user= 'root';
$password= '';



try {

 $bdd = new PDO($dsn,$user, $password);
//  si ya des erreur sql
 $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(" connection a la base donne échoue". $e->getMessage());

}
