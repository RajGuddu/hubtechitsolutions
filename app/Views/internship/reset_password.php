
<section class="register-section py-5">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 col-md-8">
                <div class="card register-card shadow border-0">
                    <!-- Header -->
                    <div class="card-header text-center py-1">
                        <h3 class="mb-2 text-white">
                            Reset Password
                        </h3>
                        <p class="mb-0">
                            Enter your new password below
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
                            <input type="hidden" name="_token" value="<?=$tokenData->token?>">
                            <input type="hidden" name="email" value="<?=$tokenData->email?>">
                            <span class="text-danger">
                                <?= isset($validation) ? display_error($validation, 'email') : '' ?>
                            </span>
                            <span class="text-danger">
                                <?= isset($validation) ? display_error($validation, '_token') : '' ?>
                            </span>
                            
                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label">
                                    New Password
                                </label>
                                <input type="password"
                                       class="form-control"
                                       name="password"
                                       placeholder="Enter Password">
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'password') : '' ?>
                                </span>
                            </div>
                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label class="form-label">
                                    Confirm Password
                                </label>
                                <input type="password"
                                       class="form-control"
                                       name="cpassword"
                                       placeholder="Confirm Password">
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'cpassword') : '' ?>
                                </span>
                            </div>
                            
                            <input type="hidden" name="token" id="token" value="">
                            <!-- Register Button -->
                            <button type="submit"
                                    class="btn register-btn w-100">
                                Reset Password
                            </button>
                        </form>
                        <!-- Login Link -->
                        <div class="text-center mt-4">
                            <p class="mb-0">
                               Back to 
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