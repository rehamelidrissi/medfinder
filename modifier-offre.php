<?php
session_start();
// Connexion à la base de données
$con = mysqli_connect('localhost', 'root', '', 'medfinder');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Traitement de la réservation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reserver'])) {
    if (!isset($_SESSION['id_patient'])) {
        header("Location: login.php"); // Rediriger vers la page de connexion si non authentifié
        exit();
    }

    $id_medicament = $_POST['id_medicament'];
    $quantite_reservation = $_POST['quantite_reservation'];
    $id_patient = $_SESSION['id_patient']; // Utilisez l'id_patient de la session

    // Validation de la quantité de réservation
    if ($quantite_reservation <= 0) {
        echo '<script>alert("Quantité invalide.");</script>';
    } else {
        $sql = "SELECT quantite_disponible FROM proposer WHERE id_medicament = $id_medicament";
        $result = mysqli_query($con, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $quantite_actuelle = $row['quantite_disponible'];
            $nouvelle_quantite = intval($quantite_actuelle) - intval($quantite_reservation);

            if ($nouvelle_quantite >= 0) {
                $update_sql = "UPDATE proposer SET quantite_disponible = $nouvelle_quantite WHERE id_medicament = $id_medicament";
                if (mysqli_query($con, $update_sql)) {
                    $sql_reservation = "INSERT INTO reservation (id_patient, id_medicament, quantite_reservation, date_reservation) 
                                        VALUES ('$id_patient', '$id_medicament', '$quantite_reservation', NOW())";
                    $result_reservation = mysqli_query($con, $sql_reservation);

                    if ($result_reservation) {
                        $_SESSION['reservation_success'] = true;
                        echo '<script>window.location.href="medicine-offers.php";</script>';
                        exit();
                    } else {
                        echo '<script>alert("Erreur lors de la réservation : ' . mysqli_error($con) . '");</script>';
                    }
                } else {
                    echo '<script>alert("Erreur lors de la mise à jour de la quantité : ' . mysqli_error($con) . '");</script>';
                }
            } else {
                echo '<script>alert("Quantité insuffisante disponible.");</script>';
            }
        } else {
            echo '<script>alert("Médicament non trouvé.");</script>';
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
                <a class="nav-link" href="medicine-requests.php">Medecine Requests</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="medicine-offers.php">Medicals offers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About Us</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
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

<div class="container my-3">
    <?php
    if (isset($_SESSION['reservation_success'])) {
        echo '<div class="alert alert-success">Réservation réussie</div>';
        unset($_SESSION['reservation_success']); // Clear the success message
    }
    ?>
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
                        <td>';
                if (isset($_SESSION['id_patient'])) {
                    echo '<form method="POST" action="medicine-offers.php">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="id_medicament" value="' . $row['id_medicament'] . '">
                                    <input type="number" class="form-control" step="1" name="quantite_reservation" min="1" max="' . $row['quantite_disponible'] . '">
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary float-end" name="reserver">Réserver</button>
                                </div>
                            </div>
                          </form>';
                } else {
                    echo '<a href="login.php" class="btn btn-secondary">Se connecter pour réserver</a>';
                }
                echo '</td>
                      </tr>';
            }
        } else {
            echo '<tr><td colspan="4" class="text-danger">Aucun médicament trouvé</td></tr>';
        }
        mysqli_close($con);
        ?>
          <?php
$conn = mysqli_connect('localhost', 'root', '', 'medfinder');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['demande_medicament'])) {
    $id_patient = $_SESSION['id_patient'];
    $nom_medicament = $_POST['nom_medicament'];
    $quantite_demande = $_POST['quantite_demande'];

    // Insérer la demande dans la table des demandes
    $sql_demande = "INSERT INTO demandes (id_patient, nom_medicament, quantite_demande, date_demande) 
                    VALUES ('$id_patient', '$nom_medicament', '$quantite_demande', NOW())";
    if (mysqli_query($conn, $sql_demande)) {
        // Vérifier si une pharmacie propose déjà ce médicament
        $sql_check = "SELECT * FROM proposer 
                      INNER JOIN medicament ON proposer.id_medicament = medicament.id_medicament
                      WHERE medicament.nom = '$nom_medicament' AND proposer.quantite_disponible > 0";
        $result_check = mysqli_query($conn, $sql_check);

        if ($result_check && mysqli_num_rows($result_check) > 0) {
            $message = "Le médicament $nom_medicament que vous avez demandé est maintenant disponible. Veuillez visiter notre site pour le réserver.";
            $sql_notification = "INSERT INTO notifications (id_patient, message) VALUES ('$id_patient', '$message')";
            mysqli_query($conn, $sql_notification);
        }
    } else {
        echo "Erreur lors de la demande de médicament : " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>




        </tbody>
    </table>
</div> 


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
