<?php   
    include_once "connection.php";

    // Logic to handle the mark as read and unread buttons
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['mark_read'])) {
            $feedback_id = $_POST['feedback_id'];
            $update_query = "UPDATE userfeedback SET read_status = 1 WHERE feedback_id = $feedback_id";
            mysqli_query($con, $update_query);
            header("Refresh:0");
        } elseif (isset($_POST['mark_unread'])) {
            $feedback_id = $_POST['feedback_id'];
            $update_query = "UPDATE userfeedback SET read_status = 0 WHERE feedback_id = $feedback_id";
            mysqli_query($con, $update_query);
            header("Refresh:0");
        }
    }

    // Retrieve unread feedback
    $unread_query = "SELECT * FROM userfeedback WHERE read_status = 0";
    $unread_result = mysqli_query($con, $unread_query);

    // Retrieve read feedback
    $read_query = "SELECT * FROM userfeedback WHERE read_status = 1";
    $read_result = mysqli_query($con, $read_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback</title>
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

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .tabcontent {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 30px;
        }

        .card {
            background-color: #3deb6c;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            box-shadow: 4px 3px 3px #D3D3D3;
            text-align: center;
            width: 300px;
        }
        .card h4 {
            color: #222;
            font-weight: 500;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .card h5 {
            color: #222;
            font-weight: 400;
            font-size: 16px;
        }  
        
        .tab {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .tab button {
            background-color: #f2f2f2;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 10px 20px;
            transition: 0.3s;
        }

        .tab button:hover {
            background-color: #ddd;
        }

        .tab button.active {
            background-color: #ccc;
        }
        .btn-mark-read, .btn-mark-unread {
            background-color: #4CAF50; /* Green background */
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 8px;
        }

        .btn-mark-read:hover, .btn-mark-unread:hover {
            background-color: white;
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <nav class="navbar">
    <a href="admin-home.php"><img src="media/pharmacy.png" style="width:40px;height:40px;"></a>
    <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </nav>
    
    <div class="container">
        <!-- Tabs -->
        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'unread')" id="defaultOpen">Unread Feedback</button>
            <button class="tablinks" onclick="openTab(event, 'read')">Read Feedback</button>
        </div>

        <!-- Unread feedback tab -->
        <div id="unread" class="tabcontent">
            <?php
                while ($row = mysqli_fetch_assoc($unread_result)) {
                    $userId = $row['user_id'];
                    $user_query = "SELECT name FROM usertable WHERE id = '$userId'";
                    $user_result = mysqli_query($con, $user_query);
                    $user_row = mysqli_fetch_assoc($user_result);

                    echo '<div class="card">';
                    echo '<h4>' . $user_row['name'] . '</h4>'; // Added the user's name
                    echo '<h5>User ID: ' . $row['user_id'] . '</h5>'; // Displaying the user's ID
                    echo '<p>' . $row['feedback'] . '</p>'; // Displaying the feedback content
                    echo '<form method="POST">';
                    echo '<input type="hidden" name="feedback_id" value="' . $row['feedback_id'] . '">';
                    echo '<button type="submit" name="mark_read" class="btn-mark-read">Mark as Read</button>';
                    echo '</form>';
                    echo '</div>';
                }
            ?>
        </div>

        <!-- Read feedback tab -->
        <div id="read" class="tabcontent" style="display: none;">
            <?php
                while ($row = mysqli_fetch_assoc($read_result)) {
                    $userId = $row['user_id'];
                    $user_query = "SELECT name FROM usertable WHERE id = '$userId'";
                    $user_result = mysqli_query($con, $user_query);
                    $user_row = mysqli_fetch_assoc($user_result);

                    echo '<div class="card">';
                    echo '<h4>' . $user_row['name'] . '</h4>'; // Added the user's name
                    echo '<h5>User ID: ' . $row['user_id'] . '</h5>'; // Displaying the user's ID
                    echo '<p>' . $row['feedback'] . '</p>'; // Displaying the feedback content
                    echo '<form method="POST">';
                    echo '<input type="hidden" name="feedback_id" value="' . $row['feedback_id'] . '">';
                    echo '<button type="submit" name="mark_unread" class="btn-mark-unread">Mark as Unread</button>';
                    echo '</form>';
                    echo '</div>';
                }
            ?>
        </div>



    <!-- Add your script tags and other HTML content here -->
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>

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
          <a href="#">Reports</a>
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