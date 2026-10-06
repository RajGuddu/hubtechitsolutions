
<section class="register-section py-5">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 col-md-8">
                <div class="card register-card shadow border-0">
                    <!-- Header -->
                    <div class="card-header text-center py-1">
                        <h3 class="mb-2 text-white">
                            Forgot Password
                        </h3>
                        <p class="mb-0">
                            Enter your email to receive reset link
                        </p>
                    </div>
                    <!-- Body -->
                    <div class="card-body p-4">
                        <?php if(session()->getFlashdata('alert_error') !== NULL){ ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('alert_error'); ?>
                            </div>
                        <?php } ?>
                        <?php if(session()->getFlashdata('alert_success') !== NULL){ ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('alert_success'); ?>
                            </div>
                        <?php } ?>
                        <form action="<?= current_url() ?>" method="post">
                            <?= csrf_field() ?>
                            
                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">
                                    Email
                                </label>
                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       value="<?= set_value('email') ?>"
                                       placeholder="Enter your registered email">
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'email') : '' ?>
                                </span>
                            </div>
                            
                            <input type="hidden" name="token" id="token" value="">
                            <!-- Register Button -->
                            <button type="submit"
                                    class="btn register-btn w-100">
                                Send Reset Link
                            </button>
                        </form>
                        <!-- Login Link -->
                        <div class="text-center mt-4">
                            <p class="mb-0">
                                Remembered your password?
                                <a href="<?= base_url('internship/login') ?>"
                                   class="fw-bold">
                                    Login
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://www.google.com/recaptcha/api.js?render=<?=$siteKey?>"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('<?=$siteKey?>', {action: 'submit'}).then(function(token) {
            var response = document.getElementById("token");
            response.value = token;
        });
    });
</script>