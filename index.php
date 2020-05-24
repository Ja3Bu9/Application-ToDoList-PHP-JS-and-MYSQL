<?php
require('config.php');
require('class.php');
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit(); 
  }
  


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


  <div class="container">
    <h1 class="title">TodoLists</h1>

    <div>

<?php 

if(isset($_GET['update'])){
  $id = $_GET["update"];
  

  $sql = "SELECT * FROM todolist WHERE id = '$id'";
        $result = $conn->query($sql);

        $row = $result->fetch_assoc();
?>
      <div class="d-flex justify-content-center align-items-center">
        <form method="post" action="index.php" class="input_form">
        <input type="hidden" name="id" class="input" value="<?php echo $id; ?>"  >

          <input type="text" name="task" class="input" value="<?php echo $row['name'] ?>" placeholder="Name"  required>
          <div class="d-flex justify-content-center align-items-center">
            <label for="color-select">Choose a color:</label>

            <select class="input" name="color" id="color-select" required>
              <option value="">--Please choose an option--</option>
              <option style='color: rgba(218, 95, 68)' value="rgba(218, 95, 68, 0.6)">Orange</option>
              <option style='color: rgba(40, 191, 204)' value="rgba(40, 191, 204, 0.6)">Blue</option>
              <option style='color: rgba(210, 68, 218)' value="rgba(210, 68, 218, 0.6)">Pink</option>
              <option style='color: rgba(210, 218, 68)' value="rgba(210, 218, 68, 0.6)">Yellow</option>
              <option style='color: rgba(151, 134, 152)' value="rgba(151, 134, 152, 0.6)">DarkGrey</option>
            </select>
          </div>
          <input class="but " type="submit" name="edit" value="Edit">
        </form>
      </div>

      <?php } else { ?>


        <div class="d-flex justify-content-center align-items-center">
        <form method="post" action="index.php" class="input_form">
          <input type="text" name="task" class="input" placeholder="Name" required>
          <div class="d-flex justify-content-center align-items-center">
            <label for="color-select">Choose a color:</label>

            <select class="input" name="color" id="color-select" required>
              <option value="">--Please choose an option--</option>
              <option style='color: rgba(218, 95, 68)' value="rgba(218, 95, 68, 0.6)">Orange</option>
              <option style='color: rgba(40, 191, 204)' value="rgba(40, 191, 204, 0.6)">Blue</option>
              <option style='color: rgba(210, 68, 218)' value="rgba(210, 68, 218, 0.6)">Pink</option>
              <option style='color: rgba(210, 218, 68)' value="rgba(210, 218, 68, 0.6)">Yellow</option>
              <option style='color: rgba(151, 134, 152)' value="rgba(151, 134, 152, 0.6)">DarkGrey</option>
            </select>
          </div>
          <input class="but " type="submit" name="submit" value="Add">
        </form>
      </div>
        <?php 
    
      } ?>

<table>

	<thead>
		<tr>
			<th>N</th>
			<th>Tasks</th>
			<th style="width: 60px;">Action</th>
		</tr>
	</thead>

	<tbody>
  
<?php
$sql = "SELECT * FROM todolist WHERE user_id = '{$_SESSION[ "id" ]}'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
$i = 1;

while($row = $result->fetch_assoc()) {

    ?>
    
			<tr style="background-color:<?php echo $row['color'] ?>;">
				<td> <?php echo $i; ?> </td>
				<td class="task"> <a style='text-decoration: none;color:white' href="task.php?idtask=<?php echo $row['id']; ?>"> <?php echo $row['name']; ?></a> </td>
				<td class="delete"> 
        <a style="background-color:green; " href="index.php?update=<?php echo $row['id'] ?>">~</a> 

					<a href="index.php?del=<?php echo $row['id'] ?>">x</a> 
				</td>
			</tr>
		
    <?php 
    $i++;
  }
}
?>
	</tbody>
</table>



    </div>

  </div>
</body>

</html>




































<!-- BY Ja3Bu9 -->