<?php
	session_start();

	$mysql_user = "vieul";
    $mysql_passwd = "iymhnc8d";
    
    $conn = mysql_connect("tp-epu:3308", $mysql_user, $mysql_passwd) or die("Impossible de se connecter : ". mysql_error());
    
    mysql_select_db($mysql_user, $conn)or die("Impossible de sélectionner la base: ". mysql_error());
    
    mysql_query("SET NAMES UTF8");

    if(isset($_POST["connexion_bouton"])){
    	if($_POST['login']!="" && $_POST['password']!=""){
	    	$requete_sql="SELECT mot_de_passe FROM user WHERE login LIKE '" . $_POST['login'] . "'";
	    	$result = mysql_query($requete_sql) or die("Requête invalide: ". mysql_error()."\n".$requete_sql);
	    	$data = mysql_fetch_row($result);
	    	if($data[0]==$_POST['password']){
	    		$_SESSION['login']=$_POST['login'];
	    		$_SESSION['password']=$_POST['password'];
	    		$access_granted = True;
	    		header('Location : EDT.php') /*redirection*/
	    	}
	    	else{
	    		$acces_denied = True;
	    	}
    	}
	    else{
	    	$acces_denied = True;
    	}
    }

?>

<!DOCTYPE html>
<html>
	<head>
		<title>EDT - connexion </title>
		<meta content="info">
    	<meta charset="UTF-8">
    	<link rel="stylesheet" href="edt_connexion.css" />
	</head>
	<body>

	<h1>Bienvenue sur votre site de gestion d'emploi du temps</h1>

	<form id="connexion" action="" method="POST">
		<span id="titre">Connexion à EDT </span>
		<input type="text" name="login" value="" placeholder="Nom d'utilisateur">
		<input type="password" name="password" value="" placeholder="Mot de passe">
		<?php if (isset($acces_denied)): ?>
			<div id="msg_error">Le nom d'utilisateur ou le mot de passe est incorrect, veuillez réessayer </div>
		<?php endif; ?>
		<input type="submit" name="connexion_bouton" value="connexion_pressed">
	</form>
	

	</body>
</html>
