<?php
    session_start();
    require_once '../config.php';
    $trimmedMail =  $_SESSION['email'];
    $id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cstyle.css" />
    <title>Pending Complaints</title>
</head>
<body>
    <div class="container">
        <div class="nav">
            <p><a href="../dashboard.php" class="hlink">Resolvio</a></p>
            <p1>Pending Complaints</p1>
            <a href="../destroy.php" ><button class="logb" >Logout</button></a>
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
                    <th >Staff</th>
                    <th>Status</th>
		        </tr>
	        </thead>
	        <tbody>
                <?php

                    $sql = "SELECT complaints.*, staff.staffname 
                    FROM complaints 
                    JOIN staff ON complaints.staff = staff.staff_id
                    WHERE complaints.u_id = '$id' AND complaints.type != 'suggestion'
                    ORDER BY complaints.reg_time DESC";
                    $result = mysqli_query($conn,$sql);
                    $num = mysqli_num_rows($result);

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
                            <td scope="row" class="tab"><?php echo $row['staffname'] ?></td>
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