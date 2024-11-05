<?php
session_start();
require_once '../config.php';

// Check if session variables are set
if(!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
    header("Location:../index.html");
    echo "Session variables not set. Please login again.";
    exit; // Stop further execution
}

$trimmedMail = $_SESSION['email'];
$id = $_SESSION['id'];

// Fetch complaints
$sql = "SELECT complaints.*, staff.staffname 
        FROM complaints 
        LEFT JOIN staff ON complaints.staff = staff.staff_id
        WHERE complaints.u_id = '$id' AND complaints.type = 'complaint' AND complaints.status = 'pending'
        ORDER BY complaints.reg_time DESC";

$result = mysqli_query($conn, $sql);

if(!$result) {
    echo "Error fetching complaints: " . mysqli_error($conn);
    exit; // Stop further execution
}

$num = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="staff.css" />
    <title>Pending Complaints</title>
</head>
<body>
    <div class="container">
        <div class="nav flex">
            <p><a href="../dashboard.php" class="custom-link">Resolvio</a></p>
            <p>Pending Complaints</p>
            <a href="../destroy.php"><button class="logb">Logout</button></a>
        </div>
        <table class="com-table">
	        <thead>
		        <tr>
                    <th>Actions</th>
                    <th>Mobile No.</th>
                    <th>Category</th>
                    <th>Location</th>
                    <th>Priority</th>
                    <th>Description</th>
                    <th>Time of Registration</th>
                    <th>Staff</th>
                    <th>File</th>
                    <th>Status</th>
		        </tr>
	        </thead>
	        <tbody>
            <?php
                while($row = mysqli_fetch_array($result)){
            ?>
                <tr>
                    <td class="tab"><a href="viewFeedback.php?id=<?php echo $row['C_Id']; ?>"><button class='alress'>View Status History</button></a></td>
                    <td scope="row" class="tab"><?php echo $row['Mob'] ?></td>
                    <td scope="row" class="tab"><?php echo $row['Category'] ?></td>
                    <td scope="row" class="tab"><?php echo $row['Location'] ?></td>
                    <td scope="row" class="tab"><?php echo $row['Priority'] ?></td>
                    <td scope="row" class="tab"><?php echo $row['Description'] ?></td>
                    <td scope="row" class="tab"><?php echo $row['Reg_time'] ?></td>
                    <td scope="row" class="tab"><?php echo $row['staffname'] ? $row['staffname'] : 'Not Assigned' ?></td>
                    <td scope="row" class="tab">
                        <?php if ($row['image'] != 'No File' && !empty($row['image'])): ?>
                            <a href="../images/<?php echo $row['image']; ?>" target="_blank"><button class='alress'>View File</button></a>
                        <?php else: ?>
                            No File
                        <?php endif; ?>
                    </td>
                    <td scope="row" class="tab"><?php echo $row['status'] ?></td>
                </tr>
            <?php    
                }
            ?>
            </tbody>
	    </table>
    </div>
</body>
</html>
