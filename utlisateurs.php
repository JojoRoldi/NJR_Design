<?php
// Inclure le fichier de connexion à la base de données
require_once 'db_connection.php';

// Connexion à la base de données
$servername = "localhost";
$username = "root"; // Par défaut, XAMPP utilise "root" comme nom d'utilisateur MySQL
$password = ""; // Par défaut, XAMPP n'a pas de mot de passe pour l'utilisateur "root"
$dbname = "utilsateurs njr design"; // Remplacez "votre_base_de_donnees" par le nom de votre base de données

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
  die("La connexion a échoué : " . $conn->connect_error);
}

// Vérifier si le formulaire d'inscription a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Récupérer les données du formulaire
  $nom = $_POST['nom'];
  $email = $_POST['email'];
  $numero_telephone = $_POST['numero_telephone'];
  $mot_de_passe = $_POST['mot_de_passe'];

  // Hacher le mot de passe avant de le stocker
  $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

  // Préparer et exécuter la requête SQL pour insérer l'utilisateur dans la base de données
  $sql = "INSERT INTO utilisateurs (nom, email, numero_telephone, mot_de_passe) VALUES ('$nom', '$email', '$numero_telephone', '$hashed_password')";

  if ($conn->query($sql) === TRUE) {
    echo "Utilisateur enregistré avec succès.";
  } else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
  }
}

// Fermer la connexion
$conn->close();
?>
