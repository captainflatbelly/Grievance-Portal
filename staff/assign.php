<?php 
require_once '../config.php';

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM complaints WHERE C_Id = '$id'";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0) {
        $sql = "SELECT staff_id, staffname FROM staff";
        $staff_result = mysqli_query($conn, $sql);

        // Step 3: Generate HTML options
        $options = "";
        if (mysqli_num_rows($staff_result) > 0) {
            while ($row = mysqli_fetch_assoc($staff_result)) {
                $options .= "<option value='" . $row['staff_id'] . "'>" . $row['staffname'] . "</option>";
            }
        }

        $row = mysqli_fetch_assoc($result);
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['staff'])) {
            $staffId = mysqli_real_escape_string($conn, $_POST['staff']);
            $updateSql = "UPDATE complaints SET staff = '$staffId' WHERE C_Id = '$id'";
            if (mysqli_query($conn, $updateSql)) {
                echo "Staff assigned successfully.";
                header('Location: admin.php');
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Complaint not found.";
    }
} else {
    echo "Invalid request.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Staff</title>
    <link rel="stylesheet" href="staff.css">
</head>
<body>
    
    <div class="container">
    <div class="nav">
            <p>Resolvio</p>
            <a href="../destroy.php" >
                <button class="logb" >
                    Logout
                </button>
            </a>
        </div>
        <div>
    </div>
    <div class="container2">
        
            <h2 class="title">Assign Staff to Complaint</h2>
            <?php if(isset($row)) { ?>
            <div class="complaint-details">
            <p class="detail"><strong>Complaint ID:</strong> <?php echo $row['C_Id']; ?></p>
            <p class="detail"><strong>Category:</strong> <?php echo $row['Category']; ?></p>
            <p class="detail"><strong>Location:</strong> <?php echo $row['Location']; ?></p>
            <p class="detail"><strong>Priority:</strong> <?php echo $row['Priority']; ?></p>
            <p class="detail"><strong>Description:</strong> <?php echo $row['Description']; ?></p>
            </div>
            <?php } ?>
            <form method="post" class="form">
            <label for="staff" class="label">Select Staff:</label>
            <select name="staff" id="staff" class="select">
                <?php echo $options; ?>
            </select>
            <input type="submit" value="Assign Staff" class="button">
            </form>
        </div>
    </div>
</body>
</html>
