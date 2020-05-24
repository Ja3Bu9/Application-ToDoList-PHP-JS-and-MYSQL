<?php 

require('class.php');
require('config.php');
session_start();

?>
<!DOCTYPE html>
<html>

<head>
  <!-- Font Awesome -->
  <title>Application By Ja3Buu9</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <!-- Material Design Bootstrap -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/css/mdb.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark ">
    <div class="collapse navbar-collapse d-flex justify-content-center">
      <ul class="navbar-nav ">
        <li class="nav-item ">
          <a class="nav-link" href="index.php">Accueil </a>
        </li>
      </ul>
    </div>
    <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarText">

      <span class="navbar-text white-text">
        <?php
        
        
        
        if(!isset($_SESSION["username"])){
         
          echo '<a href="login.php"> Se connecter !</a>';
          
        }else {
          $sql = "SELECT * FROM user WHERE id = '{$_SESSION[ "id" ]}'";
          $result = $conn->query($sql);
               
          $row = $result->fetch_assoc();

          echo '<div class="d-flex align-items-center">';
          echo '<img src="'.$row['photo'].'" class="rounded-circle z-depth-0"
                    alt="avatar image" height="35">';
                    echo '<span style="color:#AFA;text-align:center; margin:5px"> '. $row["username"].'  </span>';
                    echo '&nbsp;<a href="logout.php">Déconnexion</a>';
                    echo '<div class="dropdown">
            <button class="btnn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="updateuser.php?id='.$row["id"].'">Update Information</a>
              <a class="dropdown-item" href="updatephoto.php?id='.$row["id"].'">Update Picture</a>
              <a class="dropdown-item" href="updatepassword.php?id='.$row["id"].'">Update Password</a>
            </div>
          </div>';
          echo '</div>';
                  }
      ?>
      </span>
    </div>
  </nav>

  
  <div class="form-container">
    <h1 class="title">Update User Infos</h1>

    <form class="text-center border border-light p-5" action="" method="post">
     
      <input type="text" class="form-control mb-4" name="username" placeholder="Nom d'utilisateur" required />
      <input type="email" class="form-control mb-4" name="email" placeholder="Email" required />
      <input type="text" class="form-control mb-4" name="firstname" placeholder="Firstname" required />
      <input type="text" class="form-control mb-4" name="lastname" placeholder="Lastname" required />

      <input type="submit" name="updateinfos" value="update" class="btn btn-info btn-block my-4" />
      


     
    </form>

    <?php



if(isset($_POST["updateinfos"])) {

  $user = new USER();


$user->username = stripslashes($_REQUEST['username']);
$user->username = mysqli_real_escape_string($conn, $user->username); 

$user->email = stripslashes($_REQUEST['email']);
$user->email = mysqli_real_escape_string($conn, $user->email);

$user->firstname = stripslashes($_REQUEST['firstname']);
$user->firstname = mysqli_real_escape_string($conn, $user->firstname);

$user->lastname = stripslashes($_REQUEST['lastname']);
$user->lastname = mysqli_real_escape_string($conn, $user->lastname);

$user->UpdateInfromation($_GET['id'], $user->username, $user->email, $user->firstname, $user->lastname,$conn);



  }

?>
  </div>

</body>

</html>












































<!-- BY Ja3Bu9 -->