<?php 
// Connexion à la base de données
$con = mysqli_connect('localhost', 'root', '', 'medfinder');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Traitement de la réservation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reserver'])) {
    $id_medicament = $_POST['id_medicament'];
    $quantite_reservation = $_POST['quantite_reservation'];

    $sql = "SELECT quantite_disponible FROM proposer WHERE id_medicament = $id_medicament";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $quantite_actuelle = $row['quantite_disponible'];
        $nouvelle_quantite = $quantite_actuelle - $quantite_reservation;

        if ($nouvelle_quantite >= 0) {
            $update_sql = "UPDATE proposer SET quantite_disponible = $nouvelle_quantite WHERE id_medicament = $id_medicament";
            if (mysqli_query($con, $update_sql)) {
                $sql_reservation = "INSERT INTO reservation (id_medicament, quantite_reservation, date_reservation) VALUES ('$id_medicament', '$quantite_reservation', NOW())";
                $result_reservation = mysqli_query($con, $sql_reservation);

                if ($result_reservation) {
                    echo '<script>alert("Reservation successful");</script>';
                    echo '<script>window.location.href="medicine-offers.php";</script>';
                } else {
                    echo '<script>alert("Error occurred during reservation");</script>';
                }
            } else {
                echo '<script>alert("Error occurred during updating quantity");</script>';
            }
        } else {
            echo '<script>alert("Insufficient quantity available");</script>';
        }
    }
}

// Requête de sélection des médicaments proposés
$sql = "SELECT proposer.id_medicament, proposer.quantite_disponible, medicament.prix, medicament.nom
        FROM medicament
        INNER JOIN proposer ON medicament.id_medicament = proposer.id_medicament";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search']) && !empty($_POST['search'])) {
    $search = $_POST['search'];
    $sql .= " WHERE medicament.nom LIKE '%$search%'";
}

$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page des médicaments proposés</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="path/to/your/css/file.css">
</head>
<body>
<header class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><img src="./assets/medlogo.png" alt="Logo" height="60"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto"></ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="medicine-offers.php">Medicals offers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="medicine-requests.php">Medicals requests</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About Us</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#"><img src="./assets/user.png" alt="User" height="30"></a>
            </li>
        </ul>
    </div>
</header>

<div class="container mt-3">
    <form action="medicine-offers.php" method="POST" id="search-form">
        <div class="row">
            <div class="col-md-8">
                <input type="search" class="form-control" id="searchbar" name="search" placeholder="Chercher un médicament">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary float-end" id="search-button">Rechercher</button>
            </div>
        </div>
    </form>
</div>

<div class="container my-5">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité disponible</th>
                <th>Réservation</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                        <td>' . $row['nom'] . '</td>
                        <td>' . $row['prix'] . '</td>
                        <td>' . $row['quantite_disponible'] . '</td>
                        <td>
                            <form method="POST" action="medicine-offers.php">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="id_medicament" value="' . $row['id_medicament'] . '">
                                        <input type="number" class="form-control" step="1" name="quantite_reservation" min="0" max="' . $row['quantite_disponible'] . '">
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary float-end" name ="reserver">Reserver</button>
                                    </div>
                                </div>
                            </form>
                        </td>
                      </tr>';
            }
        } else {
            echo '<tr><td colspan="4" class="text-danger">Data not found</td></tr>';
        }
        mysqli_close($con);
        ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>