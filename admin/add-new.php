<?php
include "../connection.php";

if (isset($_POST["submit"])) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $status = $_POST['status'];
   $authorization = $_POST['authorization'];
   
   $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

   $sql = "INSERT INTO `usertable`(`id`, `name`, `email`, `password`, `status`, `authorization`) VALUES (NULL,'$name','$email','$hashedPassword','$status','$authorization')";

   $result = mysqli_query($con, $sql);

   if ($result) {
      header("Location: user-panel.php?msg=New record created successfully");
   } else {
      echo "Failed: " . mysqli_error($con);
   }
}

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
        
        
        
    </style>  
   <title>User Panel</title>
</head>

<body>
<nav class="navbar">
    <a href="../admin-home.php"><img src="" style="width:40px;height:40px;"></a>
    <button type="button" class="btn btn-light"><a href="../logout-user.php">Logout</a></button>
    </nav>

   <div class="container">
      <div class="text-center mb-4">
         <h3>Add New User</h3>
         <p class="text-muted">Complete the form below to add a new user</p>
      </div>

      <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Name:</label>
                  <input type="text" class="form-control" name="name" placeholder="Albert">
               </div>

               <div class="col">
                  <label class="form-label">Email:</label>
                  <input type="email" class="form-control" name="email" placeholder="name@example.com">
               </div>
            
               <div class="col">
                  <label class="form-label">Password:</label>
                  <input type="password" class="form-control" name="password" placeholder="5trathm0re">
               </div>
            </div>
            <br>
            <div class="form-group mb-3">
               <label>Status:</label>
               &nbsp;
               &nbsp;
               &nbsp;
               <input type="radio" class="form-check-input" name="status" id="notverified" value="notverified">
               <label for="notverified" class="form-input-label">Not Verified</label>
               &nbsp;
               &nbsp;
               &nbsp;
               <input type="radio" class="form-check-input" name="status" id="verified" value="verified">
               <label for="verified" class="form-input-label">Verified</label>
            </div>

            <!-- <div class="mb-3">
               <label class="form-label">Authorization:</label>
               <input type="text" class="form-control" name="authorization" placeholder="user">
            </div> -->

            <div class="form-group mb-3">
               <label>Authorization:</label>
               &nbsp;
               &nbsp;
               &nbsp;
               <input type="radio" class="form-check-input" name="authorization" id="admin" value="admin">
               <label for="admin" class="form-input-label">Admin</label>
               &nbsp;
               &nbsp;
               &nbsp;
               <input type="radio" class="form-check-input" name="authorization" id="user" value="user">
               <label for="user" class="form-input-label">User</label>
            </div>

            <div>
               <button type="submit" class="btn btn-success" name="submit">Save</button>
               &nbsp;
               &nbsp;
               &nbsp;
               <a href="user-panel.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>
   </div>
   <aside class="sidebar">
      <div class="logo">
      <img src="../media/pharmacy.png" alt="logo">
        <h2>CholeraCare</h2>
      </div>
      <ul class="links">
      <li>
          <span class="material-symbols-outlined">dashboard</span>
          <a href="../admin-home.php">Dashboard</a>
        </li>
        <li>
        <li>
          <span class="material-symbols-outlined">group</span>
          <a href="user-panel.php">Users Panel </a>
        </li>
        <li>
          <span class="material-symbols-outlined">monitoring</span>
          <a href="../admin-charts.php">Analytics</a>
        </li>
        <li>
          <span class="material-symbols-outlined">person</span>
          <a href="../display-feedback.php">Feedback</a>
        </li>
        
        <hr>

        <li class="logout-link">
          <span class="material-symbols-outlined">logout</span>
          <a href="../logout-user.php">Logout</a>
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