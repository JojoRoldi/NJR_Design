<?php
// Inclure le fichier de connexion � la base de donn�es
require_once 'db_connection.php';

// Connexion � la base de donn�es
$servername = "localhost";
$username = "root"; // Par d�faut, XAMPP utilise "root" comme nom d'utilisateur MySQL
$password = ""; // Par d�faut, XAMPP n'a pas de mot de passe pour l'utilisateur "root"
$dbname = "utilsateurs njr design"; // Remplacez "votre_base_de_donnees" par le nom de votre base de donn�es

// Cr�ation de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// V�rifier la connexion
if ($conn->connect_error) {
  die("La connexion a �chou� : " . $conn->connect_error);
}

// V�rifier si le formulaire d'inscription a �t� soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // R�cup�rer les donn�es du formulaire
  $nom = $_POST['nom'];
  $email = $_POST['email'];
  $numero_telephone = $_POST['numero_telephone'];
  $mot_de_passe = $_POST['mot_de_passe'];

  // Hacher le mot de passe avant de le stocker
  $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);

  // Pr�parer et ex�cuter la requ�te SQL pour ins�rer l'utilisateur dans la base de donn�es
  $sql = "INSERT INTO utilisateurs (nom, email, numero_telephone, mot_de_passe) VALUES ('$nom', '$email', '$numero_telephone', '$hashed_password')";

  if ($conn->query($sql) === TRUE) {
    echo "Utilisateur enregistr� avec succ�s.";
  } else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
  }
}

// Fermer la connexion
$conn->close();
?>
