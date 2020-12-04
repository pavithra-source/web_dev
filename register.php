<?php
error_reporting(0);
include('includes/config.php');
if(isset($_POST['reg_btn']))
  {
$username=$_POST['username'];
$email=$_POST['email'];
$bloodgroup=$_POST['bloodgroup'];
$password=md5($_POST['password']);
$ret="SELECT * FROM receiveruser where(username=:username ||  email=:email)";
$queryt = $dbh -> prepare($ret);
$queryt->bindParam(':email',$email,PDO::PARAM_STR);
$queryt->bindParam(':username',$username,PDO::PARAM_STR);
$queryt -> execute();
$results = $queryt -> fetchAll(PDO::FETCH_OBJ);
if($queryt -> rowCount() == 0)
{

$sql="INSERT INTO receiveruser(username,email,bloodgroup,password) VALUES(:username,:email,:bloodgroup,:password)";
$query = $dbh->prepare($sql);
$query->bindParam(':username',$username,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':bloodgroup',$bloodgroup,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Your info submitted successfully Please Login now";
}
else
{
$error="Something went wrong. Please try again";
}

}
else
{
$error="Username or Email-id already exist. Please try again";
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/error.css">
    <title>Receiver Register </title>
</head>
<body>
<div class="header">
  <a href="index.php" class="logo">Blood Bank</a>
  <div class="header-right">
    <a href="index.php">Home</a>
    <a href="Login.php">Login</a>
  </div>
</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
<div class="form-wrapper">
    <form name="signup" method="post" action="register.php" class="form">
      <h2>Receiver Register</h2>
      <div class="input-group">
        <input type="text" name="username" pattern="[a-zA-Z\s]+" title="Full name must contain letters only" id="loginUser" required>
        <label for="hospitalname">User Name<span style="color:red">*</label>  
    </div>
    <div class="input-group">
        <input type="email" name="email" onBlur="checkEmailAvailability()"  required>
        <label for="email">Email<span style="color:red">*</span></label>  
    </div>
    <div class="input-group">
        <input type="password" name="password" id="reg_Password" pattern="^\S{4,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 4 characters' : '');" if(this.checkValidity()) form.password_two.pattern = this.value; required>
        <label for="password">Password<span style="color:red">*</span></label>
      </div>
    <div class="input-group">
     <label for="bloodgroups">Blood Group:</label>
    
<select name="bloodgroup" id="bloodgroup">

<?php $sql = "SELECT * from  bloodgroups";
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

      
      <input type="submit" name="reg_btn" value="Register" class="submit-btn" style="cursor:pointer">
      <p>
  		Already a member? <a href="Login.php">Sign in</a>
    	</p>
    </form>
  </div>
</body>
</html>