
<div class="col-lg-2 col-xl-2">
    <div class="position-sticky" style="top:20px;">
        <!-- Profile Card -->
        <div class="card border-0 shadow-sm overflow-hidden mb-4">
            <!-- Cover -->
            <div class="bg-linear p-4 text-center">
                <?php if(session('image') == NULL){ 
                    $img = 'https://ui-avatars.com/api/?name='.session('stu_name').'&background=80082b&color=fff&size=150';
                }else{
                    $img = base_url(IMAGE_PATH.session('image'));
                } ?>
                <img src="<?= $img ?>"
                    class="rounded-circle border border-4 border-white shadow" width="95">
                <h5 class="text-white mt-2 mb-1">
                    <?=ucwords(strtolower(session('stu_name')))?>
                </h5>
                <small class="text-white-50">
                    Internship Student
                </small>
                <!-- <div class="mt-2">
                    <span class="badge bg-light text-dark px-3">
                        HUBI25061234
                    </span>
                </div> -->
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">
                        <i class="bx bx-envelope"></i> Email
                    </span>
                    <small><?=session('email')?></small>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">
                        <i class="bx bx-phone"></i> Mobile
                    </span>
                    <small><?=session('phone')?></small>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">
                        Status
                    </span>
                    <div class="">
                        <?php echo get_intern_stu_status(session('status')); ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- Menu -->
        <?php $segment2 = service('uri')->getSegment(2); ?>
        <div class="card border-0 shadow-sm">
            <div class="list-group list-group-flush">
                <a href="<?=base_url('internship/dashboard')?>" class="list-group-item list-group-item-action <?=($segment2 == 'dashboard')?'active':''?> py-3">
                    <i class="ri-apps-line me-2"></i>
                    Dashboard
                </a>
                <a href="<?=base_url('internship/profile')?>" class="list-group-item list-group-item-action <?=($segment2 == 'profile')?'active':''?> py-3">
                    <i class="ri-account-circle-line me-2 text-primary"></i>
                    My Profile
                </a>
                <a href="<?=base_url('internship/courses')?>" class="list-group-item list-group-item-action <?=(in_array($segment2, ['courses','update-course','add-course','verify_razor_payment','payment-success']))?'active':''?> py-3">
                    <i class="ri-book-open-line me-2"></i>
                    Internship Course
                </a>
                <a href="<?=base_url('internship/change-password')?>" class="list-group-item list-group-item-action <?=($segment2 == 'change-password')?'active':''?> py-3">
                    <i class="ri-lock-password-line me-2"></i>
                    Change Password
                </a>
                
                <a href="<?=base_url('internship/logout') ?>" onclick="return confirm('Are you sure to logout?')" class="list-group-item list-group-item-action py-3 text-danger">
                    <i class="ri-logout-box-r-line me-2"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>
</div>