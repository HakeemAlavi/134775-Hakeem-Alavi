<?php
require_once "connection.php";
require_once "controllerUserData.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hygiene and Sanitation Quiz Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <script src="feedback.js"></script>
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
        top: 50%;
        left: 50%;
        width: 100%;
        text-align: center;
        transform: translate(-50%, -50%);
        font-size: 50px;
        font-weight: 600;
    }
    /* Importing Google font - Poppins */
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        a{
          padding: 5px;
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
        .quiz-container {
            width: 50%;
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 15px;
            margin-left: 25%;
            margin-top: 5%;
            
        }
    </style>
</head>
<body>
<nav class="navbar">
    <a href="home.php"><img src="media/pharmacy.png" style="width:40px;height:40px;"></a>
    
    <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </nav>
    <div class="quiz-container">
    <div style="text-align: center;">
        <h4 style="font-weight: 600">Quiz Results</h4>
        <br>
        <?php
        // Check if the email is valid
        $email = $_SESSION['email'];
        if ($email != false) {
            $sql = "SELECT * FROM usertable WHERE email = '$email'";
            $run_Sql = mysqli_query($con, $sql);
            if ($run_Sql) {
                $fetch_info = mysqli_fetch_assoc($run_Sql);
                $user_id = $fetch_info['id'];

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $answers = [
                        "20 seconds", 
                        "In an airtight container", 
                        "Using a vinegar solution", 
                        "Every day", 
                        "5°C (41°F)", 
                        "Throw them away", 
                        "Once a month", 
                        "Keeping the kitchen clean and dry", 
                        "Thaw it in the refrigerator", 
                        "Use a disinfectant cleaner", 
                        "Wash your hands", 
                        "165°C (329°F)", 
                        "Plastic", 
                        "Clean the cutting board with soap and water", 
                        "Consult a healthcare professional"
                    ];
                    $score = 0;

                    for ($i = 1; $i <= 15; $i++) {
                        $answer = $_POST['q' . $i];
                        if ($answer == $answers[$i - 1]) {
                            $score++;
                        }
                    }

                    echo "<p>Your final score is: " . $score . "/15</p>";

                    // Update the user's score in the userquiz table
                    $update_sql = "UPDATE userquiz SET score = '$score' WHERE user_id = '$user_id'";
                    if (mysqli_query($con, $update_sql)) {
                        echo "Your score has been updated successfully";
                    } else {
                        echo "Error: " . $update_sql . "<br>" . mysqli_error($con);
                    }
                }
            }
        } else {
            // Redirect to the appropriate page if the email is not valid
            header('Location: quiz.php');
        }

        // Close the database connection
        mysqli_close($con);
        ?>
        <br><br><br>
        <a href="quiz.php" class="btn btn-primary px-4 py-2 mx-2" name="quiz">Back to Quiz</a>
    </div>
    </div>
    <aside class="sidebar">
      <div class="logo">
      <img src="media/pharmacy.png" alt="logo">
        <h2>CholeraCare</h2>
      </div>
      <ul class="links">
        <li>
          <span class="material-symbols-outlined">home</span>
          <a href="home.php">My Home</a>
        </li>
        <li>
            <span class="material-symbols-outlined">pacemaker</span>
            <a href="#" onclick="openCenteredWindow('https://hakeemalavi.shinyapps.io/Cholera_Model/', 'myWindow', 900, 630); return false;">Cholera Model</a>
        </li>
        <li>
          <span class="material-symbols-outlined">quiz</span>
          <a href="quiz.php">Quiz</a>
        </li>
        <li>
          <span class="material-symbols-outlined">monitoring</span>
          <a href="user-charts.php">Analytics</a>
        </li>  
          
        <hr>

        <li>
          <span class="material-symbols-outlined">person</span>
          <a href="user/profile.php">My Profile</a>
        </li>
        <li>
          <span class="material-symbols-outlined">star_half</span>
          <a href="review.php">My Review</a>
        </li>
        <li>
          <span class="material-symbols-outlined">flag</span>
          <a href="#">My Reports</a>
        </li> 

        <hr>
        
        <li class="logout-link">
          <span class="material-symbols-outlined">logout</span>
          <a href="#">Logout</a>
        </li>
      </ul>
    </aside>
</body>

</html>
