<?php 

session_start();
$hostname = "sql7.freemysqlhosting.net:3306";
$username="sql7336475";
$password="ItBWtR3xM5";
$db="sql7336475";
$conn = new mysqli($hostname, $username, $password, $db) or die('Error connecting to database');


if(isset($_POST["edit_event_submit"])){
$req2 = $conn->prepare("INSERT INTO sql7336475.modification (identifiantCours, identifiantUtilisateur,type, statue,salleEvent, dateEventD, dateEventF) VALUES (?,?,2,0,?,?,?)");
$req2->bind_param('sssss',$_POST["id"],$_SESSION['login'],$_POST["event_location"],$_POST["event_dtstart"],$_POST["event_dtend"]);	
$req2->execute();}

if(isset($_POST["del"])){
$req2 = $conn->prepare("INSERT INTO sql7336475.modification (identifiantCours, identifiantUtilisateur,type, statue,salleEvent, dateEventD, dateEventF) VALUES (?,?,3,0,?,?,?)");
$req2->bind_param('sssss',$_POST["id"],$_SESSION['login'],$_POST["event_location"],$_POST["event_dtstart"],$_POST["event_dtend"]);	
$req2->execute();
}

header ('Location: edt_main.php');

?>