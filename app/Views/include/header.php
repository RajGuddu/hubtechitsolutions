<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=(isset($title))?$title:'Hubtechitsolutions.com'?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url('public/assets/images/favicon.png')?>">
    <!-- CSS
	============================================ -->
    <link rel="stylesheet" href="<?=base_url('public/assets/css/vendor/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?=base_url('public/assets/css/vendor/icomoon.css') ?>">
    <link rel="stylesheet" href="<?=base_url('public/assets/css/vendor/remixicon.css') ?>">
    <link rel="stylesheet" href="<?=base_url('public/assets/css/vendor/magnifypopup.min.css') ?>">
    <link rel="stylesheet" href="<?=base_url('public/assets/css/vendor/odometer.min.css') ?>">
    <link rel="stylesheet" href="<?=base_url('public/assets/css/vendor/lightbox.min.css') ?>">
    <link rel="stylesheet" href="<?=base_url('public/assets/css/vendor/animation.min.css') ?>">
    <link rel="stylesheet" href="<?=base_url('public/assets/css/vendor/jqueru-ui-min.css') ?>">
    <link rel="stylesheet" href="<?=base_url('public/assets/css/vendor/swiper-bundle.min.css') ?>">
    <link rel="stylesheet" href="<?=base_url('public/assets/css/vendor/tipped.min.css') ?>">

    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="<?=base_url('public/assets/css/app.css') ?>">
    <!-- Modernizer JS -->
    <script src="<?=base_url('public/assets/js/vendor/modernizr.min.js') ?>"></script>
    <!-- Jquery Js -->
    <script src="<?=base_url('public/assets/js/vendor/jquery.min.js') ?>"></script>

</head>

<body class="sticky-header ">
    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  	<![endif]-->
  
    <div id="main-wrapper" class="main-wrapper">

        <!--=====================================-->
        <!--=        Header Area Start       	=-->
        <!--=====================================-->
        <?php 
        $common_model = model('App\Models\Common_model', false);
        $course_category = $common_model->getAllRecord('tbl_course_category',['status'=>'1']);
        $settings = $common_model->get_setting(1);
        ?>
        <header class="edu-header header-style-1 header-fullwidth">
            <div class="header-top-bar">
                <div class="container-fluid">
                    <div class="header-top">
                        <div class="header-top-left">
                            <div class="header-notify">
                                First 20 students get 50% discount. <a href="#">Hurry up!</a>
                            </div>
                        </div>
                        <div class="header-top-right">
                            <ul class="header-info">
                                <!-- <li><a href="#">Login</a></li> -->
                                 <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Login
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="<?=base_url('internship/login')?>">
                                                Internship Student
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?=base_url('student/login')?>">
                                                Center Student
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="<?=base_url('franchise/login')?>">
                                                Franchise
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#">Register</a></li>
                                <li><a href="tel:+91<?=$settings->phone?>"><i class="icon-phone"></i>Call: +91 <?=$settings->phone?></a></li>
                                <li><a href="mailto:<?=$settings->email?>" target="_blank"><i class="icon-envelope"></i>Email: <?=$settings->email?></a></li>
                                <li class="social-icon">
                                    <a href="<?=$settings->facebook_link?>"><i class="icon-facebook"></i></a>
                                    <a href="<?=$settings->instagram_link?>"><i class="icon-instagram"></i></a>
                                    <a href="<?=$settings->twitter_link?>"><i class="icon-twitter"></i></a>
                                    <a href="<?=$settings->linkedin_link?>"><i class="icon-linkedin2"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="edu-sticky-placeholder"></div>
            <div class="header-mainmenu">
                <div class="container-fluid">
                    <div class="header-navbar">
                        <div class="header-brand">
                            <div class="logo">
                                <a href="<?=base_url();?>">
                                    <img class="logo-light" src="<?=base_url('public/assets/images/logo/logo-dark.png') ?>" alt="Corporate Logo">
                                    <img class="logo-dark" src="<?=base_url('public/assets/images/logo/logo-dark.png') ?>" alt="Corporate Logo">
                                </a>
                            </div>
                            
                        </div>
                        <div class="header-mainnav">
                            <nav class="mainmenu-nav">
                                <ul class="mainmenu">
                                    <li><a href="<?=base_url()?>">Home</a>
                    
                                    </li>
                                    <li><a href="<?=base_url('about-us')?>">About Us</a>
									</li>
     
                                    <li class="has-droupdown"><a href="#">Our Courses</a>
                                        <ul class="submenu">
                                            <?php if(!empty($course_category)){
                                            foreach($course_category as $cate){ ?>
                                            <li><a href="<?=base_url('courses').'?category='.$cate->ccat_id?>"><?=ucwords($cate->course_category_name)?></a></li>
                                            <?php } }?>
                                            <!-- <li><a href="course-two.html">Course Style 2</a></li>
                                            <li><a href="course-three.html">Course Style 3</a></li>
                                            <li><a href="course-four.html">Course Style 4</a></li>
                                            <li><a href="course-five.html">Course Style 5</a></li> -->
                                       
									   </ul>
                                    </li>
                                    <li class="has-droupdown"><a href="#">Certificate Verification</a>
                                        <ul class="submenu">
                                            
                                            <li><a href="<?=base_url('intern-certificate-verification')?>">Internship Student</a></li>
                                            <li><a href="<?=base_url('certificate-verification')?>">Center Student</a></li>
                                            <!-- <li><a href="course-four.html">Course Style 4</a></li>
                                            <li><a href="course-five.html">Course Style 5</a></li> -->
                                       
									   </ul>
                                    </li>
                                    <!-- <li><a href="#">Blog</a></li>
									<li><a href="#">FAQ</a></li> -->
                                    <li><a href="<?=base_url('contact-us'); ?>">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="header-right">
                            <ul class="header-action">
                                <li class="search-bar">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <button class="search-btn" type="button"><i class="icon-2"></i></button>
                                    </div>
                                </li>
                                <li class="icon search-icon">
                                    <a href="javascript:void(0)" class="search-trigger">
                                        <i class="icon-2"></i>
                                    </a>
                                </li>
                                
                                <li class="header-btn">
                                    <a href="<?=base_url('enroll-internship'); ?>" class="edu-btn btn-medium">Apply Internship <i class="icon-4"></i></a>
                                </li>
                                <li class="mobile-menu-bar d-block d-xl-none">
                                    <button class="hamberger-button">
                                        <i class="icon-54"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="popup-mobile-menu">
                <div class="inner">
                    <div class="header-top">
                        <div class="logo">
                            <a href="index.html">
                                <img class="logo-light" src="<?=base_url('public/assets/images/logo/logo-dark.png') ?>" alt="Corporate Logo">
                                <img class="logo-dark" src="<?=base_url('public/assets/images/logo/logo-dark.png') ?>" alt="Corporate Logo">
                            </a>
                        </div>
                        <div class="close-menu">
                            <button class="close-button">
                                <i class="icon-73"></i>
                            </button>
                        </div>
                    </div>
                    <ul class="mainmenu">
                        <li><a href="<?=base_url()?>">Home</a>
        
                        </li>
                        <li><a href="#">About Us</a>
                        </li>

                        <li class="has-droupdown"><a href="#">Our Courses</a>
                            <ul class="submenu">
                                <li><a href="course-one.html">Course Style 1</a></li>
                                <li><a href="course-two.html">Course Style 2</a></li>
                                <li><a href="course-three.html">Course Style 3</a></li>
                                <li><a href="course-four.html">Course Style 4</a></li>
                                <li><a href="course-five.html">Course Style 5</a></li>
                            
                            </ul>
                        </li>
                        <li><a href="#">Blog</a></li>
                            <li><a href="#">FAQ</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
            <!-- Start Search Popup  -->
            <div class="edu-search-popup">
                <div class="content-wrap">
                    <div class="site-logo">
                        <img class="logo-light" src="<?=base_url('public/assets/images/logo/logo-dark.png') ?>" alt="Corporate Logo">
                        <img class="logo-dark" src="<?=base_url('public/assets/images/logo/logo-dark.png') ?>" alt="Corporate Logo">
                    </div>
                    <div class="close-button">
                        <button class="close-trigger"><i class="icon-73"></i></button>
                    </div>
                    <div class="inner">
                        <form class="search-form" action="#">
                            <input type="text" class="edublink-search-popup-field" placeholder="Search Here...">
                            <button class="submit-button"><i class="icon-2"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Search Popup  -->
        </header>