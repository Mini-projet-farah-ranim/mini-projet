<?php

// Définir les variables et filtrer les données
$id = $_GET["id"];
$cin = $_GET["cin"]; // Assuming the ID is received from a form or URL parameter
// Assuming database connection is established (replace with your code)
$db = new PDO('mysql:host=localhost;dbname=gestion_cursus', 'root', '');

// Prepare the DELETE query with the ID as a parameter
$sql = "DELETE FROM cours WHERE id = :id";
$stmt = $db->prepare($sql);

// Bind the ID value to the prepared statement
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

// Execute the query
$stmt->execute();

// Check if the deletion was successful
if ($stmt->rowCount() > 0) {
  // Successful deletion
  header('Location: cours_add.php?cin=' . $cin); // Redirect to a list page with a success message
} else {
  // Error during deletion
  echo "Une erreur est survenue lors de la suppression du cours.";
}

?>
