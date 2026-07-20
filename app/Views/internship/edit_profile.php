

    <!-- Right Content -->
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-linear py-3 d-flex justify-content-between align-items-center">
                <h4 class="text-white mb-0">
                    <i class="bx bx-edit-alt me-2"></i>
                    Edit Profile
                </h4>
                <?php echo get_intern_stu_status($profile->status); ?>
            </div>
            <div class="card-body">
                <form action="<?=current_url()?>" class="internship-form" method="post" enctype="multipart/form-data">
                    <?=csrf_field()?>
                    <!-- Profile Image -->
                    <div class="mb-5 text-center">
                        <p class="text-danger fw-bold fs-3 mb-0">
                            <i class="ri-error-warning-fill fs-2 me-2 align-middle"></i>
                            Please complete your profile first to gain full access to all internship features and services.
                        </p>
                    </div>
                    <h5 class="mb-3">Personal Information</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name<span class="text-danger">*</span></label>
                            <input type="text" name="stu_name" class="form-control" value="<?=set_value('stu_name', $profile->stu_name) ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'stu_name') : '' ?></span>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email<span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="<?=set_value('email', $profile->email) ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Photo<span class="text-danger">*</span></label>
                            <input type="file" name="image" class="form-control">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'image') : '' ?></span>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mobile Number<span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" value="<?=set_value('phone', $profile->phone) ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'phone') : '' ?></span>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date of Birth<span class="text-danger">*</span></label>
                            <input type="date" name="dob" class="form-control" value="<?=set_value('dob', ($profile->dob != NULL)?date('Y-m-d',strtotime($profile->dob)):'') ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'dob') : '' ?></span>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Gender<span class="text-danger">*</span></label>
                            <select class="form-select" name="gender">
                                <?php $gender = $profile->genger; ?>
                                <option value="M" <?=($gender == 'M')?'selected':'' ?>>Male</option>
                                <option value="F" <?=($gender == 'F')?'selected':'' ?>>Female</option>
                                <option value="O" <?=($gender == 'O')?'selected':'' ?>>Other</option>
                            </select>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'gender') : '' ?></span>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Aadhar No<span class="text-danger">*</span></label>
                            <input type="text" name="aadhar" class="form-control" value="<?=set_value('aadhar', $profile->aadhar) ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'aadhar') : '' ?></span>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Father's Name</label>
                            <input type="text" name="f_name" class="form-control" value="<?=set_value('f_name', $profile->f_name) ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mother's Name</label>
                            <input type="text" name="m_name" class="form-control" value="<?=set_value('m_name', $profile->m_name) ?>">
                        </div>
                    </div>
                    <hr class="my-4">
                    <h5 class="mb-3">Address Details</h5>
                    <?php $fullAddress = ($profile->full_address != null)?json_decode($profile->full_address):[]; ?>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="3"><?=set_value('address', $fullAddress->add ?? '')?></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">State</label>
                            <input type="text" name="state" class="form-control" value="<?=set_value('state', $fullAddress->state ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">District</label>
                            <input type="text" name="district" class="form-control" value="<?=set_value('district', $fullAddress->dist ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pincode</label>
                            <input type="text" name="pincode" class="form-control" value="<?=set_value('pincode', $fullAddress->pincode ?? '') ?>">
                        </div>
                    </div>
                    <hr class="my-4">
                    <h5 class="mb-3">Academic Information</h5>
                    <?php $academic = ($profile->academic != null)?json_decode($profile->academic):[]; ?>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Qualification</label>
                            <div class="fs-5 fw-bold text-dark">
                                Matric (10th)
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Board</label>
                            <input type="text" name="board1" class="form-control" value="<?=set_value('board1', $academic->board1 ?? '') ?>">
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label">Passing Year</label>
                            <input type="number" name="passyear1" class="form-control" value="<?=set_value('passyear1', $academic->passyear1 ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Percentage / CGPA</label>
                            <input type="number" name="percentage1" class="form-control" value="<?=set_value('percentage1', $academic->percentage1 ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Qualification</label>
                            <div class="fs-5 fw-bold text-dark">
                                Inter (12th)
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Board</label>
                            <input type="text" name="board2" class="form-control" value="<?=set_value('board2', $academic->board2 ?? '') ?>">
                        </div>
                        
                        <div class="col-md-3">
                            <label class="form-label">Passing Year</label>
                            <input type="number" name="passyear2" class="form-control" value="<?=set_value('passyear2', $academic->passyear2 ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Percentage / CGPA</label>
                            <input type="number" name="percentage2" class="form-control" value="<?=set_value('percentage2', $academic->percentage2 ?? '') ?>">
                        </div>
                    </div>
                    <hr class="my-4">
                    
                    <div class="text-end mt-5">
                        
                        <button type="submit" class="btn text-white px-4" style="background:#0c2778;">
                            <i class="bx bx-save me-1"></i>
                            Save Changes

                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    