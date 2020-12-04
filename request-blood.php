<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['username'])==0)
	{
header('location:index.php');
}
else{

$username=$_SESSION['username'];

	if(isset($_POST['request-btn']))
	  {
      
  $bloodgroup=$_POST['bloodgroup'];
  $hospitalname=$_POST['hospitalname'];
  $status=1;
  
	$sql="INSERT INTO requestedbloodinfo(username,bloodgroup,hospitalname,status) VALUES(:username,:bloodgroup,:hospitalname,:status)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':username',$username,PDO::PARAM_STR);
  $query->bindParam(':bloodgroup',$bloodgroup,PDO::PARAM_STR);
  $query->bindParam(':hospitalname',$hospitalname,PDO::PARAM_STR);
  $query->bindParam(':status',$status,PDO::PARAM_STR);
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
	if($lastInsertId)
	{
	$msg="Your Request Sent successfully";
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
    <title>Request Blood</title>
</head>
<body>
<!-- Header -->
<div class="header">
  <a href="#" class="logo">Blood Bank</a>
  <div class="header-right">
    <a href="user-home.php">Home</a>
    <a href="logout.php">Logout</a>
  </div>
  
</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>


<div class="form-wrapper">
    <form method="post" class="form">
      <h2>Request Blood </h2>
      <div class="input-group">
        <input type="text" name="hospitalname" id="hospitalname" required>
        <label for="hospitalname"> Hospital Name<span style="color:red">*</label>
      </div>
      <div class="input-group">
      <label for="bloodgroups">Blood Group:<span style="color:red">*</label>

<select name="bloodgroup" id="bloodgroup" required>
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
      <input type="submit" name="request-btn" value="Request" class="submit-btn">
     
    </form>

  </div>
  <?php include('includes/footer.php');?>
</body>
</html>
<?php } ?>