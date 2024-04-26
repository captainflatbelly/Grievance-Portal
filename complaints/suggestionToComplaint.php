 
<?php 
session_start();
require_once '../config.php';

$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
//$id_get = isset($_GET['id']) ? $_GET['id'] : null;



// if(!$id || !$id_get) {
//     echo "<script>alert('ID not found');</script>";
//     exit; // Stop further execution
// }

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mob = $_POST['mobile'];
    $category = $_POST['category'];
    $loc = $_POST['location'];
    $priority = $_POST['priority'];
    $id_get = $_POST['id_get'];
    $desc = ""; // Initialize $desc variable

    // Fetch description from database based on $id_get
    $query = "SELECT Description FROM complaints WHERE C_Id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id_get);
    $stmt->execute();
    $stmt->bind_result($desc);
    $stmt->fetch();
    $stmt->close();

    // Update the row in complaints table
    $query = "UPDATE complaints 
              SET u_id = ?, Mob = ?, Category = ?, Location = ?, Priority = ?, Description = ?, Reg_time = current_timestamp(), status = 'Pending', type = 'complaint'
              WHERE C_Id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssss", $id, $mob, $category, $loc, $priority, $desc, $id_get);
    $stmt->execute();
    $stmt->close();

    header("Location: pcom.php");
    exit; // Stop further execution
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
      <a href="../destroy.php"><button class="logb">Logout</button></a>
    </div>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_get" value="<?php echo htmlspecialchars($_GET["id"]); ?>">  
    <div>
        <label for="mobile">Mobile Number: (*optional)</label>
        <input type="tel" id="mobile" name="mobile">
      </div>
      <div>
        <label for="category">Category:</label>
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
        <label for="location">Location: (*optional)</label>
        <input type="text" id="location" name="location">
      </div>
      <div>
        <label for="priority">Priority Level:</label>
        <select id="priority" name="priority" required>
          <option value="">Select Priority</option>
          <option value="High">High</option>
          <option value="Medium">Medium</option>
          <option value="Low">Low</option>
        </select>
      </div>
      <div>
        <input type="submit" value="Submit">
      </div>
    </form>
  </div>
</body>
</html>
