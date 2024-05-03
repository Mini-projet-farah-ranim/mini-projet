<?php
$cin = $_GET['cin'];

// Connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=gestion_cursus', 'root', '');

// Requête pour récupérer l'utilisateur avec le CIN
$sql = "SELECT * FROM chef WHERE cin = :cin";
$stmt = $db->prepare($sql);
$stmt->execute(['cin' => $cin]);

// Vérifier si l'utilisateur existe
$user = $stmt->fetch();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare an SQL statement to insert data into the programme table
    $sql = "INSERT INTO programme (filiere, cours, enseignant, date_ajout) VALUES (:filiere, :cours, :enseignant, :date_insertion)";

    // Get the current date
    $currentDate = date('Y-m-d H:i:s');

    // Prepare and execute the SQL statement
    $stmt = $db->prepare($sql);
    $stmt->execute([
        'filiere' => $_POST['filiere'],
        'cours' => $_POST['cours'],
        'enseignant' => $_POST['enseignant'],
        'date_insertion' => $currentDate
    ]);

   // Display success message
   echo "<script>alert('Affectation enseignant avec succès');</script>";

   // Redirect to gestionEnseignant.php with parameters
   echo "<script>setTimeout(function() { window.location.href = 'gestionEnseignant.php?cin=$cin&nom={$user['nom']}'; }, 1000);</script>";

    exit();
}
?>
