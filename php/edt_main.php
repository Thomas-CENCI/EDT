<?php
	session_start();
	if(isset($_SESSION['status'])){
	$status = $_SESSION['status'];}
	else{
		 header ('Location: edt_connexion.php');
	}


	if( !isset($_GET["page"]) ) { 
        $page=0;
      }else{
        $page=$_GET["page"];
      }

       $active = array(" "," "," "," ");
       $active[$page]= "active";

    if(isset($_GET["deconnexion"])){
    	session_unset();
		session_destroy();
		header ('Location: edt_connexion.php');

    }

    if(isset($_GET["recherche"])){
    	$page=5; // on va à la page 5
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>EDT</title>
		<meta content="info">
    	<meta charset="UTF-8"> 
    	<link href="../css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    	<link href="../css/edt_main.css" rel="stylesheet">
    	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		</head>

	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  		<a class="navbar-brand" href="?page=0">EDT</a>
	  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    		<span class="navbar-toggler-icon"></span> 
	  		</button>

	  		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		   		<ul class="navbar-nav mr-auto">
		      		<?php echo "<li class=\"nav-item $active[0]\">"; ?> <!-- peut être à changer le 0 en 4 -->
		        		<a class="nav-link" href="?page=0">Emploi du temps</a>
		     		</li>
		     		<?php if($status == "admin"): ?>
		      			<?php echo "<li class=\"nav-item $active[1]\">"; ?>
			        		<a class="nav-link" href="?page=1">Gestion cours</a> <!-- Permet à l'admin d'ajouter, de supprimer et de modifier des cours -->
			      		</li>
		      			<?php echo "<li class=\"nav-item $active[2]\">"; ?>
			        		<a class="nav-link" href="?page=2">Demandes de cours</a> <!-- affiche toutes les demandes à traiter -->
			      		</li>
			      	<?php elseif($status == "enseignant"): ?>
		      			<?php echo "<li class=\"nav-item $active[3]\">"; ?>
			        		<a class="nav-link" href="?page=3">Demander des cours</a> <!-- Demander à l'damin d'ajouter, de supprimer ou de modifier des cours  -->
			      		</li>
			      	<?php endif; ?>
			      	<li class="nav-item dropdown">
			        		<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">⚙️</a>
			      			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
          						<a class="dropdown-item" href="#">aide</a>
          						<a class="dropdown-item" href="?deconnexion=true">Déconnexion</a>
        					</div>
			      		</li>

		    	</ul>
		    	<form class="form-inline my-2 my-lg-0" method="GET">
		    		<div class="form-group">
						<label>Rechercher des cours </label>
					</div>
		      		<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="barre_de_recherche" value="">
		      		<button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="recherche" value="search">Search</button>
		    	</form>
	  		</div>
		</nav>
		
		<div class="container content">
			<?php
        		if(file_exists("page".$page.".php") ){ 
         		 include("page".$page.".php");
        		}
      		?>

	</body>
</html>