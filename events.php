<?php
// List of events
 $json = array();

 // Query that retrieves events
 $requete = "SELECT id, titulo AS title, fecha as start FROM ordenes where ban_evento=1 and tipo='E'";

 // connection to the database
 try {
 $bdd = new PDO('mysql:host=localhost;dbname=cuac', 'root', '0ehn4TNU5I');
 } catch(Exception $e) {
  exit('Unable to connect to database.');
 }
 // Execute the query
 $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

 // sending the encoded result to success page
 echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));

?>