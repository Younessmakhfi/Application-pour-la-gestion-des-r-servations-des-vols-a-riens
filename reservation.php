<?php
include 'connection.php';
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MZY</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
    table,
    th,
    td {
      border: 1px solid black;
      color: white;
    }

    input[type=text],
    select {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type=submit] {
      width: 50%;
      background-color: black;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type=submit]:hover {
      background-color: black;
    }

    
  </style>
</head>

<body>
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="index.html">
                                        <img class="logo" src="img/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a class="active" href="home.php">home</a></li>
                                            <li><a class="" href="reservation.php">Reservation</a></l/li> <li><a
                                                    href="confirmation.php">Cofirmation</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 d-none d-lg-block">
                                <div class="social_wrap d-flex align-items-center justify-content-end">
                                    <div class="number">
                                        <p> <i class="fa fa-phone"></i> +21260000000000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <div class="destination_banner_wrap overlay">
        <div class="destination_text text-center">
            <h3>Enjoy Your Flight</h3>
        </div>
    </div>
    <div class="card text-center">
        <div class="card-header">
            Vol Détails
        </div>
        <?php

$sql = "SELECT IdVol, Depart, Destination, Date, NombrePlace, Prix FROM vols";

$result = $conn->query($sql);
$IdVol = 1;
if ($result->num_rows > $IdVol) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      if($row["IdVol"] == $IdVol){
          
          echo "<table style='width:100%'>
  <tr style = 'background-color: black;'>
    <th>ID de vol</th>
    <th>Depart</th> 
    <th>Destination</th> 
    <th>Date</th> 
    <th>Nombre de place</th> 
    <th>Prix</th> 
  </tr>
  <tr style = 'background-color: #85830b;'>
    <th>" . $row["IdVol"] . "</th>
    <th>" . $row["Depart"] . "</th>
    <th>" . $row["Destination"] . "</th>
    <th>" . $row["Date"] . "</th>
    <th>" . $row["NombrePlace"] . "</th>
    <th>" . $row["Prix"] . "</th>
  </tr>
</table>";

      }
    
  }
} else {
  echo "0 results";
}
// $conn->close();
?>

  <center>
    <h3>Merci de remplir le formulaire : </h3>
    <div style="width: 50%;
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 20px;">
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label for="fname">Nom & Prénom</label>
        <input type="text" id="nom" name="nom" placeholder="Votre Nom & Prénom">

        <label for="lname">EMail</label>
        <input type="text" id="email" name="email" placeholder="Votre Email..">
        <label for="lname">N° Tél</label>
        <input type="text" id="ntel" name="ntel" placeholder="Votre N° Tél..">
        <input type="submit">
      </form>
    </div>

  </center>
  <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kids_way_db";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
  $name = $_POST['nom'];
  if (empty($name)) {
    echo "Name is empty";
  } else {
      $add_data_on_client_table = "INSERT INTO `client` (`Nom`, `Email`, `PhoneNumber`) VALUES
    ('" . $_POST['nom'] . "', '" . $_POST['email'] . "', '" . $_POST['ntel'] . "')";
    if ($conn->query($add_data_on_client_table) === TRUE) {
      $client_id = $conn->insert_id;
      $date = date("Y-m-d");
      $add_data_on_reservation_table = "INSERT INTO `reservation` (`IdClient`, `IdVol`, `IdPlace`, `DateReservation`) VALUES
    ('" . $client_id . "', '" . $IdVol . "', '0', '" . $date . "')";
    $decrement_Places ="UPDATE vols SET NombrePlace = NombrePlace - 1 WHERE IdVol = $IdVol and NombrePlace > 0";
    if($conn->query($decrement_Places) == TRUE){
      echo "NombrePlace decremented <br>";
    }else{
      echo "Error: " . $decrement_Places . "<br>" . $conn->error;
    }
    if($conn->query($add_data_on_reservation_table) == TRUE){
      $reserv_id = $conn->insert_id;
      echo "reservation data stored success";
      session_start();
      $_SESSION['reserv_id']   = $reserv_id;
      header('location:confirmation.php');
      }else{
      echo "Error: " . $add_data_on_reservation_table . "<br>" . $conn->error;
      }
      } else {
      echo "Error: " . $add_data_on_client_table . "<br>" . $conn->error;
    }
    
  }
  $conn->close();
  
}
?>
    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-md-6 col-lg-4 ">
                        <div class="footer_widget">
                            <div class="footer_logo">
                                <a href="#">
                                    <img class="logo" src="img/footer_logo.png" alt="">
                                </a>
                            </div>
                            <p>MZY, YouCode <br> Safi, Morocco<br>
                                <a href="#">+212600000000</a> <br>
                                <a href="#">contact@MZY.com</a>
                            </p>
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-twitter-alt"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-pinterest"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-youtube-play"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-2">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Company
                            </h3>
                            <ul class="links">
                                <li><a href="#">Pricing</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#"> Gallery</a></li>
                                <li><a href="#"> Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Popular destination
                            </h3>
                            <ul class="links double_links">
                                <li><a href="#">Indonesia</a></li>
                                <li><a href="#">America</a></li>
                                <li><a href="#">India</a></li>
                                <li><a href="#">Switzerland</a></li>
                                <li><a href="#">Italy</a></li>
                                <li><a href="#">Canada</a></li>
                                <li><a href="#">Franch</a></li>
                                <li><a href="#">England</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Instagram
                            </h3>
                            <div class="instagram_feed">
                                <div class="single_insta">
                                    <a href="#">
                                        <img src="img/instagram/1.png" alt="">
                                    </a>
                                </div>
                                <div class="single_insta">
                                    <a href="#">
                                        <img src="img/instagram/2.png" alt="">
                                    </a>
                                </div>
                                <div class="single_insta">
                                    <a href="#">
                                        <img src="img/instagram/3.png" alt="">
                                    </a>
                                </div>
                                <div class="single_insta">
                                    <a href="#">
                                        <img src="img/instagram/4.png" alt="">
                                    </a>
                                </div>
                                <div class="single_insta">
                                    <a href="#">
                                        <img src="img/instagram/5.png" alt="">
                                    </a>
                                </div>
                                <div class="single_insta">
                                    <a href="#">
                                        <img src="img/instagram/6.png" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>