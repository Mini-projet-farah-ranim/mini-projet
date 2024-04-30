<?php

// Définir les variables et filtrer les données
$cin = $_POST['cin'];
$nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
$prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING);

// Assuming database connection is established (replace with your code)
$db = new PDO('mysql:host=localhost;dbname=gestion_cursus', 'root', '');

// ------------------- Traitement de la photo de profil -------------------

// Vérifier si le fichier a été téléchargé
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
  // Définir les variables
  $photo = $_FILES['photo'];
  $nomFichier = $photo['name'];
  $typeFichier = $photo['type'];
  $tailleFichier = $photo['size'];
  $tmpFichier = $photo['tmp_name'];

  // Définir les extensions autorisées
  $extensionsAutorisees = ['image/jpeg', 'image/png', 'image/gif'];

  // Vérifier l'extension du fichier
  if (!in_array($typeFichier, $extensionsAutorisees)) {
    echo "L'extension du fichier n'est pas autorisée.";
    exit;
  }

  // Vérifier la taille du fichier
  if ($tailleFichier > 2097152) {
    echo "La taille du fichier est trop grande (max 2 Mo).";
    exit;
  }

  // Définir le nom unique du fichier
  $nomUnique = uniqid() . '.' . pathinfo($nomFichier, PATHINFO_EXTENSION);

  // Déplacer le fichier temporaire vers le dossier de destination
  $destination = 'uploads/' . $nomUnique;
  if (!move_uploaded_file($tmpFichier, $destination)) {
    echo "Une erreur est survenue lors du téléchargement de la photo.";
    exit;
  }
} else {
  // Pas de photo téléchargée, garder l'ancienne photo (optionnel)
  // $nomUnique = ''; // Ou récupérer la photo existante de la base de données
}

// ------------------- Fin du traitement de la photo -------------------

// Préparer la requête SQL (inclure le champ photo si une photo a été téléchargée)
$sql = "UPDATE etudiant SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone";
if (isset($nomUnique)) {
  $sql .= ", photo = :photo";
}
$sql .= " WHERE cin = :cin";
$stmt = $db->prepare($sql);

// Lier les valeurs avec les données filtrées et le nom unique de la photo (si applicable)
$stmt->execute([
  ':cin' => $cin,
  ':nom' => $nom,
  ':prenom' => $prenom,
  ':email' => $email,
  ':telephone' => $telephone,
  // Lier la photo uniquement si elle existe
  ...(isset($nomUnique) ? [':photo' => $nomUnique] : []),
]);

// Afficher un message de succès
if ($stmt->rowCount() > 0) {
  echo "Profil modifié avec succès !";
  // Optional: Redirect to confirmation page with cin parameter
  header('Location: profilset.php?cin=' . $cin);
} else {
  echo "Une erreur est survenue lors de la modification de votre profil.";
}

?>
