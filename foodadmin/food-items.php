<?php 
include_once("config/config.php"); 
$added_date = date("Y-m-d H:i:s");
$modified_date = date("Y-m-d H:i:s");
if($_POST['submit']=='Submit' && $_POST['update']!= ''){
$category_id=trim($_POST['category_id']);
$food_name=trim($_POST['food_name']);
$food_price=trim($_POST['food_price']);
$food_desc=trim($_POST['food_desc']);
$food_inventory=trim($_POST['food_inventory']);
$update_query = $mysqli->query("UPDATE food_items SET category_id='$category_id',food_name='$food_name' ,food_price='$food_price',food_desc = '$food_desc' , food_inventory ='$food_inventory',added_date='".$added_date."' WHERE id='".$_POST['update']."'");

     if(isset($_FILES['food_image']['name']) && count($_FILES['food_image']) > 0 ){
      $file_tmp =$_FILES['food_image']['tmp_name'];
      $file_type=$_FILES['food_image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['food_image']['name'])));
      $file_name = $_POST['update'].".".$file_ext;
      move_uploaded_file($file_tmp,"food_images/".$file_name);
      $update_query = $mysqli->query("UPDATE food_items SET food_image='".$file_ext."' WHERE id='".$_POST['update']."' limit 1 ");
    }



    	if($update_query)
			{
			$msg="Food Item Updated Successfully";
			}
		else{
	        $msg="Error In Updation";
	        }
}
if($_GET['action']=='updation' && $_GET['id']!= ''  && $_GET['status']!= ''){
$update_query = $mysqli->query("UPDATE food_items SET status='".$_GET['status']."' WHERE id='".$_GET['id']."'");
    	if($update_query)
			{
			header("location:food-items.php");
			}
		else{
	        $msg="Error In Disable Operation";
	        }
}
if($_GET['action']=='edit' && $_GET['id']!= ''){
//echo 	"SELECT * FROM category where id='".$_GET["id"]."'";	
	    $results = $mysqli->query("SELECT * FROM food_items where id='".$_GET["id"]."'");
	    $row = $results->fetch_assoc();
		if(!is_array($row))
			{
			$msg="Not found ID=".$_GET["id"];
			}
		else{
			$uid=$row['id'];
			$ucategory_id=$row['category_id'];
			$ufood_name=$row['food_name'];
			$ufood_price=$row['food_price'];
			$ufood_desc=$row['food_desc'];
			$ufood_inventory=$row['food_inventory'];
		    }
}

if($_POST['submit']=='Submit' && $_POST['food_name'] !=  '' && $_POST['food_price'] !=  '' && $_POST['food_desc'] !=  '' && $_POST['food_inventory'] !=  '' && empty($_POST['update'])){ 
$category_id = '"'.$mysqli->real_escape_string(trim($_POST['category_id'])).'"';
$food_name = '"'.$mysqli->real_escape_string(trim($_POST['food_name'])).'"';
$food_price = '"'.$mysqli->real_escape_string(trim($_POST['food_price'])).'"';
$food_desc = '"'.$mysqli->real_escape_string(trim($_POST['food_desc'])).'"';
$food_inventory = '"'.$mysqli->real_escape_string(trim($_POST['food_inventory'])).'"';
$insert_row = $mysqli->query("INSERT INTO food_items(category_id, food_name,food_price,food_desc,food_inventory,added_date,status) VALUES($category_id, $food_name,$food_price,$food_desc,$food_inventory,'".$added_date."','1')");

if($mysqli->insert_id){
    if(isset($_FILES['food_image']['name']) && count($_FILES['food_image']) > 0 ){
      $file_tmp =$_FILES['food_image']['tmp_name'];
      $file_type=$_FILES['food_image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['food_image']['name'])));
      $file_name = $mysqli->insert_id.".".$file_ext; 
      move_uploaded_file($file_tmp,"food_images/".$file_name);
      $update_query = $mysqli->query("UPDATE food_items SET food_image='".$file_ext."' WHERE id='".$mysqli->insert_id['id']."' limit 1 ");
    }
}


if($insert_row){
	$msg="Food Item Inserted Successfully";
	}
	else{
	$msg="Error In Insertion";
	}
}
?>
<!DOCTYPE html>
<html xmlns="">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Canada Food Point Admin Panel</title>
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
          <h2>Manage Food Items</h2>
        </div>
      </div>
      <!-- /. ROW  -->
      <hr />
      <div class="row">
        <div class="col-md-12">
          <!-- Form Elements -->
          <div class="panel panel-default">
              <div class="panel-heading"> <?php echo isset($msg) && $msg!= '' ? $msg : ''; ?> </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-6">
                  
                    <form role="form" action="food-items.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="update" value="<?php echo $uid; ?>" >
                    <div class="form-group">
                      <label>Add Food Item Name</label>
                      <input type="text" class="form-control"  required  name="food_name" id="food_name" placeholder="Please Enter Food Item Name" value="<?php echo $ufood_name; ?>" />
                    </div>
                    <div class="form-group">
                      <label>Add Food Item Image</label>
                      <input <?php echo isset($uid) && $uid >0 ? "required" : ""; ?>  accept=".jpg,.png,.jpeg" type="file" class="form-control"  required  name="food_image" id="food_image"   />   
                      <small class="customSmall">Image file format: .jpg, .png, .jpeg</small>
                    </div>
                    <div class="form-group">
                      <label>Category Name<?php echo $uid; ?></label>
                    <select class="form-control" name="category_id" id="category_id">
                        <option value="" selected disabled>Select Category </option>
                        <?php
					 
                        $results = $mysqli->query("SELECT * FROM category where status='1'");
                        while($row = $results->fetch_assoc()) {
                            $selected = '';
                            if(isset($ucategory_id) && $ucategory_id == $row['id']){
                                $selected = ' selected ';
                            }else{
                                $selected = '';
                            }
                     echo "<option $selected value='".$row['id']."'>".$row['category']."</option>";
                       }									//PASS ID NOT NAME
                       ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Price</label>
                      <input type="text" class="form-control"  required  name="food_price" id="food_price" placeholder="Please Enter Food Item Price" value="<?php echo $ufood_price; ?>" onkeyup="this.value=this.value.replace(/[^\d]/,'')" />
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control" required id="food_desc" name="food_desc" rows="3"><?php echo $ufood_desc; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label>Inventory</label>
                      <select class="form-control" name="food_inventory" id="food_inventory">
                          <option value="" selected disabled>Select Option</option>
                          <option value="1" <?php echo isset($ufood_inventory) && $ufood_inventory==1 ? "selected" : " ";  ?>>Yes</option>
                        <option value="0" <?php echo isset($ufood_inventory) && $ufood_inventory==0 ? "selected" : " ";  ?>>No</option>  
                      </select>
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
            <div class="panel-heading"> Manage Food Items</div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Food Name</th>
                      <th>Food Desc</th>
                      <th>Category</th>
                      <th>Price</th>
                      <th>Inventory</th>
                      <th>Status</th>
                      <th style="text-align: center;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
				   $results = $mysqli->query("SELECT a.*,b.category FROM food_items as a left join category as b on a.category_id = b.id where b.status = 1 order by a.id desc ");
				   while($row = $results->fetch_assoc()) {
				   ?>
                    <tr class="odd gradeX">
                      <td width="2%"><?php echo $row['id']; ?></td>
                      <td width="5%"><?php echo $row['food_name']; ?></td>
                      <td width="10%"><?php echo substr($row['food_desc'],0,25); ?></td>
                       <td width="2%" ><?php echo $row['category']; ?></td>
                      <td width="2%" ><?php echo $row['food_price']; ?></td>
                      <td width="2%" ><?php echo $row['food_inventory']==1 ? " Yes"  : " No"; ?></td>
                      <td width="2%" ><?php echo $row['status']==1 ? " Active"  : " In-active"; ?></td>
                      <td width="10%" class="center"><a  class="btn btn-default" href="food-items.php?action=edit&id=<?php echo $row['id'];?>">Edit</a>&nbsp;&nbsp;
                      <?php if($row['status']==1){?>
                          <a  class="btn btn-default" href="food-items.php?action=updation&status=0&id=<?php echo $row['id'];?>">Disable</a> <?php }else {?><a  class="btn btn-default" href="food-items.php?action=updation&status=1&id=<?php echo $row['id'];?>">Enable</a><?php } ?></td>
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
