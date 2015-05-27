
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
            <a href="<?php echo base_url_admin("dashboard"); ?>">
                <i class="icon-home"></i> 
                <span class="title">Dashboard</span>
            </a>
        </li>
        <li class="has-sub ">
            <a href="javascript:;">
                <i class="icon-user"></i> 
                <span class="title">Users</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub">
                <li ><a href="<?php echo base_url_admin("users"); ?>">Users</a></li>
                <li ><a href="<?php echo base_url_admin("users/userLog"); ?>">User Log</a></li>
                <li ><a href="<?php echo base_url_admin("sellers"); ?>">Sellers</a></li>
                <li ><a href="<?php echo base_url_admin("sellers/sellerLog"); ?>">Seller Log</a></li>
            </ul>
        </li>
        <li class="has-sub ">
            <a href="javascript:;">
                <i class="icon-th-list"></i> 
                <span class="title">Categories</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub">
                <li ><a href="<?php echo base_url_admin("categories/parentCategories"); ?>">Category</a></li>
                <li ><a href="<?php echo base_url_admin("categories/childCategories"); ?>">Sub-Category</a></li>
            </ul>
        </li>
        <li class="has-sub ">
            <a href="javascript:;">
                <i class="icon-th-large"></i> 
                <span class="title">Products</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub">
                <li ><a href="<?php echo base_url_admin("products"); ?>">Products</a></li>
                <li ><a href="<?php echo base_url_admin("products/featuredList"); ?>">Featured Products</a></li>
            </ul>
        </li>        
        <li class="has-sub ">
            <a href="javascript:;">
                <i class="icon-cogs"></i> 
                <span class="title">Website Configs</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub">
                <li><a href="<?php echo base_url_admin("staticcontent"); ?>">Static Content</a></li>
                <li><a href="<?php echo base_url_admin("websiteContact"); ?>">Website Contact</a></li>
            </ul>
        </li>
        <li class="">
            <a href="<?php echo base_url_admin("discountcoupon"); ?>">
                <i class="icon-gift"></i> 
                <span class="title">Discount Coupons</span>
            </a>
        </li>
        <li class="has-sub ">
            <a href="javascript:;">
                <i class="icon-bar-chart"></i> 
                <span class="title">Stats</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub">
                <li><a href="<?php echo base_url_admin("orders"); ?>">Orders</a></li>
                <li><a href="<?php echo base_url_admin("earnings"); ?>">Earnings</a></li>
            </ul>
        </li>
    </ul>
    <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->