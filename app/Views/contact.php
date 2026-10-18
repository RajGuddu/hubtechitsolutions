
    <div class="edu-breadcrumb-area breadcrumb-style-2 ">
        <img src="<?= base_url('public/assets/images/bg/bg-image-19.webp') ?>" class="breadcrumb-bg" alt="">
        <div class="container breadcrumb-content">
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
<!--=          Contact Area Start       =-->
<!--=====================================-->
<section class="edu-section-gap contact-modern-area">
    <div class="container">
        <div class="row align-items-stretch g-4">
            <!--=====================================-->
            <!--=       Contact Information         =-->
            <!--=====================================-->
            <div class="col-lg-5">
                <div class="contact-modern-info">
                    <div class="contact-modern-heading">
                        <span class="contact-pre-title">CONTACT US</span>
                        <h2>
                            Let's Start a
                            <span>Conversation</span>
                        </h2>
                        <p>
                            Have a question about our courses or services?
                            Feel free to reach out to us. Our team will be
                            happy to assist you.
                        </p>
                    </div>
                    <!-- Address -->
                    <div class="contact-modern-item">
                        <div class="contact-modern-icon">
                            <i class="icon-16"></i>
                        </div>
                        <div class="contact-modern-content">
                            <h5>Our Address</h5>
                            <p><?=$settings->address?></p>
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="contact-modern-item">
                        <div class="contact-modern-icon">
                            <i class="icon-envelope"></i>
                        </div>
                        <div class="contact-modern-content">
                            <h5>Email Address</h5>
                            <a href="mailto:<?=$settings->email?>">
                                <?=$settings->email?>
                            </a>
                        </div>
                    </div>
                    <!-- Phone -->
                    <div class="contact-modern-item">
                        <div class="contact-modern-icon">
                            <i class="icon-17"></i>
                        </div>
                        <div class="contact-modern-content">
                            <h5>Phone Number</h5>
                            <a href="tel:<?=$settings->phone?>">
                                <?=$settings->phone?>
                            </a>
                        </div>
                    </div>
                    <!-- Social Media -->
                    <div class="contact-modern-social">
                        <h5>Follow Us</h5>
                        <div class="contact-social-list">
                            <a href="<?=$settings->instagram_link?>"
                               target="_blank"
                               aria-label="Instagram">
                                <i class="icon-instagram"></i>
                            </a>
                            <a href="<?=$settings->facebook_link?>"
                               target="_blank"
                               aria-label="Facebook">
                                <i class="icon-facebook"></i>
                            </a>
                            <a href="<?=$settings->twitter_link?>"
                               target="_blank"
                               aria-label="Twitter">
                                <i class="icon-twitter"></i>
                            </a>
                            <a href="<?=$settings->linkedin_link?>"
                               target="_blank"
                               aria-label="LinkedIn">
                                <i class="icon-linkedin2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--=====================================-->
            <!--=             Contact Form          =-->
            <!--=====================================-->
            <div class="col-lg-7">
                <div class="contact-modern-form">
                    <div class="contact-form-header">
                        <span>GET IN TOUCH</span>
                        <h3>Send Us a Message</h3>
                        <p>
                            Fill in the details below and our team will
                            get back to you as soon as possible.
                        </p>
                    </div>
                    <form action="<?=base_url('home/save_contact_us')?>"
                          method="post"
                          class="rnt-contact-form"
                          id="contact_us_form">
                        <?= csrf_field() ?>
                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6">
                                <div class="contact-form-group">
                                    <label for="contactname">
                                        Your Name
                                    </label>
                                    <input type="text"
                                           name="name"
                                           id="contactname"
                                           placeholder="Enter your name">
                                    <span class="contact-error"
                                          id="nameErr"></span>
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="contact-form-group">
                                    <label for="contactemail">
                                        Email Address
                                    </label>
                                    <input type="email"
                                           name="email"
                                           id="contactemail"
                                           placeholder="Enter your email">
                                    <span class="contact-error"
                                          id="emailErr"></span>
                                </div>
                            </div>
                            <!-- Phone -->
                            <div class="col-md-6">
                                <div class="contact-form-group">
                                    <label for="contactphone">
                                        Phone Number
                                    </label>
                                    <input type="text"
                                           name="phone"
                                           id="contactphone"
                                           placeholder="Enter your phone number">
                                    <span class="contact-error"
                                          id="phoneErr"></span>
                                </div>
                            </div>
                            <!-- Subject -->
                            <div class="col-md-6">
                                <div class="contact-form-group">
                                    <label for="contactsubject">
                                        Subject
                                    </label>
                                    <input type="text"
                                           name="subject"
                                           id="contactsubject"
                                           placeholder="Enter subject">
                                </div>
                            </div>
                            <!-- Message -->
                            <div class="col-12">
                                <div class="contact-form-group">
                                    <label for="contactmessage">
                                        Your Message
                                    </label>
                                    <textarea name="message"
                                              id="contactmessage"
                                              placeholder="Write your message here..."></textarea>
                                </div>
                            </div>
                            <!-- Submit -->
                            <div class="col-12">
                                <div class="contact-submit-wrap">
                                    <a href="javascript:void(0);"
                                       id="contact-submit-btn"
                                       class="edu-btn contact-submit-btn">
                                        Send Message
                                        <i class="icon-4"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
/* =========================================================
   Contact Page
   Theme Colors
========================================================= */
.contact-modern-area {
    background: #f7f7f7;
    position: relative;
}
/* =========================================================
   Left Contact Information
========================================================= */
.contact-modern-info {
    height: 100%;
    background: #fff;
    border-radius: 16px;
    padding: 42px 38px;
    position: relative;
    overflow: hidden;
    border: 1px solid #eeeeee;
    box-shadow: 0 12px 35px rgba(12, 39, 120, 0.07);
}
.contact-modern-info::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: #0c2778;
}
.contact-modern-info::after {
    content: "";
    position: absolute;
    bottom: -55px;
    right: -55px;
    width: 140px;
    height: 140px;
    border-radius: 50%;
    background: rgba(128, 8, 43, 0.05);
}
/* Heading */
.contact-pre-title {
    display: inline-block;
    color: #80082b;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 1.5px;
    margin-bottom: 10px;
}
.contact-modern-heading h2 {
    color: #0c2778;
    font-size: 34px;
    line-height: 1.25;
    font-weight: 700;
    margin-bottom: 16px;
}
.contact-modern-heading h2 span {
    color: #80082b;
}
.contact-modern-heading p {
    color: #666;
    font-size: 15px;
    line-height: 1.8;
    margin-bottom: 32px;
}
/* =========================================================
   Contact Items
========================================================= */
.contact-modern-item {
    display: flex;
    align-items: flex-start;
    gap: 17px;
    padding: 17px 0;
    border-bottom: 1px solid #eeeeee;
    position: relative;
    z-index: 2;
}
.contact-modern-item:last-of-type {
    border-bottom: 0;
}
.contact-modern-icon {
    flex: 0 0 48px;
    width: 48px;
    height: 48px;
    border-radius: 10px;
    background: rgba(12, 39, 120, 0.08);
    color: #0c2778;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
    transition: all 0.3s ease;
}
.contact-modern-item:hover .contact-modern-icon {
    background: #0c2778;
    color: #fff;
    transform: translateY(-2px);
}
.contact-modern-content {
    min-width: 0;
}
.contact-modern-content h5 {
    color: #0c2778;
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 5px;
}
.contact-modern-content p,
.contact-modern-content a {
    color: #666;
    font-size: 14px;
    line-height: 1.7;
    margin-bottom: 0;
    word-break: break-word;
}
.contact-modern-content a:hover {
    color: #80082b;
}
/* =========================================================
   Social Media
========================================================= */
.contact-modern-social {
    position: relative;
    z-index: 2;
    margin-top: 25px;
}
.contact-modern-social h5 {
    color: #0c2778;
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 13px;
}
.contact-social-list {
    display: flex;
    gap: 9px;
}
.contact-social-list a {
    width: 39px;
    height: 39px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background: #f7f7f7;
    color: #0c2778;
    border: 1px solid #e8e8e8;
    transition: all 0.3s ease;
}
.contact-social-list a:hover {
    background: #80082b;
    color: #fff;
    border-color: #80082b;
    transform: translateY(-3px);
}
/* =========================================================
   Contact Form Card
========================================================= */
.contact-modern-form {
    height: 100%;
    background: #fff;
    border-radius: 16px;
    padding: 42px 42px;
    border: 1px solid #eeeeee;
    box-shadow: 0 12px 35px rgba(12, 39, 120, 0.07);
    position: relative;
    overflow: hidden;
}
.contact-modern-form::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 155px;
    height: 5px;
    background: #80082b;
}
/* Form Header */
.contact-form-header {
    margin-bottom: 27px;
}
.contact-form-header > span {
    display: inline-block;
    color: #80082b;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1.4px;
    margin-bottom: 7px;
}
.contact-form-header h3 {
    color: #0c2778;
    font-size: 27px;
    font-weight: 700;
    margin-bottom: 8px;
}
.contact-form-header p {
    color: #777;
    font-size: 14px;
    line-height: 1.7;
    margin-bottom: 0;
}
/* =========================================================
   Form Fields
========================================================= */
.contact-form-group {
    margin-bottom: 20px;
}
.contact-form-group label {
    display: block;
    color: #0c2778;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
}
.contact-form-group input,
.contact-form-group textarea {
    width: 100%;
    border: 1px solid #e1e1e1;
    background: #fdfdfd;
    border-radius: 8px;
    padding: 13px 15px;
    color: #333;
    font-size: 14px;
    outline: none;
    transition: all 0.3s ease;
}
.contact-form-group input {
    height: 50px;
}
.contact-form-group textarea {
    min-height: 135px;
    resize: vertical;
}
.contact-form-group input::placeholder,
.contact-form-group textarea::placeholder {
    color: #aaa;
}
.contact-form-group input:focus,
.contact-form-group textarea:focus {
    background: #fff;
    border-color: #0c2778;
    box-shadow: 0 0 0 3px rgba(12, 39, 120, 0.07);
}
/* =========================================================
   Validation Error
========================================================= */
.contact-error {
    display: block;
    color: #80082b;
    font-size: 12px;
    margin-top: 5px;
}
/* =========================================================
   Submit Button
========================================================= */
.contact-submit-wrap {
    margin-top: 3px;
}
.contact-submit-btn {
    display: inline-flex !important;
    align-items: center;
    justify-content: center;
    gap: 10px;
    min-width: 175px;
    background: #0c2778 !important;
    color: #fff !important;
    border: 1px solid #0c2778;
    border-radius: 7px;
    padding: 14px 24px;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s ease;
}
.contact-submit-btn:hover {
    background: #80082b !important;
    border-color: #80082b;
    color: #fff !important;
    transform: translateY(-2px);
    box-shadow: 0 7px 18px rgba(128, 8, 43, 0.20);
}
.contact-submit-btn i {
    transition: transform 0.3s ease;
}
.contact-submit-btn:hover i {
    transform: translateX(4px);
}
/* =========================================================
   Responsive
========================================================= */
@media (max-width: 991px) {
    .contact-modern-info,
    .contact-modern-form {
        padding: 35px 30px;
    }
    .contact-modern-heading h2 {
        font-size: 30px;
    }
}
@media (max-width: 767px) {
    .contact-modern-area {
        padding-top: 55px;
        padding-bottom: 55px;
    }
    .contact-modern-info,
    .contact-modern-form {
        padding: 30px 22px;
        border-radius: 12px;
    }
    .contact-modern-heading h2 {
        font-size: 27px;
    }
    .contact-modern-heading p {
        font-size: 14px;
    }
    .contact-form-header h3 {
        font-size: 24px;
    }
    .contact-modern-item {
        gap: 13px;
    }
    .contact-modern-icon {
        flex: 0 0 44px;
        width: 44px;
        height: 44px;
    }
    .contact-submit-btn {
        width: 100%;
    }
}
@media (max-width: 575px) {
    .contact-modern-info,
    .contact-modern-form {
        padding: 27px 18px;
    }
    .contact-modern-heading h2 {
        font-size: 25px;
    }
    .contact-form-group {
        margin-bottom: 16px;
    }
}
</style>