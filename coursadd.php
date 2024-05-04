<?php

// Définir les variables et filtrer les données
$matiere = $_POST["matiere"];
$cin=$_POST['cin'];
// Assuming database connection is established (replace with your code)
$db = new PDO('mysql:host=localhost;dbname=gestion_cursus', 'root', '');
$sql = "INSERT INTO cours (matiere,date) VALUES (:matiere, :date)";
$currentDate = date('Y-m-d H:i:s');
$stmt = $db->prepare($sql);

// Bind values using named parameters
$stmt->execute([
    ':matiere' => $matiere,
    ':date' => $currentDate,  
]);


// Afficher un message de succès
if ($stmt->rowCount() > 0) {
  header('Location: cours_add.php?cin=' . $cin);    
} else {
  echo "Une erreur est survenue lors de l'ajout du cours'.";
}

?>
