<?php include ("db.php");?>
<?php include "admin_header.php"; ?>


<!-- topBar-->
<nav class="navbar navbar-dark navbar-expand-md fixed-top bg-success" >
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
            <span class="navbar-toggler-icon"></span>
        </button>&emsp;
        <a href="index.php" class="navbar-brand mr-auto"><i class="fas fa-arrow-left"></i>&nbsp;DashBoard&emsp;</a>
        <div class="collapse navbar-collapse" id="Navbar">
            <ul class="navbar-nav mr-auto" id="nav">
                <li class='nav-item mr-3'>
                    <a class='nav-link' href="#"><i class="fas fa-align-right"></i>&emsp;AddLinks</a>
                </li>
            </ul>
            <!-- <span class="navbar-nav mr-3">
                <form method='get' action='search.php'>
                    <div class='input-group input-group-sm'>
                        <input name='search' type='text' class='form-control' placeholder="Search..">
                    </div>
                </form>
            </span> -->
			<span class="d-none d-sm-inline text-white"><i class="fas fa-user"></i>&nbsp;&nbsp;<?php echo $_SESSION['username']; ?></span>
			&emsp;
            <a href="../logout.php"><i class="fa fa-fw fa-power-off" style="color: red;"></i> </a>
        </div>
    </div>
</nav> 

<!--SideBar-->
<!--    <div class="sidebar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-medkit" aria-hidden="true"></i> Medicinals <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo" class="collapse navbar-nav">
                        <li class="nav-item">
                            <a href="manage.php">&emsp;<i class="fa fa-tasks" aria-hidden="true"></i></i> Manages</a>
                        </li>
                        <li class="nav-item">
                            <a href="expiry.php">&emsp;<i class="fas fa-pills"></i> Date of Expiry</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="patients.php"><i class="fas fa-wheelchair"></i> Patients </a>

                     <i class="fa fa-fw fa-caret-down"></i>
                    <ul id="demo" class="collapse navbar-nav">
                        <li class="nav-item">
                            <a href="#">&emsp;<i class="fas fa-fw fa-book-open"></i> Add Page</a>
                        </li>
                        <li class="nav-item">
                            <a href="posts.php?source=add_post">&emsp;<i class="fas fa-fw fa-plus-circle"></i> Add Page</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="categories.php"><i class="fa fa-fw fa-list"></i> Categories</a>
                </li> 
                <li class="nav-item">
                    <a href="supplier.php"><i class="fa fa-industry" aria-hidden="true"></i> Suppilers </a>
                </li>
                <li class="nav-item">
                    <a href="profile.php"><i class="fas fa-fw fa-user"></i> Profile</a>
                </li>
            </ul>
        </div>-->
            


