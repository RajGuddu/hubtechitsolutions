
        <!--=====================================-->
        <!--=       Hero Banner Area Start      =-->
        <!--=====================================-->
        <div class="hero-banner hero-style-1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="banner-content">
                            <?php if(isset($banner->main_title)){
                                $main_title = explode(' ',trim($banner->main_title));
                                $words = array();
                                foreach($main_title as $k=>$word){
                                    if($k==0){$word1 = $word;}
                                    if($k==1){$word2 = $word;}
                                    if($k > 1){
                                        $words[] = $word;
                                    }
                                }
                                $words = implode(' ', $words);
                            } ?>
                            <h1 class="title" data-sal-delay="100" data-sal="slide-up" data-sal-duration="1000"><?=(isset($word1))?$word1:'' ?> <span class="color-secondary"><?=(isset($word2))?$word2:'' ?></span> <br><?=(isset($words))?$words:''?></h1>
                            <p data-sal-delay="200" data-sal="slide-up" data-sal-duration="1000"><?=(isset($banner->sub_title))?$banner->sub_title:''?></p>
                            <div class="banner-btn" data-sal-delay="400" data-sal="slide-up" data-sal-duration="1000">
                                <a href="<?=base_url('courses')?>" class="edu-btn">Find courses <i class="icon-4"></i></a>
                            </div>
                            <ul class="shape-group">
                                <li class="shape-1 scene" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                    <img data-depth="2" src="<?=base_url('public/assets/images/about/shape-13.png') ?>" alt="Shape">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="banner-thumbnail">
                            <div class="thumbnail" data-sal-delay="500" data-sal="slide-left" data-sal-duration="1000">
                                <?php if(isset($banner->brochure) && $banner->brochure != ''){
                                    $imgurl = base_url('public/assets/upload/images/'. $banner->brochure);
                                }else{
                                    $imgurl = base_url('public/assets/images/banner/girl-1.webp');
                                } ?>
                                <img src="<?=$imgurl ?>" alt="Girl Image">
                            </div>
                            <div class="instructor-info" data-sal-delay="600" data-sal="slide-up" data-sal-duration="1000">
                                <div class="inner">
                                    <h5 class="title">Instructor</h5>
                                    <div class="media">
                                        <div class="thumb">
                                            <img src="<?=base_url('public/assets/images/banner/author-1.png') ?>" alt="Images">
                                        </div>
                                        <div class="content">
                                            <span>200+</span>Instructors
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="shape-group">
                                <li class="shape-1" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                    <img data-depth="1.5" src="<?=base_url('public/assets/images/about/shape-15.png') ?>" alt="Shape">
                                </li>
                                <li class="shape-2 scene" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                    <img data-depth="-1.5" src="<?=base_url('public/assets/images/about/shape-16.png')?>" alt="Shape">
                                </li>
                                <li class="shape-3 scene" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                    <span data-depth="3" class="circle-shape"></span>
                                </li>
                                <li class="shape-4" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                    <img data-depth="-1" src="<?=base_url('public/assets/images/counterup/shape-02.png')?>" alt="Shape">
                                </li>
                                <li class="shape-5 scene" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                    <img data-depth="1.5" src="<?=base_url('public/assets/images/about/shape-13.png')?>" alt="Shape">
                                </li>
                                <li class="shape-6 scene" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                                    <img data-depth="-2" src="<?=base_url('public/assets/images/about/shape-18.png')?>" alt="Shape">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shape-7">
                <img src="<?=base_url('public/assets/images/about/h-1-shape-01.png')?>" alt="Shape">
            </div>
        </div>
        <!--=====================================-->
        <!--=       Features Area Start      =-->
        <!--=====================================-->
        <!-- Start Categories Area  -->
        <div class="features-area-2">
            <div class="container">
                <div class="features-grid-wrap">
                    <div class="features-box features-style-2 edublink-svg-animate">
                        <div class="icon">
                            <img class="svgInject" src="<?=base_url('public/assets/images/animated-svg-icons/online-class.svg')?>" alt="animated icon">
                        </div>
                        <div class="content">
                            <h5 class="title"><span>100+</span>Courses</h5>
                        </div>
                    </div>
                    <div class="features-box features-style-2 edublink-svg-animate">
                        <div class="icon">
                            <img class="svgInject" src="<?=base_url('public/assets/images/animated-svg-icons/instructor.svg')?>" alt="animated icon">
                        </div>
                        <div class="content">
                            <h5 class="title"><span>Top</span>Instructors</h5>
                        </div>
                    </div>
                    <div class="features-box features-style-2 edublink-svg-animate">
                        <div class="icon certificate">
                            <img class="svgInject" src="<?=base_url('public/assets/images/animated-svg-icons/certificate.svg')?>" alt="animated icon">
                        </div>
                        <div class="content">
                            <h5 class="title"><span>Online</span>Certifications</h5>
                        </div>
                    </div>
                    <div class="features-box features-style-2 edublink-svg-animate">
                        <div class="icon">
                            <img class="svgInject" src="<?=base_url('public/assets/images/animated-svg-icons/user.svg')?>" alt="animated icon">
                        </div>
                        <div class="content">
                            <h5 class="title"><span>256</span>Members</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Categories Area  -->
    
        <!--=       About Us Area Start      	=-->
        <!--=====================================-->
        <div class="gap-bottom-equal edu-about-area about-style-1">
            <div class="container edublink-animated-shape">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="about-image-gallery">
                            <img class="main-img-1" src="<?=base_url('public/assets/images/about/about-01.webp') ?>" alt="About Image">
                            <div class="video-box sal-animate" data-sal-delay="150" data-sal="slide-down" data-sal-duration="800">
                                <div class="inner">
                                    <div class="thumb">
                                        <img src="<?=base_url('public/assets/images/about/about-01.webp') ?>" alt="About Image">
                                      
                                       
                                    </div>
                                    <div class="loading-bar">
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="award-status bounce-slide">
                                <div class="inner">
                                    <div class="icon">
                                        <i class="icon-21"></i>
                                    </div>
                                    <div class="content">
                                        <h6 class="title">29+</h6>
                                        <span class="subtitle">Wonderful Awards</span>
                                    </div>
                                </div>
                            </div>
                            <ul class="shape-group">
                                <li class="shape-1 scene sal-animate" data-sal-delay="500" data-sal="fade" data-sal-duration="200" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                                    <img data-depth="1" src="<?=base_url('public/assets/images/about/shape-36.png') ?>" alt="Shape" style="transform: translate3d(8.2px, 0.3px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                                </li>
                                <li class="shape-2 scene sal-animate" data-sal-delay="500" data-sal="fade" data-sal-duration="200" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                                    <img data-depth="-1" src="<?=base_url('public/assets/images/about/shape-37.png') ?>" alt="Shape" style="transform: translate3d(-5.6px, -1px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                                </li>
                                <li class="shape-3 scene sal-animate" data-sal-delay="500" data-sal="fade" data-sal-duration="200" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                                    <img data-depth="1" src="<?=base_url('public/assets/images/about/shape-02.png') ?>" alt="Shape" style="transform: translate3d(3.2px, 0.5px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                                </li>
                            </ul>
                        </div>
                    </div>
				
                    <div class="col-lg-6" data-sal-delay="150" data-sal="slide-left" data-sal-duration="800">
                        <div class="about-content">
                            <div class="section-title section-left">
                                <span class="pre-title">About Us</span>
                                <h2 class="title">Learn & Grow Your Skills From <span class="color-secondary">Hub Techsolutions</span></h2>
                                <span class="shape-line"><i class="icon-19"></i></span>
                                <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod ex tempor incididunt labore dolore magna aliquaenim minim veniam quis nostrud exercitation ullamco laboris.</p>
                            </div>
                            <ul class="features-list">
                                <li>Expert Trainers</li>
                                <li>Online Remote Learning</li>
                                <li>Popular Courses</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="shape-group">
                    <li class="shape-1 circle scene" data-sal-delay="500" data-sal="fade" data-sal-duration="200">
                        <span data-depth="-2.3"></span>
                    </li>
                </ul>
            </div>
        </div>
        <!--=====================================-->
        <!--=       Course Area Start      		=-->
        <!--=====================================-->
        <!-- Start Course Area  -->
        <div class="edu-course-area course-area-2 gap-tb-text bg-lighten03">
            <div class="container">
                <div class="section-title section-center sal-animate" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                    <span class="pre-title">Popular Courses</span>
                    <h2 class="title">Pick A Course To Get Started</h2>
                    <span class="shape-line"><i class="icon-19"></i></span>
                </div>
                <div class="row g-5">
                    <?php if(!empty($popular_courses)){
                    foreach($popular_courses as $list){ ?>

                    <!-- Start Single Course  -->
                    <div class="col-md-6 col-lg-4 sal-animate" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-course course-style-2 hover-button-bg-white">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="course-details.html">
                                        <img src="<?=base_url('public/assets/upload/images/'.$list->image) ?>" alt="Course Meta">
                                    </a>
                                    <div class="time-top">
                                        <span class="duration"><i class="icon-61"></i><?=$list->duration?></span>
                                    </div>
                                </div>
                                <div class="content">
                                    <?php if($list->course_level == 'A'){ 
                                        $course_level = 'Advanced';
                                    }else if($list->course_level == 'I'){
                                        $course_level = 'Intermidiate';
                                    }else{
                                        $course_level = 'Beginner';
                                    } ?>
                                    <span class="course-level"><?=$course_level; ?></span>
                                    <h5 class="title">
                                        <a href="javascript:void(0);"><?=$list->course_full_name?></a>
                                    </h5>
                                    <div class="course-rating">
                                        <div class="rating">
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                        </div>
                                        <span class="rating-count">(5.0 /7 Rating)</span>
                                    </div>
                                    <div class="course-price">RS/- <?=$list->course_fee?></div>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i><?=$list->lesson?> Lessons</li>
                                        <li><i class="icon-25"></i><?=$list->enrolled?> Students</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course-hover-content-wrapper">
                                <button class="wishlist-btn"><i class="icon-22"></i></button>
                            </div>
                            <div class="course-hover-content">
                                <div class="content">
                                    <button class="wishlist-btn"><i class="icon-22"></i></button>
                                    <span class="course-level"><?=$course_level; ?></span>
                                    <h5 class="title">
                                        <a href="<?=base_url('course-details').'/'.$list->url?>"><?=$list->course_full_name?></a>
                                    </h5>
                                    <div class="course-rating">
                                        <div class="rating">
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                        </div>
                                        <span class="rating-count">(5.0 /7 Rating)</span>
                                    </div>
                                    <div class="course-price">RS/- <?=$list->course_fee?></div>
                                    <p><?=$list->short_description?></p>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i><?=$list->lesson?> Lessons</li>
                                        <li><i class="icon-25"></i><?=$list->enrolled?> Students</li>
                                    </ul>
                                    <a href="<?=base_url('course-details').'/'.$list->url?>" class="edu-btn btn-secondary btn-small">Browse <i class="icon-4"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Course  -->
                    <?php } } ?>
                    <!-- Start Single Course  -->
                    <!-- <div class="col-md-6 col-lg-4 sal-animate" data-sal-delay="200" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-course course-style-2 hover-button-bg-white">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="course-details.html">
                                        <img src="<?=base_url('public/assets/images/course/course-02.jpg')?>" alt="Course Meta">
                                    </a>
                                    <div class="time-top">
                                        <span class="duration"><i class="icon-61"></i>8 Weeks</span>
                                    </div>
                                </div>
                                <div class="content">
                                    <span class="course-level">Advanced</span>
                                    <h5 class="title">
                                        <a href="#">Java Programming Masterclass for Software Developers</a>
                                    </h5>
                                    <div class="course-rating">
                                        <div class="rating">
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                        </div>
                                        <span class="rating-count">(4.5 /9 Rating)</span>
                                    </div>
                                    <div class="course-price">$49.00</div>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>15 Lessons</li>
                                        <li><i class="icon-25"></i>35 Students</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course-hover-content-wrapper">
                                <button class="wishlist-btn"><i class="icon-22"></i></button>
                            </div>
                            <div class="course-hover-content">
                                <div class="content">
                                    <button class="wishlist-btn"><i class="icon-22"></i></button>
                                    <span class="course-level">Advanced</span>
                                    <h5 class="title">
                                        <a href="course-details.html">Java Programming Masterclass for Software Developers</a>
                                    </h5>
                                    <div class="course-rating">
                                        <div class="rating">
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                        </div>
                                        <span class="rating-count">(4.5 /9 Rating)</span>
                                    </div>
                                    <div class="course-price">$49.00</div>
                                    <p>Lorem ipsum dolor sit amet consectur adpis elit sed eiusmod tempor incididunt labore dolore magna aliquaenim.</p>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>15 Lessons</li>
                                        <li><i class="icon-25"></i>35 Students</li>
                                    </ul>
                                    <a href="course-details.html" class="edu-btn btn-secondary btn-small">Enrolled <i class="icon-4"></i></a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- End Single Course  -->
                    <!-- Start Single Course  -->
                    <!-- <div class="col-md-6 col-lg-4 sal-animate" data-sal-delay="300" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-course course-style-2 hover-button-bg-white">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="course-details.html">
                                        <img src="<?=base_url('public/assets/images/course/course-03.jpg')?>" alt="Course Meta">
                                    </a>
                                    <div class="time-top">
                                        <span class="duration"><i class="icon-61"></i>3 Weeks</span>
                                    </div>
                                </div>
                                <div class="content">
                                    <span class="course-level">Intermediate</span>
                                    <h5 class="title">
                                        <a href="#">The Complete Camtasia Course for Content Creators</a>
                                    </h5>
                                    <div class="course-rating">
                                        <div class="rating">
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                        </div>
                                        <span class="rating-count">(4.9 /7 Rating)</span>
                                    </div>
                                    <div class="course-price">$35.00</div>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>13 Lessons</li>
                                        <li><i class="icon-25"></i>18 Students</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course-hover-content-wrapper">
                                <button class="wishlist-btn"><i class="icon-22"></i></button>
                            </div>
                            <div class="course-hover-content">
                                <div class="content">
                                    <button class="wishlist-btn"><i class="icon-22"></i></button>
                                    <span class="course-level">Intermediate</span>
                                    <h5 class="title">
                                        <a href="course-details.html">The Complete Camtasia Course for Content Creators</a>
                                    </h5>
                                    <div class="course-rating">
                                        <div class="rating">
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                        </div>
                                        <span class="rating-count">(4.9 /7 Rating)</span>
                                    </div>
                                    <div class="course-price">$35.00</div>
                                    <p>Lorem ipsum dolor sit amet consectur adpis elit sed eiusmod tempor incididunt labore dolore magna aliquaenim.</p>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>13 Lessons</li>
                                        <li><i class="icon-25"></i>18 Students</li>
                                    </ul>
                                    <a href="course-details.html" class="edu-btn btn-secondary btn-small">Enrolled <i class="icon-4"></i></a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- End Single Course  -->
                </div>
                <div class="course-view-all sal-animate" data-sal-delay="100" data-sal="slide-up" data-sal-duration="1200">
                    <a href="<?=base_url('courses')?>" class="edu-btn">Browse more courses <i class="icon-4"></i></a>
                </div>
            </div>
        </div>
		
		<div class="video-area-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="video-gallery">
                            <div class="thumbnail">
                                <img src="<?=base_url('public/assets/images/others/video-01.webp')?>" alt="Thumb">
                                <a href="https://www.youtube.com/watch?v=PICj5tr9hcc" class="video-play-btn video-popup-activation">
                                    <i class="icon-18"></i>
                                </a>
                            </div>
                            <ul class="shape-group">
                                <li class="shape-1 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                                    <img data-depth="2" class="rotateit" src="<?=base_url('public/assets/images/about/shape-37.png') ?>" alt="Shape" style="transform: translate3d(25.4px, -7.7px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                                </li>
                                <li class="shape-2 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                                    <img data-depth="-2" src="<?=base_url('public/assets/images/faq/shape-04.png') ?>" alt="Shape" style="transform: translate3d(-23.1px, 7.7px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                                </li>
                                <li class="shape-3 scene shape-light" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                                    <img data-depth="2" src="<?=base_url('public/assets/images/faq/shape-14.png') ?>" alt="Shape" style="transform: translate3d(23.7px, -5.2px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                                </li>
                                <li class="shape-3 scene shape-dark" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                                    <img data-depth="2" src="<?=base_url('public/assets/images/faq/dark-shape-14.png')?>" alt="Shape" style="transform: translate3d(23.7px, -5.2px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		<div class="counterup-area-5 edu-section-gap">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-3 col-sm-6 sal-animate" data-sal-delay="50" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-counterup counterup-style-5 primary-color">
                            <h2 class="counter-item count-number">
                                <span class="odometer odometer-auto-theme" data-odometer-final="29.3"><div class="odometer-inside"><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">2</span></span></span></span></span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">9</span></span></span></span></span><span class="odometer-formatting-mark odometer-radix-mark">.</span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">3</span></span></span></span></span></div></span><span>K</span>
                            </h2>
                            <h6 class="title">Student Enrolled</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 sal-animate" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-counterup counterup-style-5 secondary-color">
                            <h2 class="counter-item count-number">
                                <span class="odometer odometer-auto-theme" data-odometer-final="32.4"><div class="odometer-inside"><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">3</span></span></span></span></span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">2</span></span></span></span></span><span class="odometer-formatting-mark odometer-radix-mark">.</span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">4</span></span></span></span></span></div></span><span>K</span>
                            </h2>
                            <h6 class="title">Class Completed</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-counterup counterup-style-5 extra02-color">
                            <h2 class="counter-item count-number">
                                <span class="odometer odometer-auto-theme" data-odometer-final="100"><div class="odometer-inside"><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">1</span></span></span></span></span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">0</span></span></span></span></span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">0</span></span></span></span></span></div></span><span>%</span>
                            </h2>
                            <h6 class="title">Satisfaction Rate</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 sal-animate" data-sal-delay="200" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-counterup counterup-style-5 extra05-color">
                            <h2 class="counter-item count-number">
                                <span class="odometer odometer-auto-theme" data-odometer-final="354"><div class="odometer-inside"><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">3</span></span></span></span></span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">5</span></span></span></span></span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">4</span></span></span></span></span></div></span><span>+</span>
                            </h2>
                            <h6 class="title">Top Instructors</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Course Area -->
        <!--=====================================-->
        <!--=       CounterUp Area Start      	=-->
        <!--=====================================-->
 
        <!--=====================================-->
        <!-- Start Testimonial Area  -->
        <div class="testimonial-area-5 gap-lg-bottom-equal">
            <div class="container">
                <div class="row g-lg-5">
                    <div class="col-lg-5">
                        <div class="testimonial-heading-area">
                            <div class="section-title section-left sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                <span class="pre-title">Testimonials</span>
                                <h2 class="title">What Our Students Have To Say</h2>
                                <span class="shape-line"><i class="icon-19"></i></span>
                                <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod tempor incididunt labore dolore magna aliquaenim ad minim.</p>
                                <a href="#" class="edu-btn btn-large">View All<i class="icon-4"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="swiper-testimonial-slider-wrapper swiper testimonial-coverflow swiper-coverflow swiper-3d swiper-initialized swiper-horizontal swiper-pointer-events">
                            <div class="swiper-wrapper" id="swiper-wrapper-7ed70089c3eef6fc" aria-live="off" style="cursor: grab; transition-duration: 0ms; transform: translate3d(-1842.5px, 0px, 0px);"><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="2" role="group" aria-label="3 / 4" style="width: 335px; transition-duration: 0ms; transform: translate3d(480px, 0px, -1080px) rotateX(0deg) rotateY(0deg) scale(1); z-index: -5;">
                                    <div class="testimonial-grid">
                                        <div class="thumbnail">
                                            <img src="<?=base_url('public/assets/images/testimonial/testimonial-03.png')?>" alt="Testimonial">
                                            <span class="qoute-icon"><i class="icon-26"></i></span>

                                        </div>
                                        <div class="content">
                                            <p>Lorem ipsum dolor amet consec tur elit adicing sed do usmod zx tempor enim minim veniam quis nostrud exer citation.</p>
                                            <div class="rating-icon">
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                            </div>
                                            <h5 class="title">Amber Page</h5>
                                            <span class="subtitle">Developer</span>
                                        </div>
                                    </div>
                                </div><div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-prev" data-swiper-slide-index="3" role="group" aria-label="4 / 4" style="width: 335px; transition-duration: 0ms; transform: translate3d(400px, 0px, -900px) rotateX(0deg) rotateY(0deg) scale(1); z-index: -4;">
                                    <div class="testimonial-grid">
                                        <div class="thumbnail">
                                            <img src="<?=base_url('public/assets/images/testimonial/testimonial-04.png')?>" alt="Testimonial">
                                            <span class="qoute-icon"><i class="icon-26"></i></span>

                                        </div>
                                        <div class="content">
                                            <p>Lorem ipsum dolor amet consec tur elit adicing sed do usmod zx tempor enim minim veniam quis nostrud exer citation.</p>
                                            <div class="rating-icon">
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                            </div>
                                            <h5 class="title">Robert Tapp</h5>
                                            <span class="subtitle">Content Creator</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide swiper-slide-duplicate-active" data-swiper-slide-index="0" role="group" aria-label="1 / 4" style="width: 335px; transition-duration: 0ms; transform: translate3d(320px, 0px, -720px) rotateX(0deg) rotateY(0deg) scale(1); z-index: -3;">
                                    <div class="testimonial-grid">
                                        <div class="thumbnail">
                                            <img src="<?=base_url('public/assets/images/testimonial/testimonial-01.png')?>" alt="Testimonial">
                                            <span class="qoute-icon"><i class="icon-26"></i></span>

                                        </div>
                                        <div class="content">
                                            <p>Lorem ipsum dolor amet consec tur elit adicing sed do usmod zx tempor enim minim veniam quis nostrud exer citation.</p>
                                            <div class="rating-icon">
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                            </div>
                                            <h5 class="title">Ray Sanchez</h5>
                                            <span class="subtitle">Student</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide swiper-slide-duplicate-next" data-swiper-slide-index="1" role="group" aria-label="2 / 4" style="width: 335px; transition-duration: 0ms; transform: translate3d(240px, 0px, -540px) rotateX(0deg) rotateY(0deg) scale(1); z-index: -2;">
                                    <div class="testimonial-grid">
                                        <div class="thumbnail">
                                            <img src="<?=base_url('public/assets/images/testimonial/testimonial-02.png')?>" alt="Testimonial">
                                            <span class="qoute-icon"><i class="icon-26"></i></span>

                                        </div>
                                        <div class="content">
                                            <p>Lorem ipsum dolor amet consec tur elit adicing sed do usmod zx tempor enim minim veniam quis nostrud exer citation.</p>
                                            <div class="rating-icon">
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                            </div>
                                            <h5 class="title">Thomas Lopez</h5>
                                            <span class="subtitle">Designer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide" data-swiper-slide-index="2" role="group" aria-label="3 / 4" style="width: 335px; transition-duration: 0ms; transform: translate3d(160px, 0px, -360px) rotateX(0deg) rotateY(0deg) scale(1); z-index: -1;">
                                    <div class="testimonial-grid">
                                        <div class="thumbnail">
                                            <img src="<?=base_url('public/assets/images/testimonial/testimonial-03.png')?>" alt="Testimonial">
                                            <span class="qoute-icon"><i class="icon-26"></i></span>

                                        </div>
                                        <div class="content">
                                            <p>Lorem ipsum dolor amet consec tur elit adicing sed do usmod zx tempor enim minim veniam quis nostrud exer citation.</p>
                                            <div class="rating-icon">
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                            </div>
                                            <h5 class="title">Amber Page</h5>
                                            <span class="subtitle">Developer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide swiper-slide-visible swiper-slide-prev" data-swiper-slide-index="3" role="group" aria-label="4 / 4" style="width: 335px; transition-duration: 0ms; transform: translate3d(80px, 0px, -180px) rotateX(0deg) rotateY(0deg) scale(1); z-index: 0;">
                                    <div class="testimonial-grid">
                                        <div class="thumbnail">
                                            <img src="<?=base_url('public/assets/images/testimonial/testimonial-04.png')?>" alt="Testimonial">
                                            <span class="qoute-icon"><i class="icon-26"></i></span>

                                        </div>
                                        <div class="content">
                                            <p>Lorem ipsum dolor amet consec tur elit adicing sed do usmod zx tempor enim minim veniam quis nostrud exer citation.</p>
                                            <div class="rating-icon">
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                            </div>
                                            <h5 class="title">Robert Tapp</h5>
                                            <span class="subtitle">Content Creator</span>
                                        </div>
                                    </div>
                                </div>
                            <div class="swiper-slide swiper-slide-duplicate swiper-slide-visible swiper-slide-active" data-swiper-slide-index="0" role="group" aria-label="1 / 4" style="width: 335px; transition-duration: 0ms; transform: translate3d(0px, 0px, 0px) rotateX(0deg) rotateY(0deg) scale(1); z-index: 1;">
                                    <div class="testimonial-grid">
                                        <div class="thumbnail">
                                            <img src="<?=base_url('public/assets/images/testimonial/testimonial-01.png')?>" alt="Testimonial">
                                            <span class="qoute-icon"><i class="icon-26"></i></span>

                                        </div>
                                        <div class="content">
                                            <p>Lorem ipsum dolor amet consec tur elit adicing sed do usmod zx tempor enim minim veniam quis nostrud exer citation.</p>
                                            <div class="rating-icon">
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                            </div>
                                            <h5 class="title">Ray Sanchez</h5>
                                            <span class="subtitle">Student</span>
                                        </div>
                                    </div>
                                </div><div class="swiper-slide swiper-slide-duplicate swiper-slide-visible swiper-slide-next" data-swiper-slide-index="1" role="group" aria-label="2 / 4" style="width: 335px; transition-duration: 0ms; transform: translate3d(-80px, 0px, -180px) rotateX(0deg) rotateY(0deg) scale(1); z-index: 0;">
                                    <div class="testimonial-grid">
                                        <div class="thumbnail">
                                            <img src="<?=base_url('public/assets/images/testimonial/testimonial-02.png')?>" alt="Testimonial">
                                            <span class="qoute-icon"><i class="icon-26"></i></span>

                                        </div>
                                        <div class="content">
                                            <p>Lorem ipsum dolor amet consec tur elit adicing sed do usmod zx tempor enim minim veniam quis nostrud exer citation.</p>
                                            <div class="rating-icon">
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                                <i class="icon-23"></i>
                                            </div>
                                            <h5 class="title">Thomas Lopez</h5>
                                            <span class="subtitle">Designer</span>
                                        </div>
                                    </div>
                                </div></div>
                            <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets swiper-pagination-horizontal"><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 1" aria-current="true"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 2"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide 3" aria-current="true"></span><span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide 4"></span></div>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Testimonial Area  -->
        <!--=====================================-->
        <!--=      Call To Action Area Start   	=-->
        <!--=====================================-->
        <!-- Start CTA Area  -->
        <div class="edu-cta-banner-area home-one-cta-wrapper bg-image">
            <div class="container">
                <div class="edu-cta-banner">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="section-title section-center sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                <h2 class="title">Get Your Quality Skills <span class="color-secondary">Certificate</span> Through HUB TECHSOLUTIONS</h2>
                                <a href="<?=base_url('courses')?>" class="edu-btn">Get started now <i class="icon-4"></i></a>
                            </div>
                        </div>
                    </div>
                    <ul class="shape-group">
                        <li class="shape-01 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                            <img data-depth="2.5" src="<?=base_url('public/assets/images/cta/shape-10.png')?>" alt="shape" style="transform: translate3d(23.9px, 12.2px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                        </li>
                        <li class="shape-02 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                            <img data-depth="-2.5" src="<?=base_url('public/assets/images/cta/shape-09.png')?>" alt="shape" style="transform: translate3d(-20.1px, -4px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                        </li>
                        <li class="shape-03 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                            <img data-depth="-2" src="<?=base_url('public/assets/images/cta/shape-08.png')?>" alt="shape" style="transform: translate3d(-25.2px, -14.1px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                        </li>
                        <li class="shape-04 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                            <img data-depth="2" src="<?=base_url('public/assets/images/about/shape-13.png')?>" alt="shape" style="transform: translate3d(29.7px, 15.1px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                        </li>
                    </ul>
					
                </div>
				
            </div>
        </div>
        <!-- End CTA Area  -->
        <div class="edu-brand-area brand-area-2 bg-image">
           <div class="container">
                
                <div class="row g-5">
                    <!-- Start Blog Grid  -->
                    <div class="col-lg-3 sal-animate" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-blog blog-style-1">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="blog-details.html">
                                        <img src="<?=base_url('public/assets/images/blog/blog-07.jpg')?>" alt="Blog Images">
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 sal-animate" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-blog blog-style-1">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="blog-details.html">
                                        <img src="<?=base_url('public/assets/images/blog/blog-04.jpg')?>" alt="Blog Images">
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 sal-animate" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-blog blog-style-1">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="blog-details.html">
                                        <img src="<?=base_url('public/assets/images/blog/blog-05.jpg')?>" alt="Blog Images">
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 sal-animate" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-blog blog-style-1">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="blog-details.html">
                                        <img src="<?=base_url('public/assets/images/blog/blog-06.jpg')?>" alt="Blog Images">
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                    </div><!-- End Blog Grid  -->
                    <!-- Start Blog Grid  -->
                    
                    <!-- End Blog Grid  -->
                    <!-- Start Blog Grid  -->
					<a href="contact-us.html" class="edu-btn">Search Your Certificate Now <i class="icon-4"></i></a>
                    <div class="col-lg-4 col-md-6 col-12 sal-animate" data-sal-delay="300" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-blog blog-style-1">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="blog-details.html">
                                        
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- End Blog Grid  -->
                </div>
            </div>
            <ul class="shape-group">
                <li class="shape-2 scene shape-light" data-sal-delay="500" data-sal="fade" data-sal-duration="200" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                    <img data-depth="-2" src="<?=base_url('public/assets/images/about/shape-41.png')?>" alt="Shape" style="transform: translate3d(0px, 0px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                </li>
                <li class="shape-2 scene shape-dark" data-sal-delay="500" data-sal="fade" data-sal-duration="200" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                    <img data-depth="-2" src="<?=base_url('public/assets/images/about/dark-shape-41.png')?>" alt="Shape" style="transform: translate3d(0px, 0px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                </li>
            </ul>
        </div>
        <!-- Start Team Area  -->
        <?php /* <div class="edu-team-area team-area-1 gap-tb-text">
            <div class="container">
                <div class="section-title section-center sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <span class="pre-title">Jobs</span>
                    <h2 class="title">Latest Government Job</h2>
                    <span class="shape-line"><i class="icon-19"></i></span>
                </div>
                <div class="edu-event-area event-area-">
                    <div class="container">
                        <div class="row g-5">
                            <!-- Start Event Grid  -->
                            <div class="col-lg-4 col-md-6 sal-animate" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                                <div class="edu-event event-style-1">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="event-details.html">
                                                <img src="<?=base_url('public/assets/images/event/event-01.jpg')?>" alt="Blog Images">
                                            </a>
                                            
                                        </div>
                                        <div class="content">
                                            <div class="event-date">
                                                <span class="day">30</span>
                                                <span class="month">SEP</span>
                                            </div>
                                            <h5 class="title"><a href="event-details.html">SBI Clerk.
                                            </a></h5>
                                            <p>Lorem ipsum dolor sit amet consectur elit sed eiusmod ex tempor incididunt labore dolore magna.</p>
                                            
                                            <div class="read-more-btn">
                                                <a class="edu-btn btn-small btn-secondary" href="event-details.html">Learn More <i class="icon-4"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Event Grid  -->
                            <!-- Start Event Grid  -->
                            <div class="col-lg-4 col-md-6 sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                <div class="edu-event event-style-1">
                                
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="event-details.html">
                                                <img src="<?=base_url('public/assets/images/event/event-02.jpg')?>" alt="Blog Images">
                                            </a>
                                            <div class="event-time">
                                                
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="event-date">
                                                <span class="day">30</span>
                                                <span class="month">SEP</span>
                                            </div>
                                            <h5 class="title"><a href="event-details.html">PSU Jobs.</a></h5>
                                            <p>Lorem ipsum dolor sit amet consectur elit sed eiusmod ex tempor incididunt labore dolore magna.</p>
                                            
                                            <div class="read-more-btn">
                                                <a class="edu-btn btn-small btn-secondary" href="event-details.html">Learn More <i class="icon-4"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Event Grid  -->
                            <!-- Start Event Grid  -->
                            <div class="col-lg-4 col-md-6 sal-animate" data-sal-delay="200" data-sal="slide-up" data-sal-duration="800">
                                <div class="edu-event event-style-1">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="event-details.html">
                                                <img src="<?=base_url('public/assets/images/event/event-03.jpg')?>" alt="Blog Images">
                                            </a>
                                            
                                        </div>
                                        <div class="content">
                                            <div class="event-date">
                                                <span class="day">30</span>
                                                <span class="month">SEP</span>
                                            </div>
                                            <h5 class="title"><a href="event-details.html">RBI Grade B Officer.</a></h5>
                                            <p>Lorem ipsum dolor sit amet consectur elit sed eiusmod ex tempor incididunt labore dolore magna.</p>
                                            
                                            <div class="read-more-btn">
                                                <a class="edu-btn btn-small btn-secondary" href="event-details.html">Learn More <i class="icon-4"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Event Grid  -->
                            <!-- Start Event Grid  -->
                            
                            <!-- End Event Grid  -->
                            <!-- Start Event Grid  -->
                            
                            <!-- End Event Grid  -->
                            <!-- Start Event Grid  -->
                            
                            <!-- End Event Grid  -->
                            <!-- Start Event Grid  -->
                            
                            <!-- End Event Grid  -->
                            <!-- Start Event Grid  -->
                            
                            <!-- End Event Grid  -->
                            <!-- Start Event Grid  -->
                            <div class="col-lg-4 col-md-6 sal-animate" data-sal-delay="200" data-sal="slide-up" data-sal-duration="800">
                                <div class="edu-event event-style-1">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href="event-details.html">
                                                
                                            </a>
                                            <div class="event-time">
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- End Event Grid  -->
                        </div>

                    </div>
                </div>
            </div>
        </div> */ ?>

		<div class="edu-faq-area faq-style-1">
            <div class="container">
                <div class="row g-5 row--45">
                    <div class="col-lg-6">
                        <div class="edu-faq-gallery">
                            <div class="row g-5">
                                <div class="col-6 sal-animate" data-sal-delay="50" data-sal="slide-right" data-sal-duration="800">
                                    <div class="faq-thumbnail thumbnail-1">
                                        <img src="<?=base_url('public/assets/images/faq/faq-01.jpg')?>" alt="Faq Images">
                                    </div>
                                </div>
                                <div class="col-6 sal-animate" data-sal-delay="100" data-sal="slide-left" data-sal-duration="800">
                                    <div class="faq-thumbnail thumbnail-2">
                                        <img src="<?=base_url('public/assets/images/faq/faq-02.jpg')?>" alt="Faq Images">
                                    </div>
                                </div>
                                <div class="col-6 sal-animate" data-sal-delay="50" data-sal="slide-right" data-sal-duration="800">
                                    <div class="faq-thumbnail thumbnail-3">
                                        <img src="<?=base_url('public/assets/images/faq/faq-03.jpg')?>" alt="Faq Images">
                                    </div>
                                </div>
                                <div class="col-6 sal-animate" data-sal-delay="100" data-sal="slide-left" data-sal-duration="800">
                                    <div class="faq-thumbnail thumbnail-4">
                                        <img src="<?=base_url('public/assets/images/faq/faq-04.webp')?>" alt="Faq Images">
                                    </div>
                                </div>
                            </div>
                            <ul class="shape-group">
                                <li class="shape-1 scene shape-light sal-animate" data-sal-delay="500" data-sal="fade" data-sal-duration="200" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                                    <img data-depth="2" src="<?=base_url('public/assets/images/faq/shape-02.png')?>" alt="Shape Images" style="transform: translate3d(26.1px, -1.4px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                                </li>
                                <li class="shape-1 scene shape-dark sal-animate" data-sal-delay="500" data-sal="fade" data-sal-duration="200" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                                    <img data-depth="1.5" src="<?=base_url('public/assets/images/faq/dark-shape-02.png')?>" alt="Shape Images" style="transform: translate3d(19.6px, -1px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                                </li>
                                <li class="shape-2 scene sal-animate" data-sal-delay="500" data-sal="fade" data-sal-duration="200" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                                    <img data-depth="-2" src="<?=base_url('public/assets/images/faq/shape-03.png')?>" alt="Shape Images" style="transform: translate3d(-19.1px, 2.4px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                                </li>
                                <li class="shape-3 scene sal-animate" data-sal-delay="500" data-sal="fade" data-sal-duration="200" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                                    <img data-depth="2" src="<?=base_url('public/assets/images/faq/shape-04.png')?>" alt="Shape Images" style="transform: translate3d(24.6px, -2.2px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                                </li>
                                <li class="shape-4 scene sal-animate" data-sal-delay="500" data-sal="fade" data-sal-duration="200" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                                    <img data-depth="-2" src="<?=base_url('public/assets/images/faq/shape-05.png')?>" alt="Shape Images" style="transform: translate3d(-32.7px, 2.4px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 sal-animate" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-faq-content">
                            <div class="section-title section-left">
                                <span class="pre-title">FAq’s</span>
                                <h2 class="title">Over 10 Years in <span class="color-secondary">Distant <br> Skill</span> Development</h2>
                                <span class="shape-line"><i class="icon-19"></i></span>
                            </div>
                            <div class="faq-accordion" id="faq-accordion">
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <h5 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true">
                                                How can I contact a school directly?
                                            </button>
                                        </h5>
                                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faq-accordion">
                                            <div class="accordion-body">
                                                <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eius mod ex tempor incididunt labore dolore magna aliquaenim ad minim eniam.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h5 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false">
                                                How do I find a school where I want to study?
                                            </button>
                                        </h5>
                                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faq-accordion">
                                            <div class="accordion-body">
                                                <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eius mod ex tempor incididunt labore dolore magna aliquaenim ad minim eniam.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h5 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false">
                                                Where should I study abroad?
                                            </button>
                                        </h5>
                                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faq-accordion">
                                            <div class="accordion-body">
                                                <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eius mod ex tempor incididunt labore dolore magna aliquaenim ad minim eniam.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="shape-group">
                                <li class="shape-1 scene sal-animate" data-sal-delay="500" data-sal="fade" data-sal-duration="200" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                                    <img data-depth="1.5" src="<?=base_url('public/assets/images/about/shape-02.png')?>" alt="Shape Images" style="transform: translate3d(32.7px, -2.6px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                                </li>
                                <li class="shape-2 scene sal-animate" data-sal-delay="500" data-sal="fade" data-sal-duration="200" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                                    <span data-depth="-2.2" style="transform: translate3d(-17.3px, 1.4px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;"></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="edu-blog-area blog-area-2 svg-image--2 bg-image gap-bottom-equal">
            <div class="container">
                <div class="section-title section-center sal-animate" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                    <span class="pre-title">Latest Articles</span>
                    <h2 class="title">Get News with Hub Techsolutions</h2>
                    <span class="shape-line"><i class="icon-19"></i></span>
                </div>
                <div class="row g-5">
                    <!-- Start Blog Grid  -->
                    <div class="col-lg-4 col-md-6 col-12 sal-animate" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-blog blog-style-1">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="blog-details.html">
                                        <img src="<?=base_url('public/assets/images/blog/blog-01.jpg')?>" alt="Blog Images">
                                    </a>
                                </div>
                                <div class="content position-top">
                                    <div class="read-more-btn">
                                        <a class="btn-icon-round" href="blog-details.html"><i class="icon-4"></i></a>
                                    </div>
                                    <div class="category-wrap">
                                        <a href="#" class="blog-category">ONLINE</a>
                                    </div>
                                    <h5 class="title"><a href="blog-details.html">Become a Better Blogger: Content Planning</a></h5>
                                    <ul class="blog-meta">
                                        <li><i class="icon-27"></i>Oct 10, 2022</li>
                                        <li><i class="icon-28"></i>Com 09</li>
                                    </ul>
                                    <p>Lorem ipsum dolor sit amet cons tetur adipisicing sed.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Blog Grid  -->
                    <!-- Start Blog Grid  -->
                    <div class="col-lg-4 col-md-6 col-12 sal-animate" data-sal-delay="200" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-blog blog-style-1">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="blog-details.html">
                                        <img src="<?=base_url('public/assets/images/blog/blog-02.jpg')?>" alt="Blog Images">
                                    </a>
                                </div>
                                <div class="content position-top">
                                    <div class="read-more-btn">
                                        <a class="btn-icon-round" href="blog-details.html"><i class="icon-4"></i></a>
                                    </div>
                                    <div class="category-wrap">
                                        <a href="#" class="blog-category">LECTURE</a>
                                    </div>
                                    <h5 class="title"><a href="blog-details.html">Become a Better Blogger: Content Planning</a></h5>
                                    <ul class="blog-meta">
                                        <li><i class="icon-27"></i>Oct 10, 2022</li>
                                        <li><i class="icon-28"></i>Com 09</li>
                                    </ul>
                                    <p>Lorem ipsum dolor sit amet cons tetur adipisicing sed.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Blog Grid  -->
                    <!-- Start Blog Grid  -->
                    <div class="col-lg-4 col-md-6 col-12 sal-animate" data-sal-delay="300" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-blog blog-style-1">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="blog-details.html">
                                        <img src="<?=base_url('public/assets/images/blog/blog-03.jpg')?>" alt="Blog Images">
                                    </a>
                                </div>
                                <div class="content position-top">
                                    <div class="read-more-btn">
                                        <a class="btn-icon-round" href="blog-details.html"><i class="icon-4"></i></a>
                                    </div>
                                    <div class="category-wrap">
                                        <a href="#" class="blog-category">BUSINESS</a>
                                    </div>
                                    <h5 class="title"><a href="blog-details.html">Become a Better Blogger: Content Planning</a></h5>
                                    <ul class="blog-meta">
                                        <li><i class="icon-27"></i>Oct 10, 2022</li>
                                        <li><i class="icon-28"></i>Com 09</li>
                                    </ul>
                                    <p>Lorem ipsum dolor sit amet cons tetur adipisicing sed.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Blog Grid  -->
                </div>
            </div>
            <ul class="shape-group">
                <li class="shape-1">
                    <img src="<?=base_url('public/assets/images/about/shape-25.png')?>" alt="Shape">
                </li>
            </ul>
        </div>
		