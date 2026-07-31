<div class="container-fluid py-0">
    <div class="row g-4">
        <!-- Sidebar -->
        <?= view('internship/sidebar'); ?>
        <!-- Right Content -->
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-linear py-3 d-flex justify-content-between align-items-center">
                    <h4 class="text-white mb-0">
                        <i class="bx bx-edit-alt me-2"></i>
                        <?=(isset($record) && $record->ia_id)?'Edit':'Add'?> Course
                    </h4>
                    <a href="<?=base_url('internship/courses')?>" class="btn btn-warning">
                        <i class="ri-arrow-left-line me-1"></i> Back
                    </a>
                </div>
                <?php if(session()->getFlashdata('message') !== NULL){
                    echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
                } ?>
                <div class="card-body">
                    <form action="<?=current_url()?>" class="internship-form" method="post"
                        enctype="multipart/form-data">
                        <?=csrf_field()?>
                        <input type="hidden" name="ia_id" value="<?=$record->ia_id ?? ''?>">
                        <!-- Profile Image -->
                        <div class="mb-5 text-center">
                            <p class="text-danger fw-bold fs-3 mb-0">
                                <i class="ri-error-warning-fill fs-2 me-2 align-middle"></i>
                                Note: All fields marked with * are mandatory.
                            </p>
                        </div>
                        <h5 class="mb-3">Course Details:</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">University Roll No<span class="text-danger">*</span></label>
                                <input type="text" name="uni_roll_no" class="form-control"
                                    value="<?=set_value('uni_roll_no', $record->uni_roll_no ?? '') ?>">
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'uni_roll_no') : '' ?>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">University Registration No<span class="text-danger">*</span></label>
                                <input type="text" name="uni_reg_no" value="<?=set_value('uni_reg_no', $record->uni_reg_no ?? '') ?>" class="form-control">
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'uni_reg_no') : '' ?>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Class<span class="text-danger">*</span></label>
                                <select class="form-select" name="class">
                                    <option value="">Select Class</option>
                                    <option value="BA" <?=set_select('class','BA', (isset($record) && $record->class == 'BA')?true:'') ?>>BA</option>
                                    <option value="B.Sc" <?=set_select('class','B.Sc', (isset($record) && $record->class == 'B.Sc')?true:'') ?>>B.Sc</option>
                                    <option value="B.Com" <?=set_select('class','B.Com', (isset($record) && $record->class == 'B.Com')?true:'') ?>>B.Com</option>
                                </select>
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'class') : '' ?>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">MJC Subject <span class="text-danger">*</span></label>
                                <select class="form-select" name="mjc_id">
                                    <option value="">Select One</option>
                                    <?php if(!empty($mjc)){
                                    foreach($mjc as $list){  
                                    $sel = (isset($record) && $record->mjc_id == $list->mjc_id)?true:''   
                                    ?>
                                    <option value="<?=$list->mjc_id?>" <?=set_select('mjc_id', $list->mjc_id, $sel)
                                        ?>><?=$list->sub_name?></option>
                                    <?php } } ?>
                                </select>
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'mjc_id') : '' ?>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Session<span class="text-danger">*</span></label>
                                <select class="form-select" name="session">
                                    <option value="">Select Session</option>
                                    <option value="2023-2027" <?=set_select('session', '2023-2027', (isset($record) && $record->session == '2023-2027')?true:'' ) ?> >2023-2027</option>
                                    <option value="2024-2028" <?=set_select('session', '2024-2028', (isset($record) && $record->session == '2024-2028')?true:'' ) ?> >2024-2028</option>
                                </select>
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'session') : '' ?>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Semester<span class="text-danger">*</span></label>
                                <select class="form-select" name="semester">
                                    <option value="">Select Semester</option>
                                    <option value="5" <?=set_select('semester', '5', (isset($record) && $record->semester == '5')?true:''  ) ?>>5</option>
                                </select>
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'semester') : '' ?>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">College/Institute<span class="text-danger">*</span></label>
                                <select class="form-select" name="clg_id">
                                    <option value="">Select College/Institute</option>
                                    <?php if(!empty($colleges)){
                                        foreach($colleges as $list){ 
                                    $sel = (isset($record) && $record->clg_id == $list->clg_id)?true:''    
                                    ?>
                                    <option value="<?=$list->clg_id?>" <?=set_select('clg_id', $list->clg_id, $sel)
                                        ?>><?=$list->college_name?></option>
                                    <?php }
                                    } ?>
                                </select>
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'clg_id') : '' ?>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Internship Course <span class="text-danger">*</span></label>
                                <select class="form-select" name="ic_id">
                                    <option value="">Select One</option>
                                    <?php if(!empty($internCourse)){
                                    foreach($internCourse as $list){  
                                    $sel = (isset($record) && $record->ic_id == $list->ic_id)?true:''    
                                    ?>
                                    <option value="<?=$list->ic_id?>" <?=set_select('ic_id', $list->ic_id, $sel)
                                        ?>><?=$list->ic_name?></option>
                                    <?php } } ?>
                                </select>
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'ic_id') : '' ?>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Duration<span class="text-danger">*</span> </label>
                                <select class="form-select" name="duration">
                                    <option value="">Select Duration</option>
                                    <option value="120" <?=set_select('duration', '120', (isset($record))?true:'') ?>>120 Hrs</option>
                                </select>
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'duration') : '' ?>
                                </span>
                            </div>
                            <div class="col-md-6 mt-5 pt-2">
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="terms" name="terms" value="1"
                                        <?=set_checkbox('terms','1', (isset($record))?true:''); ?>>
                                    <label class="form-check-label" for="terms">
                                        I agree to Terms & Conditions
                                    </label>
                                </div>
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'terms') : '' ?>
                                </span>
                            </div>
                            
                        </div>
                        
                        <hr class="my-4">

                        <div class="text-end mt-5">

                            <button type="submit" class="btn text-white px-4" style="background:#0c2778;">
                                <i class="ri-save-line me-1"></i>
                                <?=(isset($record))?'Save Changes':'Pay &#x20B9;300 & Submit'?>
                            </button>
                            <a href="<?=base_url('internship/courses')?>" class="btn btn-secondary">
                                <i class="ri-close-circle-line me-1"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>