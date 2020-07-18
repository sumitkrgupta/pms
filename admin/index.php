<?php include ("includes/db.php"); ?>

<?php
    date_default_timezone_set('Asia/Kolkata');
    session_start();
    if($_SESSION['userrole']==null)
    {
        header("Location: ../index.php"); 
    } 

    
    if($_SESSION['userrole']!= "admin")
    {
        $msg = "User Not Found";
        header('Location: ../index.php');

    } 
   
?>



<html lang="en">

<head>
    <link rel="shortcut icon" type="image/png" href="../image/icon.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Dashboard -Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <link href="fontawesome/css/all.css" rel="stylesheet" type="text/css">

    <link href="mycss/main.css" rel="stylesheet">
</head>
<body>

    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <!-- Top Nav Bar logo -->
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                 <span class="navbar-brand mr-auto text-success">&nbsp;<i class="fas fa-hospital-symbol"></i> UOH Health Centre</span>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
           
            <!--Top Nav Bar contents  -->
            <div class="app-header__content">
                <!-- <div class="app-header-left">
                    <ul class="header-menu nav">
                       <li class="dropdown nav-item">
                            <a href="javascript:void(0);" class="nav-link">
                                <i class="nav-link-icon fa fa-cog"></i>
                                Settings
                            </a>
                        </li>
                    </ul>        
                </div> -->
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <i class="fas fa-user" style="font-size: 30px;"></i>
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <a href="User_profile.php">  
                                                <button type="button" tabindex="0" class="dropdown-item">User Profile</button>
                                            </a>
                                            <a href="">
                                                <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        <?php echo $_SESSION['adminname']; ?>
                                    </div>
                                    <div class="widget-subheading">
                                       <?php echo $_SESSION['userrole']; ?>
                                    </div>
                                </div>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i></a>
                            </div>
                        </div>
                    </div>       
                </div>
            </div>
        </div>              
        <div class="app-main">
            <!-- Side Bar -->
                <div class="app-sidebar sidebar-shadow" style="overflow: auto;">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Side Bar Menu -->
                    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Dashboards</li>
                                <li>
                                    <a href="index.php" class="mm-active">
                                        <i class="metismenu-icon pe-7s-rocket"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Medicinals</li>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-capsules"></i>
                                        Medicines
                                        <i class="fa fa-fw fa-caret-down"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="drugs.php">
                                                <i class="fas fa-capsules"></i>
                                                Medicine Lists
                                            </a>
                                        </li>
                                        <li>
                                            <a href="drug_genric.php">
                                                <i class="fas fa-capsules"></i>
                                                Genric Medicine
                                            </a>
                                        </li>
                                        <li>
                                            <a href="drug_branded.php">
                                                <i class="fas fa-capsules"></i>
                                                </i>Branded Medicine
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="app-sidebar__heading">Stock</li>
                                <li>
                                    <a href="stock.php">
                                       <i class="fas fa-warehouse">
                                        </i>&emsp;Stock Lists
                                    </a>
                                </li>
                                <!-- Recevied orders -->
                                <li class="app-sidebar__heading">Received Orders</li>
                                <li>
                                    <a href="recived_invoice.php">
                                        <i class="fas fa-receipt"></i>
                                        Received Invoice
                                    </a>
                                </li>
                                <!-- Orders -->
                                <li class="app-sidebar__heading"> Orders</li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-first-order"></i>
                                        Orders
                                        <i class="fa fa-fw fa-caret-down"></i>
                                    </a>
                                    <ul>
                                        <li>
                                        <a href="orders.php">
                                            <i class="fab fa-first-order"></i>&emsp;
                                            New Orders
                                        </a>
                                        </li>
                                        <li>
                                        <a href="manage_order.php">
                                            <i class="fas fa-info-circle">&emsp;
                                            </i>Manage Orders
                                        </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="app-sidebar__heading">Reports</li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-file" aria-hidden="true"></i>
                                        Reports
                                        <i class="fa fa-fw fa-caret-down"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="reportForOrder.php">
                                                <i class="fas fa-info-circle"></i>
                                                Purchase Orders Report
                                            </a>
                                        </li>
                                        <li>
                                            <a href="ReceviedReport.php">
                                                <i class="fas fa-info-circle"></i>
                                                Purchase Recevied Report
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Supplier -->
                                <li class="app-sidebar__heading">Suppliers</li>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-capsules"></i>
                                        Suppliers
                                        <i class="fa fa-fw fa-caret-down"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="supplier.php">
                                                <i class="fas fa-info-circle"></i>
                                                Suppliers Lists
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                Orders Date
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-tasks" aria-hidden="true"></i>
                                                </i>&emsp;Drugs Quantity
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="app-sidebar__heading">Manages Company</li>
                                <li>
                                    <a href="drug_company.php">
                                        <i class="fa fa-industry" aria-hidden="true"></i>
                                        Companies Info
                                    </a>
                                </li>
                                <!-- Employye -->
                                <li class="app-sidebar__heading">Manage Employee</li>
                                <li>
                                    <a href="add_staff.php">
                                        <i class="fas fa-users"></i> 
                                        Manage Employee
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> 
                <!-- End Side Menu  -->

                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="row">
                            <!-- Card 1 -->
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-midnight-bloom">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Expire Record</div>
                                            <a href="expiry_list.php"><span class="text-success">View Details</span></a>
                                        </div>
                                        <div class="widget-content-right">
                                            <?php
                                                if(isset($_SESSION['userrole'])) 
                                                {
                                                    if($_SESSION['userrole'] == 'admin') 
                                                    {
                                                        $query = "SELECT drug_name FROM drugs  where DATEDIFF(exp_date,NOW())<=2 and quantity>=1;";
                                                       $count = mysqli_num_rows(mysqli_query($conn,$query));
                                                    } 
                                                }
                                            ?>
                                            <div class="widget-numbers text-white"><span><?php echo $count; ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card 2 -->
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-arielle-smile">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Low Stock</div>
                                            <a href="low_stock.php"><span class="text-white">View Details</span></a>
                                        </div>
                                        <div class="widget-content-right">
                                             <?php
                                                if(isset($_SESSION['userrole'])) 
                                                {
                                                    if($_SESSION['userrole'] == 'admin') 
                                                    {
                                                       $query = "SELECT count(drug_name_id),drug_name,drug_type,power_ml,sum(quantity) as total_quantity,drug_location from drugs where DATEDIFF(exp_date,NOW())>=2 GROUP BY drug_name,drug_type,power_ml HAVING sum(quantity)<=50";
                                                       $count = mysqli_num_rows(mysqli_query($conn,$query));
                                                    } 
                                                }
                                            ?>
                                            <div class="widget-numbers text-white"><span><?php echo $count; ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card 3 -->
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-grow-early">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Medicines</div>
                                            <a href="drugs.php"><span class="text-white">View Details</span></a>
                                        </div>
                                        <div class="widget-content-right">
                                            <?php
                                                if(isset($_SESSION['userrole'])) 
                                                {
                                                    if($_SESSION['userrole'] == 'admin') 
                                                    {
                                                       $query = "SELECT drug_name FROM drugs where quantity>=1";
                                                       $count = mysqli_num_rows(mysqli_query($conn,$query));
                                                    } 
                                                }
                                            ?>
                                            <div class="widget-numbers text-white"><span><?php echo $count; ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card End -->

                        <div class="row">
                             <!-- row 2 Card 1 -->
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-success"><?php echo date('l') .' '.date('d').', '.date('Y'); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- row 2 card 2 -->
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Total Orders</div>
                                                <!-- <div class="widget-subheading">Revenue streams</div> -->
                                            </div>
                                            <div class="widget-content-right">
                                                <?php 
                                                    $query = "SELECT * from orders";
                                                    $result = mysqli_query($conn,$query);
                                                    $count = mysqli_num_rows($result);
                                                ?>
                                                <div class="widget-numbers text-warning"><?php echo $count; ?> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- row 2 card 3 -->
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Dummy</div>
                                                <div class="widget-subheading">People Interested</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-danger">45,9%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Table -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">
                                    <div class="card-header"><h3 class="text-center text-dark">Recent 10 Orders</h3></div>
                                    <div class="table-responsive">
                                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                            <thead class="bg-light">
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Order Invoice No.</th>
                                                <th class="text-center">Supplier Name</th>
                                                <th class="text-center">Order Date</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">View</th>
                                            </tr>
                                            </thead>
                                            <?php       
                                                $query = "SELECT o.orders_id,DATE_FORMAT(o.orders_date, '%d/%m/%Y') AS orderDate, s.supplier_name,o.orders_invoice_no,o.orders_status FROM orders o inner join supplier s on o.supplier_id = s.supplier_id  ORDER BY o.orders_date desc limit 10;";

                                                $run = mysqli_query($conn,$query);
                                                $counter=1;
                                                if($run)
                                                {   
                                                    while($row = mysqli_fetch_array($run))
                                                    {
                                            ?>  
                                            <tbody>
                                                <tr>
                                                    <td class="text-center text-muted"><?php echo $counter ;?></td>
                                                    <td class="text-center"><?php echo $row['orders_invoice_no']; ?></td>
                                                    <td class="text-center"><?php echo $row['supplier_name']; ?></td>
                                                    <td class="text-center"><?php echo $row['orderDate']; ?></td>
                                                    <?php
                                                        $status = $row['orders_status'];
                                                        if($status==0)
                                                        {
                                                            $statusIs = "Not Received";
                                                    ?>
                                                        <td class="text-center">
                                                            <div class="badge badge-warning"><?php echo $statusIs; ?></div>
                                                        </td>
                                                    <?php                       
                                                        }
                                                        else
                                                        {
                                                            $statusIs = "Received";
                                                    ?>
                                                        <td class="text-center">
                                                            <div class="badge badge-warning"><?php echo $statusIs; ?></div>
                                                        </td>
                                                    <?php               
                                                        }
                                                    ?>
                                                
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-primary"><a href="view_order_item.php?id=<?php echo $row['orders_id']; ?>" class="text-white">Details</a>
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                            <?php   
                                                        $counter++;     
                                                    }

                                                }
                                                else
                                                {
                                                    $msgs="No record found";
                                                    echo $msgs;
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="app-wrapper-footer">
                            <div class="app-footer">
                                <div class="app-footer__inner">
                                    <div class="app-footer-left">
                                        <ul class="nav">
                                            <li class="nav-item text-center">
                                                Copyright &copy;
                                                <script>document.write(new Date().getFullYear());</script> All rights reserved 
                                                <a href="https://www.uohyd.ac.in/health-centre/" target="_blank"
                                                    class="text-primary">Uiversity of Hyderabad
                                                </a>
                                                
                                            </li>
                                        </ul>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>    
                    </div>
                <!-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
        </div>
    </div>
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
