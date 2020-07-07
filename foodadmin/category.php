<?php 
include_once("config/config.php");
$added_date = date("Y-m-d H:i:s");
$modified_date = date("Y-m-d H:i:s");
if($_POST['submit']=='Submit' && $_POST['update']!=''){
$category=trim($_POST['category']); 
$update_query = $mysqli->query("UPDATE category SET category='$category', modified_date='$modified_date'    WHERE id='".$_POST['update']."'");
    	if($update_query)
			{
			$msg="Category Updated Successfully";
			}
		else{
	        $msg="Error In Updation";
	        }
}
if($_GET['action']=='updation' && $_GET['id']!=''  && $_GET['status']!=''){
$update_query = $mysqli->query("UPDATE category SET status='".$_GET['status']."' WHERE id='".$_GET['id']."'");
    	if($update_query)
			{
			header("location:category.php");
			}
		else{
	        $msg="Error In Disable Operation";
	        }
}
if($_GET['action']=='edit' && $_GET['id']!=''){
//echo 	"SELECT * FROM category where id='".$_GET["id"]."'";	
	    $results = $mysqli->query("SELECT * FROM category where id='".$_GET["id"]."'");
	    $row = $results->fetch_assoc();
		if(!is_array($row))
			{
			$msg="Not found ID=".$_GET["id"];
			}
		else{
			$uid=$row['id'];
			$ucat=$row['category']; 
		    }
}

if($_POST['submit']== 'Submit' && $_POST['category'] != ''  && empty($_POST['update'])){
$category = '"'.$mysqli->real_escape_string(trim($_POST['category'])).'"'; 
 $insert_row = $mysqli->query("INSERT INTO category(category,added_date, status) VALUES($category,'$added_date','1')");
if($insert_row){
	$msg="Category Inserted Successfully";
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
          <h2>Manage Category</h2>
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
                  <h3>Add Category</h3>
                  <form role="form" action="category.php" method="post">
                    <input type="hidden" name="update" value="<?php echo $uid; ?>" >
                    <div class="form-group">
                      <label>Category Name</label>
                      <input class="form-control"  required  name="category" id="category" placeholder="Please Enter Category" value="<?php echo $ucat; ?>" />
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
            <div class="panel-heading"> Manage Categories</div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Category</th> 
                      <th align="center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
				   $results = $mysqli->query("SELECT a.*  FROM category as a   order by a.id desc ");
				   while($row = $results->fetch_assoc()) {
				   ?>
                    <tr class="odd gradeX">
                      <td width="10%"><?php echo $row['id']; ?></td>
                      <td width="10%"><?php echo $row['category']; ?></td>
                       
                      <td width="10%" class="center"><a  class="btn btn-default" href="category.php?action=edit&id=<?php echo $row['id'];?>">Edit</a>&nbsp;&nbsp;
                      <?php if($row['status']==1){?>
                      <a  class="btn btn-default" href="category.php?action=updation&status=0&id=<?php echo $row['id'];?>">Disable</a> <?php }else {?><a  class="btn btn-default" href="category.php?action=updation&status=1&id=<?php echo $row['id'];?>">Enable</a><?php } ?></td>
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
