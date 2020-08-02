<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <base href = "<?= domain ?>">

    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Admin Dashboard">
    <meta name="keywords" content="">
    <meta name="author" content="">
	<link rel="shortcut icon" href="<?= $assets ?>/img/favicon-32x32.png" type="image/png">

    <title> <?= $title ?> </title>

    <link href="<?= $assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="<?= $assets ?>dashboard/css/users.css" rel="stylesheet" media="screen">
    <link href="<?= $assets ?>dashboard/css/main.css" rel="stylesheet" media="screen">
    <link href="<?= $assets ?>fonts/icomoon/icomoon.css" rel="stylesheet">
    <link href="<?= $assets ?>dashboard/css/c3/c3.css" rel="stylesheet">
    <link href="<?= $assets ?>dashboard/css/nvd3/nv.d3.css" rel="stylesheet">
    <link href="<?= $assets ?>dashboard/css/horizontal-bar/chart.css" rel="stylesheet">
    <link href="<?= $assets ?>dashboard/css/heatmap/cal-heatmap.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $assets ?>dashboard/css/circliful/circliful.css">
    <link rel="stylesheet" href="<?= $assets ?>dashboard/css/odometer.css">
    <link href="<?= $assets ?>dashboard/css/icheck/custom.css" rel="stylesheet">
    <link href="<?= $assets ?>dashboard/css/icheck/skins/all.css" rel="stylesheet">
    <link href="<?= $assets ?>dashboard/css/projects.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="<?= $assets ?>dashboard/css/pricing.css">

	<link href="<?= $assets ?>dashboard/css/datatables/dataTables.bs.min.css" rel="stylesheet">
	<link href="<?= $assets ?>dashboard/css/datatables/autoFill.bs.min.css" rel="stylesheet">
	<link href="<?= $assets ?>dashboard/css/datatables/fixedHeader.bs.css" rel="stylesheet">

	<link href="<?= $assets ?>dashboard/css/alertify/core.css" rel="stylesheet">
	<link href="<?= $assets ?>dashboard/css/alertify/default.css" rel="stylesheet">


	<link rel="stylesheet" href="<?= $assets ?>dashboard/css/lobipanel/lobipanel.css">
	
    <link rel="stylesheet" type="text/css/css" href="<?= $assets ?>dashboard/css/bitbank.css" media="all">
    
    <link rel="stylesheet" href="//cdn.muut.com/1/moot.css">

	<link href="<?= $assets ?>dashboard/css/formfix.css" rel="stylesheet">
	<link href="<?= $assets ?>dashboard/css/small.css" rel="stylesheet">

  
    
</head>

<body>

    <header>
    
        <ul id="header-actions" class="clearfix">
            <li class="list-box hidden-xs dropdown"><a id="drop2" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-warning2"></i> </a><span class="info-label blue-bg">0</span>
                <ul class="dropdown-menu imp-notify">
                    <li class="dropdown-header">You have 0 notifications</li>
                </ul>
            </li>
            <li class="list-box hidden-xs dropdown"><a id="drop3" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-archive2"></i> </a><span class="info-label red-bg">0</span>
                <ul class="dropdown-menu progress-info">
					<li class="dropdown-header">You have 0 pending tasks</li>
                </ul>
            </li>
            <li class="list-box user-admin dropdown">
                <div class="admin-details">
                    <div class="designation">Welcome</div>
                    <div class="name"><strong><?=(isset($firstname))? $firstname : $username  ?> <?=(isset($lastname))? $lastname : ''  ?></strong></div>
               
            </li>
        </ul>
        <div class="custom-search hidden-sm hidden-xs">
        <input type="text" class="search-query" placeholder="Search here ..."> <i class="icon-search3"></i></div>
    </header>
    
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

 <ul class="nav navbar-nav">
  <li class="active"><a href="/ecommerce/dashboard"><i class="icon-blur_on"></i>Dashboard</a></li>
     
  <?php
     if(isset($username)){
       echo '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="icon-people"></i> Home Manager Admin <span class="caret"></span></a>
       <ul class="dropdown-menu">
           <li><a href="./dashboard/admin-accounts/"><i class="icon-people"></i> Manage Customers</a></li>
       </ul>
   </li>';
     }
  ?>


<li class="dropdown pull-right"><a href="/ecommerce/exit"><i class="icon-close"></i>Logout</a></li>

</ul>
</div>
</div>
                
</nav>
<div class="dashboard-wrapper">
<div class="container-fluid">
<div class="top-bar clearfix">
    <div class="row gutter">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="page-title">
                
            </div>
        </div>
     <?php
     if(isset($firstname)){
       echo '
       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
       <ul class="right-stats" id="mini-nav-right">
           <li class=""><a href="/ecommerce/transaction/payment_process" class="btn btn-success text-center"><i class="icon-close"></i> Fund my Wallet </a></li>
           <li class=""><a href="/ecommerce/transaction/tranfer_process" class="btn btn-success text-center"><i class="icon-close"></i> Transfer Money </a></li>
       </ul>
       </div>
      ';
     }
  ?>
                   
    </div>
</div>

