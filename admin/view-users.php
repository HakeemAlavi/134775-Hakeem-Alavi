<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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
    
        h1 {
            width: 100%;
            text-align: center;
            font-size: 28px;
            font-weight: 600;
            font-family: 'Poppins';
            padding: 30px;
            
        }
        * {
            font-family: "Poppins";
        }
        .users {
            width: fit-content;
            transform: translate(30%, 0%);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            box-shadow: 0 2px 15px rgba(64, 64, 64, .7);
            border-radius: 12px 12px 0 0;
            
        }

        td,
        th {
            padding:10px 16px;
            text-align: center;
            
        }

        th {
            background-color: #3deb6c;
            color: #fafafa;
            font-family: 'Poppins';
            font-weight: bold;
        }

        tr {
            width: 100%;
            background-color: #fafafa;
            
        }

        tr:nth-child(even) {
            background-color: #eeeeee;
        }

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
    </style>
</head>
<body> 
<nav class="navbar">
    <a href="../admin-home.php"><img src="../media/pharmacy.png" style="width:40px;height:40px;"></a>
    <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
</nav>       
<div class="users" >
  <h1>All Users</h1>
  <table class="table">
    <thead>
      <tr>
        <th class="text-center">No.</th>
        <th class="text-center">Name </th>
        <th class="text-center">Email</th>
        <th class="text-center">Status</th>
        <th class="text-center">Role</th>
        <th class="text-center" colspan="2">Action</th>
      </tr>
    </thead>
    <?php
      include_once "../connection.php";
      $sql="SELECT * from usertable WHERE authorization = 'user'";
      $result=$con-> query($sql);
      $count=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
           
    ?>
    <tr>
      <td><?=$count?></td>
      <td><?=$row["name"]?></td>
      <td><?=$row["email"]?></td>
      <td><?=$row["status"]?></td>
      <td><?=$row["authorization"]?></td>
      <td><button class="btn btn-primary" style="height:35px" onclick="userEditForm('<?=$row['id']?>')">Edit</button></td>
      <td><button class="btn btn-danger" style="height:35px"  onclick="userDelete('<?=$row['id']?>')">Delete</button></td>
    </tr>
    <?php
            $count=$count+1;
           
        }
    }
    ?>
  </table>
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
          <a href="view-users.php">Users Panel </a>
        </li>
        <li>
          <span class="material-symbols-outlined">show_chart</span>
          <a href="#">Revenue</a>
        </li>
        <li>
          <span class="material-symbols-outlined">flag</span>
          <a href="#">Reports</a>
        </li>
        <hr>
        
        <li>
          <span class="material-symbols-outlined">person</span>
          <a href="#">Designer</a>
        </li>
        
        <li>
          <span class="material-symbols-outlined">ambient_screen</span>
          <a href="#">Magic Build</a>
        </li>
        <li>
          <span class="material-symbols-outlined">pacemaker</span>
          <a href="#">Theme Maker</a>
        </li>
        <li>
          <span class="material-symbols-outlined">monitoring</span>
          <a href="#">Analytic</a>
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

<script type="text/javascript" src="../js/functions.js"></script>    
<script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>