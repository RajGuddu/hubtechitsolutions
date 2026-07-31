<div class="container-fluid py-0">
    <div class="row g-4">
        <!-- Sidebar -->
        <?= view('internship/sidebar'); ?>
        <!-- Right Content -->
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-linear py-3 d-flex justify-content-between align-items-center">
                    <h4 class="text-white mb-0">
                        Change Password
                    </h4>
                </div>
                <?php if(session()->getFlashdata('message') !== NULL){
                    echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
                } ?>
                <div class="card-body">
                    <form action="<?=current_url()?>" class="internship-form" method="post"
                        enctype="multipart/form-data">
                        <?=csrf_field()?>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">New Password<span class="text-danger">*</span></label>

                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control"
                                            value="<?= set_value('password') ?>">

                                        <span class="input-group-text toggle-password" data-target="password"
                                            style="cursor:pointer;">
                                            <i class="ri-eye-line"></i>
                                        </span>
                                    </div>
                                    <span class="text-danger">
                                        <?= isset($validation) ? display_error($validation, 'password') : '' ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Confirm Password<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="cpassword" id="cpassword" class="form-control"
                                            value="<?= set_value('cpassword') ?>">

                                        <span class="input-group-text toggle-password" data-target="cpassword"
                                            style="cursor:pointer;">
                                            <i class="ri-eye-line"></i>
                                        </span>
                                    </div>
                                    <span class="text-danger">
                                        <?= isset($validation) ? display_error($validation, 'cpassword') : '' ?>
                                    </span>
                                </div>
                                <div class="text-end mt-5">

                                    <button type="submit" class="btn text-white px-4" style="background:#0c2778;">
                                        <i class="bx bx-save me-1"></i>
                                        Save Changes

                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    $(document).on("click", ".toggle-password", function () {
        let target = $("#" + $(this).data("target"));
        let icon = $(this).find("i");

        if (target.attr("type") === "password") {
            target.attr("type", "text");
            icon.removeClass("ri-eye-line").addClass("ri-eye-off-line");
        } else {
            target.attr("type", "password");
            icon.removeClass("ri-eye-off-line").addClass("ri-eye-line");
        }
    });
</script>