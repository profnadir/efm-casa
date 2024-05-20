<?php 
require_once 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['matricule'])) {

    $matricule = $_GET['matricule'];

    // Récupérer les informations de la voiture à modifier
    $sql = "SELECT * FROM Voiture WHERE Matricule = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$matricule]);

    $voiture = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$voiture) {
        echo "Voiture non trouvée.";
        exit();
    }
} 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifier'])) {

    $matricule = $_POST['matricule'];
    $marque = $_POST['marque'];
    $annee = $_POST['annee'];
    $numClient = $_POST['numClient'];

    // Mettre à jour les informations de la voiture
    $sql = "UPDATE Voiture SET Marque = ?, Année = ?, NumClient = ? WHERE Matricule = ?";

    $stmt = $pdo->prepare($sql);
    if($stmt->execute([$marque, $annee, $numClient, $matricule])){
        header("Location: ListeVoiture.php?message=La%20voiture%20a%20été%20modifiée%20avec%20succès.");
        exit();
    }else{
        header("Location: ListeVoiture.php?message=Erreur%20lors%20de%20la%20modification%20de%20la%20voiture.");
        exit();
    }

}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Voiture</title>
</head>

<body>
    <h1>Modifier Voiture</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="matricule" value="<?php echo $voiture['Matricule']; ?>"><br>
        <label for="marque">Marque:</label>
        <input type="text" id="marque" name="marque" value="<?php echo $voiture['Marque']; ?>"><br>
        <label for="annee">Année:</label>
        <input type="text" id="annee" name="annee" value="<?php echo $voiture['Année']; ?>"><br>
        <label for="numClient">Numéro Client:</label>
        <input type="text" id="numClient" name="numClient" value="<?php echo $voiture['NumClient']; ?>"><br>
        <input type="submit" value="Modifier" name="modifier">
    </form>
</body>

</html>