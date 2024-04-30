
<?php

// Définir les variables
$cin = $_GET['cin'];
$email = $_POST['email'];
$password = $_POST['password'];
$telephone = $_POST['telephone'];

// Vérifier si le mot de passe est vide
if (empty($password)) {
  echo "Le mot de passe est obligatoire.";
  exit();
}

// Connexion à la base de données
try {
  $db = new PDO('mysql:host=localhost;dbname=gestion_cursus', 'root', '');
} catch (PDOException $e) {
  echo "Une erreur est survenue lors de la connexion à la base de données.";
  exit();
}

// Vérifier si l'utilisateur existe déjà
$sql = "SELECT * FROM etudiant WHERE cin = :cin";
$stmt = $db->prepare($sql);
$stmt->execute(['cin' => $cin]);
$etudiant = $stmt->fetch();

if ($etudiant) {
  // Mettre à jour l'utilisateur
  $sql = "UPDATE etudiant SET email = :email, password = :password, telephone = :telephone  WHERE cin = :cin";
  $stmt = $db->prepare($sql);
  $stmt->execute(['email' => $email, 'password' => $password,'telephone' => $telephone, 'cin' => $cin]);

  if ($stmt->rowCount() === 1) {
    // Démarrer la session
    session_start();

    // Stocker les informations de l'utilisateur dans la session
    $_SESSION['etudiant'] = $etudiant;

    // Redirection vers la page d'accueil
    header('Location: etudiant.php?cin=' . $cin. '&nom=' . $user['nom']);
  } else {
    // Afficher un message d'erreur
    echo "Une erreur est survenue lors de la mise à jour de l'utilisateur.";
  }
} else {
  // Afficher un message d'erreur
  echo "L'utilisateur n'existe pas.";
}

?>