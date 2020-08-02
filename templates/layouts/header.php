<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title><?= $title ?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
 <base href="<?= domain ?>">
    <!-- Site Icons -->
    <link rel="shortcut icon" href="<?=$assets ?>images/logo.jpg" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?=$assets ?>images/logo.jpg">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=$assets ?>css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="<?=$assets ?>css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?=$assets ?>css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?=$assets ?>css/custom.css">
    <link rel="stylesheet" href="<?=$assets ?>css/custom2.css">
    

</head>

<body>
   

    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                    <a class="navbar-brand" href="index.html"> <img src="<?=$assets ?>images/logo.jpg" width="70px" height="50px" class="logo" alt=""> </a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item <?= (isset($menuslug))? '' : 'active' ?>"><a class="nav-link " href="/ecommerce/">HOME</a></li>
                       
                          <li class="dropdown"><a class="nav-link dropdown-toggle arrow" href="#" data-toggle="dropdown">Services</a>
                         <ul class="dropdown-menu">
                                <li><a href="#">Buy Goods</a></li>
                                <li><a href="#">Subscribe Data</a></li>
                                <li><a href="#">Pay Bill</a></li>
                                <li><a href="#">Faq</a></li>
                                <li><a href="#">Buy Airtle</a></li>
                            </ul>
                          </li>
                         <?php while($getMenu = mysqli_fetch_object($getMenus)):?>
                          <li class="nav-item <?= ($menuslug == $getMenu->slug)? 'active' : '' ?>"><a class="nav-link" href="/ecommerce/pages/<?=$getMenu->slug ?>"><?= $getMenu->menu_title?></a></li>
                        
                      <?php endwhile;?>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->

                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                      <?php if(isset($_SESSION['Qd_user'])){?>  <li class="side-menu">
							<a href="#">
								<i class="fa fa-shopping-bag"></i>
								<span class="badge">3</span>
								<p>My Cart</p>
							</a>
						</li> <?php }?>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>
          
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <!-- End Top Search -->