<div class="container-fluid py-0">
    <div class="row g-4">
        <!-- Sidebar -->
        <?= view('internship/sidebar'); ?>
        <?php if($profile->profile_completed){  ?>
        <!-- Right Content -->
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-linear py-3">
                    <h4 class="text-white mb-0">
                        <i class="bx bx-user-circle me-2"></i>
                        My Profile
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Profile Top -->
                    <div class="row align-items-center mb-5">
                        <div class="col-md-2 text-center">
                            <?php if($profile->image == NULL){ 
                                $img = 'https://ui-avatars.com/api/?name='.$profile->stu_name.'&background=80082b&color=fff&size=150';
                            }else{
                                $img = base_url(IMAGE_PATH.$profile->image);
                            } ?>
                            <img src="<?=$img?>"
                                class="rounded-circle img-thumbnail" width="120">
                        </div>
                        <div class="col-md-8">
                            <h3 class="mb-1">
                                <?=ucwords($profile->stu_name)?>
                            </h3>
                            <p class="text-muted mb-2">
                                Internship Student
                            </p>
                            <?php echo get_intern_stu_status($profile->status); ?>
                            <!-- <span class="badge ms-2 text-bg-light">
                                HUBI25061234
                            </span> -->
                        </div>
                        <?php /*<div class="col-md-2 text-end mt-5">
                            <a href="<?= base_url('internship/edit_profile/'.$profile->ie_id) ?>" class="edu-btn btn-medium px-4 text-white"
                                onclick="return confirm('Are You Sure?')">
                                Edit Profile
                            </a>
                        </div>*/ ?>
                    </div>
                    <hr>
                    <?php if(session()->getFlashdata('message') !== NULL){
                        echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
                    } ?>
                    <!-- Personal Information -->
                    <h5 class="mb-3">
                        Personal Information
                    </h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                Full Name
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                                <?= ucwords($profile->stu_name) ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                Email
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                                <?= $profile->email ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                Mobile No
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                               <?= $profile->phone ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                Date of Birth
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                                <?= ($profile->dob != NULL)?date('d-M-Y',strtotime($profile->dob)):'N/A' ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                Gender
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                                <?= match($profile->genger) {
                                    'M' => 'Male',
                                    'F' => 'Female',
                                    'O' => 'Other',
                                    default => '-'
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                Aadhar No
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                                <?= ($profile->aadhar != NULL)?$profile->aadhar:'N/A' ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                Father's Name
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                                <?= ($profile->f_name != NULL)?$profile->f_name:'N/A' ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                Mother's Name
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                                <?= ($profile->m_name != NULL)?$profile->m_name:'N/A' ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- Academic -->
                    <h5 class="mb-3">
                        Address Details
                    </h5>
                    <?php $fullAddress = json_decode($profile->full_address??''); ?>
                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                Address
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                                <?= $fullAddress->add ?? 'N/A'; ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                State
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                                <?= $fullAddress->state ?? 'N/A'; ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                District
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                                <?= $fullAddress->dist ?? 'N/A'; ?>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                Pincode
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                                <?= $fullAddress->pincode ?? 'N/A'; ?>
                            </div>
                        </div>
                        
                    </div>
                    <hr>
                    <!-- Internship -->
                    <h5 class="mb-3">
                        Academic Information
                    </h5>
                    <?php $academic = json_decode($profile->academic ?? ''); ?>
                    <div class="row g-3 mb-3">
                        <!-- 10th -->
                        <div class="col-md-3">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                Qualification(10th)
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                                Matric (10th)
                            </div>
                        </div>
                        <div class="col-md-3">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                Board
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                                <?= $academic->board1 ?? 'N/A'; ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                Year of Passing
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                                <?= $academic->passyear1 ?? 'N/A'; ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                Percentage / CGPA
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                                <?= $academic->percentage1 ?? 'N/A'; ?>
                            </div>
                        </div>
                        <!-- 12th -->
                        <div class="col-md-3">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                Qualification(12th)
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                                Inter (12th)
                            </div>
                        </div>
                        <div class="col-md-3">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                Board
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                                <?= $academic->board2 ?? 'N/A'; ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                Year of Passing
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                                <?= $academic->passyear2 ?? 'N/A'; ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <small class="text-secondary d-block mb-1 fw-semibold text-uppercase">
                                Percentage / CGPA
                            </small>
                            <div class="fs-5 fw-bold text-dark">
                                <?= $academic->percentage2 ?? 'N/A'; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php } else {
            echo view('internship/edit_profile'); 
        } ?>
    </div>
</div>