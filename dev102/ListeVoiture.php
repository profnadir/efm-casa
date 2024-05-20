<?php 

// connexion la DB
require_once 'connexion.php';

// Ajouter une nouvelle voiture
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // get inputs values    
    $matricule = $_POST['matricule'];
    $marque = $_POST['marque'];
    $annee = $_POST['annee'];
    $numClient = $_POST['numClient'];

    //warniiiing
    //$sql = "insert into voiture (matricule, marque, annee, numclient) values ('".$matricule."','".$marque."', $annee,$numClient)";

    // create sql insert new car
    $sql = "INSERT INTO Voiture (Matricule, Marque, Année, NumClient) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql); 
    // excec
    $stmt->execute([$matricule, $marque, $annee, $numClient]); 
}


// Récupérer la liste des voitures
$sql = "SELECT * FROM Voiture";
$stmt = $pdo->query($sql);
$voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <p>
        <?php 
            echo isset($_GET['message']) ? $_GET['message'] : '';
        ?>
    </p>
    <table border="1">
        <tr>
            <th>Matricule</th>
            <th>Marque</th>
            <th>Année</th>
            <th>Numéro Client</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($voitures as $voiture) : ?>
            <tr>
                <td><?php echo $voiture['Matricule']; ?></td>
                <td><?php echo $voiture['Marque']; ?></td>
                <td><?php echo $voiture['Année']; ?></td>
                <td><?php echo $voiture['NumClient']; ?></td>
                <td>
                    <a href="supprimer-voiture.php?matricule=<?php echo $voiture['Matricule']; ?>" onclick="return confirm('Are you sure ?')">Supprimer</a>
                    <a href="modifier-voiture.php?matricule=<?php echo $voiture['Matricule']; ?>" >modifier</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>