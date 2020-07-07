<?php 
include_once("config/config.php");
$added_date = date("Y-m-d H:i:s");
$modified_date = date("Y-m-d H:i:s");
if($_POST['submit']=='Submit' && $_POST['update']!=''){
$name=trim($_POST['name']); 
$gender=trim($_POST['gender']); 
$department=trim($_POST['department']); 
$update_query = $mysqli->query("UPDATE employee SET name='$name', gender='$gender',department='$department',   modified_date='$modified_date'    WHERE id='".$_POST['update']."'");
    	if($update_query)
			{
			$msg="Employee detail Updated Successfully";
			}
		else{
	        $msg="Error In Updation";
	        }
}
if($_GET['action']=='updation' && $_GET['id']!=''  && $_GET['status']!=''){
$update_query = $mysqli->query("UPDATE employee SET status='".$_GET['status']."' WHERE id='".$_GET['id']."'");
    	if($update_query)
			{
			header("location:employee.php");
			}
		else{
	        $msg="Error In Disable Operation";
	        }
}
if($_GET['action']=='edit' && $_GET['id']!=''){ 
	    $results = $mysqli->query("SELECT * FROM employee where id='".$_GET["id"]."'");
	    $row = $results->fetch_assoc();
		if(!is_array($row))
			{
			$msg="Not found ID=".$_GET["id"];
			}
		else{
			$uid=$row['id'];
			$uname=$row['name']; 
			$ugender=$row['gender']; 
			$udepartment=$row['department']; 
		    }
}

if($_POST['submit']== 'Submit' && $_POST['name'] != ''  && $_POST['gender'] != '' && $_POST['department'] != ''  && empty($_POST['update'])){
$name = '"'.$mysqli->real_escape_string(trim($_POST['name'])).'"'; 
$gender = '"'.$mysqli->real_escape_string(trim($_POST['gender'])).'"'; 
$department = '"'.$mysqli->real_escape_string(trim($_POST['department'])).'"'; 
 $insert_row = $mysqli->query("INSERT INTO employee(name,gender,department,added_date, status) VALUES($name,$gender,$department,'$added_date','1')");
if($insert_row){
	$msg="Employee added Successfully";
	}
	else{
	$msg="Error In Insertion";
	}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Admin Panel</title>
<!-- BOOTSTRAP STYLES-->
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<!-- FONTAWESOME STYLES-->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<!-- CUSTOM STYLES-->
<link href="assets/css/custom.css" rel="stylesheet" />
<!-- GOOGLE FONTS-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
<div id="wrapper">
  <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
    <?php include_once("header.php"); ?>
  </nav>
  <!-- /. NAV TOP  -->
  <nav class="navbar-default navbar-side" role="navigation">
    <?php include_once("leftside.php"); ?>
  </nav>
  <!-- /. NAV SIDE  -->
  <div id="page-wrapper" >
    <div id="page-inner">
      <div class="row">
        <div class="col-md-12">
          <h2>Manage Employee</h2>
        </div>
      </div>
      <!-- /. ROW  -->
      <hr />
      <div class="row">
        <div class="col-md-12">
          <!-- Form Elements -->
          <div class="panel panel-default">
            <div class="panel-heading"> <?php echo $msg; ?> </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-6">
                  <h3>Add Employee</h3>
                  <form role="form" action="employee.php" method="post">
                    <input type="hidden" name="update" value="<?php echo $uid; ?>" >
                    <div class="form-group">
                      <label>Employee Name</label>
                      <input class="form-control"  required  name="name" id="name" placeholder="Please Enter Name" value="<?php echo $uname; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Gender</label>
                      <select class="form-control" required name="gender" id="gender">
                          <option value="" selected disabled>Select Option</option>
                          <option value="male" <?php echo isset($ugender) && $ugender=='male' ? "selected" : " ";  ?>>Male</option>
                        <option value="female" <?php echo isset($ugender) && $ugender=='female' ? "selected" : " ";  ?>>Female</option>  
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Department</label>
                      <input class="form-control"  required  name="department" id="department" placeholder="Please Enter Department" value="<?php echo $udepartment; ?>" />
                    </div>
                     
                    <input type="submit" class="btn btn-default" value="Submit" name="submit" >
                    &nbsp;&nbsp;
                    <input type="reset" class="btn btn-primary" value="Reset">
                  </form>
                  <br />
                </div>
              </div>
            </div>
          </div>
          <!-- End Form Elements -->
        </div>
        <div class="col-md-12">
          <!-- Advanced Tables -->
          <div class="panel panel-default">
            <div class="panel-heading"> Manage Employees</div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Employee</th> 
                      <th>Gender</th> 
                      <th>Department</th> 
                      <th align="center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
				   $results = $mysqli->query("SELECT a.*  FROM employee as a   order by a.id desc ");
				   while($row = $results->fetch_assoc()) {
				   ?>
                    <tr class="odd gradeX">
                      <td width="10%"><?php echo $row['id']; ?></td>
                      <td width="10%"><?php echo $row['name']; ?></td>
                      <td width="10%"><?php echo $row['gender']; ?></td>
                      <td width="10%"><?php echo $row['department']; ?></td>
                       
                      <td width="10%" class="center"><a  class="btn btn-default" href="employee.php?action=edit&id=<?php echo $row['id'];?>">Edit</a>&nbsp;&nbsp;
                      <?php if($row['status']==1){?>
                      <a  class="btn btn-default" href="employee.php?action=updation&status=0&id=<?php echo $row['id'];?>">Disable</a> <?php }else {?><a  class="btn btn-default" href="employee.php?action=updation&status=1&id=<?php echo $row['id'];?>">Enable</a><?php } ?></td>
                      <?php } ?>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!--End Advanced Tables -->
        </div>
      </div>
      <!-- /. ROW  -->
      <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
  </div>
  <!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="assets/js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="assets/js/jquery.metisMenu.js"></script>

<!-- DATA TABLE SCRIPTS -->
<script src="assets/js/dataTables/jquery.dataTables.js"></script>
<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
<script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
</body>
</html>
