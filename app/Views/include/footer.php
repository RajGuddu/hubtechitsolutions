        <?php 
         $common_model = model('App\Models\Common_model', false);
         $settings = $common_model->get_setting(1);
        ?>
            
        <!-- Mobile Sticky Buttons -->
        <div class="mobile-action-bar d-md-none">
            <a href="<?= base_url('enroll-internship') ?>" class="apply-btn">
                Apply Internship
            </a>

            <a href="<?= base_url('student-login') ?>" class="login-btn">
                Login
            </a>
        </div>


        <footer class="edu-footer footer-dark bg-image footer-style-2">
            <div class="footer-top footer-top-2">
                <div class="container">
                    <div class="row g-5">
                        <div class="col-lg-4 col-md-6">
                            <div class="edu-footer-widget">
                                <div class="logo">
                                    <a href="<?=base_url()?>">
                                        <img class="logo-light" src="<?=base_url('public/assets/images/logo/logo-dark.png')?>" alt="Corporate Logo">
                                    </a>
                                </div>
                                <p class="description">Lorem ipsum dolor amet consecto adi pisicing elit sed eiusm tempor incidid unt labore dolore.</p>
                                <div class="widget-information">
                                    <ul class="information-list">
                                        <li><span>Address:</span><?=$settings->address?></li>
                                        <li><span>Call:</span><a href="tel:+91 <?=$settings->phone?>">+91 <?=$settings->phone?></a></li>
                                        <li><span>Email:</span><a href="mailto:<?=$settings->email?>" target="_blank"><?=$settings->email?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="edu-footer-widget explore-widget">
                                <h4 class="widget-title">Important Links</h4>
                                <div class="inner">
                                    <ul class="footer-link link-hover">
                                        <li><a href="<?=base_url('about-us')?>">About</a></li>
                                        <li><a href="<?=base_url('courses')?>">Courses</a></li>
                                        <li><a href="team-one.html">Instructor</a></li>
                                        <li><a href="event-grid.html">Blog</a></li>
                                        <li><a href="<?=base_url('contact-us')?>">Contact</a></li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-lg-4 col-md-6">
                            <div class="edu-footer-widget">
                                <h4 class="widget-title">Contacts</h4>
                                <div class="inner">
                                    <p class="description">Enter your email Address to register to our newsletter subscription</p>
                                    <div class="input-group footer-subscription-form">
                                        <input type="email" class="form-control" placeholder="Your email">
                                        <button class="edu-btn btn-medium" type="button">Subscribe <i class="icon-4"></i></button>
                                    </div>
                                    <ul class="social-share icon-transparent">
                                        <li><a href="<?=$settings->facebook_link?>" class="color-fb"><i class="icon-facebook"></i></a></li>
                                        <li><a href="<?=$settings->linkedin_link?>" class="color-linkd"><i class="icon-linkedin2"></i></a></li>
                                        <li><a href="<?=$settings->instagram_link?>" class="color-ig"><i class="icon-instagram"></i></a></li>
                                        <li><a href="<?=$settings->twitter_link?>" class="color-twitter"><i class="icon-twitter"></i></a></li>
                                        <li><a href="<?=$settings->youtube_link?>" class="color-yt"><i class="icon-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="inner text-center">
                                <p>Copyright <?=date('Y')?> <a href="https://1.envato.market/5bQ022" target="_blank">ht solutions</a> All Rights Reserved</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div>
    <div class="rn-progress-parent">
        <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

    <?php 
    $swal_session = array();
    $swalflag = 0;
    if(session()->has('swal_session')){
        $swal_session = session('swal_session');
        $swalflag = 1;
        unset($_SESSION['swal_session']);
    }?>

    <!-- JS
	============================================ -->
    
    <script src="<?=base_url('public/assets/js/vendor/bootstrap.min.js') ?>"></script>
    <script src="<?=base_url('public/assets/js/vendor/sal.min.js') ?>"></script>
    <script src="<?=base_url('public/assets/js/vendor/backtotop.min.js') ?>"></script>
    <script src="<?=base_url('public/assets/js/vendor/magnifypopup.min.js') ?>"></script>
    <script src="<?=base_url('public/assets/js/vendor/jquery.countdown.min.js') ?>"></script>
    <script src="<?=base_url('public/assets/js/vendor/odometer.min.js') ?>"></script>
    <script src="<?=base_url('public/assets/js/vendor/isotop.min.js') ?>"></script>
    <script src="<?=base_url('public/assets/js/vendor/imageloaded.min.js') ?>"></script>
    <script src="<?=base_url('public/assets/js/vendor/lightbox.min.js') ?>"></script>
    <script src="<?=base_url('public/assets/js/vendor/paralax.min.js') ?>"></script>
    <script src="<?=base_url('public/assets/js/vendor/paralax-scroll.min.js') ?>"></script>
    <script src="<?=base_url('public/assets/js/vendor/jquery-ui.min.js') ?>"></script>
    <script src="<?=base_url('public/assets/js/vendor/swiper-bundle.min.js') ?>"></script>
    <script src="<?=base_url('public/assets/js/vendor/svg-inject.min.js') ?>"></script>
    <script src="<?=base_url('public/assets/js/vendor/vivus.min.js') ?>"></script>
    <script src="<?=base_url('public/assets/js/vendor/tipped.min.js') ?>"></script>
    <script src="<?=base_url('public/assets/js/vendor/smooth-scroll.min.js') ?>"></script>
    <script src="<?=base_url('public/assets/js/vendor/isInViewport.jquery.min.js') ?>"></script>

    <!-- Site Scripts -->
    <script src="<?=base_url('public/assets/js/app.js') ?>"></script>
    <script src="<?=base_url('public/assets/js/sweetalert.min.js')?>"></script>
    <script>
        var swalflag = '<?=$swalflag?>';
        $(document).ready(function(){
            if(swalflag == '1'){
                swal({
                    title: "<?=(!empty($swal_session))?$swal_session['title']:''?>",
                    text: "<?=(!empty($swal_session))?$swal_session['text']:''?>",
                    icon: "success",
                    button: "Close",
                });
                $(".swal-text, .swal-footer").addClass('text-center');
                $(".swal-button--confirm").addClass('btn-success');
            }
        });

        $('#contact-submit-btn').click(function(){
            $('#nameErr').html('');
            $('#emailErr').html('');
            $('#phoneErr').html('');
            var frm = $('#contact_us_form');
            var formData = new FormData(frm[0]);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('home/save_contact_us') ?>",
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                cache: 'false',
                success: function(res){
                    console.log(res);
                    if(res.error != undefined){
                        if(res.error.name != undefined && res.error.name != ''){
                            $('#nameErr').html(res.error.name);
                        }
                        if(res.error.email != undefined && res.error.email != ''){
                            $('#emailErr').html(res.error.email);
                        }
                        if(res.error.phone != undefined && res.error.phone != ''){
                            $('#phoneErr').html(res.error.phone);
                        }
                    }else{
                        if(res.msg == 'success'){
                            window.location.reload();
                        }else if(res.err == 'fail'){
                            alert('Something went wrong. Please try again!');
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>