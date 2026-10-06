<section class="register-section py-5">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 col-md-8">
                <div class="card register-card shadow border-0">
                    <!-- Header -->
                    <div class="card-header text-center py-4">
                        <h2 class="mb-2 text-white">
                            Student Registration
                        </h2>
                        <p class="mb-0">
                            Create your account to access courses and learning resources.
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
                            <!-- Name -->
                            <div class="mb-3">
                                <label class="form-label">
                                    Full Name
                                </label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       value="<?= set_value('name') ?>"
                                       placeholder="Enter Full Name">
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'name') : '' ?>
                                </span>
                            </div>
                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">
                                    Email
                                </label>
                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       value="<?= set_value('email') ?>"
                                       placeholder="Enter Email">
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'email') : '' ?>
                                </span>
                            </div>
                            <!-- Mobile -->
                            <div class="mb-3">
                                <label class="form-label">
                                    Mobile Number
                                </label>
                                <input type="text"
                                       class="form-control"
                                       name="phone"
                                       value="<?= set_value('phone') ?>"
                                       placeholder="Enter Mobile Number">
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'phone') : '' ?>
                                </span>
                            </div>
                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label">
                                    Password
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
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        name="terms"
                                        id="terms"
                                        value="1"
                                        <?= set_checkbox('terms', '1') ?>>
                                    <label class="form-check-label" for="terms">
                                        I agree to the
                                        <a href="<?= base_url('terms-and-conditions') ?>"
                                        target="_blank">
                                            Terms & Conditions
                                        </a>
                                        and
                                        <a href="<?= base_url('privacy-policy') ?>"
                                        target="_blank">
                                            Privacy Policy
                                        </a>.
                                    </label>
                                </div>
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'terms') : '' ?>
                                </span>
                            </div>
                            <input type="hidden" name="token" id="token" value="">
                            <!-- Register Button -->
                            <button type="submit"
                                    class="btn register-btn w-100">
                                Create Account
                            </button>
                        </form>
                        <!-- Login Link -->
                        <div class="text-center mt-4">
                            <p class="mb-0">
                                Already have an account?
                                <a href="<?= base_url('internship/login') ?>"
                                   class="fw-bold">
                                    Login Now
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