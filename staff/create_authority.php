<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolvio</title>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="cstyle.css" />
    <style>
     
    </style>
</head>
<body>
<div class="container">
    <div class="forms-container">
        <div class="signin-signup">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="sign-up-form">
                <h2 class="title">Registering Municipal Authority</h2>
                <div class="input-field">
                    <i class="fas fa-signature"></i>
                    <input type="text" placeholder="Authority Name" name="authority_name" id="authority_name" required/>
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="Email" name="authority_email" id="authority_email" required/>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" name="authority_password" id="authority_password" required/>
                </div>
                <input type="submit" class="btn" value="Register" />
            </form>
        </div>
    </div>

    <div class="panels-container">
        <!-- Panel content -->
    </div>
</div>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    require_once('../config.php');


    // Escape user inputs to prevent SQL injection
    $authority_name = mysqli_real_escape_string($conn, $_POST['authority_name']);
    $authority_email = mysqli_real_escape_string($conn, $_POST['authority_email']);
    $authority_password = mysqli_real_escape_string($conn, $_POST['authority_password']);

    // Perform insert query
    $sql = "INSERT INTO staff (staffname, Email, Password) VALUES ('$authority_name', '$authority_email', '$authority_password')";

    if (mysqli_query($conn, $sql)) {
        // Data inserted successfully
        echo "<script>alert('New record created successfully');</script>";
    } else {
        // Error in inserting data
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<script>
    const sign_in_btn = document.querySelector("#sign-in-btn");
    const sign_up_btn = document.querySelector("#sign-up-btn");
    const container = document.querySelector(".container");

    sign_up_btn.addEventListener("click", () => {
        container.classList.add("sign-up-mode");
    });

    sign_in_btn.addEventListener("click", () => {
        container.classList.remove("sign-up-mode");
    });
</script>
</body>
</html>
