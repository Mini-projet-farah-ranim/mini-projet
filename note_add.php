<?php

// Définir les variables et filtrer les données
$matiere = $_POST["matiere"];
$cin=$_POST['cin'];
$inscription = $_POST["inscription"];
$note = $_POST["note"];
// Assuming database connection is established (replace with your code)
$db = new PDO('mysql:host=localhost;dbname=gestion_cursus', 'root', '');
$sql = "INSERT INTO note (matiere,inscription,note) VALUES (:matiere, :inscription,:note)";
$stmt = $db->prepare($sql);

// Bind values using named parameters
$stmt->execute([
    ':matiere' => $matiere,
    ':note' => $note,
    ':inscription' => $inscription,  
]);


// Afficher un message de succès
if ($stmt->rowCount() > 0) {
  header('Location: note_ens.php?cin=' . $cin);    
} else {
  echo "Une erreur est survenue lors de l'ajout du cours'.";
}

?>
