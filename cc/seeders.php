<?php
require_once 'connexion.php';

try {

    // Ajouter trois clients
    $clients = [
        ['RaisonSociale' => 'Client A', 'Adresse' => 'Adresse du Client A'],
        ['RaisonSociale' => 'Client B', 'Adresse' => 'Adresse du Client B'],
        ['RaisonSociale' => 'Client C', 'Adresse' => 'Adresse du Client C']
    ];
    
    foreach ($clients as $client) {
        $sql = "INSERT INTO Client (RaisonSociale, Adresse) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$client['RaisonSociale'], $client['Adresse']]);
    }
    
    echo "Les clients ont été ajoutés avec succès.";
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>
