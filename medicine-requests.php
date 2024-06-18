<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $con = mysqli_connect('localhost', 'root', '', 'medfinder');
    if (!$con) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }

    $id_recherche = mysqli_real_escape_string($con, $_POST['id']);
    $sql_update = "UPDATE recherche SET satisfait = 1 WHERE id_recherche = '$id_recherche'";

    if (mysqli_query($con, $sql_update)) {
        echo 'success';
    } else {
        echo 'error';
    }
    mysqli_close($con);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page des médicaments recherchée</title>
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
    <h1 id="bold-white-text">Liste des médicaments recherchée</h1>   
    <form action="medicine-requests.php" method="POST" id="search-form">
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
                <th>Quantité recherchée</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $con = mysqli_connect('localhost', 'root', '', 'medfinder');
        if (!$con) {
            die("Erreur de connexion : " . mysqli_connect_error());
        }

        $searchKey = "";
        if (isset($_POST['search'])) {
            $searchKey = mysqli_real_escape_string($con, $_POST['search']);
            $sql = "SELECT recherche.id_recherche, recherche.quantite_recherche, medicament.prix, medicament.nom, recherche.satisfait
                    FROM medicament 
                    INNER JOIN recherche ON medicament.id_medicament = recherche.id_medicament 
                    WHERE medicament.nom LIKE '%$searchKey%'";
        } else {
            $sql = "SELECT recherche.id_recherche, recherche.quantite_recherche, medicament.prix, medicament.nom, recherche.satisfait
                    FROM medicament 
                    INNER JOIN recherche ON medicament.id_medicament = recherche.id_medicament";
        }

        $result = mysqli_query($con, $sql);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
                    echo "<td>" . $row['prix'] . "</td>";
                    echo "<td>" . $row['quantite_recherche'] . "</td>";
                    echo "<td>";
                    if ($row['satisfait'] == 0) {
                        echo "<button class='btn btn-success satis-button' data-id='" . $row['id_recherche'] . "'>Satisfie</button>";
                    } else {
                        echo "<span class='badge badge-success'>Satisfait</span>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center text-danger'>Aucun résultat trouvé</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4' class='text-center text-danger'>Erreur de requête : " . mysqli_error($con) . "</td></tr>";
        }

        mysqli_close($con);
        ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('.satis-button').click(function() {
        var id_recherche = $(this).data('id');
        $.ajax({
            url: '', // Same page
            type: 'POST',
            data: {id: id_recherche},
            success: function(response) {
                if(response == 'success') {
                    alert('Médicament marqué comme satisfait');
                    location.reload(); // Reload the page to update the table
                } else {
                    alert('Erreur lors de la mise à jour');
                }
            }
        });
    });
});
</script>
</body>
</html>