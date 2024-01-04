<html>
 <head>
 <meta charset="utf-8">
 <!-- importer le fichier de style -->
 <link rel="stylesheet" href=" design_app.css" media="screen" type="text/css" />
 </head>
 <body id="body_login">
 	<h1 style="margin-top: 20px; font-style: italic; ">Sarl UMC LAB PLUS - CONSTANTINE - </h1>
 	<h2 style="font-style: italic; ">Distributeur de Consommables , Réactifs et Equipements Laboratoires</h2>



 <div id="container">
 <!-- zone de connexion -->
 
 <form action="verification.php" method="POST">
 <h1 align="center">Connexion</h1>
 
 <label><b>Nom d'utilisateur</b></label>
 <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

 <label><b>Mot de passe</b></label>
 <input type="password" placeholder="Entrer le mot de passe" name="password" required>

 <input type="submit" id='submit' value='LOG IN' >
 <?php
 if(isset($_GET['erreur'])){
 $err = $_GET['erreur'];
 if($err==1 || $err==2)
 echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
 }
 ?>
 
 </form>
</div>

 	 	<center><h2 style="margin-top: 20px; font-style: italic; margin-top: 100px;">Réalisé par : Mehdioui Med Adem .Version : 01/2023</h2></center>



 </body>
</html>