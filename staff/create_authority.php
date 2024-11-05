<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolvio</title>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="staff.css" />
    
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
            <div>
    </div>
    <div class="container2">
        <div class="forms-container">
        <div class="signin-signup">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="sign-up-form form">
            <h2 class="title">Registering Municipal Authority</h2>
            <div class="form-group">
                <label for="authority_name" class="label">Authority Name</label>
                <input type="text" class="form-control input" name="authority_name" id="authority_name" placeholder="Enter name" required />
            </div>
            <div class="form-group">
                <label for="authority_email" class="label">Email address</label>
                <input type="email" class="form-control input" name="authority_email" id="authority_email" placeholder="Enter email" required />
            </div>
            <div class="form-group">
                <label for="authority_password" class="label">Password</label>
                <input type="password" class="form-control input" name="authority_password" id="authority_password" placeholder="Password" required />
            </div>
            <button type="submit" class="btn btn-primary button">Submit</button>
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

        $sid = substr(md5(uniqid(mt_rand(), true)), 0, 10);
        // Perform insert query
        $sql = "INSERT INTO staff (staff_id,staffname, Email, Password) VALUES ('$sid','$authority_name', '$authority_email', '$authority_password')";

        if (mysqli_query($conn, $sql)) {
            // Data inserted successfully
            echo "<script>alert('New record created successfully');</script>";
        } else {
            // Error in inserting data
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
        
        // Close the database connection
        mysqli_close($conn);
        header("Location:admin.php");
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