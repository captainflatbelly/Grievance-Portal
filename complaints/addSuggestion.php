<?php 
session_start();
require_once '../config.php';

// Debug: Print session ID
echo "Session ID: " . session_id() . "<br>";

$id = "1234"; // Default value
if(isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
}

echo "User ID: " . $id . "<br>";

if(isset($_SESSION['id']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
    echo "Inside POST request handling<br>";
    $title = $_POST['title'];
    $desc = $_POST['description'];

    // Debug: Print title and description
    echo "Title: " . $title . "<br>";
    echo "Description: " . $desc . "<br>";

    $c_id = substr(md5(uniqid(mt_rand(), true)), 0, 10);
    $query = mysqli_query($conn,"INSERT into complaints (C_Id,u_id, title, Description, Reg_time, type) VALUES ('$c_id','$id', '$title','$desc',current_timestamp(), 'suggestion') ");
    echo "<script>alert('ID not found')</script>";
    header("Location:viewSuggestions.php");
  }
  else
  {
    echo "<script>alert('ID not found') $id;</script>";
  }
  

?>

    // Debug: Check if query executed successfully
    if($query) {
        echo "Complaint added successfully<br>";
    } else {
        echo "Error: " . mysqli_error($conn) . "<br>";
    }

    // Redirect user
    header("Location:viewSuggestions.php");
    exit;
} else {
    echo "ID not found<br>";
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

      <form action="<?php echo "returning to itself"; echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post" enctype="multipart/form-data">
        <div>
          <label for="title">Suggestion</label>
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