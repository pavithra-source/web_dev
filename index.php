<?php
session_start();
include('includes/config.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Blood Bank Welcome Page</title>
   
</head>
<body>
<?php include('includes/header.php');?>

    <div class="heading"> <h2>Available Blood Sample List</h2></div>
    <div class="row">    
<?php

$status=1;
$sql = "SELECT * from hospitalblooddetails where status=:status ";
$query = $dbh -> prepare($sql);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
 <div class="card">
        <div class="card-header">
          <h1>Hospitals</h1>
        </div>
        <div class="card-body">
         <p class="card-text"><b>Hospital Name :</b> <?php echo htmlentities($result->hospitalname);?></p>
          <p class="card-text"><b>Blood Group :</b> <?php echo htmlentities($result->bloodgroup);?></p>
          <a href="Login.php" class="btn">Request</a>
        </div>
      </div>
    
    <?php }} ?>
  </div>
<!-- footer -->
  <?php include('includes/footer.php');?>
  <script src="js/header.js"></script>
</body>
</html>