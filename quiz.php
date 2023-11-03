<?php
require_once "connection.php";
require_once "controllerUserData.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hygiene and Sanitation Quiz</title>
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
        .card {
            background-color: #f9f9f9;
            padding: 30px;
            margin-left: 25%;
            margin-top: 5%;
            margin-bottom: 5%;
            border-radius: 15px;
            text-align: center;
            width: 50%;
            
        }

        .card h4 {
            padding-top: 10px;
            color: #000;
            font-weight: 600;
            font-family: 'Poppins';
        }
    </style>
</head>
<body>
<nav class="navbar">
    <a href="home.php"><img src="media/pharmacy.png" style="width:40px;height:40px;"></a>
    
    <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </nav>

    
        <div class="quiz-container">
    <?php
    if (isset($_POST['start'])) {
        $questions = [
            1 => ["question" => "What is the recommended duration for washing hands with soap?", "choices" => ["5 seconds", "10 seconds", "20 seconds", "30 seconds"], "answer" => "20 seconds"],
            2 => ["question" => "Which of the following is a proper method for storing cooked food?", "choices" => ["At room temperature", "In an airtight container", "In an open container", "In direct sunlight"], "answer" => "In an airtight container"],
            3 => ["question" => "What is the best way to disinfect fruits and vegetables?", "choices" => ["Washing with water", "Using soap", "Using a vinegar solution", "Using bleach"], "answer" => "Using a vinegar solution"],
            4 => ["question" => "How often should kitchen towels be washed?", "choices" => ["Once a week", "Every two weeks", "Every day", "Once a month"], "answer" => "Every day"],
            5 => ["question" => "What is the ideal temperature for storing perishable foods in the refrigerator?", "choices" => ["0°C (32°F)", "5°C (41°F)", "10°C (50°F)", "15°C (59°F)"], "answer" => "5°C (41°F)"],
            6 => ["question" => "What should be done with expired food items?", "choices" => ["Use them anyway", "Donate them to charity", "Throw them away", "Store them for emergencies"], "answer" => "Throw them away"],
            7 => ["question" => "How often should you clean your refrigerator?", "choices" => ["Once a week", "Once a month", "Every six months", "Once a year"], "answer" => "Once a month"],
            8 => ["question" => "What is the most effective method for controlling pests in the kitchen?", "choices" => ["Chemical sprays", "Ultrasonic repellents", "Keeping the kitchen clean and dry", "Setting traps"], "answer" => "Keeping the kitchen clean and dry"],
            9 => ["question" => "Which of the following is a proper way to handle raw meat?", "choices" => ["Thaw it on the counter", "Thaw it in the refrigerator", "Thaw it in hot water", "Thaw it in the microwave"], "answer" => "Thaw it in the refrigerator"],
            10 => ["question" => "What is the most effective way to remove germs from surfaces?", "choices" => ["Wipe with a dry cloth", "Use a damp cloth", "Use soap and water", "Use a disinfectant cleaner"], "answer" => "Use a disinfectant cleaner"],
            11 => ["question" => "What should you do before and after handling food?", "choices" => ["Wash your hands", "Wear gloves", "Use hand sanitizer", "Nothing"], "answer" => "Wash your hands"],
            12 => ["question" => "What is the ideal temperature for cooking most meats?", "choices" => ["40°C (104°F)", "60°C (140°F)", "80°C (176°F)", "165°C (329°F)"], "answer" => "165°C (329°F)"],
            13 => ["question" => "Which of the following is a suitable material for cutting boards?", "choices" => ["Wood", "Marble", "Plastic", "Glass"], "answer" => "Plastic"],
            14 => ["question" => "What is the proper way to handle cutting raw meat?", "choices" => ["Use the same cutting board for other foods", "Wash the cutting board with water only", "Clean the cutting board with soap and water", "Use the cutting board without cleaning"], "answer" => "Clean the cutting board with soap and water"],
            15 => ["question" => "What should you do if you have a foodborne illness?", "choices" => ["Self-medicate with over-the-counter drugs", "Wait for it to pass", "Consult a healthcare professional", "Ignore the symptoms"], "answer" => "Consult a healthcare professional"],

        ];

        echo '<form action="quiz-results.php" method="post" onsubmit="return validateForm()">';
        foreach ($questions as $key => $value) {
            echo '<p>' . $value["question"] . '</p>';
            echo '<input type="radio" name="q' . $key . '" value="' . $value["choices"][0] . '"> ' . $value["choices"][0] . '<br>';
            echo '<input type="radio" name="q' . $key . '" value="' . $value["choices"][1] . '"> ' . $value["choices"][1] . '<br>';
            echo '<input type="radio" name="q' . $key . '" value="' . $value["choices"][2] . '"> ' . $value["choices"][2] . '<br>';
            echo '<input type="radio" name="q' . $key . '" value="' . $value["choices"][3] . '"> ' . $value["choices"][3] . '<br><br>';
        }
        echo '<br>';
        echo '<button type="submit" class="btn btn-success px-4 py-2 mx-2" name="submit">Submit Quiz</button>';
        echo '</form>';
    } else {
        $previousScore = 0; // Replace this with the actual score fetched from the database
        echo '<div style="text-align: center; margin-top: 50px;">';
        echo '<h4 style="font-weight: 600;">Hygiene and Sanitation Quiz</h4><br>';
        echo '<p>This quiz will test your knowledge of essential hygiene and sanitation practices. There are 15 questions in total. Make sure to answer all questions before submitting the quiz.</p><br>';
        echo '<form action="" method="post">';
        echo '<br><button type="submit" class="btn btn-primary px-4 py-2 mx-2" name="start">Start Quiz</button>';
        echo '</form>';
        echo '</div>';
    }
    ?>
    <script>
        function validateForm() {
            var radioGroups = document.querySelectorAll('input[type=radio]');

            for (var i = 0; i < radioGroups.length; i++) {
                var groupName = radioGroups[i].getAttribute('name');
                var checked = false;

                for (var j = 0; j < radioGroups.length; j++) {
                    if (radioGroups[j].getAttribute('name') === groupName && radioGroups[j].checked) {
                        checked = true;
                        break;
                    }
                }

                if (!checked) {
                    alert('Please answer all the questions before submitting the quiz');
                    return false;
                }
            }

            return true;
        }
    </script>
    </div>
            <div class="card">
                <h4 style="color:black;">Previous Score</h4><br>
                <?php
                    $email = $_SESSION['email'];
                    if ($email != false) {
                        $sql = "SELECT * FROM usertable WHERE email = '$email'";
                        $run_Sql = mysqli_query($con, $sql);
                        if ($run_Sql) {
                            $fetch_info = mysqli_fetch_assoc($run_Sql);
                            $user_id = $fetch_info['id'];
                    
                            // Fetch the user's score
                            $user_quiz_query = "SELECT score FROM userquiz WHERE user_id = '$user_id'";
                            $run_user_quiz_query = mysqli_query($con, $user_quiz_query);

                            if ($run_user_quiz_query && mysqli_num_rows($run_user_quiz_query) > 0) {
                                $user_quiz_data = mysqli_fetch_assoc($run_user_quiz_query);
                                $user_quiz = $user_quiz_data['score'];

                                echo "<p style='color: black;'>Your previous score was: $user_quiz/15</p>";
                            } else {
                                // If no review found, display a message
                                echo "<p style='color: black;'>No quiz taken yet.</p>";
                            }
                        }
                    }
                    ?>
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
