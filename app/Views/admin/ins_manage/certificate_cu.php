<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <script language="Javascript" src="<?php echo base_url('editor/scripts/innovaeditor.js'); ?>"></script>
    
        <div class="content-wrapper">
            <form class="" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card bg-info">
                        <div class="card-body">
                        <h4 class="card-title"><?php echo (isset($cert))?'Update Certificate':'Create Certificate'; ?></h4>
                        <!-- <p class="card-description">
                            Basic form elements
                        </p> -->
                        
                        <?= csrf_field(); ?>
                            <div class="form-group">
                                <label for="cert_no">Certificate Number</label>
                                <input type="text" class="form-control" id="cert_no" name="cert_no" value="<?=set_value('cert_no', (isset($cert->cert_no))?$cert->cert_no:''); ?>" >
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'cert_no') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="enrollment_no">Enrollment Number</label>
                                <input type="text" class="form-control" id="enrollment_no" name="enrollment_no" value="<?=set_value('enrollment_no', (isset($cert->enrollment_no))?$cert->enrollment_no:''); ?>" >
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'enrollment_no') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="student_name">Student's Name</label>
                                <input type="text" class="form-control" id="student_name" name="student_name" value="<?=set_value('student_name', (isset($cert->student_name))?$cert->student_name:''); ?>" >
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'student_name') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="f_name">Father's Name</label>
                                <input type="text" class="form-control" id="f_name" name="f_name" value="<?=set_value('f_name', (isset($cert->f_name))?$cert->f_name:''); ?>" >
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'f_name') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="course">Course</label>
                                <input type="text" class="form-control" id="course" name="course" value="<?=set_value('course', (isset($cert->course))?$cert->course:''); ?>" >
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'course') : '' ?></span>
                            </div>
                            
                            <?php /* <div class="form-group">
                                <label for="status">Status</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1, (isset($cert->status) && $cert->status == 1)?true:'')?>> Active </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($cert->status) && $cert->status == 0)?true:'')?>> Inactive </label>
                                </div>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                            </div> */ ?>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button type="reset" class="btn btn-info">Reset</button>
                            <a href="<?=base_url('admin/certificate_list')?>" class="btn btn-warning">Cancel</a>
                            
                        </div>
                    </div>
                </div>
                <?php /*<div class="col-md-6 grid-margin stretch-card">
                    <div class="card bg-info">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="p_address">Permanent Address</label>
                                <input type="text" class="form-control" id="p_address" name="p_address" value="<?=set_value('p_address', (isset($adm_data->p_address))?$adm_data->p_address:''); ?>" placeholder="Permanent Address">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'p_address') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="study_meterial">Study Meterial</label>
                                <?php if(isset($adm_data->study_meterial) && $adm_data->study_meterial != ''){
                                    $study_meterialArr = explode(',', $adm_data->study_meterial);
                                } ?>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="study_meterial[]" value="1" <?=(isset($study_meterialArr) && in_array('1', $study_meterialArr))?'checked':''?>>
                                            Bag
                                            <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="study_meterial[]" value="2" <?=(isset($study_meterialArr) && in_array('2', $study_meterialArr))?'checked':''?>>
                                            I.Card
                                            <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="study_meterial[]" value="3" <?=(isset($study_meterialArr) && in_array('3', $study_meterialArr))?'checked':''?>>
                                            Book
                                            <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="other">Others</label>
                                <input type="text" class="form-control" id="other" name="other" value="<?=set_value('other', (isset($adm_data->other))?$adm_data->other:''); ?>" placeholder="Permanent Address">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'other') : '' ?></span>
                            </div>

                        </div>
                    </div>
                </div> */ ?>

            </div>
            </form>
        </div>
    
    <script>
        $("#qualification").change(function(){
            var qly = $("#qualification").val();
            if(qly == 'other'){
                $("#other_qly").show();
            }else{
                $("#other_qly").hide();
            }
        });
    </script>
    
<?=$this->endSection()?>