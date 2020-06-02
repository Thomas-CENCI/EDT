<?php
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
         $_SESSION['login']=$_POST['login'];
        }
        else if ($nb_status==2){ /*c'est un enseignant */
            $_SESSION['status']="enseignant";
         $_SESSION['login']=$_POST['login'];
        }
        else{ /*c'est un étudiant*/
            $_SESSION['status']="etudiant";
         $_SESSION['login']=$_POST['login'];
        }
    }
    
    
    if(isset($_POST["connexion_bouton"])){
        if($_POST['login']!="" && $_POST['password']!=""){
            $requete_sql = "SELECT identifiant, motsDePasse, type FROM utilisateur WHERE identifiant LIKE '" . $_POST['login'] . "'";
            $result = mysqli_query($link, $requete_sql);
            $row = mysqli_fetch_array($result, MYSQLI_NUM);


            if($row[1]==$_POST['password']){
                $_SESSION['login']=$_POST['login'];
                $_SESSION['password']=$_POST['password'];
                session_start();
                setStatus($row[2]);
                header ('Location: edt_main.php');
            }
            else{
                $acces_denied = True;
            }
        }
        else{
            $acces_denied = True;
        }
        /* free result set */
        mysqli_free_result($result);
        
        /* close connection */
        mysqli_close($link);
        
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>EDT - connexion </title>
        <meta content="info">
        <meta charset="UTF-8">
        <link href="../css/connexion.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="vertical-center">
            <div class="container">
            <!-- Alert message si pas réussi à se connecter -->
                <?php if (isset($acces_denied)): ?>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <div class="alert alert-danger" role="alert">
                                Le nom d'utilisateur ou le mot de passe est incorrect, veuillez réessayer.
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-lg-8">
                        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="../image/1.jpg" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Bienvenue sur votre site d'emploi du temps</h5>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="../image/2.jpg" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Consultez votre emploie du temps</h5>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="../image/3.jpg" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Planifiez vos activités</h5>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
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
                                <div class="form-group">
                                    Entrez votre nom d'utilisateur et votre mot de passe puis cliquez sur le bouton Connexion ci-dessous pour continuer.
                                </div>
                                <div class="form-group form-bottom">
                                    <input type="submit"  class="form-control btn btn-outline-primary" name="connexion_bouton" value="Connexion">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="semi_footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-6">
                    <p>Créé par Cenci Thomas, Gosselin Rémi, Razafindrabe Noah et Vieu Loïc</p>
                    </div>
                    <div class="col-lg-3">
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
