<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $fullName = $_POST['fullName'];
    $email = $_POST['signupEmail'];
    $phone = $_POST['phoneNumber'];
    $password = $_POST['signupPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Vérifie que le mot de passe et sa confirmation correspondent
    if ($password === $confirmPassword) {
        // Hash du mot de passe avant de l'insérer dans la base de données
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Connexion à la base de données (à remplacer avec vos propres informations de connexion)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "utilsateurs njr design";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérifie la connexion
        if ($conn->connect_error) {
            die("Connexion échouée: " . $conn->connect_error);
        }

        // Requête SQL pour insérer les données de l'utilisateur dans la table
        $sql = "INSERT INTO users 1 (full_name, email, phone, password) VALUES ('$fullName', '$email', '$phone', '$hashedPassword')";

        // Exécute la requête
        if ($conn->query($sql) === TRUE) {
            echo "Inscription réussie.";
        } else {
            echo "Erreur d'inscription: " . $conn->error;
        }

        // Ferme la connexion à la base de données
        $conn->close();
    } else {
        echo "Les mots de passe ne correspondent pas.";
    }
}
?>
