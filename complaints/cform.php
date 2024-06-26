<?php 
  session_start();
  require_once '../config.php';
  $id="1234";
  $id = $_SESSION['id'];

  if(isset($_SESSION['id']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
    $mob = $_POST['mobile'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $loc = $_POST['location'];
    $priority = $_POST['priority'];
    $desc = $_POST['description'];
    $em = $_SESSION['email'];
    $type = 'complaint';
    $c_id = substr(md5(uniqid(mt_rand(), true)), 0, 10);
    $query = mysqli_query($conn,"INSERT into complaints (title, C_Id,u_id, Mob, Category, Location, Priority, Description, type,Reg_time) VALUES ('$title','$c_id','$id','$mob','$category','$loc','$priority','$desc','$type',current_timestamp()) ");

    header("Location:pencom.php");
  }
  else
  {
    echo "<script>alert('ID not found') $id;</script>";
  }
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint form</title>
    <link rel="stylesheet" href="cstyle.css">
</head>
<body>
  <div class="container">
    
      <div class="nav">
      <p><a href="../dashboard.php" class="hlink">Resolvio</a></p>
          <a href="../destroy.php" ><button class="logb" >Logout</button></a>
      </div>

      <form action="cform.php" method="post" enctype="multipart/form-data">
        <div>
          <label for="title">Title</label>
          <input type="text" id="title" name="title" required>
      </div>
        <div>
          <label for="mobile">Mobile Number</label>
          <input type="tel" id="mobile" name="mobile" >
        </div>
        <div>
          <label for="category">Category</label>
          <select id="category" name="category" required>
            <option value="">Select Category</option>
            <option value="Academic-Issues">Academic Issues</option>
            <option value="Administrative-Issues">Administrative Issues</option>
            <option value="Faculty-related-Issues">Faculty-related Issues</option>
            <option value="Facilities & Infrastructure">Facilities & Infrastructure</option>
            <option value="Discrimination & Harassment">Discrimination & Harassment</option>
            <option value="Financial Matters">Financial Matters</option>
            <option value="Admission and Recruitment">Admission and Recruitment</option>
            <option value="Safety & Security">Safety & Security</option>
            <option value="Other">Other</option>
          </select>
        </div>
        <div>
          <label for="location">Location</label>
          <input type="text" id="location" name="location" >
        </div>
        <div>
          <label for="priority">Priority Level</label>
          <select id="priority" name="priority" required>
            <option value="">Select Priority</option>
            <option value="High">High</option>
            <option value="Medium">Medium</option>
            <option value="Low">Low</option>
          </select>
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