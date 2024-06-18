<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Website </title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
    

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
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="medicine-requests.php">Medecine Requests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="medicine-offers.php">Medecine Offers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
            </ul>
            <ul class="navbar-nav">
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