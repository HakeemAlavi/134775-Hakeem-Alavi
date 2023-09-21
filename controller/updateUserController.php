<?php
    include_once "../connection.php";

    $u_id=$_POST['u_id'];
    $u_name= $_POST['u_name'];
    $u_email= $_POST['u_email'];
   
    $updateUser = mysqli_query($con,"UPDATE usertable SET 
        name=$u_name, 
        email=$u_email,
        WHERE id=$u_id");


    if($updateUser)
    {
        echo "true";
    }
?>