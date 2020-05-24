<?php



class USER {
        public $id;
        public $username;
        public $email;
        public $password;
        public $firstname;
        public $lastname;
        public $photo;

    

        public function UpdateInfromation($id, $username, $email, $firstname, $lastname, $conn){


            $update_query = mysqli_query($conn,"UPDATE user SET username = '" . $username . "', email = '" . $email . "', firstname = '" . $firstname . "' , lastname = '". $lastname ."' WHERE id = '" . $id . "'");
    
            header("Location: index.php");
        }


        function ChangePhoto($id,$photo,$conn){

            $update_query = mysqli_query($conn,"UPDATE user SET photo = '" . $photo . "' WHERE id = '" . $id . "'");
    
            header("Location: index.php");
    
    
        }
    
        function ChangePassword($id, $password, $conn){
    
            $update_query = mysqli_query($conn,"UPDATE user SET password = '" . $password . "' WHERE id = '" . $id . "'");
    
            header("Location: index.php");
    
    
    
        }

    
}

class TODOLIST {
        public $id;
        public $name;
        public $color;
        public $user_id;

    

    function DeleteToDoList($conn){
        $sqldel = "DELETE FROM todolist WHERE id=$this->id";
        return $result = $conn->query($sqldel);

    }


    function UpdateToDolist($id,$name,$color,$conn){

        $update_query = mysqli_query($conn,"UPDATE todolist SET name = '" . $name . "', color = '" . $color . "' WHERE id = '" . $id . "'");

        header("Location: index.php");

    }


}


class TASK {
        public $id;
        public $taskText;
        public $done;
        public $todolist_id;

    

    function ChangeTaskStatus($conn){
    

         $update_query = mysqli_query($conn,"UPDATE task SET  done = $this->done WHERE id = $this->id ");
        
    }


    function DeletTask($conn){
       
    $update_query = mysqli_query($conn,"DELETE FROM task WHERE id=$this->id");



    }

    function ChangeTaskText($idtask,$conn){

        $update_query = mysqli_query($conn,"UPDATE task SET taskText = '" . $this->name . "' WHERE id = '" . $this->id . "'");

        header("Location: task.php?idtask=$idtask");

    }
    
}




if (isset($_GET['del'])) {
  $todolist1 = new TODOLIST();
  $todolist1->id = $_GET['del'];

  $res = $todolist1->DeleteToDoList($conn);

}

if (isset($_GET['deltask'])) {
    $task = new TASK();
    $task->id = $_GET['deltask'];
  
    $res = $task->DeletTask($conn);
  }

if(isset($_POST["edit"])) {
    $todolist = new TODOLIST();

  $todolist->id = $_POST['id'];
   

  $todolist->name = stripslashes($_REQUEST['task']);
  $todolist->name = mysqli_real_escape_string($conn, $todolist->name);

  $todolist->color = stripslashes($_REQUEST['color']);
  $todolist->color = mysqli_real_escape_string($conn, $todolist->color);

 

    $todolist->UpdateToDolist($todolist->id,$todolist->name,$todolist->color,$conn);
}


if(isset($_POST["submit"])) {

  $todolist = new TODOLIST();

  $todolist->name = stripslashes($_REQUEST['task']);
  $todolist->name = mysqli_real_escape_string($conn, $todolist->name); 

  $todolist->color = stripslashes($_REQUEST['color']);
  $todolist->color = mysqli_real_escape_string($conn, $todolist->color);

  $todolist->user_id = $_SESSION['id'];
  



$query = "INSERT into `todolist` (name, color, user_id)
VALUES ('$todolist->name', '$todolist->color', '$todolist->user_id')";

  $res = mysqli_query($conn, $query);
    

  }

  


  if(isset($_POST["addtask"])) {

    $idtask = $_POST['idtask'];
  
    $task = new TASK(); 
  
    $task->taskText = stripslashes($_REQUEST['tasktext']);
    $task->taskText = mysqli_real_escape_string($conn, $task->taskText); 
  
    $task->done = FALSE;
  
    $query = "INSERT into `task` (taskText, done, todolist_id)
    VALUES ('$task->taskText', '$task->done', '$idtask')";
  
    $res = mysqli_query($conn, $query);

    header("Location: task.php?idtask=$idtask");

      
  
    }




    if(isset($_POST["edittask"])){
        $task = new TASK();
        $idtask = $_POST['taskid'];
    
      $task->id = $_POST['idupd'];
    
    
      $task->name = stripslashes($_REQUEST['tasktext']);
      $task->name = mysqli_real_escape_string($conn, $task->name);
    
    
    
        $task->ChangeTaskText($idtask,$conn);
    }

?>
























































<!-- BY Ja3Bu9 -->