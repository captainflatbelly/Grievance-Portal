<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashb.css" />
</head>
<body>
    <div class="container">
        <div class="nav">
            <p>Resolvio</p>
            <a href="destroy.php" >
                <button class="logb" >
                    Logout
                </button>
            </a>
        </div>
        <div class="main">
           
            
            <div class="uactions">
                <div class="dash-all">
                <p ><a href="./complaints/viewSuggestions.php">View Suggestions</a></p>
                <p><a href="./complaints/addSuggestion.php">Add Suggestion</a></p>
                <p><a href="./complaints/cform.php">Initialize Complaint</a></p>
                <p><a href="./complaints/pcom.php">Complaints</a></p>
                <p><a href="./complaints/rcom.php">Resolved Complaints</a></p>
                <p><a href="./complaints/pencom.php">Pending Complaints</a></p>
                </div>
                <img src="./img/complain.jpg" alt="">
            </div>
        </div>
    </div>


</body>
</html>