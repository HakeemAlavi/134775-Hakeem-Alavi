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
            if (isset($_POST['rating'])) {
                $rating = $_POST['rating'];
                $submit_status = 1; // 1 represents submission

                $check_sql = "SELECT * FROM userreview WHERE user_id = '$user_id'";
                $check_run_Sql = mysqli_query($con, $check_sql);
                
                if (mysqli_num_rows($check_run_Sql) > 0) {
                    $edit_sql = "UPDATE userreview SET review = '$rating', submit_status = '$submit_status' WHERE user_id = '$user_id'";
                    if (mysqli_query($con, $edit_sql)) {
                        header('Location: review.php');
                    } else {
                        echo "Error: " . $edit_sql . "<br>" . mysqli_error($con);
                    }
                } else {
                    $sql_insert = "INSERT INTO userreview (user_id, review, submit_status) VALUES ('$user_id', '$rating', '$submit_status')";

                    if (mysqli_query($con, $sql_insert)) {
                        header('Location: review.php');
                    } else {
                        echo "Error: " . $sql_insert . "<br>" . mysqli_error($con);
                    }
                }
            }
        }
    }
} else {
    header('Location: review.php');
}
mysqli_close($con);
?>
