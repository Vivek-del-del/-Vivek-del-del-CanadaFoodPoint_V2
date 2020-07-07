<style>
    .main-text{font-size: 14px;}
    .text-box p {  margin: 10px 0 5px;}
</style>
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-red set-icon">
                <i class="fa fa-envelope-o"></i>
            </span>
            <div class="text-box">
                <?php
                $tot_category = $mysqli->query("SELECT count(*) as a FROM category");
                $row = $tot_category->fetch_array();
                ?>
                <p class="main-text"><?php echo $row['a']; ?></p>
                <p class="main-text">Categories</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-green set-icon">
                <i class="fa fa-bars"></i>
            </span>
            <div class="text-box" >
                <?php
                $tot_subcat = $mysqli->query("SELECT count(*) as a FROM food_items where status = '1'");
                $row_subcat = $tot_subcat->fetch_array();
                ?>
                <p class="main-text"><?php echo $row_subcat['a']; ?></p>
                <p class="main-text"> Active Food Items</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-green set-icon">
                <i class="fa fa-bars"></i>
            </span>
            <div class="text-box" >
                <?php
                $tot_subcat = $mysqli->query("SELECT count(*) as a FROM employee where status = '1'");
                $row_subcat = $tot_subcat->fetch_array();
                ?>
                <p class="main-text"><?php echo $row_subcat['a']; ?></p>
                <p class="main-text"> Active Employees</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-6">           
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-blue set-icon">
                <i class="fa fa-bell-o"></i>
            </span>
            <div class="text-box" >
                <?php
                $tot_subcat = $mysqli->query("SELECT count(*) as a FROM food_items where status = '0' ");
                $row_subcat = $tot_subcat->fetch_array();
                ?>
                <p class="main-text"><?php echo $row_subcat['a']; ?></p>
                <p class="main-text">In Active Food Items</p>
            </div>
        </div>
    </div>

</div>