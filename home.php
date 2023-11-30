<?php require_once "controllerUserData.php"; ?>
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
        top: 20%;
        left: 50%;
        width: 100%;
        text-align: center;
        transform: translate(-50%, -62%);
        font-size: 28px;
        font-weight: 600;
        font-family: 'Poppins';
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
        .main-content {
            margin-left: 120px;
            margin-top: 5%;
            padding: 20px;
        }

        .info-section {
            margin-bottom: 40px;
        }
        h2 {
            font-size: 24px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <nav class="navbar">
    <a href="home.php"><img src="" style="width:40px;height:40px;"></a>
    
    <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </nav>
    
    <!-- <h1>Welcome <?php echo $fetch_info['name'] ?></h1> -->
    <section class="main-content">
        <h1>Welcome <?php echo $fetch_info['name'] ?></h1>

        <div class="info-section">
    <h2>About Cholera</h2><br>
    <p>
        Cholera is an acute diarrheal infection caused by the ingestion of food or water contaminated with the bacterium Vibrio cholerae. This infectious disease is characterized by profuse, painless, and watery diarrhea, which can lead to severe dehydration and even death if not promptly treated. The bacterium responsible for cholera produces a toxin that causes the cells lining the small intestine to release massive amounts of water, leading to the characteristic diarrhea.
    </p>
    <p>
        Common symptoms of cholera include sudden onset of watery diarrhea, vomiting, and leg cramps. While some individuals may only experience mild symptoms, others can rapidly develop severe dehydration, low blood pressure, and shock, leading to a life-threatening condition if left untreated.
    </p>
    <p>
        Cholera outbreaks are often associated with areas or communities with inadequate access to clean water and proper sanitation facilities. Additionally, factors such as overcrowding, poor hygiene practices, and contaminated food contribute to the rapid spread of the disease, particularly in regions prone to natural disasters, such as floods and earthquakes.
    </p>
    <p>
        Immediate treatment for cholera involves rehydration therapy to replace the lost fluids and electrolytes in the body. Oral rehydration salts (ORS) or intravenous fluids are administered to manage dehydration and restore the body's electrolyte balance. Antibiotic treatment can also be effective in reducing the severity and duration of symptoms.
    </p>
    <p>
        Prevention of cholera primarily focuses on ensuring access to safe and clean drinking water, maintaining proper sanitation and hygiene practices, and promoting community awareness and education. Implementing water purification methods, practicing good personal hygiene, and ensuring the proper disposal of human waste are crucial in preventing the transmission and spread of cholera.
    </p>
    <p>
        In endemic areas, cholera vaccination campaigns may be conducted to provide additional protection and prevent the occurrence of large-scale outbreaks. Public health interventions and community-based initiatives play a vital role in controlling and preventing the spread of cholera, particularly in regions vulnerable to the disease.
    </p>
    <p>
        While cholera remains a significant global health concern, timely access to clean water, sanitation facilities, and adequate medical care can significantly reduce the burden of the disease and prevent its devastating impact on affected communities.
    </p>
</div>

<div class="info-section">
    <h2>Key Principles of Proper Hygiene and Sanitation</h2><br>
    <p>The recommended duration for washing hands prior to handling food or eating and post bathroom usage is 30 seconds, and one should use clean water and soap to maximize disinfection.</p>
    <img src="media/Illustration1.png" style="width:250px;height:25opx; margin: 20px;"></a></br></br>
    <p>Store cooked food in airtight containers to maintain its freshness and prevent contamination. Avoid storing it at room temperature, in an open container, or in direct sunlight.</p>
    <img src="media/Illustration2.png" style="width:250px;height:25opx; margin: 20px;"></a></br></br>
    <p>Disinfect fruits and vegetables using a vinegar solution to ensure the removal of any harmful bacteria or contaminants present on their surfaces.</p>
    <img src="media/Illustration3.png" style="width:250px;height:25opx; margin: 20px;"></a></br></br>
    <p>Kitchen towels should be washed daily to avoid the spread of germs and bacteria that can lead to food-borne illnesses.</p>
    <img src="media/Illustration4.png" style="width:250px;height:25opx; margin: 20px;"></a></br></br>
    <p>Maintain the refrigerator temperature at 5°C (41°F) to preserve perishable foods properly and prevent the growth of harmful bacteria.</p>
    <img src="media/Illustration5.png" style="width:250px;height:25opx; margin: 20px;"></a></br></br>
    <p>Dispose of expired food items properly instead of using them, donating them, or storing them, as they can be a source of food-borne illnesses.</p>
    <img src="media/Illustration6.png" style="width:250px;height:25opx; margin: 20px;"></a></br></br>
    <p>Regularly clean your refrigerator, preferably once a month, to ensure the removal of any potential sources of contamination and to maintain a hygienic food storage environment.</p>
    <img src="media/Illustration7.png" style="width:250px;height:25opx; margin: 20px;"></a></br></br>
    <p>Prevent pests in the kitchen by keeping the area clean and dry. Avoid using chemical sprays and opt for natural prevention methods whenever possible.</p>
    <img src="media/Illustration8.png" style="width:250px;height:25opx; margin: 20px;"></a></br></br>
    <p>Thaw raw meat in the refrigerator to maintain its freshness and prevent the growth of harmful bacteria. Avoid thawing it on the counter, in hot water, or in the microwave.</p>
    <img src="media/Illustration9.png" style="width:250px;height:25opx; margin: 20px;"></a></br></br>
    <p>Use a disinfectant cleaner to effectively remove germs from various surfaces in your living space, especially in areas where food is prepared or stored.</p>
    <img src="media/Illustration10.png" style="width:250px;height:25opx; margin: 20px;"></a></br></br>
    <p>Before and after handling food, always remember to wash your hands thoroughly with soap and clean water to prevent the spread of harmful bacteria and viruses.</p>
    <img src="media/Illustration11.png" style="width:250px;height:25opx; margin: 20px;"></a></br></br>
    <p>Cook most meats at a temperature of 165°C (329°F) to ensure that they are thoroughly cooked and free from any harmful bacteria that could cause food-borne illnesses.</p>
    <img src="media/Illustration12.png" style="width:250px;height:25opx; margin: 20px;"></a></br></br>
    <p>Use plastic cutting boards, as they are easier to clean and sanitize compared to other materials such as wood, marble, or glass.</p>
    <img src="media/Illustration13.png" style="width:250px;height:25opx; margin: 20px;"></a></br></br>
    <p>Properly clean the cutting board with soap and water after cutting raw meat to avoid cross-contamination between raw and cooked foods.</p>
    <img src="media/Illustration14.png" style="width:250px;height:25opx; margin: 20px;"></a></br></br>
    <p>If you have a food-borne illness, consult a healthcare professional immediately for proper diagnosis and treatment instead of self-medicating or waiting for it to pass.</p>
    <img src="media/Illustration15.png" style="width:250px;height:25opx; margin: 20px;"></a></br></br>
</div>

            <!-- Add more informative sections as needed -->

    </section>

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
        <hr>
        
        <li class="logout-link">
          <span class="material-symbols-outlined">logout</span>
          <a href="logout-user.php">Logout</a>
        </li>
      </ul>
    </aside>
</body>
</html>