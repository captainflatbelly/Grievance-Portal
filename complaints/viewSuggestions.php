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
<<<<<<< HEAD
        <div class="nav">
            <p><a href="../dashboard.php" class="hlink">Resolvio</a></p>
            <p1>Suggestions</p1>
            <a href="viewMySuggestions.php"><button>My Suggestions</button></a>
=======
        <div class="nav" >
            <p><a href="../dashboard.php" class="hlink">VoxFlow</a></p>
            <p1>Suggestions</p1>
            
>>>>>>> refs/remotes/origin/main
            <a href="../destroy.php" ><button class="logb" >Logout</button></a>
        </div>
        <div style="width: 100%; margin-top: 10px; margin-bottom: 10px; display: flex; justify-content: flex-end; align-items: center">
        <a href="viewMySuggestions.php"><button class="sugg">My Suggestions</button></a></div>
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
                        $checkUpvoteQuery = "SELECT * FROM likes WHERE u_id = '$id' AND C_Id = '{$row['C_Id']}'";
                        $checkUpvoteResult = mysqli_query($conn, $checkUpvoteQuery);
                        $alreadyUpvoted = mysqli_num_rows($checkUpvoteResult) > 0;

                        // Output the suggestion row
                        echo "<tr>";
                        echo "<td>{$row['title']}</td>";
                        echo "<td>{$row['Description']}</td>";
                        echo "<td>{$row['u_id']}</td>";
                        echo "<td>{$row['upvotes']}</td>";
                        echo "<td>";
                        if (!$alreadyUpvoted) {
                            // Display upvote button if the user hasn't upvoted
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
