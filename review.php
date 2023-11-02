<?php
require_once "connection.php";
require_once "controllerUserData.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <script src="feedback.js"></script>
    <script type="text/javascript">
        // Change card title based on submit status
        var submitStatus = <?php echo $submit_status; ?>;
        if (submitStatus === 1) {
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('cardTitle').innerText = "Edit Your Review";
            });
        }
    </script>
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

        .card {
            background-color: #3deb6c;
            padding: 20px;
            margin: 10px auto;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 80%;
            margin-top: 2%;
        }

        .card h4 {
            padding-top: 10px;
            color: #222;
            font-weight: 600;
            font-family: 'Poppins';
        }

        .card form {
            margin-top: 20px;
        }

        .rating {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .rating input {
            display: none;
        }

        .rating label {
            cursor: pointer;
            width: 30px;
            height: 30px;
            background-image: url('media/outline-star.png');
            background-size: cover;
        }

        .rating input:checked ~ label {
            background-image: url('media/gold-star.png');
        }

        .rating label:hover,
        .rating label:hover ~ label {
            background-image: url('media/gold-star.png');
        }

        /* Updated CSS for star order and animation */
        .rating {
            flex-direction: row-reverse;
        }

        .submit-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 12px;
        }

        .submit-button:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>
    <nav class="navbar">
    <a href="home.php"><img src="media/pharmacy.png" style="width:40px;height:40px;"></a>
    
    <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </nav>
    
    <div id="main-content" class="container allContent-section py-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <h4 style="color:white;">Rate This Application</h4>
                    <form id="reviewForm" method="post" action="submit-review.php">
                        <div class="rating">
                            <input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
                        </div>
                        <button class="submit-button" type="submit">Submit Review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- New "My Review" card -->
    <div id="my-review" class="container allContent-section py-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <h4 style="color:white;">My Rating</h4><br>
                    <?php
                    $email = $_SESSION['email'];
                    if ($email != false) {
                        $sql = "SELECT * FROM usertable WHERE email = '$email'";
                        $run_Sql = mysqli_query($con, $sql);
                        if ($run_Sql) {
                            $fetch_info = mysqli_fetch_assoc($run_Sql);
                            $user_id = $fetch_info['id'];
                    
                            // Fetch the user's review
                            $user_review_query = "SELECT review FROM userreview WHERE user_id = '$user_id'";
                            $run_user_review_query = mysqli_query($con, $user_review_query);

                            if ($run_user_review_query && mysqli_num_rows($run_user_review_query) > 0) {
                                $user_review_data = mysqli_fetch_assoc($run_user_review_query);
                                $user_review = $user_review_data['review'];

                                // Display the user's review with stars or relevant information
                                // Replace the following line with your HTML code to display the user's review
                                echo "<p style='color: black;'>Current Review: $user_review/5</p>";
                            } else {
                                // If no review found, display a message
                                echo "<p style='color: black;'>No review submitted yet.</p>";
                            }
                        }
                    }
                    ?>
                </div>
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
          <span class="material-symbols-outlined">home</span>
          <a href="home.php">My Home</a>
        </li>
        <li>
            <span class="material-symbols-outlined">pacemaker</span>
            <a href="#" onclick="openCenteredWindow('https://hakeemalavi.shinyapps.io/Cholera_Model/', 'myWindow', 900, 630); return false;">Cholera Model</a>
        </li>
        <li>
          <span class="material-symbols-outlined">monitoring</span>
          <a href="user-charts.php">Analytics</a>
        </li>  
        <li>
          <span class="material-symbols-outlined">flag</span>
          <a href="#">Reports</a>
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
          <span class="material-symbols-outlined">group</span>
          <a href="#">Developer </a>
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
</body>
</html>