<?php
session_start();
include('includes/config.php');

if(strlen($_SESSION['hospitalname'])==0){
    
    header('location:index.php');
  }
  else

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Document</title>
</head>
<body>
<div class="header">
<a href="#" class="logo">Blood Bank</a>
<div class="header-right">
<a href="logout.php">Logout</a>
</div>
</div>
     <div class="row">
     <div class="card">
     <div class="card-body">
     <div class="card-header">
     <a href="hosp-add-blood.php" class="btn">Add Blood Samples</a>
     </div>
     </div>
     </div>
     <div class="card">
     <div class="card-body">
     <div class="card-header">
     <a href="hosp-manage-info.php" class="btn">Manage Blood Samples</a>
     </div>
     </div>
     </div>
  
     <div class="card">
     <div class="card-body">
     <div class="card-header">
     <a href="hosp-view-req.php" class="btn">View Blood Request</a>
     </div>
     </div>
     </div>
</div>
</div>
</body>
</html>