<?php 
    session_start();
    require_once '../config.php';

    // Fetch counts of different types of complaints
    $result = mysqli_query($conn, "SELECT * FROM complaints");
    $num = mysqli_num_rows($result);

    $result1 = mysqli_query($conn, "SELECT * FROM complaints WHERE status='Resolved'");
    $num1 = mysqli_num_rows($result1);
    
    $result2 = mysqli_query($conn, "SELECT * FROM complaints WHERE status='Pending'");
    $num2 = mysqli_num_rows($result2);
    
    $result3 = mysqli_query($conn, "SELECT * FROM complaints WHERE Priority='High'");
    $num3 = mysqli_num_rows($result3);
    
    $result4 = mysqli_query($conn, "SELECT * FROM complaints WHERE staff='Unassigned' AND status='Pending'");
    $num4 = mysqli_num_rows($result4);
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
            <!-- <div class="complaint-count">
                <p>All Complaints: <?php echo $num; ?></p>
                <p>Resolved Complaints: <?php echo $num1; ?></p>
                <p>Pending Complaints: <?php echo $num2; ?></p>
                <p>High Priority Complaints: <?php echo $num3; ?></p>
                <p>Unassigned Complaints: <?php echo $num4; ?></p>
            </div> -->
            <a href="../destroy.php">
                <button class="logb">Logout</button>
            </a>
        </div>
        <div class="content">
            <div class="con-updates">
                <p>Complaint Id <i class="fas fa-angle-down"></i></p>
                <p>Category <i class="fas fa-angle-down"></i></p>
                <p>Location <i class="fas fa-angle-down"></i></p>
                <p>Priority <i class="fas fa-angle-down"></i></p>
                <p>Year <i class="fas fa-angle-down"></i></p>
                <p>Date <i class="fas fa-angle-down"></i></p>
                <p>Staff <i class="fas fa-angle-down"></i></p>
                <p>Status <i class="fas fa-angle-down"></i></p>
            </div>
            <table class="com-table">
                <thead>
                    <tr>
                        <th>Complaint ID</th>
                        <th>Mobile No.</th>
                        <th>Category</th>
                        <th>Location</th>
                        <th>Priority</th>
                        <th>Description</th>
                        <th>Time of Registration</th>
                        <th>Staff</th>
                        <th colspan="2">Status</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once '../config.php';
                        $em = $_SESSION['name'];
                        $sql = "SELECT * FROM complaints";
                        $result = mysqli_query($conn, $sql);
                        $num = mysqli_num_rows($result);

                        while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td class="tab"><a href="assign.php?id=<?php echo $row['C_Id']; ?>"><button class='alress'><?php echo $row['C_Id']; ?></button></a></td>
                        <td class="tab"><?php echo $row['Mob'] ?></td>
                        <td class="tab"><?php echo $row['Category'] ?></td>
                        <td class="tab"><?php echo $row['Location'] ?></td>
                        <td class="tab"><?php echo $row['Priority'] ?></td>
                        <td class="tab"><?php echo $row['Description'] ?></td>
                        <td class="tab"><?php echo $row['Reg_time'] ?></td>
                        <td class="tab"><?php echo $row['staff'] ?></td>
                        <td class="tab"><?php echo $row['status'] ?></td>
                        
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
 </body>
</html> 