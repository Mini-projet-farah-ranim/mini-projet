<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields
    $errors = array();

    // Validate Nom
    $nom = $_POST['nom'] ?? '';
    if (empty($nom)) {
        $errors[] = "Le nom est requis.";
    }

    // Validate Titre
    $titre = $_POST['titre'] ?? '';
    if (empty($titre)) {
        $errors[] = "Le titre est requis.";
    }

    // Validate Departement
    $departement = $_POST['departement'] ?? '';
    if (empty($departement)) {
        $errors[] = "Le département est requis.";
    }

    // If there are no validation errors, proceed to insert into database
    if (empty($errors)) {
        // Assuming you have a PDO database connection established
        try {
            $db = new PDO('mysql:host=localhost;dbname=gestion_cursus', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare SQL statement
            $sql = "INSERT INTO chef (nom, email, password, titre, departement) VALUES (:nom, :email, :password, :titre, :departement)";
            $stmt = $db->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':departement', $departement);

            // Execute the query
            $stmt->execute();

            // Redirect after successful insertion
            echo "<script>
        alert('Ajouté avec succés');
        window.location.href='chefs.html';
        </script>";
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        // If there are validation errors, display them
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>
