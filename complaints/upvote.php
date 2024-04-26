<?php
session_start();
require_once '../config.php';

if (isset($_GET['id'])) {
    $complaintId = $_GET['id'];
    $userId = $_SESSION['id'];

    // Check if the user has already upvoted this complaint
    $checkUpvoteQuery = "SELECT * FROM likes WHERE u_id = '$userId' AND C_Id = '$complaintId'";
    $checkUpvoteResult = mysqli_query($conn, $checkUpvoteQuery);

    if (mysqli_num_rows($checkUpvoteResult) == 0) {
        // If the user hasn't upvoted, insert a new upvote record into the likes table
        $insertUpvoteQuery = "INSERT INTO likes (u_id, C_Id, `like`) VALUES ('$userId', '$complaintId', '1')";
        $insertUpvoteResult = mysqli_query($conn, $insertUpvoteQuery);

        if ($insertUpvoteResult) {
            echo "Upvote successful!";
            header("Location: viewSuggestions.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "You have already upvoted this complaint!";
    }
} else {
    echo "Complaint ID not provided!";
}
?>
