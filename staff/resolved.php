<?php 
require_once '../config.php';

// Check if connection is established
if($conn){
    // If connection is established, show alert message
    ?>
    <script>
        alert('COMPLAINT RESOLVED successfully !!!');
    </script>
    <?php
} else {
    // If connection is not established, show error message and terminate script
    die("No Connection" . mysqli_connect_error());
}

// Get the complaint ID from the URL parameter
$id = $_GET['id'];

// Prepare the SQL query with a placeholder for the complaint ID
$resolvequery = mysqli_prepare($conn, "UPDATE complaints SET status = 'Resolved' WHERE `C_Id` = ?");
if ($resolvequery) {
    // Bind the complaint ID parameter to the prepared statement
    mysqli_stmt_bind_param($resolvequery, "s", $id);
    
    // Execute the prepared statement
    mysqli_stmt_execute($resolvequery);

    // Close the prepared statement
    mysqli_stmt_close($resolvequery);
    
    // Redirect to the admin page
    header('location: sreso.php');
} else {
    // If there's an error in preparing the statement, display an error message
    echo "Error in preparing the statement: " . mysqli_error($conn);
}
?>
