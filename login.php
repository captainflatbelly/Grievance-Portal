<?php

    require_once 'config.php';

    session_start();

    if(isset($_SESSION['email'])){
        header ('location:dashboard.php');
    }
    //signup
    elseif(isset($_POST['Semail'])){
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
        if($num_rows1 > 0 || $num_rows2 > 0){
            header('location:./alreadyexists.php');
            exit;
        }
        // $result1 = mysqli_query($conn,"select * from users where email = '$sem'");
        // $result2 = mysqli_query($conn,"select * from staff where Email = '$sem'");
        // echo "Selected user type: " . $usermode;
        // if(mysqli_num_rows($result1)==0 && mysqli_num_rows($result2)==0){
        //     header ('location:./alreadyexists');
        //     return;
        // }   
        if($usermode == 'user') {
            $query = "INSERT INTO users (username, email, upassword, joining_date) VALUES (?, ?, ?, current_timestamp())";
        } else {
            $query = "INSERT INTO staff (staffname, Email, Password, joining_date) VALUES (?, ?, ?, current_timestamp())";
        }
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $sname, $sem, $spass);
        $stmt->execute();
        $stmt->close();
        header ('location:./');
        session_destroy();    
    }
    //login
    elseif(isset($_POST['Lemail'] )){
        $lem = $_POST['Lemail'];
        $lpass = $_POST['Lpassword'];
        $usermode = isset($_POST['Luser_type']) ? $_POST['Luser_type'] : 'nai aaya'; // Check if Suser_type is set

        $query = "SELECT email, upassword FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $lem);
        $stmt->execute();
        $stmt->bind_result($dbemail, $dbpassword);
        $stmt->fetch();
        $stmt->close();

        if($dbemail == $lem && $dbpassword == $lpass ){
            session_start();
            $_SESSION['email']=$lem;

            header ('location:dashboard.php');
        }

        elseif($usermode == 'staff'){
            $lid = "SELECT staff_id FROM staff WHERE Email = ?";
            $query1 = "SELECT Email, Password FROM staff WHERE Email = ?";
            $stmt = $conn->prepare($query1);
            $stmt->bind_param("s", $lem);
            $stmt->execute();
            $stmt->bind_result($dbemail1, $dbpassword1);
            $stmt->fetch();
            $stmt->close();

            if($dbemail1 == $lem && $dbpassword1 == $lpass){

                $query2 = "SELECT staffname FROM staff WHERE Email = ?";
                $stmt = $conn->prepare($query2);
                $stmt->bind_param("s", $dbemail1);
                $stmt->execute();
                $stmt->bind_result($dbname);
                $stmt->fetch();
                $stmt->close();

                session_start();
                
                $_SESSION['id']=$lid;
                $_SESSION['email']=$lem;
                $_SESSION['name']=$dbname;
                header ('location:./staff/staff.php');
            }
            
        }
        
        else{
            
            if($dbemail == null){
               
            ?>
            
            
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Unsuccessful</title>
            </head>
            <body>
                <a href="index.html">Return</a>
                <script>alert("Theres no account with this Email. Sign-in");</script>
            </body>
            </html>
            <?php }
                else{ ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Unsuccessful</title>
            </head>
            <body>
                <a href="index.html">return</a>
                <script>alert("Incorrect Username or Password");</script>
                
            </body>
            </html>
                          
        <?php
        } 
        //header ('location:./alreadyexists');    
    }
    }

?>