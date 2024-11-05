<?php
session_start();
if(!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
    header("Location:../index.html");
    echo "Session variables not set. Please login again.";
    exit; // Stop further execution
}
require_once '../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adminboard</title>
    <link rel="stylesheet" href="cstyle.css">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="staff.css" />
</head>
<body>
    <div class="container">
        <div class="nav">
            <p>Resolvio</p>
            <p>Status History</p>
            <a href="../destroy.php">
                <button class="logb">Logout</button>
            </a>
        </div>
        <div class="content">
            
            <table class="com-table">
                <thead>
                    <tr>
                        <th>Serial Number </th>
                        <th>Title</th>
                        <th>Description</th>
                        
                        <th>Department</th>
                        <th>Time</th>
                         
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once '../config.php';
                      
                        if(isset($_GET['id'])) {
                            $complaintId = $_GET['id'];
                        } else {
                            header("Location: error.php");
                            exit;
                        }
                       
                        $sql = "SELECT activity.*, staff.staffname 
                                FROM activity 
                                JOIN staff ON activity.feedback_from = staff.staff_id
                                WHERE activity.C_Id = '$complaintId'";
                        $result = mysqli_query($conn, $sql);
                        $num = mysqli_num_rows($result);

                        // Fetch the title from the complaints table
                        $sqlTitle = "SELECT title FROM complaints WHERE C_Id = '$complaintId'";
                        $resultTitle = mysqli_query($conn, $sqlTitle);
                        $rowTitle = mysqli_fetch_array($resultTitle);
                        $title = $rowTitle['title'];

                        while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td class="tab"><?php echo $row['activity_number'] ?></td>
                        <td class="tab"><?php echo $title ?></td>
                        <td class="tab"><?php echo $row['feedback'] ?></td>
                        <td class="tab"><?php echo $row['staffname'] ?></td>
                        <td class="tab"><?php echo $row['ftime'] ?></td> 
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
 </body>
</html>
