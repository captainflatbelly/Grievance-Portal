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
    <title>Suggestions</title>
</head>
<body>
    <div class="container">
        <div class="nav" >
            <p><a href="../dashboard.php" class="hlink">VoxFlow</a></p>
            <p1>Suggestions</p1>
            
            <a href="../destroy.php" ><button class="logb" >Logout</button></a>
            
    </a>
        </div>
        <div style="width: 100%; margin-top: 10px; margin-bottom: 10px; display: flex; justify-content: flex-end; align-items: center">
        <a href="viewMySuggestions.php"><button class="sugg">My Suggestions</button></a></div>
        <table class="com-table">
	        <thead>
		        <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Posted by</th>
                    <th >Upvotes</th>
		        </tr>
	        </thead>
	        <tbody>
                <?php

                    $sql = "SELECT * FROM complaints where type='suggestion' order by reg_time desc";
                    $result = mysqli_query($conn,$sql);
                    $num = mysqli_num_rows($result);

                    while($row = mysqli_fetch_array($result)){
                ?>
                        <tr>
                            
                            <td scope="row" class="id"><?php echo $row['title'] ?></td>
                            <td scope="row" class="tab"><?php echo $row['Description'] ?></td>
                            <td scope="row" class="tab"><?php echo $row['u_id'] ?></td>
                            <td scope="row" class="tab"><?php echo $row['upvotes'] ?></td>
                            <td scope="row" class="tab"><a href="suggestionToComplaint.php?id=<?php echo $row['C_Id']; ?>"><button>File Suggestion</button></td>
                            
                        </tr>
                <?php	
                    }


                ?>
            </tbody>
	    </table>
    </div>
</body>
</html>