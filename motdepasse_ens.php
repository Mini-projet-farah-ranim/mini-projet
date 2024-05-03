<?php

// Define variables
$cin = $_GET['cin'];
$email = $_POST['email'];
$password = $_POST['password'];

// Check if the file has been uploaded
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
  // Define variables
  $photo = $_FILES['photo'];
  $fileName = $photo['name'];
  $fileType = $photo['type'];
  $fileSize = $photo['size'];
  $tmpFile = $photo['tmp_name'];

  // Define allowed extensions
  $allowedExtensions = ['image/jpeg', 'image/png', 'image/gif'];

  // Check file extension
  if (!in_array($fileType, $allowedExtensions)) {
    echo "The file extension is not allowed.";
    exit;
  }

  // Check file size
  if ($fileSize > 2097152) {
    echo "The file size is too large (max 2 MB).";
    exit;
  }

  // Generate unique file name
  $uniqueName = uniqid() . '.' . pathinfo($fileName, PATHINFO_EXTENSION);

  // Move temporary file to destination folder
  $destination = 'uploads/' . $uniqueName;
  if (!move_uploaded_file($tmpFile, $destination)) {
    echo "An error occurred while uploading the photo.";
    exit;
  }
} else {
  // No photo uploaded, keep old photo (optional)
  // $uniqueName = ''; // Or retrieve existing photo from database
}

// Check if password is empty
if (empty($password)) {
  echo "Password is required.";
  exit();
}

// Connect to the database
try {
  $db = new PDO('mysql:host=localhost;dbname=gestion_cursus', 'root', '');
} catch (PDOException $e) {
  echo "An error occurred while connecting to the database.";
  exit();
}

// Check if the user exists
$sql = "SELECT * FROM enseignant WHERE cin = :cin";
$stmt = $db->prepare($sql);
$stmt->execute(['cin' => $cin]);
$enseignant = $stmt->fetch();

if ($enseignant) {
  // Update the user
  $sql = "UPDATE enseignant SET email = :email, password = :password";
  if (isset($uniqueName)) {
    $sql .= ", photo = :photo";
  }
  $sql .= " WHERE cin = :cin";
  $stmt = $db->prepare($sql);

  // Bind values with sanitized data and unique photo name (if applicable)
  $stmt->execute([
    ':cin' => $cin,
    ':email' => $email,
    ':password' => password_hash($password, PASSWORD_DEFAULT), // Hash the password
    // Bind photo only if it exists
    ...(!empty($uniqueName) ? [':photo' => $uniqueName] : []),
  ]);

  // Display success message
  if ($stmt->rowCount() > 0) {
    echo "Profile updated successfully!";
    // Optional: Redirect to confirmation page with cin parameter
    header('Location: enseignant.php?cin=' . $cin. '&nom=' . $enseignant['nom']);
  } else {
    echo "An error occurred while updating your profile.";
  }

} else {
  // Display error message
  echo "User does not exist.";
}

?>
