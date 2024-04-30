<?php

// Définir les variables et filtrer les données
$filiere = $_POST["filiere"];
$jour = $_POST["jour"];
$debut = $_POST["debut"];
$fin = $_POST["fin"];
$matiere = $_POST["matiere"];
$enseignant = $_POST["enseignant"];
$type = $_POST["type"];
$salle = $_POST["salle"];
$regime = $_POST["regime"];

// Assuming database connection is established (replace with your code)
$db = new PDO('mysql:host=localhost;dbname=gestion_cursus', 'root', '');
$sql = "INSERT INTO emploi (filiere,jour,debut,fin,matiere,enseignant,type,salle,regime,date) VALUES (:filiere,:jour, :debut,:fin,:matiere,:enseignant,:type,:salle,:regime,:date)";
$currentDate = date('Y-m-d H:i:s');
$stmt = $db->prepare($sql);

// Bind values using named parameters
$stmt->execute([
   ':filiere' => $filiere,
   ':jour' => $jour,
   ':debut' => $debut,
   ':fin' => $fin,
   ':matiere' => $matiere,
   ':enseignant' => $enseignant,
   ':type' => $type,
   ':salle' => $salle,
   ':regime' => $regime,
   ':date' => $currentDate,
  ]);
  


// Afficher un message de succès
if ($stmt->rowCount() > 0) {
  header('Location: emplois_admin.php?cin=' . $cin);    
} else {
  echo "Une erreur est survenue lors de la modification de votre profil.";
}

?>
