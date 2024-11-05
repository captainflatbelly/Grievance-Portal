<?php
session_start();
require_once '../config.php';
if(!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
    header("Location:../index.html");
    echo "Session variables not set. Please login again.";
    exit; 
}
if (isset($_GET['id'])) {
    $complaintId = $_GET['id'];
    $userId = $_SESSION['id'];


    $checkUpvoteQuery = "SELECT * FROM likes WHERE u_id = '$userId' AND C_Id = '$complaintId'";
    $checkUpvoteResult = mysqli_query($conn, $checkUpvoteQuery);

    if (mysqli_num_rows($checkUpvoteResult) == 0) {

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
} 
?>
