<?php

// Définir les variables
$cin = $_GET['cin'];
$password = $_POST['password'];

// Connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=gestion_cursus', 'root', '');

// Requête pour récupérer l'utilisateur avec le CIN et le mot de passe haché
$sql = "SELECT * FROM etudiant WHERE cin = :cin AND password = :password";
$stmt = $db->prepare($sql);
$stmt->execute(['cin' => $cin, 'password' => $password]);

// Vérifier si l'utilisateur existe
$user = $stmt->fetch();

if (!$user) {
  echo "Identifiants incorrects.";
  exit();
}
else{
header('Location: etudiant.php?cin=' . $cin. '&nom=' . $user['nom']); 
}
?>
