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
          echo '<span style="color:#AFA;text-align:center;"> '. $_SESSION["username"].'  </span>';
          echo '&nbsp;<a href="logout.php">Déconnexion</a>';
        }
      ?>
      </span>
    </div>
  </nav>
  <?php
require('config.php');
require('class.php');
session_start();
if (isset($_POST['log'])){

    $user = new USER();

  $user->username = stripslashes($_REQUEST['username']);
  $user->username = mysqli_real_escape_string($conn, $user->username);
  $user->password = stripslashes($_REQUEST['password']);
  $user->password = mysqli_real_escape_string($conn, $user->password);
    $query = "SELECT * FROM `user` WHERE username='$user->username' and password='$user->password'";
  $result = mysqli_query($conn,$query) or die(mysql_error());
  $rows = mysqli_num_rows($result);
  $row = mysqli_fetch_assoc($result);
  if($rows==1){
      $_SESSION['id']    = $row['id'];
      $_SESSION['username'] = $user->username;
      $_SESSION['photo'] = $row['photo'];
      header("Location: index.php");
  }else{
    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";

  }
}
?>


  <div class="form-container">
    <h1 class="title">Login</h1>

    <form class="text-center border border-light p-5" action="" method="post" name="login">
      <p class="h4 mb-4">Connectez-vous !</p>
      <input type="text" class="form-control mb-4" name="username" placeholder="Nom d'utilisateur">
      <input type="password" class="form-control mb-4" name="password" placeholder="Mot de passe">
      <input type="submit" value="Connexion " name="log" class="btn btn-info btn-block my-4">
      <p>Vous êtes nouveau ici?<a href="register.php"> s'inscrire !</a></p>
      <?php if (! empty($message)) { ?>
      <p class="errorMessage"><?php echo $message; ?></p>
      <?php } ?>
    </form>
  </div>


 
</body>

</html>












































<!-- BY Ja3Bu9 -->