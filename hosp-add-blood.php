<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['hospitalname'])==0)
	{
header('location:index.php');
}
else{
  
$hospitalname = $_SESSION['hospitalname'];
$sql="SELECT * FROM hospitalusers WHERE hospitalname=:hospitalname";
$query = $dbh -> prepare($sql);
$query->bindParam(':hospitalname',$hospitalname);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$hospitalname=$_SESSION['hospitalname'];


	if(isset($_POST['submit-btn']))
	  {

  $bloodgroup=$_POST['bloodgroup'];
	$status=1;
	$sql="INSERT INTO hospitalblooddetails(hospitalname,bloodgroup,status) VALUES(:hospitalname,:bloodgroup,:status)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':hospitalname',$hospitalname,PDO::PARAM_STR);
  $query->bindParam(':bloodgroup',$bloodgroup,PDO::PARAM_STR);
	$query->bindParam(':status',$status,PDO::PARAM_STR);
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
	if($lastInsertId)
	{
	$msg="Your Blood Samples Added successfully";
	}
	else
	{
	$error="Something went wrong. Please try again";
	}
	}
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/error.css">
    <title>Add Blood Available</title>
</head>
<body>
<div class="header">
  <a href="#" class="logo">Blood Bank</a>
  <div class="header-right">
  <a href="hosp-home.php">Dashboard</a>
  <a href="hosp-manage-info.php">My Blood Samples</a>
  <a href="hosp-view-req.php">View Request</a>
  <a href="logout.php">Logout</a>
  </div>
</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

<div class="form-wrapper">
    <form method="post" class="form">
     <h2>Add Blood Available</h2>
     <div class="input-group">
     <label for="bloodgroups">Blood Group:</label>

<select name="bloodgroup" id="bloodgroup">
<?php $sql = "SELECT * from  bloodgroups ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>
<option value="<?php echo htmlentities($result->bloodgroup);?>"><?php echo htmlentities($result->bloodgroup);?></option>
<?php }} ?>
</select>
</div>
<input type="submit" name="submit-btn"value="Update" class="submit-btn">
     
</form>
</div>
    <!-- Footer -->
<?php include('includes/footer.php');?>
</body>
</html>
<?php } ?>