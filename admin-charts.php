<?php
include "connection.php";
?>
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
                exit;
            }
        }else{
            header('Location: user-otp.php');
            exit;
        }
    }
}else{
    header('Location: login-user.php');
    exit;
}
?>

<?php
// Fetch data from the database
$query = "SELECT DATE(submission_time) as submission_date, COUNT(*) as total_usage FROM userfeedback GROUP BY DATE(submission_time)";
$result = mysqli_query($con, $query);

// Initialize arrays for the chart data
$dates = [];
$usages = [];

// Populate the arrays with data from the database
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $dates[] = date('Y-m-d', strtotime($row['submission_date']));
        $usages[] = $row['total_usage'];
    }
}

// Fetch data from the database for the pie chart
$diagnosis_query = "SELECT diagnosis, COUNT(*) as count FROM userfeedback GROUP BY diagnosis";
$diagnosis_result = mysqli_query($con, $diagnosis_query);

// Initialize arrays for the pie chart data
$diagnosis_labels = [];
$diagnosis_counts = [];

// Populate the arrays with data from the database
if ($diagnosis_result) {
    while ($row = mysqli_fetch_assoc($diagnosis_result)) {
        $diagnosis_labels[] = $row['diagnosis'];
        $diagnosis_counts[] = $row['count'];
    }
}

// Fetch data from the database for the bar chart
$review_query = "SELECT review, COUNT(*) as count FROM userreview WHERE review != 0 GROUP BY review";
$review_result = mysqli_query($con, $review_query);

// Initialize arrays for the bar chart data
$ratings = [1, 2, 3, 4, 5];
$reviewCounts = [0, 0, 0, 0, 0];

// Populate the arrays with data from the database
if ($review_result) {
    while ($row = mysqli_fetch_assoc($review_result)) {
        $reviewCounts[$row['review'] - 1] = $row['count'];
    }
}

// Fetch data from the database
$query = "SELECT score, COUNT(*) as score_count FROM userquiz WHERE score IS NOT NULL GROUP BY score";
$result = mysqli_query($con, $query);

// Initialize arrays for the chart data
$scores = [];
$scoreCounts = [];

// Populate the arrays with data from the database
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $scores[] = $row['score'];
        $scoreCounts[] = $row['score_count'];
    }
}


// Close the connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudfare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    
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
    /* h1{
        position: absolute;
        top: 20%;
        left: 50%;
        width: 100%;
        text-align: center;
        transform: translate(-50%, -62%);
        font-size: 28px;
        font-weight: 600;
        font-family: 'Poppins';
    } */
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

        .container {
            transform: translate(4.5%, 15%);
        }

        a{
          padding: 5px;
        }
        
        .container-fluid {
            padding-left: 138px;
            padding-top: 56px;
            padding-bottom: 56px;
        }
        .pdf {
            transform: translate(42%, 15%);
            margin-top: 4%;
        }
    </style>  
  <title>Admin Charts</title>
</head>

<body>
    <nav class="navbar">
    <a href="admin-home.php"><img src="" style="width:40px;height:40px;"></a>
    <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </nav>
    <div class="pdf">
        <button type="button" class="btn btn-success" onclick="downloadPDF()">Download Reports</button>
    </div>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-7 my-1">
            <div class="card">
            <div class="card-body">
                <canvas id="modelUsageChart" ></canvas>
            </div>
            </div>
        </div>

        <div class="col-md-4.5 my-1">
            <div class="card">
            <div class="card-body">
                <canvas id="diagnosisChart" ></canvas>
            </div>
            </div>
        </div>

        <div class="col-md-7 my-1">
            <div class="card">
            <div class="card-body">
                <canvas id="reviewChart" ></canvas>
            </div>
            </div>
        </div>
        <div class="col-md-4.5 my-1">
            <div class="card">
            <div class="card-body">
                <canvas id="polarChart"></canvas>
            </div>
            </div>
        </div>
    </div>
    </div>
  


    <script>
        // JavaScript code for the line chart
        var dates = <?php echo json_encode($dates); ?>;
        var usages = <?php echo json_encode($usages); ?>;

        var ctx = document.getElementById('modelUsageChart').getContext('2d');
        var modelUsageChart = new Chart(ctx, {
            type: 'line', // Change the type to 'line'
            data: {
                labels: dates,
                datasets: [{
                    label: 'Number of Model Classifications',
                    data: usages,
                    backgroundColor: '#3deb6c',
                    borderColor: '#3deb6c',
                    borderWidth: 1,
                    fill: false // Ensure the line chart is not filled
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Daily Classifications',
                            font: {
                                family: 'Poppins'
                            }
                        },
                        ticks: {
                            font: {
                                family: 'Poppins'
                            }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Date',
                            font: {
                                family: 'Poppins'
                            }
                        },
                        ticks: {
                            font: {
                                family: 'Poppins'
                            }
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Daily Model Classifications',
                        font: {
                            family: 'Poppins',
                            size: 20
                        }
                    }
                }
            }
        });

        // JavaScript code for the pie chart
        var diagnosisLabels = <?php echo json_encode($diagnosis_labels); ?>;
        var diagnosisCounts = <?php echo json_encode($diagnosis_counts); ?>;

        var diagnosisData = {
            labels: diagnosisLabels,
            datasets: [{
                label: 'Diagnosis',
                data: diagnosisCounts,
                backgroundColor: ['#f43f5e', '#3deb6c'] // You can add more colors for additional categories
            }]
        };

        var diagnosisCtx = document.getElementById('diagnosisChart').getContext('2d');
        var diagnosisChart = new Chart(diagnosisCtx, {
            type: 'pie',
            data: diagnosisData,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Diagnosis Feedback',
                        font: {
                            family: 'Poppins',
                            size: 20
                        }
                    }
                }
            }
        });
        
        
        // JavaScript code for the bar chart
        var ratings = <?php echo json_encode($ratings); ?>;
        var reviewCounts = <?php echo json_encode($reviewCounts); ?>;

        var barCtx = document.getElementById('reviewChart').getContext('2d');
        var reviewChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ratings,
                datasets: [{
                    label: 'Number of Reviews',
                    data: reviewCounts,
                    backgroundColor: '#3deb6c',
                    borderColor: '#3deb6c',
                    borderWidth: 1,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Reviews',
                            font: {
                                family: 'Poppins'
                            }
                        },
                        ticks: {
                            font: {
                                family: 'Poppins'
                            }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Ratings',
                            font: {
                                family: 'Poppins'
                            }
                        },
                        ticks: {
                            font: {
                                family: 'Poppins'
                            }
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Reviews Distribution',
                        font: {
                            family: 'Poppins',
                            size: 20
                        }
                    }
                }
            }
        });

        
    // JavaScript code for the polar area chart
    var scores = <?php echo json_encode($scores); ?>;
    var scoreCounts = <?php echo json_encode($scoreCounts); ?>;
    var backgroundColors = [];
    for (var i = 0; i < scores.length; i++) {
        var color = 'rgba(' + (Math.floor(Math.random() * 256)) + ',' + 
                    (Math.floor(Math.random() * 256)) + ',' + 
                    (Math.floor(Math.random() * 256)) + ', 0.6)';
        backgroundColors.push(color);
    }

    var polarData = {
        datasets: [{
            data: scoreCounts,
            backgroundColor: backgroundColors,
            borderWidth: 1
        }],
        labels: scores
    };

    var polarCtx = document.getElementById('polarChart').getContext('2d');
    var polarChart = new Chart(polarCtx, {
        type: 'polarArea',
        data: polarData,
        options: {
            elements: {
                arc: {
                    borderColor: '#ffffff'
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Scores Distribution',
                    font: {
                        family: 'Poppins',
                        size: 20
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var index = context.dataIndex;
                            var label = 'Quiz Score: ' + scores[index] + ' - User Count: ' + scoreCounts[index];
                            return label;
                        }
                    }
                }
            },
            scale: {
                ticks: {
                    display: false
                }
            },
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            }
        }
    });

    function downloadPDF() {
    const pdf = new jsPDF('landscape');
    const canvas1 = document.getElementById('modelUsageChart');
    const canvas2 = document.getElementById('diagnosisChart');
    const canvas3 = document.getElementById('reviewChart');
    const canvas4 = document.getElementById('polarChart');

    const canvasImage1 = canvas1.toDataURL('image/png', 1.0);
    const canvasImage2 = canvas2.toDataURL('image/png', 1.0);
    const canvasImage3 = canvas3.toDataURL('image/png', 1.0);
    const canvasImage4 = canvas4.toDataURL('image/png', 1.0);

    // Add the title within the PDF
    const pageTitle = 'SYSTEM REPORTS AS OF - ' + new Date().toLocaleString();

    pdf.addFont('Poppins-Regular.ttf', 'Poppins', 'normal');
    pdf.setFont('Poppins');
    pdf.setFontSize(30);
    pdf.setFontStyle('bold');
    pdf.text(30, 100, pageTitle);

    pdf.addPage();

    pdf.addImage(canvasImage1, 'PNG', 15, 15, 280, 150);
    pdf.addPage();
    pdf.addImage(canvasImage2, 'PNG', 60, 15, 180, 180);
    pdf.addPage();
    pdf.addImage(canvasImage3, 'PNG', 5, 15, 280, 150);
    pdf.addPage();
    pdf.addImage(canvasImage4, 'PNG', 60, 15, 180, 180);

    pdf.save('Cholera-System-Report.pdf');
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
          <span class="material-symbols-outlined">person</span>
          <a href="display-feedback.php">Feedback</a>
        </li>
        
        <hr>

        <li class="logout-link">
          <span class="material-symbols-outlined">logout</span>
          <a href="logout-user.php">Logout</a>
        </li>
      </ul>
    </aside>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>      
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>