<?php
session_start();
include('includes/config.php');
if(isset($_POST['login-btn']))
{
$email=$_POST['hospitalname'];
$password=md5($_POST['password']);
$sql ="SELECT hospitalname,password FROM hospitalusers WHERE hospitalname=:hospitalname and password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':hospitalname', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['hospitalname']=$_POST['hospitalname'];
header('location: hosp-home.php');
} else{

  $error="Invalid Username or Password.Please try again";

}

}

?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/error.css">
 

	<title>Blood Bank | Hospital Login</title>
	
</head>

<body>
<!-- Header -->
<div class="header">
  <a href="index.php" class="logo">Blood Bank</a>
  <div class="header-right">
    <a href="index.php">Home</a>
    <a href="hosp-register.php">Register</a>
    <a href="#about"></a>
  </div>
</div>
<!-- Error or Success Message -->
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
<div class="form-wrapper">
    <form method="post" class="form">
      
      <h2>Login Hospital</h2>
      <div class="input-group">
        <input type="text" name="hospitalname" id="loginUser" required>
        <label for="loginUser">User Name<span style="color:red">*</label>
      </div>
      <div class="input-group">
        <input type="password" name="password" id="loginPassword" required>
        <label for="loginPassword">Password<span style="color:red">*</label>
      </div>
      <input type="submit" name="login-btn"value="Login" class="submit-btn">
      New member? <a href="hosp-register.php">Sign Up</a>
    </form>

  </div>
  <!-- Footer -->
  <?php include('includes/footer.php');?>
</body>

</html>
