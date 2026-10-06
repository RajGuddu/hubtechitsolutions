<div class="container-fluid py-0">
    <div class="row g-4">
        <!-- Sidebar -->
        <?= view('internship/sidebar'); ?>
        <div class="col-lg-10">
            <section class="py-4 d-flex align-items-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-7">
                            <div class="card shadow-sm text-center mt-5">
                                <div class="card-body py-5">
                                    <h3 class="mb-3">
                                        Exam Not Started
                                    </h3>
                                    <p class="text-muted">
                                        Your exam will start after 7 days
                                        of course application.
                                    </p>
                                    <h5 class="mt-4">
                                        Exam will start in
                                    </h5>
                                    <div id="countdown" class="fs-1 fw-bold text-danger mt-3" style="font-family: monospace;">
                                        Loading...
                                    </div>
                                    <div class="mt-4">
                                        <a href="javascript:history.back()" class="btn btn-secondary btn-lg">
                                            <i class="fa-solid fa-arrow-left"></i> Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script>
    const examStart = new Date(
        "<?= $examStart ?>"
    ).getTime();

    const countdown = setInterval(function () {

        const now = new Date().getTime();

        const distance = examStart - now;

        if (distance <= 0) {
            clearInterval(countdown);

            // Page reload → controller dobara check karega
            location.reload();

            return;
        }

        const days = Math.floor(
            distance / (1000 * 60 * 60 * 24)
        );

        const hours = Math.floor(
            (distance % (1000 * 60 * 60 * 24))
            / (1000 * 60 * 60)
        );

        const minutes = Math.floor(
            (distance % (1000 * 60 * 60))
            / (1000 * 60)
        );

        const seconds = Math.floor(
            (distance % (1000 * 60))
            / 1000
        );

        document.getElementById('countdown').innerHTML =
            days + (days === 1 ? " Day " : " Days ") +
            hours + (hours === 1 ? " Hour " : " Hours ") +
            minutes + (minutes === 1 ? " Minute " : " Minutes ") +
            seconds + (seconds === 1 ? " Second" : " Seconds");

    }, 1000);
</script>