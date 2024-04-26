<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total complaints</title>
    <link rel="stylesheet" href="staff.css">
</head>
<body>
<div class="container">
        <div class="nav">
            <p><a href="staff.php" class="hlink">Resolvio</a></p>
            <p1>All Complaints</p1>
            <a href="../destroy.php" ><button class="logb" >Logout</button></a>
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
                    session_start();
                    $em = $_SESSION['id'];
                    $sql = "SELECT complaints.*, staff.staffname 
                            FROM complaints 
                            JOIN staff ON complaints.staff = staff.staff_id 
                            WHERE complaints.staff = '$em'";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                    while($row = mysqli_fetch_array($result)){
                ?>
                    <tr>
                    <td class="tab"><a href="../complaints/viewFeedback.php?id=<?php echo $row['C_Id']; ?>"><button class='alress'>View Status History</button></a></td>
                         <td scope="row" class="tab"><?php echo $row['Mob'] ?></td>
                        <td scope="row" class="tab"><?php echo $row['Category'] ?></td>
                        <td scope="row" class="tab"><?php echo $row['Location'] ?></td>
                        <td scope="row" class="tab"><?php echo $row['Priority'] ?></td>
                        <td scope="row" class="tab"><?php echo $row['Description'] ?></td>
                        <td scope="row" class="tab"><?php echo $row['Reg_time'] ?></td>
                        <td scope="row" class="tab"><?php echo $row['staffname'] ?></td>
                        <td scope="row" class="tab"><?php echo $row['status'] ?></td>
                        <?php 
                            // Check if status is not "Resolved"
                            if($row['status'] != "resolved"){
                        ?>
                            <td class="tab"><a href="resolved.php?id=<?php echo $row['C_Id'];?>"><button class='ress' >Resolve</button></a></td>
                        <?php
                            }
                        ?>
                    </tr>
                <?php
                    }	
                ?>
            </tbody>
        </table>
</body>
</html>
