<?php 

// connexion database
require_once 'connexion.php';

// sql create tables
try {
    // Script de création des tables
    $sql = "
    CREATE TABLE Client (
        NumClient INT AUTO_INCREMENT PRIMARY KEY,
        RaisonSociale VARCHAR(255),
        Adresse VARCHAR(255)
    );

    CREATE TABLE Voiture (
        Matricule VARCHAR(50) PRIMARY KEY,
        Marque VARCHAR(50),
        Année INT,
        NumClient INT,
        FOREIGN KEY (NumClient) REFERENCES Client(NumClient)
    );

    CREATE TABLE Réparation (
        NumRep INT AUTO_INCREMENT PRIMARY KEY,
        Matricule VARCHAR(50),
        Description TEXT,
        DateRep DATE,
        coût DECIMAL(10, 2),
        FOREIGN KEY (Matricule) REFERENCES Voiture(Matricule)
    );
    ";
    
    // Exécution du script SQL
    $pdo->exec($sql);
    
    echo "Les tables ont été créées avec succès.";

} catch (PDOException $e) {

    echo 'Erreur : ' . $e->getMessage();
    
}