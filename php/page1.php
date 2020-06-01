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


// requete affichage modification évènement
$requete_modification_sql = "SELECT utilisateur.identifiant, events.SUMMARY, events.DTSTART, events.DTEND, events.LOCATION, events.description, modification.salleEvent, modification.dateEventD, modification.dateEventF FROM utilisateur, events,modification WHERE (modification.identifiantUtilisateur LIKE utilisateur.identifiant) and(events.id = modification.identifiantCours) and modification.type = 2
";
$result_modification = mysqli_query($link, $requete_modification_sql);
$nb_champs1 = mysqli_field_count($link);

//requete affichage création évènement
$requete_creation_sql = "SELECT utilisateur.identifiant, modification.nomEvent, modification.DESCRIPTION, modification.dateEvent, modification.enseignantEvent, modification.salleEvent, modification.heureDebut, modification.heureFin, modification.groupeEvent FROM utilisateur, modification WHERE (modification.identifiantUtilisateur LIKE utilisateur.identifiant) and modification.type = 1";
$result_creation = mysqli_query($link, $requete_creation_sql);
$nb_champs2 = mysqli_field_count($link);

?>


<head>
  <meta name=description content="Gestion de cours - ADMIN"> <!-- il voit une liste de demandes de modification et peu accepter ou nom la demande -->
</head>

<h1>Demandes de modifications d'évènement </h1>
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
              <?php for($i=0; $i<$nb_champs1; $i++ ){
                  if ($i==5){
                    $row[$i] = str_replace('\\n', ' ', $row[$i]);
                  }
                  echo "<td>$row[$i]</td>";
              } ?>
              <td>
                <button type="button" class="btn btn-primary">Accepter</button>
                <button type="button" class="btn btn-danger">Refuser</button>
              </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
      </div>
  </div>
</div>

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
            <th scope="col">Description</th>
            <th scope="col">Salle</th>
            <th scope="col">Heure début</th>
            <th scope="col">Heure fin</th>
            <th scope="col">Groupe</th>
            <th scope="col">Choix</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_array($result_modification, MYSQLI_NUM)): ?>
            <tr>
              <?php for($i=0; $i<$nb_champs2; $i++ ){
                  echo "<td>$row[$i]</td>";
              } ?>
              <td>
                <button type="button" class="btn btn-primary">Accepter</button>
                <button type="button" class="btn btn-danger">Refuser</button>
              </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
      </div>
  </div>

<?php
  /* free result set */
  mysqli_free_result($result_event);

  /* close connection */
  mysqli_close($link);
?>