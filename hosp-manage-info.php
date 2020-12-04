<?php 
session_start();
  error_reporting(0);
  include('includes/config.php');
  if(strlen($_SESSION['hospitalname'])==0){
    header('location:index.php');
  }
  else

if(isset($_REQUEST['del']))
  {
$did=intval($_GET['del']);
$sql = "delete from hospitalblooddetails WHERE  id=:did";
$query = $dbh->prepare($sql);
$query-> bindParam(':did',$did, PDO::PARAM_STR);
$query -> execute();

$msg="Record deleted Successfully ";
}


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
    <!--Header -->
<div class="header">
  <a href="#" class="logo">Blood Bank</a>
  <div class="header-right">
  <a href="hosp-home.php">Dashboard</a>
  <a href="hosp-add-blood.php">Add Blood Samples</a>
  <a href="logout.php">Logout</a>
</div>
</div>
<section> 
<div class="heading"> <h2>Manage Your Blood Samples List</h2> </div>
        <table> 
            <tr> 
                <th>#</th>
                <th>Blood Sample List</th> 
                <th>Action </th>
            </tr> 
            <?php
           
// Fetch data for specific user
$hospitalname= $_SESSION['hospitalname'];
$sql = "SELECT * FROM hospitalblooddetails WHERE hospitalname='$hospitalname'"; 
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>
            <tr> 
                <!--Fetching data for each rows--> 
                <td><?php echo htmlentities($cnt);?></td>
                <td><?php echo htmlentities($result->bloodgroup);?></td> 
                <td>
                <?php if($result->status==1)
{?>
<button><a href="hosp-manage-info.php?del=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to delete this record')"> Delete</a></button>
<?php }   ?>

            </td>
              
            </tr> 
           
            <?php $cnt=$cnt+1; } }
             ?> 
        </table> 
    </section> 
</body>
</html>
