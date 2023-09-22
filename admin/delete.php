<?php
include "../connection.php";
$id = $_GET["id"];
$sql = "DELETE FROM `usertable` WHERE id = $id";
$result = mysqli_query($con, $sql);

if ($result) {
  header("Location: user-panel.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($con);
}
