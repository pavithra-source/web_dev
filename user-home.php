<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['username'])==0)
	{
header('location:index.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/error.css">
    <title>Request Blood</title>
</head>
<body>
<div class="header">
  <a href="#" class="logo">Blood Bank</a>
  <div class="header-right">
    <a href="logout.php">Logout</a>
  </div>  
</div>
<div class="heading"> <h2>Available bloods</h2>  </div>
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
         <p class="card-text"><b>Name :</b> <?php echo htmlentities($result->hospitalname);?></p>
          <p class="card-text"><b>Blood Group :</b> <?php echo htmlentities($result->bloodgroup);?></p>
          <a href="request-blood.php"  class="btn">Request</a>
        </div>
      </div>
    
    <?php }} ?>
 
  </div>

<?php include('includes/footer.php');?>

</body>
</html>