<?php
	session_start();

    $user = 'root';
	$password = 'root';
	$db = 'inventory';
	$host = 'localhost';
	$port = 8889;

	/*$link = mysqli_init();*/
	/*$success = mysqli_real_connect($link, $host, $user, $password, $db, $port);*/

	/*if (mysqli_connect_error()) {
    	die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
  	}

  	echo 'Connected successfully.';

    mysql_query("SET NAMES UTF8");*/

    
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
    
   	/*$mysqli->close();*/
?>

<!DOCTYPE html>
<html>
	<head>
		<title>EDT - connexion </title>
		<meta content="info">
    	<meta charset="UTF-8">
    	<link href="../css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    	<link href="../css/edt_connexion.css" rel="stylesheet">
	</head>

	<body>

	<div class="vertical-center">
		<div class="container">
			<!-- Alert message if didn't success to sign in -->
			<?php if (isset($acces_denied)): ?>
				<div class="row justify-content-center">
					<div class="col-4">
						<div class="alert alert-warning" role="alert">
	 						 A simple warning alert—check it out!
						</div>
					</div>
				</div>
			<?php endif; ?>

			<div class="row">
				<div class="col-4">
				</div> 
				<div class="col-4">
					<div id="connexion_block">
							<form id="connexion" action="" method="POST">
								<div class="form-group form-top text-center">
									<label class="font-weight-bold">Connexion à EDT </label>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="login" value="" placeholder="Nom d'utilisateur">
								</div>
								<div class="form-group">
									<input type="password" class="form-control" name="password" value="" placeholder="Mot de passe">
								</div>
								<!-- <?php if (isset($acces_denied)): ?> -->
									<!-- <div id="msg_error">Le nom d'utilisateur ou le mot de passe est incorrect, veuillez réessayer </div> -->
								<!-- <?php endif; ?> -->
								<div class="form-group form-bottom">
									<input type="submit"  class="form-control btn btn-outline-primary" name="connexion_bouton" value="Connexion">
								</div>
							</form>
					</div>
				</div>
				<div class="col-4">
				</div> 
			</div>
		</div>
	</div>
	

	</body>
</html>
