<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Travelo</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

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
                                            <li><a class="active" href="home.html">home</a></li>
                                            <li><a class="" href="reservation.html">Reservation</a></l/li>
                                            <li><a href="confirmation.html">Cofirmation</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 d-none d-lg-block">
                                <div class="social_wrap d-flex align-items-center justify-content-end">
                                    <div class="number">
                                        <p> <i class="fa fa-phone"></i> +21260000000000</p>
                                    </div>
                                    <div class="social_links d-none d-xl-block">
                                        <ul>
                                            <li><a href="#"> <i class="fa fa-instagram"></i> </a></li>
                                            <li><a href="#"> <i class="fa fa-linkedin"></i> </a></li>
                                            <li><a href="#"> <i class="fa fa-facebook"></i> </a></li>
                                            <li><a href="#"> <i class="fa fa-google-plus"></i> </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>Destinations</h3>
                        <p>Pixel perfect design with awesome contents</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->
    <center><h3> Des information sur votre réservation </h3></center>
    
<?php
include 'connection.php';
session_start();
$sql = "SELECT IdVol, Depart, Destination, Date, NombrePlace, Prix FROM vols";

$result = $conn->query($sql);
$IdVol = 1;
if ($result->num_rows > $IdVol) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      if($row["IdVol"] == 1){
          
          echo "<table style='width:100%'>
  <tr style = 'background-color: green;'>
    <th>ID de vol</th>
    <th>Depart</th> 
    <th>Destination</th> 
    <th>Date</th> 
    <th>Nombre de place</th> 
    <th>Prix</th> 
  </tr>
  <tr>
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
$conn->close();
?>
<!--/ table form  -->
    <div class="destination_details_info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-9">
                    <div class="destination_info">
                    <div class="bordered_1px"></div>
                    <div class="contact_join">
                        <h3>Merci de remplir le formulaire suivent pour reserver un vol</h3>
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="single_input">
                                        <input type="text" id="nom" name="nom" placeholder="Votre Nom & Prénom">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="single_input">
                                        <input type="text" id="email" name="email" placeholder="Votre Email..">
                                    </div>
                                </div>                             
                                <div class="col-lg-6 col-md-6">
                                    <div class="single_input">
                                        <input type="text" id="ntel" name="ntel" placeholder="Votre N° Tél..">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="submit_btn">
                                    <input type="submit">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="bordered_1px"></div>
                </div>
            </div>
        </div>
    </div>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "makhispw_vol";
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
    $decrement_Places =("UPDATE vols SET NombrePlace = NombrePlace - 1 WHERE IdVol = $IdVol and NombrePlace > 0");
    if($conn->query($decrement_Places) == TRUE){
      echo "vols data stored success <br>";
    }else{
      echo "Error: " . $decrement_Places . "<br>" . $conn->error;
    }
    if($conn->query($add_data_on_reservation_table) == TRUE){
      $reserv_id = $conn->insert_id;
      echo "reservation data stored success";
      
      $_SESSION['reserv_id']   = $reserv_id;
      header('location:confirmation.php');
      }else{
      echo "Error: " . $add_data_on_client_table . "<br>" . $conn->error;
      }
      } else {
      echo "Error: " . $add_data_on_client_table . "<br>" . $conn->error;
    }
    
  }
  $conn->close();
  
}
?>
<!--/ end table form  -->
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
                            <p>5th flora, 700/D kings road, green <br> lane New York-1782 <br>
                                <a href="#">+10 367 826 2567</a> <br>
                                <a href="#">contact@carpenter.com</a>
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

</body>

</html>