<?php
include('includes/config.php');
if(isset($_POST['reg_btn']))
{
//Getting values
$hospitalname=$_POST['hospitalname'];
$email=$_POST['email'];
$password=md5($_POST['password']);
// Query for validation of hospitalname and email-id duplicates
$ret="SELECT * FROM hospitalusers where(hospitalname=:uname ||  email=:uemail)";
$queryt = $dbh -> prepare($ret);
$queryt->bindParam(':uemail',$email,PDO::PARAM_STR);
$queryt->bindParam(':uname',$hospitalname,PDO::PARAM_STR);
$queryt -> execute();
$results = $queryt -> fetchAll(PDO::FETCH_OBJ);
if($queryt -> rowCount() == 0)
{
// Query for inserting data to DB
$sql="INSERT INTO hospitalusers(hospitalname,email,password) VALUES(:hospitalname,:email,:password)";
$query = $dbh->prepare($sql);
$query->bindParam(':hospitalname',$hospitalname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="You have signup Successfully. Please Login";
}
else
{
$error="Something went wrong.Please try again";
}
}
 else
{
$error="hospitalname or Email-id already exist. Please try again";
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
    <title>Register </title>
</head>
<body>
<div class="header">
  <a href="#" class="logo">Blood Bank</a>
  <div class="header-right">
    <a href="index.php">Home</a>
    <a href="hosp-login.php">Login</a>
    <a href="#about"></a>
  </div>
</div>
<!-- Error or success message -->
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
<div class="form-wrapper">
    <form name="signup" method="post" action="hosp-register.php" class="form">
      <h2>Hospital Register</h2>
      <div class="input-group">
        <input type="text" name="hospitalname" pattern="[a-zA-Z\s]+" title="Full name must contain letters only" id="loginUser" required>
        <label for="hospitalname">Hospital Name<span style="color:red">*</label>  
    </div>
    <div class="input-group">
        <input type="email" name="email" onBlur="checkEmailAvailability()"  required>
        <label for="email">Email<span style="color:red">*</span></label>  
    </div>
      <div class="input-group">
        <input type="password" name="password" id="reg_Password" pattern="^\S{4,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 4 characters' : '');" if(this.checkValidity()) form.password_two.pattern = this.value; required>
        <label for="password">Password<span style="color:red">*</span></label>
      </div>
      <input type="submit" name="reg_btn" value="Register" class="submit-btn" style="cursor:pointer">
     
      <p>
		Already a member? <a href="hosp-login.php">Sign in</a>
  	</p>
    </form>

  </div>
    <!--Footer  -->
  <?php include('includes/footer.php');?>
  
</body>
</html>