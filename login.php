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

        if($num_rows1 > 0){
            header('location:./alreadyexists.php');
            exit;
        }
        
        $sid = substr(md5(uniqid(mt_rand(), true)), 0, 10);
        
        $query = "INSERT INTO users (u_id, username, email, upassword, joining_date) VALUES (?, ?, ?, ?, current_timestamp())";
       
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $sid, $sname, $sem, $spass);
        $stmt->execute();
        $stmt->close();
        header ('location:./');
        session_destroy();    
    }
    //login
    elseif(isset($_POST['Lemail'] )){
        $lem = $_POST['Lemail'];
        $lpass = $_POST['Lpassword'];
        $usermode = isset($_POST['Luser_type']) ? $_POST['Luser_type'] : 'nai aaya';
        echo $usermode;
        // Check if Suser_type is set
        if($lem == 'admin@db' && $lpass == '1234') {
            session_destroy(); 
            session_start();
            $_SESSION['email']=$lem;
            $_SESSION['id']='adminID';
            $_SESSION['name']='Admin';
            header('location:/staff/admin.php');
            return;
        }
        elseif($usermode == 'user')
        {
            $query = "SELECT email, upassword FROM users WHERE email = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $lem);
            $stmt->execute();
            $stmt->bind_result($dbemail, $dbpassword);
            $stmt->fetch();
            $stmt->close();
            $query3 = "SELECT u_id FROM users WHERE email = ?";
                $stmt = $conn->prepare($query3);
                $stmt->bind_param("s", $lem);
                $stmt->execute();
                $stmt->bind_result($userId);
                if ($stmt->fetch()) {
                    $_SESSION['id'] = $userId;
                } else {
                    $resultUserId = null;
                }
                $stmt->close();
            if($dbemail == $lem && $dbpassword == $lpass ){
                session_destroy(); 
                session_start();
                $_SESSION['id']=$userId;
                $_SESSION['email']=$lem;
    
                header ('location:dashboard.php');
            }
        }

        elseif($usermode == 'staff'){

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

            if($dbemail1 == $lem && $dbpassword1 == $lpass){

                $query2 = "SELECT staffname FROM staff WHERE Email = ?";
                $stmt = $conn->prepare($query2);
                $stmt->bind_param("s", $dbemail1);
                $stmt->execute();
                $stmt->bind_result($dbname);
                $stmt->fetch();
                $stmt->close();

                session_start();
                
                $_SESSION['id']=$staffId;
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