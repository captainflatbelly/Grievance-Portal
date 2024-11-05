<?php 
    session_start();
    require_once '../config.php';
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        
        
        <div class="dash-main">
            <div class="dash-img">
                <img src="../img/form.jpg" alt="img" >
            </div>
            <div class="dash-all">
                <p><a href="admin_complaints.php">View Complaints</a></p>
                <p><a href="create_authority.php">Create Authority Account</a></p>
            </div>
        </div>
    </div>
</body>
</html>


