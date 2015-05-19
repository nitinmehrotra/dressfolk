
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar nav-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->        	
    <ul class="navigation">
        <li>
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <div class="sidebar-toggler hidden-phone"></div>
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        </li>
        <li class="start ">
            <a href="<?php echo base_url_seller("dashboard"); ?>">
                <i class="icon-home"></i> 
                <span class="title">Dashboard</span>
            </a>
        </li>
        <li class="has-sub ">
            <a href="javascript:;">
                <i class="icon-th-large"></i> 
                <span class="title">Products</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub">
                <li ><a href="<?php echo base_url_seller("products"); ?>">Products List</a></li>
            </ul>
        </li>
        <li class="has-sub ">
            <a href="javascript:;">
                <i class="icon-bar-chart"></i> 
                <span class="title">Stats</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub">
                <li ><a href="<?php echo base_url_seller("orders"); ?>">Orders</a></li>
                <li ><a href="<?php echo base_url_seller("earnings"); ?>">Earnings</a></li>
            </ul>
        </li>
    </ul>
    <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->