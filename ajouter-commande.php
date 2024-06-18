<?php
header('Content-Type: application/json');

// Connexion à la base de données
$con = mysqli_connect('localhost', 'root', '', 'medfinder');

if (!$con) {
    error_log("Connection failed: " . mysqli_connect_error());
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

// Récupération des données du formulaire
$nom = mysqli_real_escape_string($con, $_POST['nom']);
$prix = floatval($_POST['prix']);
$quantite_reservee = intval($_POST['quantite_reservee']);

mysqli_begin_transaction($con);

try {
    // Insérer dans la table medicament
    $sql_medicament = "INSERT INTO medicament (nom, prix) VALUES ('$nom', '$prix')";
    if (mysqli_query($con, $sql_medicament)) {
        $id_medicament = mysqli_insert_id($con);

        // Insérer dans la table reservation
        $sql_reservation = "INSERT INTO reservation (id_medicament, quantite_reservation) VALUES ('$id_medicament', '$quantite_reservee')";
        if (mysqli_query($con, $sql_reservation)) {
            mysqli_commit($con);
            echo json_encode(['success' => true]);
        } else {
            mysqli_rollback($con);
            error_log("Error in reservation insert: " . mysqli_error($con));
            echo json_encode(['success' => false, 'message' => 'Error inserting reservation']);
        }
    } else {
        mysqli_rollback($con);
        error_log("Error in medicament insert: " . mysqli_error($con));
        echo json_encode(['success' => false, 'message' => 'Error inserting medicament']);
    }
} catch (Exception $e) {
    mysqli_rollback($con);
    error_log("Exception: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Transaction failed']);
}

mysqli_close($con);
?>
