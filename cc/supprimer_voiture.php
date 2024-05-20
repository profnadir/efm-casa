<?php
require_once 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['matricule'])) {
    $matricule = $_GET['matricule'];

    // Supprimer la voiture
    $sql = "DELETE FROM Voiture WHERE Matricule = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$matricule]);

    // Rediriger vers la liste des voitures
    header("Location: ListeVoiture.php?message=La%20voiture%20a%20été%20suprimée%20avec%20succès.");
    exit();
} else {
    echo "Erreur : Paramètres invalides.";
}
?>
