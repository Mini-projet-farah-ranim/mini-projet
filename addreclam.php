<?php

// Définir les variables et filtrer les données
$cin=$_POST['cin'];
$nom=$_POST['nom'];
$objet = $_POST["objet"];
$contenu = $_POST["contenu"];

// Assuming database connection is established (replace with your code)
$db = new PDO('mysql:host=localhost;dbname=gestion_cursus', 'root', '');
$sql = "INSERT INTO reclamation (cin,nom,objet, contenu,date_publication) VALUES (:cin,:nom,:objet, :contenu,:date_publication)";
$currentDate = date('Y-m-d H:i:s');
$stmt = $db->prepare($sql);

// Bind values using named parameters
$stmt->execute([
    ':cin' => $cin,
    ':nom' => $nom,
    ':objet' => $objet,
    ':contenu' => $contenu,
    ':date_publication' => $currentDate,
   
]);


// Afficher un message de succès
if ($stmt->rowCount() > 0) {
  header('Location: success.php?cin=' . $cin);    
} else {
  echo "Une erreur est survenue lors de l'envoie du réclamation'.";
}

?>
