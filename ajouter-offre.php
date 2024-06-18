<?php
header('Content-Type: application/json');
$response = array('success' => false);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $quantite_recherche = $_POST['quantite_recherche'];

    $con = mysqli_connect('localhost', 'root', '', 'medfinder');
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert into medicament table
    $sql_medicament = "INSERT INTO medicament (nom, prix) VALUES ('$nom', '$prix')";
    if (mysqli_query($con, $sql_medicament)) {
        $id_medicament = mysqli_insert_id($con);

        // Insert into recherche table with 'satisfait' set to 0
        $sql_recherche = "INSERT INTO recherche (id_medicament, quantite_recherche, satisfait) VALUES ('$id_medicament', '$quantite_recherche', 0)";
        if (mysqli_query($con, $sql_recherche)) {
            $response['success'] = true;
        }
    }

    mysqli_close($con);
}

echo json_encode($response);
?>
