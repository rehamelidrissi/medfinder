


<!--DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Website Dashboard</title>
    <-- Bootstrap CSS ->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons ->
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
    <!-- Navigation Bar ->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><img src=".\assets\medlogo.png" alt="Logo" height="60"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
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

    <!-- Content Section ->
    <div class="container mt-4">
        <h1 class="welcome-message">Welcome to the Medicine Finder!</h1>
        <!-- Add more content here ->
        <p class="message">Le projet “MedFinder” a été lancé dans un contexte où les pénuries de médicaments deviennent de plus en plus fréquentes et problématiques à l’échelle mondiale. Face à ce défi, la nécessité d’une solution technologique pour faciliter la recherche et l’accès aux médicaments en pénurie est devenue évidente. “MedFinder” vise à combler ce vide en offrant une plateforme centralisée pour la gestion des informations relatives aux stocks de médicaments disponibles dans les pharmacies.
        </p><br> 
        <!-- Add more content here ->
    </div>

    <!-- Squares Section ->
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

    <!-- Bootstrap JS and dependencies ->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body->

</html-->

<ul class="navbar-nav">
                <li class="nav-item">
                    <?php
                    
             
                  

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








 <!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Sticky responsive sidenav</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap'>
<style>
    /* -
-*-~*~-*-*-~*~-*-*-~*~* |
●▬▬▬▬▬▬▬๑۩۩๑▬▬▬▬▬▬▬●
Made by ~
Areal Alien ❥ 雷克斯
●▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬●
──────▄▀▄─────▄▀▄
─────▄█░░▀▀▀▀▀░░█▄
─▄▄──█░░░░░░░░░░░█──▄▄
█▄▄█─█░░▀░░┬░░▀░░█─█▄▄█
-*-~*~-*-*-~*~-*-*-~*~* |
- */
:root {
    --primary: 237, 94%, 81%;
    --background: 266, 16%, 92%;
    --background-secondary: 256, 12%, 12%;
    --background-secondary-dark: 256, 10%, 10%;
    --background-secondary-light: 257, 11%, 16%;
    --text-primary: 0, 0%, 0%;
    /* Colors */
    --black: 0, 0%, 0%;
    --white: 0, 0%, 100%;
    --quite-gray: 0, 0%, 50%;
    --grooble: 10, 28%, 93%;
    /* Sizes */
    --heading-large: 5.6rem;
    --heading-medium: 3.6rem;
    --heading-small: 2.4rem;
    --paragraph: 1.11rem;
    --navbar-buttons: 2.4rem;
    /* misc */
    --transition-main: .175, .685, .32;
    /* Fonts */
    --font-main: "Poppins";
}

/* ===========
    Variabels
   =========== */

/* ===============
    Global Styles
   =============== */

*, *::before, *::after {
    box-sizing: inherit;
}
img{
    height: 85px;
    overflow: clip;
    overflow-clip-margin: content-box;
    color: hsl(var(--quite-gray));}
html, body {
    background-image:url(background.jpg) ;
    margin: 0;
    width: 100%;
    color: hsl(var(--text-primary));
    font-family: var(--font-main);
    background-color: hsl(var(--background));
    -webkit-font-smoothing: antialiased;
    scroll-behavior: smooth;
    box-sizing: border-box;
}

/* ============
    Typography
   ============ */

/* Headings */
h1, h2, h3, h4, h5, h6 {
    margin: 0;
}
/* Font Size */
h1 {
    font-size: var(--heading-large);
    
}
h2 {
    font-size: var(--heading-medium);
    margin: 17px;
    TEXT-ALIGN: center;
    TEXT-SIZE-ADJUST: auto
}
h3 {
    font-size: var(--heading-small);
}
h4 {
    font-size: calc(var(--heading-small) - .2rem);
}
h5 {
    font-size: calc(var(--heading-small) - .4rem);
}
h6 {
    font-size: calc(var(--heading-small) - .6rem);
}
/* Font Weight */
h1, h2 {
    font-weight: 900;
}
h3, h4, h5, h6 {
    font-weight: 800;
}
/* Paragraphs */
p {
    margin: 0;
    font-size: var(--paragraph);
    font-size: medium;
    
}
/* Links */
a {
    color: hsla(var(--primary), 1);
    font-size: var(--paragraph);
    text-decoration: underline;
}
a:visited {
    color: hsla(var(--primary), .5);
}

/* =========
    Buttons
   ========= */

button {
    padding: .8em 1.2em;
    border: 1px solid hsl(var(--black));
    background-color: hsl(var(--background));
    font-size: var(--paragraph);
    cursor: pointer;
    outline: none;
}
button:focus {
    box-shadow:
            0 0 0 2px hsl(var(--black)),
            0 0 0 3px hsl(var(--white));
    border: 1px solid transparent;
}

/* =======
    Lists
   ======= */

ul, ol {
    margin: 1em 0;
}

/* =======
    Forms
   ======= */

form {
    margin: 0;
}
fieldset {
    margin: 0;
    padding: .5em 0;
    border: none;
}
input {
    padding: .8em 1.2em;
    font-size: var(--paragraph);
    background-color: hsl(var(--grooble));
    border: 2px solid hsl(var(--grooble));
    outline: none;
}
textarea {
    padding: .8em 1.2em;
    font-size: var(--paragraph);
    font-family: var(--font-main);
    background-color: hsl(var(--grooble));
    border: 2px solid hsl(var(--grooble));
    outline: none;
}
input, textarea {
    transition: all .2s ease-in-out;
}
input:hover, input:focus, textarea:hover, textarea:focus {
    box-shadow:
            0 0 0 2px hsl(var(--black)),
            0 0 0 3px hsl(var(--white));
    border: 2px solid transparent;
}
select {
    padding: .8em 1.2em;
    border: 1px solid hsl(var(--black));
    font-size: var(--paragraph);
    outline: none;
}

/* =========
    Classes
   ========= */

/* ================
    Global classes
   ================ */

/* =========
    Flexbox
   ========= */

.flexbox {
    display: flex;
    justify-content: center;
    align-items: center;
}
.flexbox-left {
    display: flex;
    justify-content: flex-start;
    align-items: center;
}
.flexbox-right {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}
/* Columns */
.flexbox-col {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
}
.flexbox-col-left {
    display: flex;
    justify-content: flex-start;
    flex-direction: column;
    align-items: flex-start;
}
.flexbox-col-left-ns {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: flex-start;
}
.flexbox-col-right {
    display: flex;
    justify-content: flex-end;
    flex-direction: column;
    align-items: flex-end;
}
.flexbox-col-start-center {
    display: flex;
    justify-content: flex-start;
    flex-direction: column;
    align-items: center;
}
/* Spacings */
.flexbox-space-bet {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* =========
    Classes
   ========= */

.view-width {
    width: 70%;
}

/* ========
    Navbar
   ======== */

#navbar {
    top: 0;
    padding: 0;
    width: 5em;
    height: 100vh;
    position: fixed;
    background-color: hsl(var(--background-secondary));
    transition: width .35s cubic-bezier(var(--transition-main), 1);
    overflow-y: auto;
    overflow-x: hidden;
}
#navbar:hover {
    width: 16em;
}
#navbar::-webkit-scrollbar-track {
    background-color: hsl(var(--background-secondary));
}
#navbar::-webkit-scrollbar {
    width: 8px;
    background-color: hsl(var(--background-secondary));
}
#navbar::-webkit-scrollbar-thumb {
    background-color: hsl(var(--primary));
}
.navbar-items {
    margin: 0;
    padding: 0;
    list-style-type: none;
}
/* Navbar Logo */
.navbar-logo {
    margin: 0 0 2em 0;
    width: 100%;
    height: 5em;
    background: hsl(var(--background-secondary-dark));
}
.navbar-logo > .navbar-item-inner {
    width: calc(5rem - 8px);
}
.navbar-logo > .navbar-item-inner:hover {
    background-color: transparent;
}
.navbar-logo > .navbar-item-inner > svg {
    height: 2em;
    fill: hsl(var(--white));
}
/* Navbar Items */
.navbar-item {
    padding: 0 .5em;
    width: 100%;
    cursor: pointer;
}
.navbar-item-inner {
    padding: 1em 0;
    width: 100%;
    position: relative;
    color: hsl(var(--quite-gray));
    border-radius: .25em;
    text-decoration: none;
    transition: all .2s cubic-bezier(var(--transition-main), 1);
}
.navbar-item-inner:hover {
    color: hsl(var(--white));
    background: hsl(var(--background-secondary-light));
    box-shadow: 0 17px 30px -10px hsla(var(--black), .25);
}
.navbar-item-inner-icon-wrapper {
    width: calc(5rem - 1em - 8px);
    position: relative;
}
.navbar-item-inner-icon-wrapper ion-icon {
    position: absolute;
    font-size: calc(var(--navbar-buttons) - 1rem);
}
.link-text {
    margin: 0;
    width: 0;
    text-overflow: ellipsis;
    white-space: nowrap;
    transition: all .35s cubic-bezier(var(--transition-main), 1);
    overflow: hidden;
    opacity: 0;
}
#navbar:hover .link-text {
    width: calc(100% - calc(5rem - 8px));
    opacity: 1;
}

/* ======
    Main
   ====== */

#main {
    margin: 0 0 0 5em;
    min-height: 85vh;
}
#main > h2 {
    width: 80%;
    max-width: 80%;
}
#main > p {
    width: 80%;
    max-width: 80%;
}

/* =============
    ::Selectors
   ============= */

/* Selection */
::selection {
    color: hsl(var(--white));
    background: hsla(var(--primary), .33);
}
/* Scrollbar */
::-webkit-scrollbar-track {
    background-color: hsl(var(--background));
}
::-webkit-scrollbar {
    width: 8px;
    background-color: hsl(var(--background));
}
::-webkit-scrollbar-thumb {
    background-color: hsl(var(--primary));
}

/* ===============
    5. @keyframes
   =============== */

/* ==============
    @media rules
   ============== */

@media only screen and (max-width: 1660px) {
    :root {
        /* Sizes */
        --heading-large: 5.4rem;
        --heading-medium: 3.4rem;
        --heading-small: 2.2rem;
    }
}
@media only screen and (max-width: 1456px) {
    :root {
        /* Sizes */
        --heading-large: 5.2rem;
        --heading-medium: 3.2rem;
        --heading-small: 2rem;
    }
    .view-width {
        width: 80%;
    }
}
@media only screen and (max-width: 1220px) {
    .view-width {
        width: 70%;
    }
}
@media only screen and (max-width: 1024px) {
    :root {
        /* Sizes */
        --heading-large: 5rem;
        --heading-medium: 3rem;
        --heading-small: 1.8rem;
    }
    .view-width {
        width: 75%;
    }
}
@media only screen and (max-width: 756px) {
    :root {
        /* Sizes */
        --heading-large: 4rem;
        --heading-medium: 2.6rem;
        --heading-small: 1.6rem;
        --paragraph: 1rem;
        --navbar-buttons: 2.2rem;
    }
    .view-width {
        width: calc(100% - 5em);
    }
}
@media only screen and (max-width: 576px) {
    .view-width {
        width: calc(100% - 3em);
    }
}
@media only screen and (max-width: 496px) {

}
</style>

</head>
<body>
<!-- partial:index.partial.html -->
<!-- Navbar -->
<nav id="navbar">
  <ul class="navbar-items flexbox-col">
    <li class="navbar-logo flexbox-left">
      <a class="navbar-item-inner flexbox">
        <img src="medlogo.png" alt="">
      </a>
    </li>

    <li class="navbar-item flexbox-left">
      <a class="navbar-item-inner flexbox-left">
        <div class="navbar-item-inner-icon-wrapper flexbox">
          <ion-icon name="home-outline"></ion-icon>
        </div>
        <span class="link-text" href = >Home</span>
      </a>
    </li>
    <li class="navbar-item flexbox-left">
      <a class="navbar-item-inner flexbox-left">
        <div class="navbar-item-inner-icon-wrapper flexbox">
          <ion-icon name="folder-open-outline"></ion-icon>
        </div>
        <span class="link-text" href="medicine-requests.php">Medecine Requests</span>
      </a>
    </li>
    <li class="navbar-item flexbox-left">
      <a class="navbar-item-inner flexbox-left">
        <div class="navbar-item-inner-icon-wrapper flexbox">
          <ion-icon name="pie-chart-outline"></ion-icon>
        </div>
        <span class="link-text"href="medicine-offers.php">Medecine Offers</span>
      </a>
    </li>
    <li class="navbar-item flexbox-left">
      <a class="navbar-item-inner flexbox-left">
        <div class="navbar-item-inner-icon-wrapper flexbox">
          <ion-icon name="people-outline"></ion-icon>
        </div>
        <span class="nav-link" href=".php">Login</span>
      </a>
    </li>
    <li class="navbar-item flexbox-left">
      <a class="navbar-item-inner flexbox-left">
        <div class="navbar-item-inner-icon-wrapper flexbox">
          <ion-icon name="chatbubbles-outline"></ion-icon>
        </div>
        <span class="link-text">About Us</span>
      </a>
    </li>
   
  </ul>
</nav>

<!-- Main -->
<main id="main" class="flexbox-col">
  <h2>Welcome to the Medicine Finder!</h2>
  <p>Le projet “MedFinder” a été lancé dans un contexte où les pénuries de médicaments deviennent de plus en plus fréquentes et problématiques à l’échelle mondiale. Face à ce défi, la nécessité d’une solution technologique pour faciliter la recherche et l’accès aux médicaments en pénurie est devenue évidente. “MedFinder” vise à combler ce vide en offrant une plateforme centralisée pour la gestion des informations relatives aux stocks de médicaments disponibles dans les pharmacies.</p>
</main>
<!-- partial -->
  <script src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js'></script>
<script src='https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js'></script>
</body>
</html>

