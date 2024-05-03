<?php

// Définir les variables
$cin = $_POST['cin'];
$message = "";
// Vérifier si le CIN est vide
if (empty($cin)) {
    $message = "CIN est obligatoire";
    header('Location: home.php');

  }
  
// Connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=gestion_cursus', 'root', '');

// Requête pour récupérer l'utilisateur avec le CIN saisi
$sql = "SELECT * FROM user WHERE cin = :cin";
$stmt = $db->prepare($sql);
$stmt->execute(['cin' => $cin]);
// Vérifier si l'utilisateur existe
$user = $stmt->fetch();

if (!$user) {
  echo "Le CIN est incorrect.";
  exit();
}

// Déterminer le type d'utilisateur et rediriger vers la page appropriée
switch ($user['type']) {
  case 'etudiant':
          // Vérifier si l'étudiant existe déjà
          $sql = "SELECT * FROM groupe WHERE cin = :cin";
          $stmt = $db->prepare($sql);
          $stmt->execute(['cin' => $user['cin']]);
          $etudiant = $stmt->fetch();
      
          if (!$etudiant) {
            // Insérer l'étudiant
            $sql = "INSERT INTO groupe (cin,inscription, nom,prenom, filiere, group) VALUES (:cin,:inscription, :nom, :prenom,:filiere, :group)";
            $stmt = $db->prepare($sql);
            $stmt->execute(['cin' => $user['cin'],'inscription' => $user['inscription'], 'nom' => $user['nom'], 'prenom' => $user['prenom'], 'filiere' => $user['filiere'], 'group' => $user['group']]);
            header('Location: accueil_etudiant.php?cin=' . $cin. '&nom=' . $user['nom']);  
            } 
                        
            break;
  case 'enseignant':
    $sql = "SELECT * FROM enseignant WHERE cin = :cin";
          $stmt = $db->prepare($sql);
          $stmt->execute(['cin' => $user['cin']]);
          $enseignant = $stmt->fetch();
      
          if (!$enseignant) {
            // Insérer l'enseignant
            $sql = "INSERT INTO enseignant (cin, nom, titre_ens) VALUES (:cin, :nom, :titre_ens)";
            $stmt = $db->prepare($sql);
            $stmt->execute(['cin' => $user['cin'], 'nom' => $user['nom'], 'titre_ens' => $user['titre_ens']]);
            header('Location: accueil_enseignant.php?cin=' . $cin. '&nom=' . $user['nom']);  
            } else {
              // Afficher un message d'erreur
              header('Location: password_ens.php?cin=' . $cin);    
            }  
    break;
  case 'chef':
    header('Location: accueil_chef.php?cin=' . $cin);
    break;
  case 'admin':
    header('Location: accueil_admin.php?cin=' . $cin);
    break;
  default:
    echo "Le type d'utilisateur est inconnu.";
    exit();
}

?>
