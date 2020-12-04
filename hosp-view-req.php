<?php 
session_start();
  error_reporting(0);
  include('includes/config.php');
  if(strlen($_SESSION['hospitalname'])==0){
    header('location:index.php');
  }
  else

  if(isset($_REQUEST['hide']))
  {
$eid=intval($_GET['hide']);
$status="0";
$sql = "UPDATE requestedbloodinfo SET Status=:status WHERE  id=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();

$msg="Cancelled Confirmation";
}


if(isset($_REQUEST['public']))
  {
$aeid=intval($_GET['public']);
$status=1;

$sql = "UPDATE requestedbloodinfo SET Status=:status WHERE  id=:aeid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
$query -> execute();

$msg="Successfully Confirmed";
}
if(isset($_REQUEST['del']))
  {
$did=intval($_GET['del']);
$sql = "delete from requestedbloodinfo WHERE  id=:did";
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
    <title>Blood Bank | Hospital View Request</title>
</head>
<body>
<div class="header">
  <a href="#" class="logo">Blood Bank</a>
  <div class="header-right">
  <a href="hosp-home.php">Dashboard</a>
  <a href="hosp-manage-info.php">My Blood Samples</a>
  <a href="hosp-add-blood.php">Add Blood Samples</a>
    <a href="logout.php">Logout</a>
  </div>
</div>
<section> 
       <div class="heading"> <h2>Blood Requester List</h2> </div>
        <table> 
            <tr> 
                <th>#</th>
                <th>User Name</th> 
                <th>Blood Request</th> 
                <th>Action </th>
            </tr> 
            <?php
           
            // SQL query to select data from database 
            $hospitalname= $_SESSION['hospitalname'];
$sql = "SELECT * FROM requestedbloodinfo WHERE hospitalname='$hospitalname'"; 
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>
            <tr> 
                <!--FETCHING DATA FROM EACH  
                    ROW OF EVERY COLUMN--> 
                <td><?php echo htmlentities($cnt);?></td>
                <td><?php echo htmlentities($result->username);?></td> 
                <td><?php echo htmlentities($result->bloodgroup);?></td> 
                <td>
                <?php if($result->status==1)
{?>
<button><a href="hosp-view-req.php?hide=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to cancel')"> Cancel</a></button>
<?php } else {?>

<button><a href="hosp-view-req.php?public=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Confirm')"> Confirm</a></button>

<?php } ?>
<button><a href="hosp-view-req.php?del=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to delete this record')"> Delete</a></button>
                </td>
              
            </tr> 
           
               	<?php $cnt=$cnt+1; } }
             ?> 
        </table> 
    </section> 

</body>
</html>
