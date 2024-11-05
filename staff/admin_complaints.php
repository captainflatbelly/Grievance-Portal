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
            
            <a href="../destroy.php">
                <button class="logb">Logout</button>
            </a>
        </div>
        <div class="content">
            
            <table class="com-table">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Mobile No.</th>
                        <th>Category</th>
                        <th>Location</th>
                        <th>Priority</th>
                        <th>Description</th>
                        <th>Time of Registration</th>
                        <th>Staff</th>
                        <th>File</th>
                        <th colspan="2">Status</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once '../config.php';
                        $em = $_SESSION['name'];
                        $sql = "SELECT complaints.*, staff.staffname 
                                FROM complaints 
                                LEFT JOIN staff ON complaints.staff = staff.staff_id 
                                WHERE type!='suggestion' 
                                ORDER BY reg_time DESC";
                        $result = mysqli_query($conn, $sql);
                        $num = mysqli_num_rows($result);
                        
                        while ($row = mysqli_fetch_array($result)) {
                            $flag = ($row['staff'] == 'TBD')?'Assign Department':'Reassign Department';
                    ?>
                    <tr>
                        <td class="tab"><a href="assign.php?id=<?php echo $row['C_Id']; ?>"><button class='alress'><?php echo $flag; ?></button></a></td>
                        <td class="tab"><?php echo $row['Mob'] ?></td>
                        <td class="tab"><?php echo $row['Category'] ?></td>
                        <td class="tab"><?php echo $row['Location'] ?></td>
                        <td class="tab"><?php echo $row['Priority'] ?></td>
                        <td class="tab"><?php echo $row['Description'] ?></td>
                        <td class="tab"><?php echo $row['Reg_time'] ?></td>
                        <td scope="row" class="tab"><?php echo $row['staffname'] ? $row['staffname'] : 'Not Assigned' ?></td>
                        <td scope="row" class="tab">
                            <?php if ($row['image'] != 'No File' && !empty($row['image'])): ?>
                                <a href="../images/<?php echo $row['image']; ?>" target="_blank"><button class='alress'>View File</button></a>
                            <?php else: ?>
                                No File
                            <?php endif; ?>
                        </td>
                        <td class="tab"><?php echo $row['status'] ?></td>
                        
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
 </body>
</html>
