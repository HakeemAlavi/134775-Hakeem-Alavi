<?php 
require_once "controllerUserData.php"; 
?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $fetch_info['name'] ?> | Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    nav{
        padding-left: 50px!important;
        padding-right: 50px!important;
        padding-top: 15px!important;
        padding-bottom: 15px!important;
        background: #3deb6c;
        font-family: 'Poppins', sans-serif;
    } 
    nav a.navbar-brand{
        color: #fff;
        font-size: 25px!important;
        font-weight: 500;
    }
    button a{
        color: #3deb6c;
        font-weight: 500;
        border-radius: 16px;
    }
    button a:hover{
        text-decoration: none;
    }
    h1{
        position: absolute;
        top: 20%;
        left: 50%;
        width: 100%;
        text-align: center;
        transform: translate(-50%, -62%);
        font-size: 28px;
        font-weight: 600;
        font-family: 'Poppins';
    }
    * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 110px;
            height: 100%;
            display: flex;
            align-items: center;
            flex-direction: column;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(17px);
            --webkit-backdrop-filter: blur(17px);
            border-right: 1px solid rgba(255, 255, 255, 0.7);
            transition: width 0.3s ease;
        }

        .sidebar:hover {
            width: 260px;
        }

        .sidebar .logo {
            color: #000;
            display: flex;
            align-items: center;
            padding: 25px 10px 15px;
        }

        .logo img {
            width: 30px;
            border-radius: 50%;
        }

        .logo h2 {
            font-size: 1.15rem;
            font-weight: 600;
            margin-left: 15px;
            display: none;
            margin-top: 8px;
        }

        .sidebar:hover .logo h2 {
            display: block;
        }

        .sidebar .links {
            list-style: none;
            margin-top: 20px;
            overflow-y: auto;
            scrollbar-width: none;
            height: calc(100% - 140px);
        }

        .sidebar .links::-webkit-scrollbar {
            display: none;
        }

        .links li {
            display: flex;
            border-radius: 4px;
            align-items: center;
        }

        .links li:hover {
            cursor: pointer;
            background: #fff;
        }

        .links h4 {
            color: #222;
            font-weight: 500;
            display: none;
            margin-bottom: 10px;
        }

        .sidebar:hover .links h4 {
            display: block;
        }

        .links hr {
            margin: 10px 8px;
            border: 1px solid #4c4c4c;
        }

        .sidebar:hover .links hr {
            border-color: transparent;
        }

        .links li span {
            padding: 12px 10px;
        }

        .links li a {
            padding: 10px;
            color: #000;
            display: none;
            font-weight: 500;
            white-space: nowrap;
            text-decoration: none;
        }

        .sidebar:hover .links li a {
            display: block;
        }

        .links .logout-link {
            margin-top: 20px;
        }
        
        a{
          padding: 5px;
        }

        .card{
            background-color: #3deb6c;
            padding:20px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 8px 5px 5px #D3D3D3;
            width: 400px;
            height: 150px;
            /* transform: translate(40%, 60%); */
        }
        .card h4 {
            padding-top: 10px;
            color: #222;
            font-weight: 600;
            font-family: 'Poppins';
        } 
        .card h5 {
            color: #222;
            font-weight: 600;
            font-family: 'Poppins';
            font-style: italic;
        }   
        .main-container {
            padding: 70px;
        }
        
    </style>
</head>
<body>
        <?php   
            include_once "connection.php";
        ?>
    <nav class="navbar">
    <a href="admin-home.php"><img src="media/pharmacy.png" style="width:40px;height:40px;"></a>
    <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </nav>
    <h1>Welcome Admin - <?php echo $fetch_info['name'] ?></h1>
    
    <div class="main-container">
    <div class="container d-flex justify-content-around my-3">
        <div class="card">
            <i class="fa fa-users  mb-2" style="color: #ffffff";></i>
                <h4 style="color:white;">Total Users</h4>
                <h5 style="color:white;">
                    <?php
                        $sql="SELECT * from usertable WHERE authorization = 'user'";
                        $result=$con-> query($sql);
                        $count=0;
                        if ($result-> num_rows > 0){
                            while ($row=$result-> fetch_assoc()) {
                    
                                $count=$count+1;
                            }
                        }
                        echo $count;
                    ?>
                </h5>
            </div>
    
        <div class="card">
            <i class="fa fa-user-circle  mb-2" style="color: #ffffff";></i>
                <h4 style="color:white;">Total Admins</h4>
                <h5 style="color:white;">
                    <?php
                        $sql="SELECT * from usertable WHERE authorization = 'admin'";
                        $result=$con-> query($sql);
                        $count=0;
                        if ($result-> num_rows > 0){
                            while ($row=$result-> fetch_assoc()) {
                    
                                $count=$count+1;
                            }
                        }
                        echo $count;
                    ?>
                </h5>
            </div>
        <div class="card">
            <i class="fa fa-stethoscope  mb-2" style="color: #ffffff;"></i>
                <h4 style="color:white;">Classifications</h4>
                <h5 style="color:white;">
                <?php
                    include "connection.php"; // Include your connection file
                    $sql="SELECT COUNT(*) as total_classifications from userfeedback";
                    $result=$con-> query($sql);
                    if ($result-> num_rows > 0){
                        while ($row=$result-> fetch_assoc()) {
                            echo $row['total_classifications'];
                        }
                    } else {
                        echo '0';
                    }
                    $con->close(); // Close the database connection
                ?>
            </h5>
        </div>
        <div class="card">
            <i class="fa fa-envelope  mb-2" style="color: #ffffff;"></i>
                <h4 style="color:white;">Unread Feedback</h4>
                <h5 style="color:white;">
                    <?php
                        include "connection.php"; // Include your connection file
                        $sql = "SELECT COUNT(*) as unread_feedback FROM userfeedback WHERE read_status = 0";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo $row['unread_feedback'];
                        } else {
                            echo '0';
                        }
                        $con->close(); // Close the database connection
                    ?>
                </h5>
            </div>
    </div>

    <div class="container d-flex justify-content-around my-3">
        <div class="card">
             <i class="fa fa-list-ol mb-2" style="color: #ffffff;"></i>
                <h4 style="color: white;">Score Count</h4>
                <h5 style="color: white;">
                    <?php
                    include "connection.php"; // Ensure the connection is included here

                    $quizTakersQuery = "SELECT COUNT(*) as total_quiz_takers FROM userquiz WHERE score IS NOT NULL";
                    $quizTakersResult = mysqli_query($con, $quizTakersQuery);
                    if ($quizTakersResult) {
                        $quizTakersRow = mysqli_fetch_assoc($quizTakersResult);
                        $quizTakersCount = $quizTakersRow['total_quiz_takers'];
                        echo $quizTakersCount;
                    } else {
                        echo "Query Failed: " . mysqli_error($con); // Display error if the query fails
                    }
                ?>
            </h5>
        </div>


        
    <div class="card">
        <i class="fa fa-pencil-square-o  mb-2" style="color: #ffffff;"></i>
            <h4 style="color:white;">Average Score</h4>
            <h5 style="color:white;">
                <?php
                $sum = 0;
                $count = 0;

                include "connection.php"; // Ensure the connection is included here

                $sql = "SELECT score FROM userquiz WHERE score IS NOT NULL";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sum += $row['score'];
                            $count++;
                        }
                    }

                    if ($count > 0) {
                        $average = $sum / $count;
                        echo round($average, 2);
                    } else {
                        echo "N/A";
                    }
                } else {
                    echo "Query Failed: " . mysqli_error($con); // Display error if the query fails
                }

                mysqli_close($con); // Close the connection after all operations are complete
                ?>
            </h5>
        </div>
    <div class="card">
        <i class="fa fa-list-ol mb-2" style="color: #ffffff;"></i>
            <h4 style="color: white;">Review Count</h4>
            <h5 style="color: white;">
                <?php
                include "connection.php"; // Ensure the connection is included here

                $appRatersQuery = "SELECT COUNT(*) as total_app_raters FROM userreview WHERE review != 0";
                $appRatersResult = mysqli_query($con, $appRatersQuery);
                if ($appRatersResult) {
                    $appRatersRow = mysqli_fetch_assoc($appRatersResult);
                    $appRatersCount = $appRatersRow['total_app_raters'];
                    echo $appRatersCount;
                } else {
                    echo "Query Failed: " . mysqli_error($con); // Display error if the query fails
                }

                mysqli_close($con); // Close the connection after all operations are complete
                ?>
            </h5>
        </div>
    <div class="card">
        <i class="fa fa-star  mb-2" style="color: #ffffff;"></i>
            <h4 style="color:white;">Average Review</h4>
            <h5 style="color:white;">
                <?php
                    $sum = 0;
                    $count = 0;

                    include "connection.php"; // Ensure the connection is included here

                    $sql = "SELECT review FROM userreview WHERE review != 0";
                    $result = $con->query($sql);
                    if ($result) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $sum += $row['review'];
                                $count++;
                            }
                        }

                        if ($count > 0) {
                            $average = $sum / $count;
                            echo round($average, 2);
                        } else {
                            echo "N/A";
                        }
                    } else {
                        echo "Query Failed: " . $con->error; // Display error if the query fails
                    }

                    $con->close(); // Close the connection after all operations are complete
                ?>
            </h5>
        </div>
    </div>
</div>

    <aside class="sidebar">
      <div class="logo">
      <img src="media/pharmacy.png" alt="logo">
        <h2>CholeraCare</h2>
      </div>
      <ul class="links">
      <li>
          <span class="material-symbols-outlined">dashboard</span>
          <a href="admin-home.php">Dashboard</a>
        </li>
        <li>
        <li>
          <span class="material-symbols-outlined">group</span>
          <a href="admin/user-panel.php">Users Panel </a>
        </li>
        <li>
          <span class="material-symbols-outlined">monitoring</span>
          <a href="admin-charts.php">Analytics</a>
        </li>

        <li>
          <span class="material-symbols-outlined">flag</span>
          <a href="reports.php">Reports</a>
        </li>
        <hr>
        
        <li>
          <span class="material-symbols-outlined">person</span>
          <a href="display-feedback.php">Feedback</a>
        </li>
        
        <li>
          <span class="material-symbols-outlined">ambient_screen</span>
          <a href="#">Magic Build</a>
        </li>
        <li>
          <span class="material-symbols-outlined">pacemaker</span>
          <a href="#">Theme Maker</a>
        </li>
        
        <li>
          <span class="material-symbols-outlined">show_chart</span>
          <a href="#">Revenue</a>
        </li>
        <hr>
        
        <li>
          <span class="material-symbols-outlined">bar_chart</span>
          <a href="#">Overview</a>
        </li>
        <li>
          <span class="material-symbols-outlined">mail</span>
          <a href="#">Message</a>
        </li>
        <li>
          <span class="material-symbols-outlined">settings</span>
          <a href="#">Settings</a>
        </li>
        <li class="logout-link">
          <span class="material-symbols-outlined">logout</span>
          <a href="#">Logout</a>
        </li>
      </ul>
    </aside>
    

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>