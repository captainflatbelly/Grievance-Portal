<?php 
session_start();
require_once '../config.php';
$id = "1234";
$id = $_SESSION['id'];

if (isset($_SESSION['id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $mob = $_POST['mobile'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $loc = $_POST['location'];
    $priority = $_POST['priority'];
    $desc = $_POST['description'];
    $em = $_SESSION['email'];
    $type = 'complaint';
    $c_id = substr(md5(uniqid(mt_rand(), true)), 0, 10);

    $fileName = $_FILES['image']['name'];
    $fileTempName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];

    // Get the file extension
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    
    // Remove the file extension from the original file name
    $fileNameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
    
    // Append $c_id to the file name without the extension and then add the extension back
    $newFileName = $fileNameWithoutExtension . '_' . $c_id . '.' . $fileExtension;
    $folder = '../images/' . $newFileName;
    $maxFileSizeMB = 10; // Set the desired file size limit in MB
    $maxFileSizeBytes = $maxFileSizeMB * 1024 * 1024;

    // Measure the start time for the upload process
    $uploadStartTime = microtime(true);

    // Write an if condition to execute the below only if a file is being uploaded, it is not mandatory
    if (!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
        $query = mysqli_query($conn, "INSERT into complaints (title, C_Id, u_id, Mob, Category, Location, Priority, Description, type, Reg_time, image) VALUES ('$title','$c_id','$id','$mob','$category','$loc','$priority','$desc','$type',current_timestamp(), 'No File')");
        if ($query) {
            $feed = "A complaint has been filed by user.";
            $selectedRows = mysqli_query($conn, "SELECT * FROM activity WHERE C_Id = '$c_id'");
            $rows = mysqli_num_rows($selectedRows) + 1;
            $activity_id = substr(md5(uniqid(mt_rand(), true)), 0, 10);
            $feedback_from = "f74ff3ecbb";

            $sql = "INSERT INTO activity (feedback, C_Id, activity_number, activity_id, feedback_from) VALUES ('$feed', '$c_id', '$rows', '$activity_id', '$feedback_from')";
            mysqli_query($conn, $sql);
        }
        echo "<h2>Complaint Registered Successfully</h2>";
    } else if ($fileSize > $maxFileSizeBytes) {
        echo "<script>alert('File size is too large');</script>";
        exit;
    } else if (move_uploaded_file($fileTempName, $folder)) {
        // Measure the end time for the upload process
        $uploadEndTime = microtime(true);

        // Calculate the response time
        $uploadResponseTime = $uploadEndTime - $uploadStartTime;

        // Log the upload response time to a file
        $logFile = './upload_times.log';
        $logEntry = date('Y-m-d H:i:s') . " - Image upload time: " . ($uploadResponseTime * 1000) . " ms\n";
        file_put_contents($logFile, $logEntry, FILE_APPEND);

        $query = mysqli_query($conn, "INSERT into complaints (title, C_Id, u_id, Mob, Category, Location, Priority, Description, type, Reg_time, image) VALUES ('$title','$c_id','$id','$mob','$category','$loc','$priority','$desc','$type',current_timestamp(), '$newFileName')");
        if ($query) {
            $feed = "A complaint has been filed by user.";
            $selectedRows = mysqli_query($conn, "SELECT * FROM activity WHERE C_Id = '$c_id'");
            $rows = mysqli_num_rows($selectedRows) + 1;
            $activity_id = substr(md5(uniqid(mt_rand(), true)), 0, 10);
            $feedback_from = "f74ff3ecbb";

            $sql = "INSERT INTO activity (feedback, C_Id, activity_number, activity_id, feedback_from) VALUES ('$feed', '$c_id', '$rows', '$activity_id', '$feedback_from')";
            mysqli_query($conn, $sql);
        }
        echo "<h2>Complaint Registered Successfully</h2>";
    } else {
        echo "<script>alert('File not uploaded');</script>";
    }

    header("Location:pencom.php");
} else if (!isset($_SESSION['id'])) {
    echo "<script>alert('ID not found')</script>";
    header("Location:../index.html");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint form</title>
    <link rel="stylesheet" href="cstyle.css">
</head>
<body>
    <div class="container">
        <div class="nav">
            <p><a href="../dashboard.php" class="hlink">Resolvio</a></p>
            <a href="../destroy.php"><button class="logb">Logout</button></a>
        </div>

        <form action="cform.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="mobile">Mobile Number</label>
                <input type="tel" id="mobile" name="mobile">
            </div>
            <div>
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Academic-Issues">Academic Issues</option>
                    <option value="Administrative-Issues">Administrative Issues</option>
                    <option value="Faculty-related-Issues">Faculty-related Issues</option>
                    <option value="Facilities & Infrastructure">Facilities & Infrastructure</option>
                    <option value="Discrimination & Harassment">Discrimination & Harassment</option>
                    <option value="Financial Matters">Financial Matters</option>
                    <option value="Admission and Recruitment">Admission and Recruitment</option>
                    <option value="Safety & Security">Safety & Security</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div>
                <label for="location">Location</label>
                <input type="text" id="location" name="location">
            </div>
            <div>
                <label for="priority">Priority Level</label>
                <select id="priority" name="priority" required>
                    <option value="">Select Priority</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
            </div>
            <div>
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div>
                <label for="image">Upload Image</label>
                <input type="file" id="image" name="image">
            </div>
            <div>
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>
