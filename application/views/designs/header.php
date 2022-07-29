<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title><?php echo $title; ?></title>
	<?php $img = base_url('assets/favicon.ico'); ?>
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo $img; ?>">
	<link rel="icon" href="<?php echo $img; ?>" type="image/x-icon">
	<!-- Data table CSS -->
	<link href="<?php echo base_url(); ?>assets/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>assets/vendors/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url(); ?>assets/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
	<!-- Toast CSS -->
	<link href="<?php echo base_url(); ?>assets/vendors/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	
	<link href="<?php echo base_url(); ?>assets/vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css"/>

	<!-- Custom CSS -->
	<link href="<?php echo base_url(); ?>assets/dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<!-- Preloader -->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!-- /Preloader -->
    <div class="wrapper  theme-1-active pimary-color-blue">
		<!-- Top Menu Items -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="mobile-only-brand pull-left">
				<div class="nav-header pull-left">
					<div class="logo-wrap">
						<a href="<?php echo base_url('dashboard'); ?>">
							<img class="brand-img" src="<?php echo $img; ?>" alt="brand" width="30px" height="30px" />
							<span class="brand-text"><?php echo app_name; ?></span>
						</a>
					</div>
				</div>	
				<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
				<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
				
			</div>
			<div id="mobile_only_nav" class="mobile-only-nav pull-right">
				<ul class="nav navbar-right top-nav pull-right">
					
					<li class="dropdown auth-drp">
						<?php 
							if (empty($pic)) {
								$image = 'assets/img/user1.png';
							} else{
								$image = $pic;
							}
							

						?>

						<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="<?php echo base_url($image); ?>" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
						<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
							<li>
								<a href="<?php echo base_url('logout'); ?>"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
							</li>
						</ul>
					</li>
				</ul>
			</div>	
		</nav>
		<!-- /Top Menu Items -->
		
		<!-- Left Sidebar Menu -->
		<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				<li class="navigation-header">
					<span>Main</span> 
					<i class="zmdi zmdi-more"></i>
				</li>
				<li>
					<a class="<?php if($page_active == 'dashboard'){echo 'active-page';} ?>" href="<?php echo base_url('dashboard'); ?>"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">dashboard</span></div><div class="clearfix"></div></a>
				</li>
				<li>
					<a class="<?php if($page_active == 'account'){echo 'active-page';} ?>" href="<?php echo base_url('account'); ?>"><div class="pull-left"><i class=" icon-wallet mr-20"></i><span class="right-nav-text">Account</span></div><div class="clearfix"></div></a>
				</li>
				<li>
					<a class="<?php if($page_active == 'branch'){echo 'active-page';} ?>" href="<?php echo base_url('branch'); ?>"><div class="pull-left"><i class=" icon-direction mr-20"></i><span class="right-nav-text">Branch</span></div><div class="clearfix"></div></a>
				</li>
				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_dr"><div class="pull-left"><i class="ti-user mr-20"></i><span class="right-nav-text">Staff</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="ui_dr" class="collapse collapse-level-1 two-col-list">
						<li >
							<a class="<?php if($page_active == 'designation'){echo 'active-page';} ?>" href="<?php echo base_url('designation'); ?>">Designation</a>
						</li>
						<li >
							<a class="<?php if($page_active == 'new_staff'){echo 'active-page';} ?>" href="<?php echo base_url('new_staff'); ?>">New Staff</a>
						</li>
						<li>
							<a class="<?php if($page_active == 'staff'){echo 'active-page';} ?>" href="<?php echo base_url('staff'); ?>">All Staff</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_pro"><div class="pull-left"><i class="icon-people  mr-20"></i><span class="right-nav-text">Customers</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="ui_pro" class="collapse collapse-level-1 two-col-list">
						<li >
							<a class="<?php if($page_active == 'new_customer'){echo 'active-page';} ?>" href="<?php echo base_url('new_customer'); ?>">New Customer</a>
						</li>
						<li>
							<a class="<?php if($page_active == 'customer'){echo 'active-page';} ?>" href="<?php echo base_url('customer'); ?>">All Customers</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_order"><div class="pull-left"><i class="fa fa-bank  mr-20"></i><span class="right-nav-text">Companies</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="ui_order" class="collapse collapse-level-1 two-col-list">
						<li >
							<a class="<?php if($page_active == 'new_company'){echo 'active-page';} ?>" href="<?php echo base_url('new_company'); ?>">New Company</a>
						</li>
						<li>
							<a class="<?php if($page_active == 'company'){echo 'active-page';} ?>" href="<?php echo base_url('company'); ?>">All Companies</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_scrap"><div class="pull-left"><i class="ti-infinite  mr-20"></i><span class="right-nav-text">Scrap</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="ui_scrap" class="collapse collapse-level-1 two-col-list">
						<li >
							<a class="<?php if($page_active == 'category'){echo 'active-page';} ?>" href="<?php echo base_url('category'); ?>">Category</a>
						</li>
						<li >
							<a class="<?php if($page_active == 'prepared'){echo 'active-page';} ?>" href="<?php echo base_url('prepared'); ?>">Location</a>
						</li>
						<li>
							<a class="<?php if($page_active == 'daily'){echo 'active-page';} ?>" href="<?php echo base_url('daily'); ?>">Daily Record</a>
						</li>
						<li >
							<a class="<?php if($page_active == 'directory'){echo 'active-page';} ?>" href="<?php echo base_url('directory'); ?>">Directory List</a>
						</li>
						<li>
							<a class="<?php if($page_active == 'report'){echo 'active-page';} ?>" href="<?php echo base_url('report'); ?>">Reports</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_cheques"><div class="pull-left"><i class="ti-agenda  mr-20"></i><span class="right-nav-text">Cheques</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="ui_cheques" class="collapse collapse-level-1 two-col-list">
						<li >
							<a class="<?php if($page_active == 'outward'){echo 'active-page';} ?>" href="<?php echo base_url('outward'); ?>">Outward</a>
						</li>
						<li>
							<a class="<?php if($page_active == 'outward_report'){echo 'active-page';} ?>" href="<?php echo base_url('outward_report'); ?>">Outward Confirmation</a>
						</li>
						<li >
							<a class="<?php if($page_active == 'inward'){echo 'active-page';} ?>" href="<?php echo base_url('inward'); ?>">Inward</a>
						</li>
						<li>
							<a class="<?php if($page_active == 'inward_report'){echo 'active-page';} ?>" href="<?php echo base_url('inward_report'); ?>">Inward Reports</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_financial"><div class="pull-left"><i class="ti-credit-card  mr-20"></i><span class="right-nav-text">Financials</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="ui_financial" class="collapse collapse-level-1 two-col-list">
						<li>
							<a class="<?php if($page_active == 'debit'){echo 'active-page';} ?>" href="<?php echo base_url('debit'); ?>">All Debit/Credit</a>
						</li>
						<li >
							<a class="<?php if($page_active == 'debit_report'){echo 'active-page';} ?>" href="<?php echo base_url('debit_report'); ?>">Reports</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_expenses"><div class="pull-left"><i class="fa fa-money  mr-20"></i><span class="right-nav-text">Expenses</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="ui_expenses" class="collapse collapse-level-1 two-col-list">
						<li >
							<a class="<?php if($page_active == 'cost'){echo 'active-page';} ?>" href="<?php echo base_url('cost'); ?>">Cost Center</a>
						</li>
						<li >
							<a class="<?php if($page_active == 'expenses'){echo 'active-page';} ?>" href="<?php echo base_url('expenses'); ?>">Daily Expenses</a>
						</li>
						<li>
							<a class="<?php if($page_active == 'exp_report'){echo 'active-page';} ?>" href="<?php echo base_url('exp_report'); ?>">Reports</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_salary"><div class="pull-left"><i class="fa fa-list-alt mr-20"></i><span class="right-nav-text">Salary</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
					<ul id="ui_salary" class="collapse collapse-level-1 two-col-list">
						<li >
							<a class="<?php if($page_active == 'prepare'){echo 'active-page';} ?>" href="<?php echo base_url('prepare'); ?>">Prepare Salary</a>
						</li>
						<li>
							<a class="<?php if($page_active == 'salary'){echo 'active-page';} ?>" href="<?php echo base_url('salary'); ?>">All Salary</a>
						</li>
						<li>
							<a class="<?php if($page_active == 'salary_rep'){echo 'active-page';} ?>" href="<?php echo base_url('salary_rep'); ?>">Reports</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- /Left Sidebar Menu -->
		
		<!-- Right Sidebar Backdrop -->
		<div class="right-sidebar-backdrop"></div>
		<!-- /Right Sidebar Backdrop -->

        <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid pt-30">