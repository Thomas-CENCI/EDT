<?php 
 $hostname ="sql7.freemysqlhosting.net:3306";
$username="sql7336475";
$password="ItBWtR3xM5";
$db="sql7336475";


if(isset($_POST['refuser_bouton'])){ // quand on refuse une demande
  $link = mysqli_connect($hostname, $username, $password, $db);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    
  $id_row = $_POST['id_row'];
  $requete_refuser_sql = "DELETE FROM modification WHERE identifiant = $id_row";
  $result_refus = mysqli_query($link, $requete_refuser_sql);

   /* free result set */
  mysqli_free_result($result_refus);
  
  /* close connection */
  mysqli_close($link);
  echo "<div class=\"alert alert-success\" role=\"alert\">Demande supprimé.</div>";

}

if(isset($_POST['accepter_bouton'])){

}

?>


<head>
  <meta name=description content="Gestion de cours - ADMIN"> <!-- il voit une liste de demandes de modification et peu accepter ou nom la demande -->
</head>

<h1>Demandes de modifications d'évènement </h1>

<?php 

  $link = mysqli_connect($hostname, $username, $password, $db);

  /* check connection */
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
  }

  // requete affichage modification évènement
    $requete_modification_sql = "SELECT modification.identifiant, utilisateur.identifiant, events.SUMMARY, events.DTSTART, events.DTEND, events.LOCATION, events.description, modification.salleEvent, modification.dateEventD, modification.dateEventF FROM utilisateur, events,modification WHERE (modification.identifiantUtilisateur LIKE utilisateur.identifiant) and(events.id = modification.identifiantCours) and modification.type = 2
    ";
    $result_modification = mysqli_query($link, $requete_modification_sql);
    $nb_champs1 = mysqli_field_count($link); 

  ?>
<div class="container">
  <div class="row">
    <div class="table-responsive">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Auteur</th>
            <th scope="col">Nom</th>
            <th scope="col">Heure début</th>
            <th scope="col">Heure fin</th>
            <th scope="col">Localisation</th>
            <th scope="col">Description</th>
            <th scope="col">nouvelle salle</th>
            <th scope="col">nouvelle date début</th>
            <th scope="col">nouvelle date fin</th>
            <th scope="col">Choix</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_array($result_modification, MYSQLI_NUM)): ?>
            <tr>
              <form action="" method="POST">
                <input type="hidden" name="id_row" value=<?="$row[0]";?>>
                <?php for($i=1; $i<$nb_champs1; $i++ ){
                    if ($i==6){
                      $row[$i] = str_replace('\\n', ' ', $row[$i]);
                    }
                    echo "<td>$row[$i]</td>";
                } ?>
                <td>
                  <input type="submit" name="accepter_bouton" class="btn btn-primary" value="accepter">
                  <input type="submit" name="refuser_bouton" class="btn btn-danger" value="refuser">
                </td>
              </form>
            </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
      </div>
  </div>
</div>

 <?php /* free result set */
    mysqli_free_result($result_modification);

    /* close connection */
    mysqli_close($link); 

  //requete affichage création évènement

  $link = mysqli_connect($hostname, $username, $password, $db);

  /* check connection */
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
  }


  $requete_creation_sql = "SELECT modification.identifiant,utilisateur.identifiant, modification.nomEvent, modification.descriptionEvent, modification.dateEvent, modification.enseignantEvent, modification.salleEvent, modification.heureDebut, modification.heureFin, modification.groupeEvent FROM utilisateur, modification WHERE (modification.identifiantUtilisateur LIKE utilisateur.identifiant) and modification.type = 1";
  $result_creation = mysqli_query($link, $requete_creation_sql);
  $nb_champs2 = mysqli_field_count($link);

?>

<h1>Demandes de création d'évènement </h1>
<div class="container">
  <div class="row">
    <div class="table-responsive">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Auteur</th>
            <th scope="col">Nom</th>
            <th scope="col">Description</th>
            <th scope="col">Date</th>
            <th scope="col">Enseignant </th>
            <th scope="col">Salle</th>
            <th scope="col">Heure début</th>
            <th scope="col">Heure fin</th>
            <th scope="col">Groupe</th>
            <th scope="col">Choix</th>
          </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_array($result_creation, MYSQLI_NUM)): ?>
         <form action="" method="POST">
            <input type="hidden" name="id_row" value=<?="$row[0]";?>>
            <tr>
                <?php for($i=1; $i<$nb_champs2; $i++ ){
                    echo "<td>$row[$i]</td>";
                } ?>
                <td>
                  <input type="submit" name="accepter_bouton" class="btn btn-primary" value="accepter">
                  <input type="submit" name="refuser_bouton" class="btn btn-danger" value="refuser">
                </td>
            </tr>
          </form>
        <?php endwhile; ?>
        </tbody>
      </table>
      </div>
  </div>

 <?php /* free result set */
    mysqli_free_result($result_modification);

    /* close connection */
    mysqli_close($link); 
  ?>