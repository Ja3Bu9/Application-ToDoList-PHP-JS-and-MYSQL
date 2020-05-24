<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit(); 
  }
  

require('config.php');
require('class.php');

?>

<!DOCTYPE html>
<html>

<head>
  <title>Application By Ja3Buu9</title>
  <!-- Font Awesome -->
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  

  <script src="script.js"></script>

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






 
    <h1 class="title">Tasks</h1>


    <?php

if(isset($_GET['updatetask'])){
  $id = $_GET["updatetask"];


  $sql = "SELECT * FROM task WHERE id = '$id'";
        $result = $conn->query($sql);

        $row = $result->fetch_assoc();
?>


<div class="d-flex justify-content-center align-items-center">
        <form method="post" action="task.php" class="input_form">
        <input type="hidden" name="idupd" class="input" value="<?php echo $_GET['updatetask']; ?>"  >
        <input type="hidden" name="taskid" class="input" value="<?php echo $_GET['idtask']; ?>"  >

    
    <input placeholder="Enter Tasks" name="tasktext" class="input" id="value" type="text" value="<?php echo $row['taskText'] ?>" >
    <input class="but"  type="submit" name="edittask" value="Update">
    
    </form>

      </div>




<?php } else { ?>

  <div class="d-flex justify-content-center align-items-center">
        <form method="post" action="task.php" class="input_form">
        <input type="hidden" name="idtask" class="input" value="<?php echo $_GET['idtask']; ?>"  >
    
    <input placeholder="Enter Tasks" name="tasktext" class="input" id="value" type="text">
    <input class="but"  type="submit" name="addtask" value="Add">
    
    </form>

      </div>



<?php }?>


<div class="d-flex flex-column align-items-center">
  <divs style="margin-top:40px">
    <?php


$sql = "SELECT * FROM task WHERE todolist_id = '{$_GET["idtask"]}'";
$result = $conn->query($sql);



while($row = $result->fetch_assoc()) {

    ?>



    <label class="containerr d-flex justify-content-between">
            <input name="<?php echo $row['id'] ?>" class="checkboox" id="check" onclick="cheeck('1','<?php echo $row['id'] ?>')" type="checkbox" value="<?php echo $row['done'] ?>" >
            <span class="checkmark"></span>
            <p class="text"><?php echo $row['taskText'] ?></p>
            <div class="butns">
					<a style="background-color:green; " class="aa upd" href="task.php?updatetask=<?php echo $row['id'] ?>&idtask=<?php echo $_GET["idtask"] ?>">~</a> 

					<a class="aa" href="task.php?deltask=<?php echo $row['id'] ?>&idtask=<?php echo $_GET["idtask"] ?>">x</a> 
          </div>
          </label>
        
    <?php 
    
  }

?>
        </div>
        </div>
      
<script>
  var checkBox = document.getElementsByClassName("checkboox");
var text= document.getElementsByClassName("text");

for (let i = 0 ; i<checkBox.length ; i++){
        if (checkBox[i].value == 1){

          text[i].style.textDecoration = 'line-through';
          checkBox[i].checked = true;
          
        }else{
          text[i].style.textDecoration = 'none';
          checkBox[i].checked = false;
        }
      
      }

      

</script>
 

 


</body>

</html>




































<!-- BY Ja3Bu9 -->