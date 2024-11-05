<?php 
  session_start();
  require_once '../config.php';
  $id="1234";
  $id = $_SESSION['id'];

  if(isset($_SESSION['id']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = $_POST['title'];
    $desc = $_POST['description'];
   
    $c_id = substr(md5(uniqid(mt_rand(), true)), 0, 10);
    $query = mysqli_query($conn,"INSERT into complaints (C_Id,u_id, title, Description, Reg_time, type) VALUES ('$c_id','$id', '$title','$desc',current_timestamp(), 'suggestion') ");
   
        {
            $feed = "Your suggestion has been expunged to a complaint";
            $selectedRows = mysqli_query($conn, "SELECT * FROM activity WHERE C_Id = '$c_id'");
            $rows = mysqli_num_rows($selectedRows) + 1;
            $activity_id = substr(md5(uniqid(mt_rand(), true)), 0, 10);
            $feedback_from = "f74ff3ecbb";

            $sql = "INSERT INTO activity (feedback, C_Id, activity_number, activity_id, feedback_from) VALUES ('$feed', '$c_id', '$rows', '$activity_id', '$feedback_from')";
            mysqli_query($conn, $sql);
        }
    header("Location:viewSuggestions.php");
  }
  else if(!isset($_SESSION['id'])){
    echo "<script>alert('ID not found')</script>";
    header("Location:../index.html");
}
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint form</title>
    <link rel="stylesheet" href="cstyle.css" />
</head>
<body>
  <div class="container">
    
      <div class="nav">
      <p><a href="../dashboard.php" class="hlink">Resolvio</a></p>
          <a href="../destroy.php" ><button class="logb" >Logout</button></a>
      </div>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post" enctype="multipart/form-data">
        <div>
          <label for="title" >Suggestion</label>
          <input type="text" id="title" name="title" >
        </div>
        
        <div>
          <label for="description">Description</label>
          <textarea id="description" name="description" rows="4" required></textarea>
        </div>
        <div>
          <input type="submit" value="Submit">
        </div>
      </form>
    </div>

</body>
</html>