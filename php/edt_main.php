<?php
	session_start();
	$status = $_SESSION['status'];
	if( !isset($_GET["page"]) ) { 
        $page=0;
      }else{
        $page=$_GET["page"];
      }

       $active = array(" "," "," "," ");
       $active[$page]= "active";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>EDT</title>
		<meta content="info">
    	<meta charset="UTF-8">
    	<link href="../css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    	<link href="../css/edt_main.css" rel="stylesheet">
	</head>

	<body>

		<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  		<a class="navbar-brand" href="?page=0">EDT</a>
	  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    		<span class="navbar-toggler-icon"></span>
	  		</button>

	  		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		   		<ul class="navbar-nav mr-auto">
		      		<?php echo "<li class=\"nav-item $active[0]\">"; ?>
		        		<a class="nav-link" href="?page=0">Emploi du temps <span class="sr-only">(current)</span></a>
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
		    	</ul>
		    	<form class="form-inline my-2 my-lg-0">
		    		<div class="form-group">
						<label>Rechercher des cours </label>
					</div>
		      		<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
		      		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
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