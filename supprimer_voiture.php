<?php
require_once 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $matricule = $_GET['matricule'];

    // Supprimer la voiture
    $sql = "DELETE FROM Voiture WHERE Matricule = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$matricule]);

    header("Location: ListeVoiture.php");

} else {
    echo "Erreur : Paramètres invalides.";
}
?>
