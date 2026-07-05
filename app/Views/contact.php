
        <div class="edu-breadcrumb-area breadcrumb-style-2 bg-image bg-image--19">
            <div class="container">
                <div class="breadcrumb-inner">
                    <div class="page-title">
                        <h1 class="title">A Large Range of Course Learning Paths</h1>
                    </div>
                    <ul class="edu-breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                        <li class="separator"><i class="icon-angle-right"></i></li>
                       
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>

        <!--=====================================-->
        <!--=       About Area Start            =-->
        <!--=====================================-->
        <section class="section-gap-equal contact-me-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="contact-me">
                            <div class="inner">
                                <div class="thumbnail">
                                    <div class="thumb">
                                        <img src="<?=base_url('public/assets/images/others/contact-me.jpg')?>" alt="Contact Me">
                                    </div>
                                    <ul class="shape-group">
                                        <li class="shape-1 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                                            <img data-depth="1.4" src="<?=base_url('public/assets/images/about/shape-13.png')?>" alt="Shape" style="transform: translate3d(21.6px, -24px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                                        </li>
                                        <li class="shape-2 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;">
                                            <img data-depth="-1.4" src="<?=base_url('public/assets/images/counterup/shape-02.png')?>" alt="Shape" style="transform: translate3d(-18.5px, 22.6px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;">
                                        </li>
                                        <li class="shape-3">
                                            <img src="<?=base_url('public/assets/images/about/shape-07.png')?>" alt="Shape">
                                        </li>
                                    </ul>
                                </div>
                                <div class="contact-us-info">
                                    <h3 class="heading-title">I will Answer all Your Questions</h3>
                                    <ul class="address-list">
                                        <li>
                                            <h5 class="title">Address</h5>
                                            <p><?=$settings->address?></p>
                                        </li>
                                        <li>
                                            <h5 class="title">Email</h5>
                                            <p><a href="mailto:<?=$settings->email?>"><?=$settings->email?></a></p>
                                        </li>
                                        <li>
                                            <h5 class="title">Phone</h5>
                                            <p><a href="tel:<?=$settings->phone?>"><?=$settings->phone?></a></p>
                                        </li>
                                    </ul>
                                    <ul class="social-share">
                                        <li><a href="<?=$settings->instagram_link?>"><i class="icon-instagram"></i></a></li>
                                        <li><a href="<?=$settings->facebook_link?>"><i class="icon-facebook"></i></a></li>
                                        <li><a href="<?=$settings->twitter_link?>"><i class="icon-twitter"></i></a></li>
                                        <li><a href="<?=$settings->linkedin_link?>"><i class="icon-linkedin2"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================-->
        <!--=       Brand Area Start            =-->
        <section class="edu-section-gap contact-form-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="contact-form">
                            <div class="section-title section-center">
                                <h3 class="title">Just Drop Me a Line</h3>
                            </div>
                            <form action="<?=base_url('home/save_contact_us')?>" method="post" class="rnt-contact-form" id="contact_us_form">
                                <?= csrf_field() ?>
                                <div class="row row--10">
                                    <div class="form-group col-lg-6">
                                        <input type="text" name="name" id="contactname" placeholder="Your Name">
                                        <span class="text-danger" id="nameErr"></span>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <input type="email" name="email" id="contactemail" placeholder="Your Email">
                                        <span class="text-danger" id="emailErr"></span>
                                    </div>
                                    <div class="form-group col-12">
                                        <input type="tel" name="phone" id="contactphone" placeholder="Phone number">
                                        <span class="text-danger" id="phoneErr"></span>
                                    </div>
                                    <div class="form-group col-12">
                                        <textarea name="message" id="contactmessage" cols="30" rows="6" placeholder="Type your message"></textarea>
                                    </div>
                                    <div class="form-group col-12 text-center">
                                        <!-- <a href="javascript:void(0);" id="contact-submit-btn"><button class="rn-btn edu-btn submit-btn" name="submit" type="submit">Submit Now<i class="icon-4" ></i></button></a> -->
                                        <a href="javascript:void(0);" id="contact-submit-btn" class="rn-btn edu-btn submit-btn" >Submit Now<i class="icon-4" ></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="shape-group">
                <li class="shape-1 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;"><img data-depth="-2" src="<?=base_url('public/assets/images/about/shape-15.png')?>" alt="shape" style="transform: translate3d(-16.3px, 6.8px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;"></li>
                <li class="shape-2 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;"><img data-depth="2" src="<?=base_url('public/assets/images/cta/shape-04.png')?>" alt="shape" style="transform: translate3d(17.1px, -18.5px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;"></li>
                <li class="shape-3 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;"><span data-depth="1" style="transform: translate3d(38.3px, -41.6px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;"></span></li>
                <li class="shape-4 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;"><img data-depth="-2" src="<?=base_url('public/assets/images/about/shape-13.png')?>" alt="shape" style="transform: translate3d(-30px, 32.5px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;"></li>
            </ul>
        </section>
        <!-- Start Footer Area  -->
        
  		