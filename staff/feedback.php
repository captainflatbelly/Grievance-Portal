<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4;">

    <div style="max-width: 500px; margin: 0 auto; padding: 20px; background-color: #fff; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
        <h2 style="text-align: center; margin-bottom: 20px;">Feedback Form</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
            <div style="margin-bottom: 20px;">
                <label for="feedback" style="display: block; font-size: 16px; margin-bottom: 5px;">Your Feedback:</label>
                <textarea id="feedback" name="feedback" rows="5" style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px;"></textarea>
            </div>

            <div style="text-align: center;">
                <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">Submit Feedback</button>
            </div>
        </form>
    </div>

</body>
</html>

<?php
session_start();
require_once('../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $feeback_from = $_SESSION['id'];
    if (!empty($id)) {
        $feed = mysqli_real_escape_string($conn, $_POST['feedback']);
        $selectedRows = mysqli_query($conn, "SELECT * FROM activity where C_Id = '$id'");
        $rows = mysqli_num_rows($selectedRows) + 1;
        $activity_id = substr(md5(uniqid(mt_rand(), true)), 0, 10);

        $sql = "INSERT INTO activity (feedback, C_Id, activity_number, activity_id, feedback_from) VALUES ('$feed', '$id', '$rows', '$activity_id', '$feeback_from')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('New record created successfully');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('ID not found in form data');</script>";
    }
    header("Location: ../complaints/viewFeedback.php");
    mysqli_close($conn);
}
?>
