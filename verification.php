<?php

session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
 // connexion à la base de données
 $db_username = 'root';
 $db_password = '';
 $db_name = 'suivigps';
 $db_host = 'localhost';
 $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
 or die('could not connect to database');
 
 // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
 // pour éliminer toute attaque de type injection SQL et XSS
 $username = $_POST['username']; 
 $password = $_POST['password'];
 
 

 $requete = "SELECT count(*) FROM utilisateur where 
 nom_utilisateur = '$username' and password = '$password'";




 $exec_requete = mysqli_query($db,$requete);
  $reponse = mysqli_fetch_array($exec_requete);
  $count = $reponse['count(*)'];


 if($_POST['username'] == "H.ABDELKADER" && $_POST['password'] == "123") // nom d'utilisateur et mot de passe correctes
 {

 $_SESSION['username'] = $username;
 header('Location: add_tournee.php');
	

}

else {
	header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
 
}

}




?>