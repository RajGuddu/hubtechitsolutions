<style>
    .login-section{
    background:#f8f9fc;
    min-height:80vh;
    display:flex;
    align-items:center;
}

.login-card{
    border-radius:15px;
    overflow:hidden;
}

.login-card .card-header{
    background:#80082b;
    color:#fff;
}

.login-card .card-header p{
    color:rgba(255,255,255,.85);
}

.login-card .form-control{
    height:55px;
    border:1px solid #ced4da;
    border-radius:8px;
    background:#fff;
    box-shadow:none;
}

.form-control:focus{
    border-color:#80082b;
    box-shadow:0 0 0 .15rem rgba(128,8,43,.2);
}

.login-btn{
    background:#0c2778;
    color:#fff;
    height:52px;
    font-weight:600;
    border-radius:8px;
    font-size:18px;
    font-weight:600;
    letter-spacing:.5px;
    transition:.3s;
}

.login-btn:hover{
    background:#80082b;
    color:#fff;
}

a{
    color:#0c2778;
    text-decoration:none;
}

a:hover{
    color:#80082b;
}


.login-card .text-center a{
    color:#0c2778;
    text-decoration:none;
    transition:.3s;
}

.login-card .text-center a:hover{
    color:#80082b;
}
</style>
<section class="login-section py-5">
    <div class="container">
        <div class="row justify-content-center align-items-center">

            <div class="col-lg-5 col-md-7">

                <div class="card login-card shadow border-0">

                    <div class="card-header text-center py-4">
                        <h2 class="mb-2 text-white">Internship Student Login</h2>
                        <p class="mb-0">
                            Sign in to access your internship dashboard.
                        </p>
                    </div>

                    <div class="card-body p-4">
                        <?php if(session()->getFlashdata('alert_error') !== NULL){ ?>
                            <div class="alert alert-danger">
                                <?php echo session()->getFlashdata('alert_error'); ?>
                            </div>
                        <?php } ?>

                        <form action="<?=current_url()?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?=set_value('email')?>" placeholder="Enter Email">
                                <span class="text-danger" id=""><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" id="password" value="<?=set_value('password')?>" class="form-control" placeholder="Enter Password">
                                <span class="text-danger" id=""><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
                            </div>

                            <!-- <div class="d-flex justify-content-between align-items-center mb-4">

                                <a href="#">
                                    Forgot Password?
                                </a>

                            </div> -->

                            <button type="submit" class="btn login-btn w-100"> Login </button>

                        </form>
                        <!-- <div class="text-center mt-4">
                            <p class="mb-0">
                                Don't have an account?
                                <a href="" class="fw-bold">
                                    Register Now
                                </a>
                            </p>
                        </div> -->

                    </div>

                </div>

            </div>

        </div>
    </div>
</section>