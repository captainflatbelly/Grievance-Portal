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
    <link rel="stylesheet" type="text/css" href="cstyle.css">
</head>
<body>
    <h2>Assign Staff to Complaint</h2>
    <?php if(isset($row)) { ?>
    <p>Complaint ID: <?php echo $row['C_Id']; ?></p>
    <p>Category: <?php echo $row['Category']; ?></p>
    <p>Location: <?php echo $row['Location']; ?></p>
    <p>Priority: <?php echo $row['Priority']; ?></p>
    <p>Description: <?php echo $row['Description']; ?></p>
    <?php } ?>
    <form method="post">
        <label for="staff">Select Staff:</label>
        <select name="staff" id="staff">
            <?php echo $options; ?>
        </select>
        <input type="submit" value="Assign Staff">
    </form>
</body>
</html>
