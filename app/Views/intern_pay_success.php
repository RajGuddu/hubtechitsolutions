<section class="py-4 min-vh-100 d-flex align-items-center">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">

                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body text-center p-5">

                        <div class="display-4 text-warning mb-3">
                            ✅
                        </div>

                        <h2 class="fw-bold mb-3">
                            Payment Successful!
                        </h2>

                        <p class="text-muted mb-4">
                            Thank you! Your payment has been completed successfully.
                            <br><br>

                            <strong>Application ID:</strong>
                            <?= esc($application_id ?? '') ?>

                            <br>

                            <strong>Username:</strong>
                            <?= esc($username ?? '') ?>

                            <br>

                            <strong>Password:</strong>
                            <?= esc($password ?? '') ?>

                            <br><br>

                            A confirmation email has been sent to your registered email address. Please keep your account information safe for future reference.

                            <br><br>

                            You may now log in to your account to access the services and features available to you.
                        </p>

                        <a href="<?= base_url('internship/login') ?>"
                            class="btn btn-lg bg-linear text-light px-4">
                            Login to Your Account
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>

</section>