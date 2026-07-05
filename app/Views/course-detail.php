
        <!--=====================================-->
        <!--=       Breadcrumb Area Start      =-->
        <!--=====================================-->
        <?php //print_r($course); exit; ?>
        <div class="edu-breadcrumb-area breadcrumb-style-2 bg-image bg-image--19">
            <div class="container">
                <div class="breadcrumb-inner">
                    <div class="page-title">
                        <h1 class="title"><?=ucwords($course->course_full_name)?></h1>
                    </div>
                    <ul class="edu-breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                        <li class="separator"><i class="icon-angle-right"></i></li>
                       
                        <li class="breadcrumb-item active" aria-current="page">Courses</li>
						 <li class="separator"><i class="icon-angle-right"></i></li>
                       
                        <li class="breadcrumb-item active" aria-current="page"><?=ucwords(strtolower($course->course_name))?></li>
                    </ul>
                </div>
            </div>
        </div>

        <section class="edu-section-gap course-details-area">
            <div class="container">
                <div class="row row--30">
                    <div class="col-lg-8">
                        <div class="course-details-content course-details-2">
                            <div class="course-overview">
                                <h3 class="heading-title sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">About <?=ucwords($course->course_full_name)?></h3>
                                <?php echo $course->description; ?>
                                <!-- <p data-sal-delay="150" data-sal="slide-up" data-sal-duration="800" class="sal-animate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor inc idid unt ut labore et dolore magna aliqua enim ad minim veniam, quis nostrud exerec tation ullamco laboris nis aliquip commodo consequat duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur enim ipsam.</p>
                                <p data-sal-delay="150" data-sal="slide-up" data-sal-duration="800" class="sal-animate">Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem aperiam.</p> -->
                                <?php if(isset($course) && $course->what_learn != ''){
                                    $what_learnArr = json_decode($course->what_learn);
                                    //print_r(explode(',',$syllabus[0]->syllabus));exit;
                                    }
                                ?>
                                <div class="border-box">
                                    <h5 class="title sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">What You’ll Learn?</h5>
                                    <div class="row g-5">
                                        <div class="col-lg-6 sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                            <ul>
                                                <li><?=(isset($what_learnArr[0]))?$what_learnArr[0]:''; ?></li>
                                                <li><?=(isset($what_learnArr[1]))?$what_learnArr[1]:''; ?></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6 sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                            <ul>
                                                <li><?=(isset($what_learnArr[2]))?$what_learnArr[2]:''; ?></li>
                                                <li><?=(isset($what_learnArr[3]))?$what_learnArr[3]:''; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php if(isset($course) && $course->requirements != ''){
                                    $requirementsArr = json_decode($course->requirements);
                                    //print_r(explode(',',$syllabus[0]->syllabus));exit;
                                    }
                                ?>
                                <h3 class="heading-title sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">Requirements</h3>
                                <ul class="mb--90 sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                    <li><?=(isset($requirementsArr[0]))?$requirementsArr[0]:''; ?></li>
                                    <li><?=(isset($requirementsArr[1]))?$requirementsArr[1]:''; ?></li>
                                    <li><?=(isset($requirementsArr[2]))?$requirementsArr[2]:''; ?></li>
                                    <li><?=(isset($requirementsArr[3]))?$requirementsArr[3]:''; ?></li>
                                </ul>
                                <?php /*<h3 class="heading-title sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">Target Audience</h3>
                                <ul class="mb--90 sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                    <li>Newcomer as well as experienced frontend developers interested in learning a modern JavaScript framework</li>
                                    <li>If you want to learn to master Wordpress without getting bogged down with technical jargon, this course is for you.</li>
                                    <li>This course is for you if you want to build a website, whether for personal or business reasons.</li>
                                    <li>This course is perfect for you if you are taking over an existing Wordpress website, or want to build one from</li>
                                </ul> */ ?>
                            </div>
                            <div class="course-curriculam mb--90">
                                <h3 class="heading-title sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">Topics for This Course</h3>
                                <p data-sal-delay="150" data-sal="slide-up" data-sal-duration="800" class="sal-animate">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor inc idid unt ut labore et dolore magna aliqua.</p>
                                <div class="accordion edu-accordion sal-animate" id="accordionExample" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                
                                <?php if(isset($course) && $course->syllabus != ''){
                                    $syllabus = json_decode($course->syllabus);
                                    //print_r(explode(',',$syllabus[0]->syllabus));exit;
                                } ?>
                                <?php if(isset($syllabus)){
                                foreach($syllabus as $key=>$list){ ?>
                                    <div class="accordion-item">
                                        <h3 class="accordion-header" id="heading<?=$key?>">
                                            <button class="accordion-button <?=($key < 1)?'':'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$key?>" aria-expanded="true" aria-controls="collapse<?=$key?>">
                                                <?=$list->module_name;?>
                                            </button>
                                        </h3>
                                        <div id="collapse<?=$key?>" class="accordion-collapse collapse <?=($key < 1)?'show':''?>" aria-labelledby="heading<?=$key?>" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="course-lesson">
                                                    <ul>
                                                        <?php $subjectArr = explode(',',$list->syllabus);
                                                        foreach($subjectArr as $sub){  ?>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> <?=$sub?></div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li>
                                                        <?php } ?>
                                                        <!-- <li>
                                                            <div class="text"><i class="icon-65"></i> Course Overview</div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Local Development Environment Tools</div>
                                                            <div class="badge-list">
                                                                <span class="badge badge-primary">0 Question</span>
                                                                <span class="badge badge-secondary">10 Minutes</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Course Exercise / Reference Files</div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Code Editor Installation (Optional if you have one)</div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Embedding PHP in HTML</div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li> -->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } }?>
                                    <!-- <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                JavaScript Language Basics
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="course-lesson">
                                                    <ul>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Introduction</div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Course Overview</div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Local Development Environment Tools</div>
                                                            <div class="badge-list">
                                                                <span class="badge badge-primary">0 Question</span>
                                                                <span class="badge badge-secondary">10 Minutes</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Course Exercise / Reference Files</div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Code Editor Installation (Optional if you have one)</div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Embedding PHP in HTML</div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Components &amp; Databinding
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="course-lesson">
                                                    <ul>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Introduction</div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Course Overview</div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Local Development Environment Tools</div>
                                                            <div class="badge-list">
                                                                <span class="badge badge-primary">0 Question</span>
                                                                <span class="badge badge-secondary">10 Minutes</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Course Exercise / Reference Files</div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Code Editor Installation (Optional if you have one)</div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Embedding PHP in HTML</div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFour">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                Product Management Leadership
                                            </button>
                                        </h2>
                                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="course-lesson">
                                                    <ul>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Introduction</div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Course Overview</div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Local Development Environment Tools</div>
                                                            <div class="badge-list">
                                                                <span class="badge badge-primary">0 Question</span>
                                                                <span class="badge badge-secondary">10 Minutes</span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Course Exercise / Reference Files</div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Code Editor Installation (Optional if you have one)</div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li>
                                                        <li>
                                                            <div class="text"><i class="icon-65"></i> Embedding PHP in HTML</div>
                                                            <div class="icon"><i class="icon-68"></i></div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="course-instructor-wrap mb--90 sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                <h3 class="heading-title">Your Instructors</h3>
                                <div class="course-instructor">
                                    <div class="thumbnail">
                                        <img src="<?=base_url('public/assets/upload/images/'.$course->ins_image) ?>" alt="Author Images">
                                    </div>
                                    <div class="author-content">
                                        <h6 class="title"><?=ucwords($course->ins_name)?></h6>
                                        <span class="subtitle"><?=$course->post?></span>
                                        <p><?=$course->details?></p>
                                        <ul class="social-share">
                                            <li><a href="<?=$course->facebook_link?>"><i class="icon-facebook"></i></a></li>
                                            <li><a href="<?=$course->twitor_link?>"><i class="icon-twitter"></i></a></li>
                                            <li><a href="<?=$course->linkedin_link?>"><i class="icon-linkedin2"></i></a></li>
                                            <li><a href="<?=$course->youtube_link?>"><i class="icon-youtube"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php /* <div class="course-review sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                <h3 class="heading-title">Student Feedback</h3>
                                <p>5.00 average rating based on 7 rating</p>
                                <div class="border-box">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-lg-4">
                                            <div class="rating-box">
                                                <div class="rating-number">5.0</div>
                                                <div class="rating">
                                                    <i class="icon-23"></i>
                                                    <i class="icon-23"></i>
                                                    <i class="icon-23"></i>
                                                    <i class="icon-23"></i>
                                                    <i class="icon-23"></i>
                                                </div>
                                                <span>(7 Review)</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="review-wrapper">

                                                <div class="single-progress-bar">
                                                    <div class="rating-text">
                                                        5 <i class="icon-23"></i>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="rating-value">7</span>
                                                </div>

                                                <div class="single-progress-bar">
                                                    <div class="rating-text">
                                                        4 <i class="icon-23"></i>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="rating-value">0</span>
                                                </div>

                                                <div class="single-progress-bar">
                                                    <div class="rating-text">
                                                        4 <i class="icon-23"></i>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="rating-value">0</span>
                                                </div>

                                                <div class="single-progress-bar">
                                                    <div class="rating-text">
                                                        4 <i class="icon-23"></i>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="rating-value">0</span>
                                                </div>

                                                <div class="single-progress-bar">
                                                    <div class="rating-text">
                                                        4 <i class="icon-23"></i>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="rating-value">0</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Start Comment Area  -->
                                    <div class="comment-area">
                                        <div class="comment-list-wrapper">
                                            <!-- Start Single Comment  -->
                                            <div class="comment">
                                                <div class="thumbnail">
                                                    <img src="<?=base_url('public/assets/images/blog/comment-01.jpg')?>" alt="Comment Images">
                                                </div>
                                                <div class="comment-content">
                                                    <div class="rating">
                                                        <i class="icon-23"></i>
                                                        <i class="icon-23"></i>
                                                        <i class="icon-23"></i>
                                                        <i class="icon-23"></i>
                                                        <i class="icon-23"></i>
                                                    </div>
                                                    <h5 class="title">Haley Bennet</h5>
                                                    <span class="date">Oct 10, 2021</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                            <!-- End Single Comment  -->
                                            <!-- Start Single Comment  -->
                                            <div class="comment">
                                                <div class="thumbnail">
                                                    <img src="<?=base_url('public/assets/images/blog/comment-02.jpg')?>" alt="Comment Images">
                                                </div>
                                                <div class="comment-content">
                                                    <div class="rating">
                                                        <i class="icon-23"></i>
                                                        <i class="icon-23"></i>
                                                        <i class="icon-23"></i>
                                                        <i class="icon-23"></i>
                                                        <i class="icon-23"></i>
                                                    </div>
                                                    <h5 class="title">Simon Baker</h5>
                                                    <span class="date">Oct 10, 2021</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                            <!-- End Single Comment  -->
                                            <!-- Start Single Comment  -->
                                            <div class="comment">
                                                <div class="thumbnail">
                                                    <img src="<?=base_url('public/assets/images/blog/comment-03.jpg')?>" alt="Comment Images">
                                                </div>
                                                <div class="comment-content">
                                                    <div class="rating">
                                                        <i class="icon-23"></i>
                                                        <i class="icon-23"></i>
                                                        <i class="icon-23"></i>
                                                        <i class="icon-23"></i>
                                                        <i class="icon-23"></i>
                                                    </div>
                                                    <h6 class="title">Richard Gere</h6>
                                                    <span class="date">Oct 10, 2021</span>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                            <!-- End Single Comment  -->
                                        </div>
                                    </div>
                                    <!-- End Comment Area  -->
                                </div>
                            </div> */ ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="course-sidebar-3">
                            <div class="edu-course-widget widget-course-summery">
                                <div class="inner">
                                    <div class="thumbnail">
                                        <img src="<?=base_url('public/assets/upload/images/'.$course->image) ?>" alt="Courses">
                                        <?php if($course->youtube_vlink != ''){ ?>
                                        <a href="<?=$course->youtube_vlink?>" class="play-btn video-popup-activation"><i class="icon-18"></i></a>
                                        <?php } ?>
                                    </div>
                                    <div class="content">
                                        <h4 class="widget-title">Course Includes:</h4>
                                        <ul class="course-item">
                                            <li>
                                                <span class="label"><i class="icon-60"></i>Course Fee:</span>
                                                <span class="value price">RS. <?=$course->course_fee?></span>
                                            </li>
                                            <li>
                                                <span class="label"><i class="icon-60"></i>Adm Fee:</span>
                                                <span class="value price">RS. <?=$course->adm_fee?></span>
                                            </li>
                                            <li>
                                                <span class="label"><i class="icon-60"></i>Ins Fee:</span>
                                                <span class="value price">RS. <?=$course->ins_fee?></span>
                                            </li>
                                            <li>
                                                <span class="label"><i class="icon-62"></i>Instructor:</span>
                                                <span class="value"><?=$course->ins_name?></span>
                                            </li>
                                            <li>
                                                <span class="label"><i class="icon-61"></i>Duration:</span>
                                                <span class="value"><?=$course->duration?></span>
                                            </li>
                                            <!-- <li>
                                                <span class="label"><svg xmlns="http://www.w3.org/2000/svg" width="19.84" height="17.75" viewBox="0 0 19.84 17.75" data-inject-url="https://edublink.html.devsblink.com/assets/images/svg-icons/books.svg" class="svgInject">
                                                <defs>
                                                    <style>
                                                    .cls-1 {
                                                        fill: #181818;
                                                        fill-rule: evenodd;
                                                    }
                                                    </style>
                                                </defs>
                                                <path class="cls-1" d="M1244.3,708.6c-0.57-1.6-1.78-.867-1.43-1.008l-2.52,1.008v-1.314a0.719,0.719,0,0,0-.65-0.658h-9.86a0.6,0.6,0,0,0-.66.658v16.43a0.6,0.6,0,0,0,.66.657h9.86a0.6,0.6,0,0,0,.65-0.657v-11.83s3.14,8.9,3.82,10.812a1.069,1.069,0,0,0,1.44.361s2.23-.89,3.01-1.206a1,1,0,0,0,.28-1.423Zm-3.79,1.262,2.59-1.069,1.01,2.695-2.35,1.016Zm-1.47,2.024h-3.29v-3.943h3.29v3.943Zm-4.6-3.943v3.943h-3.95v-3.943h3.95Zm-3.95,5.258h3.95v9.858h-3.95V713.2Zm5.26,0h3.29v9.858h-3.29V713.2Zm6.46,0.388,2.45-.933,3.06,8.347-2.45.994Z" transform="translate(-1229.19 -706.625)" style="stroke-dasharray: 208, 210; stroke-dashoffset: 0;"></path>
                                                </svg>Lessons:</span>
                                                <span class="value">8</span>
                                            </li> -->
                                            <li>
                                                <span class="label"><i class="icon-63"></i>Enrolled:</span>
                                                <span class="value"><?=$course->enrolled?> Students</span>
                                            </li>
                                            <?php if($course->language == 'E'){
                                                $lang = 'English';
                                            }else if($course->language == 'H'){
                                                $lang = 'Hindi';
                                            }else{
                                                $lang = 'English/Hindi';
                                            }
                                            ?>
                                            <li>
                                                <span class="label"><i class="icon-59"></i>Language:</span>
                                                <span class="value"><?=$lang?></span>
                                            </li>
                                            <li>
                                                <span class="label"><i class="icon-64"></i>Certificate:</span>
                                                <span class="value"><?=$course->is_cert?></span>
                                            </li>
                                        </ul>
                                        <div class="read-more-btn">
                                            <a href="javascript:void(0)" class="edu-btn enrolled">Enrolled <i class="icon-4"></i></a>
                                        </div>
                                        <div class="share-area">
                                            <h4 class="title">Share On:</h4>
                                            <ul class="social-share">
                                                <li><a href="#"><i class="icon-facebook"></i></a></li>
                                                <li><a href="#"><i class="icon-twitter"></i></a></li>
                                                <li><a href="#"><i class="icon-linkedin2"></i></a></li>
                                                <li><a href="#"><i class="icon-youtube"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="edu-blog-widget widget-categories">
                                <div class="inner">
                                    <h4 class="widget-title">Course Categories</h4>
                                    <div class="content">
                                        <ul class="category-list">
                                            <?php if(!empty($course_category)){
                                            $service_model = model('App\Models\Service_model', false);
                                            foreach($course_category as $cate){ 
                                            $course_count = $service_model->get_count_courses(['ccat_id'=>$cate->ccat_id])  ;
                                            ?>
                                                <li><a href="<?=base_url('courses').'?category='.$cate->ccat_id?>"><?=$cate->course_category_name?> <span>(<?=$course_count?>)</span></a></li>

                                            <?php } } ?>
                                            <!-- <li><a href="#">Computer Engineering <span>(7)</span></a></li>
                                            <li><a href="#">Medical &amp; Health<span>(2)</span></a></li>
                                            <li><a href="#">Software <span>(1)</span></a></li>
                                            <li><a href="#">Web Development <span>(3)</span></a></li>
                                            <li><a href="#">Uncategorized <span>(9)</span></a></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!-- Modal -->
    <div class="modal fade" id="enrolledModal" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="rnt-contact-form" id="contact_us_form" method="POST" action="">
                        <div class="row row--10">
                            <div class="form-group col-lg-6">
                                <input type="text" name="name" id="name" placeholder="Your Name">
                                <span class="text-danger" id="nameErr"></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <input type="email" name="email" id="email" placeholder="Your Email">
                                <span class="text-danger" id="emailErr"></span>
                            </div>
                            <div class="form-group col-12">
                                <input type="tel" name="phone" id="phone" placeholder="Phone number">
                                <span class="text-danger" id="phoneErr"></span>
                            </div>
                            <div class="form-group col-12">
                                <textarea name="message" id="message" cols="30" rows="6" placeholder="Type your message"></textarea>
                            </div>
                            <input type="hidden" name="course_id" value="<?=$course->course_id?>">
                            <div class="form-group col-12 text-center">
                                <!-- <a href="#"><button class="rn-btn edu-btn submit-btn" name="submit" type="submit">Submit Now<i class="icon-4"></i></button></a> -->
                                <a href="javascript:void(0)" class="rn-btn edu-btn submit-btn" id="contact-submit-btn">Submit Now<i class="icon-4"></i></a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(".enrolled").click(function(){
            $("#enrolledModal").modal("show");
        });
        
    </script>