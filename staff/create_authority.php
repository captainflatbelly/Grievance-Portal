<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolvio</title>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" />
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="sign-up-form">
                    <h2 class="title">Registering Municipal Authority</h2>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Authority Name</label>
                        <input type="text" class="form-control" name="authority_name" id="authority_name" aria-describedby="emailHelp" placeholder="Enter name" required />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="authority_email" id="authority_email" aria-describedby="emailHelp" placeholder="Enter email" required />
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="authority_password" id="authority_password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
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