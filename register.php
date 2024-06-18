<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Inscription</title>
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      height: 100vh;
      /* Set background image with a doctor theme - Replace 'path/to/your/image.jpg' with your actual image path */
      background-image: url("assets/medbg.jpg");
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
      display: flex; /* Center boxes horizontally */
      justify-content: center;
      align-items: center;
      background-color: lightblue;
    }

    .box {
      width: 190px; /* Adjust width as needed */
      height: 150px; /* Adjust height as needed */
      border-radius: 5px; /* Rectangular box with rounded corners */
      display: flex;
      flex-direction: column; /* Stack content vertically */
      justify-content: center;
      align-items: center;
      margin: 25px;
      background-color: #fff; /* White background for contrast */
      box-shadow: 0 20px 15px rgba(0, 0, 0, 0.1); /* Optional subtle shadow */
    }

    .box img {
      /* Maintain aspect ratio */
      width: 100%; /* Ensures image fills box width */
      height: auto; /* Adjust height automatically to maintain aspect ratio */
      border-radius: 0; /* Remove circular shape for the image */
    }

    .box a {
      text-decoration: none;
      color: #212529; /* Text color */
      font-weight: bold;
      
      top: 100%;
      bottom: 100px; /* Place text at the bottom */
      text-align: center; /* Center text horizontally */
    }
  </style>
</head>

<body>


  <div class="box mx-2">
          <a href="../medicaments 1/register-medecin.php">
            <img src="assets\phar.jpg" alt="Pharmacie" />
            <p>Pharmacie</p>
          </a>
  </div>

        <div class="box mx-2">
          <a href="../medicaments 1/register-patient.php">
            <img src="assets\patient.jpg" alt="Patient" />
            <p>Patient</p>
          </a>
        </div>
  <script src="/js/bootstrap.min.js"></script>

</body>

</html>
