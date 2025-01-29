<?php 
 
// Start session 
if(!session_id()){ 
    session_start(); 
} 
 
// Retrieve session data 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
 
// Get status message from session 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $statusMsgType = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
} 
 
// Get member data 
$memberData = $userData = array(); 
if(!empty($_GET['id'])){ 
    // Include database configuration file 
    require_once 'dbConfig.php'; 
     
    // Fetch data from SQL server by row ID 
    $sql = "SELECT * FROM Rem WHERE RemId = ".$_GET['id']; 
    $query = $conn->prepare($sql); 
    $query->execute(); 
    $memberData = $query->fetch(PDO::FETCH_ASSOC); 
} 
$userData = !empty($sessData['userData'])?$sessData['userData']:$memberData; 
unset($_SESSION['sessData']['userData']); 
 
$actionLabel = !empty($_GET['id'])?'Edit':'Add'; 
 
?>

<!-- Display status message -->
<?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
<div class="col-xs-12">
    <div class="alert alert-success"><?php echo $statusMsg; ?></div>
</div>
<?php }elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>
<div class="col-xs-12">
    <div class="alert alert-danger"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>


<!DOCTYPE html>
<html>
<head>
<style>
.city {
  background-color: sky blue;
  color: black;
  border: 0px solid black;
  margin: 3px;
  padding: 5px;
  text-align: Left;
}
</style>
 <link href="css/bootstrap.css" rel="stylesheet">
  </head>
</head>
<body>

    <div class="col-md-12">
        <h2><?php echo $actionLabel; ?> Reminder</h2>
    </div>
		<div class="col-md-12">
         <form method="post" action="userAction.php">

			<div class="form-group row">
            <label class="col-sm-2 col-form-label">Domain</label>
			<div class="col-sm-10">
            <!-- <input type="text" class="form-control" name="Domain" placeholder="Enter your first name" value="<?php echo !empty($userData['Domain'])?$userData['Domain']:''; ?>" required=""> -->
            <SELECT name="Domain">
				<option value="Non SAP" <?php echo $userData['Domain']=='Non SAP'? 'selected' : '' ?> > Non SAP </option>
				<option value="SAP"  <?php echo $userData['Domain']== 'SAP'? 'selected' : '' ?> >SAP </option>
				
			</SELECT>
			</div>
			</div>
  
		  <!-- <div class="form-group row">
			<label  class="col-sm-2 col-form-label">Type</label>
			<div class="col-sm-10">
			 <input type="text" class="form-control" name="Type" placeholder="Enter Type | Followup | Reminder" value="<?php echo !empty($userData['Type'])?$userData['Type']:''; ?>" required="">
			
			</div>
		  </div> --> 
		  <div class="form-group row">
			<label for="inputPassword3" class="col-sm-2 col-form-label">Active</label>
			<div class="col-sm-10">
		   <input type="text" class="form-control" name="Enabled" placeholder="YES | NO" value="<?php echo !empty($userData['Enabled'])?$userData['Enabled']:''; ?>" required="">
			</div>
		  </div>
  
		<div class="form-group row">
		<label for="inputPassword3" class="col-sm-2 col-form-label">Date_to_send_reminder</label>
		<div class="col-sm-10">
		<input type="date" class="form-control" name="Date_to_send_reminder" placeholder="Enter Date to Send Reminder" value="<?php echo !empty($userData['Date_to_send_reminder'])?$userData['Date_to_send_reminder']:''; ?>" required="">
		</div>
		</div>
		<div class="form-group row">
		<label for="inputPassword3" class="col-sm-2 col-form-label">Subject</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" name="Subject" placeholder="Enter Value to Consider in Email Content" value="<?php echo !empty($userData['Subject'])?$userData['Subject']:''; ?>" required="">
		</div>
		</div>
		
		<div class="form-group row">
		<label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" name="Description" placeholder="Enter Value to Consider in Email Content" value="<?php echo !empty($userData['Description'])?$userData['Description']:''; ?>" required="">
		</div>
		</div>
		
		 <!--<div class="form-group row">
		<label for="inputPassword3" class="col-sm-2 col-form-label">Priority</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" name="Priority" placeholder="High | Medium | Low" value="<?php echo !empty($userData['Priority'])?$userData['Priority']:''; ?>" required="">
		</div>
		</div> -->		
	
		<div class="form-group row">
		<label for="inputPassword3" class="col-sm-2 col-form-label">UserName</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" name="UserName" placeholder="Enter Prefix Name for salutation" value="<?php echo !empty($userData['UserName'])?$userData['UserName']:''; ?>" required="">
		</div>
		</div>	
	
		<div class="form-group row">
		<label for="inputPassword3" class="col-sm-2 col-form-label">Status</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" name="Status" placeholder="Open | Closed" value="<?php echo !empty($userData['Status'])?$userData['Status']:''; ?>" required="">
		</div>
		</div>	
	              
		<div class="form-group row">
		<label for="inputPassword3" class="col-sm-2 col-form-label">To</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" name="To" placeholder="Enter To Email Address" value="<?php echo !empty($userData['To'])?$userData['To']:''; ?>" required="">
		</div>
		</div>	
		
		<div class="form-group row">
		<label for="inputPassword3" class="col-sm-2 col-form-label">CC1</label>
		<div class="col-sm-10">
		<input type="Text" class="form-control" name="CC1" placeholder="Enter CC1 Email Address" value="<?php echo !empty($userData['CC1'])?$userData['CC1']:''; ?>" >
		</div>
		</div>	
		
		<div class="form-group row">
		<label for="inputPassword3" class="col-sm-2 col-form-label">CC2</label>
		<div class="col-sm-10">
		<input type="email" class="form-control" name="CC2" placeholder="Enter CC2 Email Address" value="<?php echo !empty($userData['CC2'])?$userData['CC2']:''; ?>" >
		</div>
		</div>	
		
		<div class="form-group row">
		<label for="inputPassword3" class="col-sm-2 col-form-label">CC3</label>
		<div class="col-sm-10">
		<input type="email" class="form-control" name="CC3" placeholder="Enter CC3 Email Address" value="<?php echo !empty($userData['CC3'])?$userData['CC3']:''; ?>" >
		</div>
		</div>	
		
		<div class="form-group row">
		<label for="inputPassword3" class="col-sm-2 col-form-label">SubmittedDate</label>
		<div class="col-sm-10">
		<input type="date" class="form-control" name="SubmittedDate" placeholder="Enter Requested Date" value="<?php echo !empty($userData['SubmittedDate'])?$userData['SubmittedDate']:''; ?>" required="">
		</div>
		</div>	
		
		<div class="form-group row">
		<label for="inputPassword3" class="col-sm-2 col-form-label">DueDate</label>
		<div class="col-sm-10">
		<input type="date" class="form-control" name="DueDate" placeholder="Enter Due Date" value="<?php echo !empty($userData['DueDate'])?$userData['DueDate']:''; ?>" required="">
		</div>
		</div>	
		<!--
		<div class="form-group row">
		<label for="inputPassword3" class="col-sm-2 col-form-label">Age</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" name="Age" placeholder="Enter your Age" value="<?php //echo !empty($userData['Age'])?$userData['Age']:''; ?>" required="">
		</div>
		</div>	 -->

		            
            <a href="index.php" class="btn btn-info">Back</a>
		
            <input type="hidden" name="RemId" value="<?php echo !empty($userData['RemID'])?$userData['RemID']:''; ?>">
            <input class="btn btn-success" type="submit" name="userSubmit" class="btn btn-success" value="Submit">
        </form>
    </div>
</body>
</html>