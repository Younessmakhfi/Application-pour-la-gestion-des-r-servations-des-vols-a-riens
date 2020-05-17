<?php
include 'connection.php';
?>
<!DOCTYPE HTML>
<html>

<head>
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
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type=submit]:hover {
      background-color: #45a049;
    }

    div {
      width: 50%;
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 20px;
    }
  </style>
</head>

<body>
  <h3>Reservation de Vol : </h3>
  <?php

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
// $conn->close();
?>

  <center>
    <h3>Merci de remplir le formulaire : </h3>
    <div>
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
      session_start();
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
</body>

</html>