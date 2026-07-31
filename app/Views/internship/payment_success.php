<div class="container-fluid py-0">
    <div class="row g-4">
        <!-- Sidebar -->
        <?= view('internship/sidebar'); ?>
        <div class="col-lg-10">
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

                                        <strong>Name :</strong>
                                        <?= esc($stu_name ?? '') ?>

                                        <br>

                                        <strong>Intern Course:</strong>
                                        <?= esc($intern_course ?? '') ?>

                                        <br><br>

                                        A confirmation email has been sent to your registered email address. 

                                        <br><br>

                                        You can now begin your internship and access course materials, assignments, and other resources from your dashboard.
                                    </p>

                                    <a href="<?= base_url('internship/courses') ?>"
                                        class="btn btn-lg bg-linear text-light px-4">
                                        Go To Internship Courses
                                    </a>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>


        </div>
    </div>
</div>