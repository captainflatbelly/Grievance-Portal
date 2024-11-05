<?php
    session_start();
    require_once '../config.php';
    if(!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
        header("Location:../index.html");
        echo "Session variables not set. Please login again.";
        exit; // Stop further execution
    }
    $trimmedMail =  $_SESSION['email'];
    $id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="staff.css" />
    <title>Suggestions</title>
</head>
<body>
    <div class="container">
        <div class="nav flex">
            <p><a href="../dashboard.php" class="custom-link">Resolvio</a></p>
            <p>Suggestions</p>
             <a href="viewMySuggestions.php"><button class="logb">My Suggestions</button></a>
            <a href="../destroy.php" ><button class="logb" >Logout</button></a>
        </div>
        
        <table class="com-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Posted by</th>
                    <th>Upvotes</th>
                    <th>Action</th> <!-- New column for upvoting -->
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM complaints WHERE type='suggestion' ORDER BY reg_time DESC";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_array($result)) {
                        // Check if the user has already upvoted this suggestion
                        $postedby_query = mysqli_query($conn, "SELECT username FROM users WHERE u_id = '{$row['u_id']}'");
                        $postedby = mysqli_fetch_assoc($postedby_query)['username'];
                        $checkUpvoteQuery = "SELECT * FROM likes WHERE u_id = '$id' AND C_Id = '{$row['C_Id']}'";
                        $checkUpvoteResult = mysqli_query($conn, $checkUpvoteQuery);
                        $alreadyUpvoted = mysqli_num_rows($checkUpvoteResult) > 0;

                        // Output the suggestion row
                        echo "<tr>";
                        echo "<td>{$row['title']}</td>";
                        echo "<td>{$row['Description']}</td>";
                        echo "<td>{$postedby}</td>";
                        echo "<td>{$row['upvotes']}</td>";
                        echo "<td>";
                        if (!$alreadyUpvoted) {
                            echo "<a href='upvote.php?id={$row['C_Id']}'><button>Upvote</button></a>";
                        } else {
                            echo "Already Upvoted";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
