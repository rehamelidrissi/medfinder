<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Website Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        /* Add custom styles here */
        body {
            background-image: url('./assets/background.jpg');
            /* Specify the path to your background image */
            background-size: cover;
            /* Cover the entire background */
        
        }

        .search-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .search-input {
            width: 80%;
            font-size: 20px;
            border-radius: 20px;
            padding: 10px 20px;
        }

        .search-button {
            font-size: 20px;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            background-color: transparent;
            border: none;
            color: #007bff;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .search-button:hover {
            color: #0056b3;
        }

        .trend-container {
            display: none; /* Hide the trend container */
        }

        .carousel-item {
            padding: 10px;
        }

        .welcome-message {
            text-align: center;
            font-size:52px; /* Adjust font size */
            margin-top: 50px; /* Add some top margin */
        }
        .message {
            text-align: center;
        }
  </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><img src=".\assets\medlogo.png" alt="Logo" height="60"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
            </ul>
            <ul class="navbar-nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href=index.php>Home</a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="medicine-requests.php">Medecine Requests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="medicine-offers.php">Medecine Offers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.us.php">About Us</a>
                </li>
            </ul>
                <li class="nav-item">
                    <?php

                    session_start();

                    if (isset($_SESSION['patient_data']) || isset($_SESSION['medecin_data'])) {
                    ?>
                    <a class="nav-link" href="util/logout.php">Logout</a>
                    <?php
                    } else {
                    ?>
                    <a class="nav-link" href="login.php">Login</a>
                    <?php
                    }
                    ?>

                </li>
            </ul>
        </div>
    </nav>

    <!-- Content Section -->
    <div class="container mt-4">
        <h1 class="welcome-message">Welcome to the Medicine Finder!</h1>
        <!-- Add more content here -->
        <p class="message">Le projet “MedFinder” a été lancé dans un contexte où les pénuries de médicaments deviennent de plus en plus fréquentes et problématiques à l’échelle mondiale. Face à ce défi, la nécessité d’une solution technologique pour faciliter la recherche et l’accès aux médicaments en pénurie est devenue évidente. “MedFinder” vise à combler ce vide en offrant une plateforme centralisée pour la gestion des informations relatives aux stocks de médicaments disponibles dans les pharmacies.
        </p><br> 
        <!-- Add more content here -->
    </div>

    <!-- Squares Section -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <a href="medicine-requests.php">
                    <img src="assets\request.jpg" alt="Medicine Requests" style="width: 200px; height: 200px;">
                </a>
                <p>Medicine Requests</p>
            </div>
            <div class="col-md-6 text-center">
                <a href="medicine-offers.php">
                    <img src="assets\offer.jpg" alt="Medicine Offers" style="width: 200px; height: 200px;">
                </a>
                <p>Medicine Offers</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>