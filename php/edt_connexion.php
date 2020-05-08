<?php
	session_start();

    $hostname ="sql7.freemysqlhosting.net:3306";
	$username="sql7336475";
	$password="ItBWtR3xM5";
	$db="sql7336475";

	$link = mysqli_connect($hostname, $username, $password, $db);

	/* check connection */
	if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
	}

	function setStatus($nb_status) {
		/*set la  variable global $_SESSION['status'] en fonction de l'utilisateur connecté*/
		if ($nb_status==1){ /*c'est l'admin*/
			$_SESSION['status']="admin";
		}
		else if ($nb_status==2){ /*c'est un enseignant */
			$_SESSION['status']="enseignant";
		}
		else{ /*c'est un étudiant*/
			$_SESSION['status']="etudiant";
		}
	}

    
    if(isset($_POST["connexion_bouton"])){
    	if($_POST['login']!="" && $_POST['password']!=""){
    		$requete_sql = "SELECT identifiant, motsDePasse, type FROM utilisateur WHERE identifiant LIKE '" . $_POST['login'] . "'";
    		$result = mysqli_query($link, $requete_sql);
    		$row = mysqli_fetch_array($result, MYSQLI_NUM);
    		/*
	    	$requete_sql="SELECT motsDePasse FROM utilisateur WHERE  	identifiant LIKE '" . $_POST['login'] . "'";
	    	$result = mysql_query($requete_sql) or die("Requête invalide: ". mysql_error()."\n".$requete_sql);
	    	$data = mysql_fetch_row($result);*/
	    	echo $row[0] . " ". $row[1]. " ".$row[2];
	    	echo "password : " . $_POST['password'];
	    	if($row[1]==$_POST['password']){
	    		$_SESSION['login']=$_POST['login'];
	    		$_SESSION['password']=$_POST['password'];
	    		setStatus($row[2]);
	    		header ('Location: edt_main.php');
	    	}
	    	else{
	    		$acces_denied = True;
	    		echo "1";
	    	}
    	}
	    else{
	    	$acces_denied = True;
	    	echo "2";
    	}
	    /* free result set */
		mysqli_free_result($result);

		/* close connection */
		mysqli_close($link);

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
