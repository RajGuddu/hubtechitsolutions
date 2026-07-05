        <!--=====================================-->
        <!--=       Breadcrumb Area Start      =-->
        <!--=====================================-->

        <div class="edu-breadcrumb-area breadcrumb-style-2 bg-image bg-image--19">
            <div class="container">
                <div class="breadcrumb-inner">
                    <div class="page-title">
                        <h1 class="title">A Large Range of Course Learning Paths</h1>
                    </div>
                    <ul class="edu-breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url();?>">Home</a></li>
                        <li class="separator"><i class="icon-angle-right"></i></li>
                       
                        <li class="breadcrumb-item active" aria-current="page">Courses</li>
                    </ul>
                </div>
            </div>
        </div>

      <div class="edu-course-area course-area-1 gap-tb-text">
            <div class="container">
                <div class="edu-sorting-area">
                    <div class="sorting-left">
                        <h6 class="showing-text">We found <span><?=count($courses)?></span> courses available for you</h6>
                    </div>
                    <div class="sorting-right">
                        <form action="<?=current_url()?>">
                        <div class="edu-sorting">
                            <div class="icon"><i class="icon-55"></i></div>
                            <select class="edu-select" name="category" onchange="this.form.submit();">
                                <option value="">Filters</option>
                                <?php if(!empty($course_category)){
                                foreach($course_category as $cate){?>
                                    <option value="<?=$cate->ccat_id?>"><?=$cate->course_category_name?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                        </form>
                    </div>
                </div>

                <div class="row g-5">
                    <?php if(!empty($courses)){
                    foreach($courses as $list){ ?>
                    <!-- Start Single Course  -->
                    <div class="col-md-6 col-lg-4 col-xl-3 sal-animate" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-course course-style-1 course-box-shadow hover-button-bg-white">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="course-details.html">
                                        <img src="<?=base_url('public/assets/upload/images/'.$list->image) ?>" alt="Course Meta">
                                    </a>
                                    <div class="time-top">
                                        <span class="duration"><i class="icon-61"></i><?=$list->duration?></span>
                                    </div>
                                </div>
                                <?php if($list->course_level == 'A'){ 
                                    $course_level = 'Advanced';
                                }else if($list->course_level == 'I'){
                                    $course_level = 'Intermidiate';
                                }else{
                                    $course_level = 'Beginner';
                                } ?>
                                <div class="content">
                                    <span class="course-level"><?=$course_level; ?></span>
                                    <h6 class="title">
                                        <a href="javascript:void(0)"><?=$list->course_full_name?></a>
                                    </h6>
                                    <div class="course-rating">
                                        <div class="rating">
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                        </div>
                                        <span class="rating-count">(5.0 /9 Rating)</span>
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
                            <div class="course-hover-content-wrapper">
                                <button class="wishlist-btn"><i class="icon-22"></i></button>
                            </div>
                            <div class="course-hover-content">
                                <div class="content">
                                    <button class="wishlist-btn"><i class="icon-22"></i></button>
                                    <span class="course-level"><?=$course_level; ?></span>
                                    <h6 class="title">
                                        <a href="<?=base_url('course-details').'/'.$list->url?>"><?=$list->course_full_name?></a>
                                    </h6>
                                    <div class="course-rating">
                                        <div class="rating">
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                        </div>
                                        <span class="rating-count">(5.0 /9 Rating)</span>
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
                    <?php } } ?>
                    <!-- End Single Course  -->
                    <?php /* <!-- Start Single Course  -->
                    <div class="col-md-6 col-lg-4 col-xl-3 sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-course course-style-1 course-box-shadow hover-button-bg-white">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="course-details.html">
                                        <img src="<?=base_url('public/assets/images/course/course-04.jpg')?>" alt="Course Meta">
                                    </a>
                                    <div class="time-top">
                                        <span class="duration"><i class="icon-61"></i>9 Weeks</span>
                                    </div>
                                </div>
                                <div class="content">
                                    <span class="course-level">Intermediate</span>
                                    <h6 class="title">
                                        <a href="#">Starting SEO as your Home Based Business</a>
                                    </h6>
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
                                        <li><i class="icon-24"></i>74 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
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
                                    <h6 class="title">
                                        <a href="course-details.html">Starting SEO as your Home Based Business</a>
                                    </h6>
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
                                    <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod tempor.</p>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>74 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
                                    </ul>
                                    <a href="<?php echo base_url('course-details')?>" class="edu-btn btn-secondary btn-small">Enrolled <i class="icon-4"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Course  -->
                    <!-- Start Single Course  -->
                    <div class="col-md-6 col-lg-4 col-xl-3 sal-animate" data-sal-delay="200" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-course course-style-1 course-box-shadow hover-button-bg-white">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="course-details.html">
                                        <img src="<?=base_url('public/assets/images/course/course-05.jpg')?>" alt="Course Meta">
                                    </a>
                                    <div class="time-top">
                                        <span class="duration"><i class="icon-61"></i>4 Weeks</span>
                                    </div>
                                </div>
                                <div class="content">
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="#">Building A Better World One Student At A Time</a>
                                    </h6>
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
                                    <div class="course-price">$29.00</div>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>8 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course-hover-content-wrapper">
                                <button class="wishlist-btn"><i class="icon-22"></i></button>
                            </div>
                            <div class="course-hover-content">
                                <div class="content">
                                    <button class="wishlist-btn"><i class="icon-22"></i></button>
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="course-details.html">Building A Better World One Student At A Time</a>
                                    </h6>
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
                                    <div class="course-price">$29.00</div>
                                    <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod tempor.</p>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>8 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
                                    </ul>
                                    <a href="<?php echo base_url('course-details')?>" class="edu-btn btn-secondary btn-small">Enrolled <i class="icon-4"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Course  -->
                    <!-- Start Single Course  -->
                    <div class="col-md-6 col-lg-4 col-xl-3 sal-animate" data-sal-delay="250" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-course course-style-1 course-box-shadow hover-button-bg-white">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="course-details.html">
                                        <img src="<?=base_url('public/assets/images/course/course-06.jpg')?>" alt="Course Meta">
                                    </a>
                                    <div class="time-top">
                                        <span class="duration"><i class="icon-61"></i>4 Weeks</span>
                                    </div>
                                </div>
                                <div class="content">
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="#">Java Programming Masterclass for Software Developers</a>
                                    </h6>
                                    <div class="course-rating">
                                        <div class="rating">
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                        </div>
                                        <span class="rating-count">(5.0 /18 Rating)</span>
                                    </div>
                                    <div class="course-price">$19.00</div>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>24 Lessons</li>
                                        <li><i class="icon-25"></i>95 Students</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course-hover-content-wrapper">
                                <button class="wishlist-btn"><i class="icon-22"></i></button>
                            </div>
                            <div class="course-hover-content">
                                <div class="content">
                                    <button class="wishlist-btn"><i class="icon-22"></i></button>
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="<?php echo base_url('course-details')?>">Java Programming Masterclass for Software Developers</a>
                                    </h6>
                                    <div class="course-rating">
                                        <div class="rating">
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                            <i class="icon-23"></i>
                                        </div>
                                        <span class="rating-count">(5.0 /18 Rating)</span>
                                    </div>
                                    <div class="course-price">$19.00</div>
                                    <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod tempor.</p>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>24 Lessons</li>
                                        <li><i class="icon-25"></i>95 Students</li>
                                    </ul>
                                    <a href="<?php echo base_url('course-details')?>" class="edu-btn btn-secondary btn-small">Enrolled <i class="icon-4"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Course  -->
                    <!-- Start Single Course  -->
                    <div class="col-md-6 col-lg-4 col-xl-3 sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-course course-style-1 course-box-shadow hover-button-bg-white">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="course-details.html">
                                        <img src="<?=base_url('public/assets/images/course/course-24.jpg')?>" alt="Course Meta">
                                    </a>
                                    <div class="time-top">
                                        <span class="duration"><i class="icon-61"></i>8 Weeks</span>
                                    </div>
                                </div>
                                <div class="content">
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="#">Angular &amp; NodeJS - The MEAN Stack Guide [2021 Edition]</a>
                                    </h6>
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
                                    <div class="course-price">$29.00</div>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>8 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course-hover-content-wrapper">
                                <button class="wishlist-btn"><i class="icon-22"></i></button>
                            </div>
                            <div class="course-hover-content">
                                <div class="content">
                                    <button class="wishlist-btn"><i class="icon-22"></i></button>
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="course-details.html">Angular &amp; NodeJS - The MEAN Stack Guide [2021 Edition]</a>
                                    </h6>
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
                                    <div class="course-price">$29.00</div>
                                    <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod tempor.</p>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>8 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
                                    </ul>
                                    <a href="<?php echo base_url('course-details')?>" class="edu-btn btn-secondary btn-small">Enrolled <i class="icon-4"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Course  -->
                    <!-- Start Single Course  -->
                    <div class="col-md-6 col-lg-4 col-xl-3 sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-course course-style-1 course-box-shadow hover-button-bg-white">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="course-details.html">
                                        <img src="<?=base_url('public/assets/images/course/course-25.jpg')?>" alt="Course Meta">
                                    </a>
                                    <div class="time-top">
                                        <span class="duration"><i class="icon-61"></i>3 Weeks</span>
                                    </div>
                                </div>
                                <div class="content">
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="#">The Complete React Developer Course (Hooks and Redux)</a>
                                    </h6>
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
                                    <div class="course-price">$29.00</div>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>8 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course-hover-content-wrapper">
                                <button class="wishlist-btn"><i class="icon-22"></i></button>
                            </div>
                            <div class="course-hover-content">
                                <div class="content">
                                    <button class="wishlist-btn"><i class="icon-22"></i></button>
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="course-details.html">The Complete React Developer Course (Hooks and Redux)</a>
                                    </h6>
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
                                    <div class="course-price">$29.00</div>
                                    <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod tempor.</p>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>8 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
                                    </ul>
                                    <a href="<?php echo base_url('course-details')?>" class="edu-btn btn-secondary btn-small">Enrolled <i class="icon-4"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Course  -->
                    <!-- Start Single Course  -->
                    <div class="col-md-6 col-lg-4 col-xl-3 sal-animate" data-sal-delay="200" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-course course-style-1 course-box-shadow hover-button-bg-white">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="course-details.html">
                                        <img src="<?=base_url('public/assets/images/course/course-26.jpg')?>" alt="Course Meta">
                                    </a>
                                    <div class="time-top">
                                        <span class="duration"><i class="icon-61"></i>3 Weeks</span>
                                    </div>
                                </div>
                                <div class="content">
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="#">Build an app with ASPNET Core &amp; Angular from Scratch Begainer</a>
                                    </h6>
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
                                    <div class="course-price">$29.00</div>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>8 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course-hover-content-wrapper">
                                <button class="wishlist-btn"><i class="icon-22"></i></button>
                            </div>
                            <div class="course-hover-content">
                                <div class="content">
                                    <button class="wishlist-btn"><i class="icon-22"></i></button>
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="course-details.html">Build an app with ASPNET Core &amp; Angular from Scratch Begainer</a>
                                    </h6>
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
                                    <div class="course-price">$29.00</div>
                                    <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod tempor.</p>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>8 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
                                    </ul>
                                    <a href="<?php echo base_url('course-details')?>" class="edu-btn btn-secondary btn-small">Enrolled <i class="icon-4"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Course  -->
                    <!-- Start Single Course  -->
                    <div class="col-md-6 col-lg-4 col-xl-3 sal-animate" data-sal-delay="250" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-course course-style-1 course-box-shadow hover-button-bg-white">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="course-details.html">
                                        <img src="<?=base_url('public/assets/images/course/course-27.jpg')?>" alt="Course Meta">
                                    </a>
                                    <div class="time-top">
                                        <span class="duration"><i class="icon-61"></i>3 Weeks</span>
                                    </div>
                                </div>
                                <div class="content">
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="#">Become a WordPress Developer: Unlocking Power with Code</a>
                                    </h6>
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
                                    <div class="course-price">$29.00</div>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>8 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course-hover-content-wrapper">
                                <button class="wishlist-btn"><i class="icon-22"></i></button>
                            </div>
                            <div class="course-hover-content">
                                <div class="content">
                                    <button class="wishlist-btn"><i class="icon-22"></i></button>
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="course-details.html">Become a WordPress Developer: Unlocking Power with Code</a>
                                    </h6>
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
                                    <div class="course-price">$29.00</div>
                                    <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod tempor.</p>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>8 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
                                    </ul>
                                    <a href="<?php echo base_url('course-details')?>" class="edu-btn btn-secondary btn-small">Enrolled <i class="icon-4"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Course  -->
                    <!-- Start Single Course  -->
                    <div class="col-md-6 col-lg-4 col-xl-3 sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-course course-style-1 course-box-shadow hover-button-bg-white">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="course-details.html">
                                        <img src="<?=base_url('public/assets/images/course/course-28.jpg')?>" alt="Course Meta">
                                    </a>
                                    <div class="time-top">
                                        <span class="duration"><i class="icon-61"></i>3 Weeks</span>
                                    </div>
                                </div>
                                <div class="content">
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="#">Build Responsive Real- World Websites with HTML and CSS</a>
                                    </h6>
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
                                    <div class="course-price">$29.00</div>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>8 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course-hover-content-wrapper">
                                <button class="wishlist-btn"><i class="icon-22"></i></button>
                            </div>
                            <div class="course-hover-content">
                                <div class="content">
                                    <button class="wishlist-btn"><i class="icon-22"></i></button>
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="course-details.html">Build Responsive Real- World Websites with HTML and CSS</a>
                                    </h6>
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
                                    <div class="course-price">$29.00</div>
                                    <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod tempor.</p>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>8 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
                                    </ul>
                                    <a href="<?php echo base_url('course-details')?>" class="edu-btn btn-secondary btn-small">Enrolled <i class="icon-4"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Course  -->
                    <!-- Start Single Course  -->
                    <div class="col-md-6 col-lg-4 col-xl-3 sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-course course-style-1 course-box-shadow hover-button-bg-white">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="course-details.html">
                                        <img src="<?=base_url('public/assets/images/course/course-29.jpg')?>" alt="Course Meta">
                                    </a>
                                    <div class="time-top">
                                        <span class="duration"><i class="icon-61"></i>3 Weeks</span>
                                    </div>
                                </div>
                                <div class="content">
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="#">Vue - The Complete Guide (w/ Router, Vuex, Composition API)</a>
                                    </h6>
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
                                    <div class="course-price">$29.00</div>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>8 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course-hover-content-wrapper">
                                <button class="wishlist-btn"><i class="icon-22"></i></button>
                            </div>
                            <div class="course-hover-content">
                                <div class="content">
                                    <button class="wishlist-btn"><i class="icon-22"></i></button>
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="course-details.html">Vue - The Complete Guide (w/ Router, Vuex, Composition API)</a>
                                    </h6>
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
                                    <div class="course-price">$29.00</div>
                                    <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod tempor.</p>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>8 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
                                    </ul>
                                    <a href="<?php echo base_url('course-details')?>" class="edu-btn btn-secondary btn-small">Enrolled <i class="icon-4"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Course  -->
                    <!-- Start Single Course  -->
                    <div class="col-md-6 col-lg-4 col-xl-3 sal-animate" data-sal-delay="200" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-course course-style-1 course-box-shadow hover-button-bg-white">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="course-details.html">
                                        <img src="<?=base_url('public/assets/images/course/course-30.jpg')?>" alt="Course Meta">
                                    </a>
                                    <div class="time-top">
                                        <span class="duration"><i class="icon-61"></i>3 Weeks</span>
                                    </div>
                                </div>
                                <div class="content">
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="#">Master Microservices with Spring Boot and Spring Cloud</a>
                                    </h6>
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
                                    <div class="course-price">$29.00</div>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>8 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course-hover-content-wrapper">
                                <button class="wishlist-btn"><i class="icon-22"></i></button>
                            </div>
                            <div class="course-hover-content">
                                <div class="content">
                                    <button class="wishlist-btn"><i class="icon-22"></i></button>
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="course-details.html">Master Microservices with Spring Boot and Spring Cloud</a>
                                    </h6>
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
                                    <div class="course-price">$29.00</div>
                                    <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod tempor.</p>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>8 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
                                    </ul>
                                    <a href="<?php echo base_url('course-details')?>" class="edu-btn btn-secondary btn-small">Enrolled <i class="icon-4"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Course  -->
                    <!-- Start Single Course  -->
                    <div class="col-md-6 col-lg-4 col-xl-3 sal-animate" data-sal-delay="250" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-course course-style-1 course-box-shadow hover-button-bg-white">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="course-details.html">
                                        <img src="<?=base_url('public/assets/images/course/course-31.jpg')?>" alt="Course Meta">
                                    </a>
                                    <div class="time-top">
                                        <span class="duration"><i class="icon-61"></i>3 Weeks</span>
                                    </div>
                                </div>
                                <div class="content">
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="#">The Complete Angular Course: Beginner to Advanced</a>
                                    </h6>
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
                                    <div class="course-price">$29.00</div>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>8 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course-hover-content-wrapper">
                                <button class="wishlist-btn"><i class="icon-22"></i></button>
                            </div>
                            <div class="course-hover-content">
                                <div class="content">
                                    <button class="wishlist-btn"><i class="icon-22"></i></button>
                                    <span class="course-level">Beginner</span>
                                    <h6 class="title">
                                        <a href="course-details.html">The Complete Angular Course: Beginner to Advanced</a>
                                    </h6>
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
                                    <div class="course-price">$29.00</div>
                                    <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod tempor.</p>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>8 Lessons</li>
                                        <li><i class="icon-25"></i>20 Students</li>
                                    </ul>
                                    <a href="<?php echo base_url('course-details')?>" class="edu-btn btn-secondary btn-small">Enrolled <i class="icon-4"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Course  --> */ ?>
                </div>
                <!-- <div class="load-more-btn sal-animate" data-sal-delay="100" data-sal="slide-up" data-sal-duration="1200">
                    <a href="course-one.html" class="edu-btn">Load More <i class="icon-56"></i></a>
                </div> -->
            </div>
        </div>

 