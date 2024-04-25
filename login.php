<?php

require_once 'config.php';

session_start();

if (isset($_SESSION['email'])) {
    header('location:dashboard.php');
}
//signup
elseif (isset($_POST['Semail'])) {
    $sname = $_POST['Sname'];
    $sem = $_POST['Semail'];
    $spass = $_POST['Spassword'];
    $usermode = isset($_POST['Suser_type']) ? $_POST['Suser_type'] : 'nai aaya'; // Check if Suser_type is set

    $query1 = "SELECT email FROM users WHERE email = ?";
    $stmt = $conn->prepare($query1);
    $stmt->bind_param("s", $sem);
    $stmt->execute();
    $stmt->store_result();
    $num_rows1 = $stmt->num_rows;
    $stmt->close();

    $query2 = "SELECT Email FROM staff WHERE Email = ?";
    $stmt = $conn->prepare($query2);
    $stmt->bind_param("s", $sem);
    $stmt->execute();
    $stmt->store_result();
    $num_rows2 = $stmt->num_rows;
    $stmt->close();

    // If user already exists, redirect
    if ($num_rows1 > 0 || $num_rows2 > 0) {
        header('location:./alreadyexists.php');
        exit;
    }

    $sid = substr(md5(uniqid(mt_rand(), true)), 0, 10);
    if ($usermode == 'user') {
        $query = "INSERT INTO users (u_id, username, email, upassword, joining_date) VALUES (?, ?, ?, ?, current_timestamp())";
    } else {
        $query = "INSERT INTO staff (staff_id, staffname, Email, Password, joining_date) VALUES (?, ?, ?, ?, current_timestamp())";
    }
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $sid, $sname, $sem, $spass);
    $stmt->execute();
    $stmt->close();
    header('location:./');
    session_destroy();
}
//login
elseif (isset($_POST['Lemail'])) {
    $lem = $_POST['Lemail'];
    $lpass = $_POST['Lpassword'];
    $usermode = isset($_POST['Luser_type']) ? $_POST['Luser_type'] : 'nai aaya'; // Check if Suser_type is set
    if ($lem == 'admin@db' && $lpass == '1234') {
        $_SESSION['email'] = $lem;
        $_SESSION['id'] = 'adminID';
        $_SESSION['name'] = 'Admin';
        header('location:/staff/admin.php');
        return;
    }
    $query = "SELECT email, upassword FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $lem);
    $stmt->execute();
    $stmt->bind_result($dbemail, $dbpassword);
    $stmt->fetch();
    $stmt->close();
    $query3 = "SELECT u_id FROM users WHERE email = ?";
    $stmt = $conn->prepare($query3);
    //$email = "example@example.com";
    $stmt->bind_param("s", $lem);
    $stmt->execute();
    $stmt->bind_result($userId);
    if ($stmt->fetch()) {
        $_SESSION['id'] = $userId;
    } else {
        $resultUserId = null;
    }
    $stmt->close();
    if ($dbemail == $lem && $dbpassword == $lpass) {
        session_start();
        $_SESSION['id'] = $userId;
        $_SESSION['email'] = $lem;

        header('location:dashboard.php');
    } elseif ($usermode == 'staff') {

        $query3 = "SELECT staff_id FROM staff WHERE Email = ?";
        $stmt = $conn->prepare($query3);

        $stmt->bind_param("s", $lem);
        $stmt->execute();
        $stmt->bind_result($staffId);
        if ($stmt->fetch()) {
            $resultStaffId = $staffId;
        } else {
            $resultStaffId = null;
        }
        $stmt->close();
        $query1 = "SELECT Email, Password FROM staff WHERE Email = ?";
        $stmt = $conn->prepare($query1);
        $stmt->bind_param("s", $lem);
        $stmt->execute();
        $stmt->bind_result($dbemail1, $dbpassword1);
        $stmt->fetch();
        $stmt->close();

        if ($dbemail1 == $lem && $dbpassword1 == $lpass) {

            $query2 = "SELECT staffname FROM staff WHERE Email = ?";
            $stmt = $conn->prepare($query2);
            $stmt->bind_param("s", $dbemail1);
            $stmt->execute();
            $stmt->bind_result($dbname);
            $stmt->fetch();
            $stmt->close();

            session_start();

            $_SESSION['id'] = $staffId;
            $_SESSION['email'] = $lem;
            $_SESSION['name'] = $dbname;
            header('location:./staff/staff.php');
        }
    } else {

        if ($dbemail == null) {

?>


            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
                <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
                <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
                <title>Unsuccessful</title>
                <style>
                    body {
                        background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABZ0RVh0Q3JlYXRpb24gVGltZQAxMC8yOS8xMiKqq3kAAAAcdEVYdFNvZnR3YXJlAEFkb2JlIEZpcmV3b3JrcyBDUzVxteM2AAABHklEQVRIib2Vyw6EIAxFW5idr///Qx9sfG3pLEyJ3tAwi5EmBqRo7vHawiEEERHS6x7MTMxMVv6+z3tPMUYSkfTM/R0fEaG2bbMv+Gc4nZzn+dN4HAcREa3r+hi3bcuu68jLskhVIlW073tWaYlQ9+F9IpqmSfq+fwskhdO/AwmUTJXrOuaRQNeRkOd5lq7rXmS5InmERKoER/QMvUAPlZDHcZRhGN4CSeGY+aHMqgcks5RrHv/eeh455x5KrMq2yHQdibDO6ncG/KZWL7M8xDyS1/MIO0NJqdULLS81X6/X6aR0nqBSJcPeZnlZrzN477NKURn2Nus8sjzmEII0TfMiyxUuxphVWjpJkbx0btUnshRihVv70Bv8ItXq6Asoi/ZiCbU6YgAAAABJRU5ErkJggg==);
                    }

                    .error-template {
                        padding: 40px 15px;
                        text-align: center;
                    }

                    .error-actions {
                        margin-top: 15px;
                        margin-bottom: 15px;
                    }

                    .error-actions .btn {
                        margin-right: 10px;
                    }
                </style>
            </head>


            <body>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="error-template">
                                <h1>
                                    Oops!</h1>
                                <h2>
                                    404 Not Found</h2>
                                <div class="error-details">
                                    Theres no account with this Email. Sign-in!!
                                </div>
                                <div class="error-actions">
                                    <a href="index.html" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                                        Take Me Home </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    alert("Theres no account with this Email. Sign-in");
                </script>
            </body>

            </html>
        <?php } else { ?>
            <!DOCTYPE html>
            <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
            <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
            <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
            <title>Unsuccessful</title>
            <style>
                body {
                    background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABZ0RVh0Q3JlYXRpb24gVGltZQAxMC8yOS8xMiKqq3kAAAAcdEVYdFNvZnR3YXJlAEFkb2JlIEZpcmV3b3JrcyBDUzVxteM2AAABHklEQVRIib2Vyw6EIAxFW5idr///Qx9sfG3pLEyJ3tAwi5EmBqRo7vHawiEEERHS6x7MTMxMVv6+z3tPMUYSkfTM/R0fEaG2bbMv+Gc4nZzn+dN4HAcREa3r+hi3bcuu68jLskhVIlW073tWaYlQ9+F9IpqmSfq+fwskhdO/AwmUTJXrOuaRQNeRkOd5lq7rXmS5InmERKoER/QMvUAPlZDHcZRhGN4CSeGY+aHMqgcks5RrHv/eeh455x5KrMq2yHQdibDO6ncG/KZWL7M8xDyS1/MIO0NJqdULLS81X6/X6aR0nqBSJcPeZnlZrzN477NKURn2Nus8sjzmEII0TfMiyxUuxphVWjpJkbx0btUnshRihVv70Bv8ItXq6Asoi/ZiCbU6YgAAAABJRU5ErkJggg==);
                }

                .error-template {
                    padding: 40px 15px;
                    text-align: center;
                }

                .error-actions {
                    margin-top: 15px;
                    margin-bottom: 15px;
                }

                .error-actions .btn {
                    margin-right: 10px;
                }
            </style>
            </head>


            <body>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="error-template">
                                <h1>
                                    Oops!</h1>
                                <h2>
                                    404 Not Found</h2>
                                <div class="error-details">
                                    Sorry, Incorrect Username or Password!!
                                </div>
                                <div class="error-actions">
                                    <a href="index.html" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                                        Take Me Home </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    alert("Incorrect Username or Password");
                </script>

            </body>

            </html>

<?php
        }
        //header ('location:./alreadyexists');    
    }
}

?>