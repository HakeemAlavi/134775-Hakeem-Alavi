<?php

    include_once "../connection.php";
    
    $id=$_POST['record'];
    $query="DELETE FROM usertable where id='$id'";

    $data=mysqli_query($con,$query);

    if($data){
        echo"variation Deleted";
    }
    else{
        echo"Not able to delete";
    }
    
?>