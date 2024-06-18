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
$id = intval($_POST['id']);
$nom = mysqli_real_escape_string($con, $_POST['nom']);
$prix = floatval($_POST['prix']);
$quantite_reservee = intval($_POST['quantite_reservee']);

mysqli_begin_transaction($con);

try {
    // Mettre à jour la table medicament
    $sql_medicament = "UPDATE medicament SET nom = '$nom', prix = '$prix' WHERE id_medicament = (
        SELECT id_medicament FROM reservation WHERE id_reservation = '$id'
    )";
    if (mysqli_query($con, $sql_medicament)) {

        // Mettre à jour la table reservation
        $sql_reservation = "UPDATE reservation SET quantite_reservation = '$quantite_reservee' WHERE id_reservation = '$id'";
        if (mysqli_query($con, $sql_reservation)) {
            mysqli_commit($con);
            echo json_encode(['success' => true]);
        } else {
            mysqli_rollback($con);
            error_log("Error in reservation update: " . mysqli_error($con));
            echo json_encode(['success' => false, 'message' => 'Error updating reservation']);
        }
    } else {
        mysqli_rollback($con);
        error_log("Error in medicament update: " . mysqli_error($con));
        echo json_encode(['success' => false, 'message' => 'Error updating medicament']);
    }
} catch (Exception $e) {
    mysqli_rollback($con);
    error_log("Exception: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Transaction failed']);
}

mysqli_close($con);
?>
