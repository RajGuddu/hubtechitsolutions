<div class="container-fluid py-0">
    <div class="row g-4">
        <!-- Sidebar -->
        <?= view('internship/sidebar'); ?>
        <div class="col-lg-10">

            <section class="py-4 d-flex align-items-center" style="min-height:70vh; ">

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-8">

                            <div class="card border-0 shadow-lg rounded-4">
                                <div class="card-body text-center p-5">

                                    <div class="loader mx-auto mb-4"></div>

                                    <h2 class="fw-bold mb-3">
                                        Processing Payment...
                                    </h2>

                                    <p class="text-muted mb-4">
                                        Please wait while we verify your payment.<br>
                                        Do not refresh or close this window.
                                    </p>

                                    <form id="razorpay-verify-form2" method="post" action="<?= current_url() ?>">

                                        <?= csrf_field() ?>

                                        <input type="hidden" name="paymentId" value="<?= $paymentId ?? '' ?>">

                                        <input type="hidden" name="orderId" value="<?= $orderId ?? '' ?>">

                                        <input type="hidden" name="application_id" value="<?= $application_id ?? '' ?>">

                                        <input type="hidden" name="te_id" value="<?= $te_id ?? '' ?>">
                                        <input type="hidden" name="amount" value="<?= $amount ?? '' ?>">

                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </div>
</div>

<style>
    .loader {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #FFA500;
        border-radius: 50%;
        width: 70px;
        height: 70px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<script>
    window.addEventListener('load', function () {
        document.getElementById('razorpay-verify-form2').submit();
    });
</script>