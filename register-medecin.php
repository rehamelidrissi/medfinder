<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register pharmacy Page</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire 
    $email = $_POST['email'];
    $password = $_POST['password'];
    $raison_soc = $_POST['raison_sociale'];
    $adresse = $_POST['address'];
    $telephone = $_POST['telephone'];
  
    

    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', '', 'medFinder');
    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    } else {
        // Préparer et exécuter la requête d'insertion
        $stmt = $conn->prepare("INSERT INTO pharmacie (email, password, raison_soc, adresse , telephone) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $email, $password,$raison_soc,$adresse , $telephone);
        $execval = $stmt->execute();
        echo $execval ? "<div class='alert alert-success'>Inscription réussie...</div>" : "<div class='alert alert-danger'>Échec de l'inscription...</div>";
        $stmt->close();
        $conn->close();
    }
}
?>

<!-- Section: Design Block -->
<section class="text-center">
    <!-- Image de fond -->
    <div class="p-5 bg-image" style="
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
        height: 300px;
        "></div>
    <!-- Image de fond -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
        <div class="card-body py-5 px-md-5">

            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5"> Inscrivez-vous maintenant  </h2>
                    <form method="post" action="">
                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="email" name="email" id="form3Example3" class="form-control" required />
                            <label class="form-label" for="form3Example3"> email</label>
                        </div>

                        <!-- Password input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="password" name="password" id="form3Example4" class="form-control" required />
                            <label class="form-label" for="form3Example4">password </label>
                        </div>
                         <!-- Telephone input -->
                         <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" name="raison_sociale" id="form3Example5" class="form-control" required />
                            <label class="form-label" for="form3Example5">Raison Sociale</label>
                        </div>
                        <!-- Telephone input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" name="telephone" id="form3Example5" class="form-control" required />
                            <label class="form-label" for="form3Example5">Téléphone</label>
                        </div>

                        <!-- Address input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input type="text" name="address" id="form3Example6" class="form-control" required />
                            <label class="form-label" for="form3Example6">Adress</label>
                        </div>

                        <!-- Bouton de soumission -->
                        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
                            s'inscrire
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section: Design Block -->

<script src="/js/jquery.min.js"></script>
</body>
</html>