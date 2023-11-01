<?php
require_once "connection.php";
require_once "controllerUserData.php";

$email = $_SESSION['email'];
if ($email != false) {
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if ($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $user_id = $fetch_info['id'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $feedback = $_POST['feedback'];
            $diagnosis = $_POST['diagnosis'];

            // Add the read_status field to the SQL query
            $sql_insert = "INSERT INTO userfeedback (feedback_id, user_id, diagnosis, feedback, submission_time, read_status) VALUES (NULL, '$user_id', '$diagnosis', '$feedback', NOW(), 0)";

            if (mysqli_query($con, $sql_insert)) {
                echo '<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">';
                echo '<img src="media/checked.png" alt="Checked" style="max-width: 150px; max-height: 150px;" />';
                echo '</div>'; 

                // Script to close the window after 3 seconds
                echo '<script>';
                echo 'setTimeout(function(){ window.close(); }, 3000);';
                echo '</script>';
            } else {
                echo "Error: " . $sql_insert . "<br>" . mysqli_error($con);
            }
        }
    }
} else {
    header('Location: home.php');
}
mysqli_close($con);
?>
