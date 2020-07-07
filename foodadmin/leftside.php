<div class="sidebar-collapse" style="background-color:#A2B63C;">
  <ul class="nav" id="main-menu">
    <li class="text-center" > </li>
    
    <li> <a class=""  href="home.php"><i class="fa fa-home fa-2x"></i> Dashboard</a> </li>
    <?php  //  if(isset($_SESSION['role']) && ( $_SESSION['role'] ==1 ||  $_SESSION['role'] ==2 ) ) { ?>
    <li> <a  href="category.php"><i class="fa fa-edit fa-2x"></i>Manage Categories</a> </li>  
    <li> <a  href="food-items.php"><i class="fa fa-edit fa-2x"></i>Manage Food Items</a> </li>
    <?php // } ?>
     <?php // if(isset($_SESSION['role']) && (  $_SESSION['role'] ==2 ) ) { ?>
    <li> <a  href="employee.php"><i class="fa fa-edit fa-2x"></i>Manage Employees</a> </li>   
    <li> <a  href="customer.php"><i class="fa fa-edit fa-2x"></i>Manage Customers</a> </li>   
    <?php // } ?>
    <li> <a  href="logout.php"><i class="fa fa-table fa-3x"></i>Logout</a> </li>
    </ul>
</div>
