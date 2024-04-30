<?php

// Définir les variables et filtrer les données
$title = $_POST["title"];
$description = $_POST["description"];

// Assuming database connection is established (replace with your code)
$db = new PDO('mysql:host=localhost;dbname=gestion_cursus', 'root', '');
$sql = "INSERT INTO news (title, description,date_publication) VALUES (:title, :description,:date_publication)";
if (isset($nomUnique)) {
  $sql .= ", photo = :photo";
}
$currentDate = date('Y-m-d H:i:s');
$stmt = $db->prepare($sql);

// Bind values using named parameters
$stmt->execute([
    ':title' => $title,
    ':description' => $description,
    ':date_publication' => $currentDate,
   
]);


// Afficher un message de succès
if ($stmt->rowCount() > 0) {
  header('Location: news_admin.php?cin=' . $cin);    
} else {
  echo "Une erreur est survenue lors de la modification de votre profil.";
}

?>
