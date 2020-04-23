<?php
	session_start();

	$mysql_user = "root";
    $mysql_passwd = "root";
    
    /*$conn = mysql_connect("localhost:8889", $mysql_user, $mysql_passwd) or die("Impossible de se connecter : ". mysql_error());
    
    mysql_select_db($mysql_user, $conn)or die("Impossible de sélectionner la base: ". mysql_error());
    
    mysql_query("SET NAMES UTF8"); /*

    /*
    if(isset($_POST["connexion_bouton"])){
    	if($_POST['login']!="" && $_POST['password']!=""){
	    	$requete_sql="SELECT motsDePasse FROM utilisateur WHERE  	identifiant LIKE '" . $_POST['login'] . "'";
	    	$result = mysql_query($requete_sql) or die("Requête invalide: ". mysql_error()."\n".$requete_sql);
	    	$data = mysql_fetch_row($result);
	    	
	    	if($data[0]==$_POST['password']){
	    		$_SESSION['login']=$_POST['login'];
	    		$_SESSION['password']=$_POST['password'];
	    		$access_granted = True;
	    		header ('Location: EDT.php');
	    	}
	    	else{
	    		$acces_denied = True;
	    	}
    	}
	    else{
	    	$acces_denied = True;
    	}
    }
    */

?>

<!DOCTYPE html>
<html>
	<head>
		<title>EDT - connexion </title>
		<meta content="info">
    	<meta charset="UTF-8">
    	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    	<link href="edt_connexion.css" rel="stylesheet">
	</head>

	<body>

	<h2>Bienvenue sur votre site de gestion d'emploi du temps</h2>

	<div class="row">
		<div class="col">
		</div>
		<div id="connexion_block" class="col">
			<form id="connexion" action="" method="POST">
				<span id="titre">Connexion à EDT </span></br>
				<input type="text" name="login" value="" placeholder="Nom d'utilisateur"></br>
				<input type="password" name="password" value="" placeholder="Mot de passe"></br>
				<!-- <?php if (isset($acces_denied)): ?> -->
					<!-- <div id="msg_error">Le nom d'utilisateur ou le mot de passe est incorrect, veuillez réessayer </div> -->
				<!-- <?php endif; ?> -->
				<input type="submit" name="connexion_bouton" value="connexion">
			</form>
		</div>
		<div class="col">
		</div>
	</div>
	

	</body>
</html>
