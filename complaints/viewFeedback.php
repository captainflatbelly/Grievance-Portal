<?php 
    session_start();
    require_once '../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adminboard</title>
    <link rel="stylesheet" href="staff.css">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
<body>
    <div class="container">
        <div class="nav">
            <p>Resolvio</p>
            <a href="../destroy.php">
                <button class="logb">Logout</button>
            </a>
        </div>
        <div class="content">
            
            <table class="com-table">
                <thead>
                    <tr>
                        <th>Serial Number</th>
                        <th>Title</th>                    
                        <th>Description</th>
                        <th>Complaint ID</th>
                        <th>Department</th>
                        <th>Time</th>
                        
                        <th colspan="2">Status</th> 
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
                        echo $complaintId;
                        $sql = "SELECT * FROM activity where C_Id = '$complaintId'";
                        $result = mysqli_query($conn, $sql);
                        $num = mysqli_num_rows($result);
                        
                        while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td class="tab"><?php echo $row['C_Id'] ?></td>
                        <td class="tab"><?php echo $row['activity_number'] ?></td>
                        <td class="tab"><?php echo $row['feedback'] ?></td>
                        <td class="tab"><?php echo $row['feedback'] ?></td>
                        
                        <td class="tab"><?php echo $row['feedback_from'] ?></td>
                        <td class="tab"><?php echo $row['ftime'] ?></td>
                        
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
 </body>
</html> 