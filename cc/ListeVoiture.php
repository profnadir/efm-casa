<?php
session_start();
require_once 'connexion.php';

/* // Supprimer une voiture
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $matricule = $_POST['matricule'];

    $sql = "DELETE FROM Voiture WHERE Matricule = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$matricule]);
} */

// Ajouter une nouvelle voiture
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajouter'])) {
    $matricule = $_POST['matricule'];
    $marque = $_POST['marque'];
    $annee = $_POST['annee'];
    $numClient = $_POST['numClient'];

    $sql = "INSERT INTO Voiture (Matricule, Marque, Année, NumClient) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$matricule, $marque, $annee, $numClient]);

    $_SESSION['message'] = "La voiture a été ajoutée avec succès.";

    header("Location: ListeVoiture.php");
    exit();
}





// Récupérer la liste des voitures
$sql = "SELECT * FROM Voiture";
$stmt = $pdo->query($sql);
$voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);







// Afficher le message s'il est défini
//$message = isset($_GET['message']) ? $_GET['message'] : null;
$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;
unset($_SESSION['message']);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Voitures</title>
</head>
<body>
    <h1>Liste des Voitures</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="matricule">Matricule:</label>
        <input type="text" id="matricule" name="matricule"><br>
        <label for="marque">Marque:</label>
        <input type="text" id="marque" name="marque"><br>
        <label for="annee">Année:</label>
        <input type="text" id="annee" name="annee"><br>
        <label for="numClient">Numéro Client:</label>
        <input type="text" id="numClient" name="numClient"><br>
        <input type="submit" value="Ajouter" name="ajouter">
    </form>
    <br>
    <?php if ($message) : ?>
    <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <table border="1">
        <tr>
            <th>Matricule</th>
            <th>Marque</th>
            <th>Année</th>
            <th>Numéro Client</th>
        </tr>
        <?php foreach ($voitures as $voiture) : ?>
            <tr>
                <td><?php echo $voiture['Matricule']; ?></td>
                <td><?php echo $voiture['Marque']; ?></td>
                <td><?php echo $voiture['Année']; ?></td>
                <td><?php echo $voiture['NumClient']; ?></td>
                <td>
                    <!-- <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="hidden" name="matricule" value="<?php echo $voiture['Matricule']; ?>">
                        <input type="submit" name="delete" value="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette voiture?')">
                    </form> -->

                    <a href="supprimer_voiture.php?matricule=<?php echo $voiture['Matricule']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette voiture?')">Supprimer</a>
                    <a href="modifier_voiture.php?matricule=<?php echo $voiture['Matricule']; ?>">Modifier</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
