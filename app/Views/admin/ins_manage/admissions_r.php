<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                    <!-- <h4 class="card-title"><?=$student->stu_name ?>'s Details </h4> -->
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <div class="d-sm-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="card-title card-title-dash"><?=$student->stu_name ?>'s Details </h4>
                            <!-- <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p> -->
                        </div>
                        <?php if(is_privilege(17,3)){ ?>
                        <div>
                            <a href="<?= base_url('/admin/admissions_cu/'.$student->id) ?>" class="btn btn-outline-primary" role="button" title="Edit"><i class="fas fa-edit"></i></a>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="form-group row">
                        <label for="stu_name" class="col-md-2">Student's Name</label>
                        <div class="col-md-4">
                            <span><?=$student->stu_name ?></span>
                        </div>
                        <div class="col-md-2">
                            <img src="<?=base_url('public/assets/upload/images/'.$student->stu_image) ?>" alt="image" width="65" height="75">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="f_name" class="col-md-2"><strong>Batch Name</strong></label>
                        <div class="col-md-4">
                            <span><strong> <?=$student->batch_name ?></strong></span>
                        </div>
                        <label for="dob" class="col-md-2"><strong>Batch Time</strong></label>
                        <div class="col-md-4">
                            <span><strong> <?=$student->time_from ?></strong></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="f_name" class="col-md-2">Father's Name</label>
                        <div class="col-md-4">
                            <span><?=$student->f_name ?></span>
                        </div>
                        <label for="dob" class="col-md-2">DOB</label>
                        <div class="col-md-4">
                            <span><?=date('d,M Y',strtotime($student->dob)) ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone1" class="col-md-2">Phone 1</label>
                        <div class="col-md-4">
                            <span><?=$student->phone1 ?></span>
                        </div>
                    
                        <label for="phone2" class="col-md-2">Phone 2</label>
                        <div class="col-md-4">
                            <span><?=$student->phone2 ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-2">Email</label>
                        <div class="col-md-4">
                            <span><?=$student->email ?></span>
                        </div>
                    
                        <label for="age" class="col-md-2">Age</label>
                        <div class="col-md-4">
                            <span><?=$student->age ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="qualification" class="col-md-2">Qualifications</label>
                        <div class="col-md-4">
                            <span><?=$student->qly_title ?></span>
                        </div>
                    
                        <label for="course_name" class="col-md-2">Course</label>
                        <div class="col-md-4">
                            <span><?=$student->course_name ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="co_address" class="col-md-2">Co Address</label>
                        <div class="col-md-4">
                            <span><?=$student->co_address ?></span>
                        </div>
                    
                        <label for="p_address" class="col-md-2">P Address</label>
                        <div class="col-md-4">
                            <span><?=$student->p_address ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="study_meterial" class="col-md-2">Study Meterials</label>
                        <div class="col-md-4">
                            <?php $study_meterialArr = array('Bag','I.Card','Book');
                            if($student->study_meterial != ''){
                                foreach(explode(',',$student->study_meterial) as $list){
                                    $s_met[] = $study_meterialArr[$list-1];
                                }
                            } ?>
                            <span><?=(isset($s_met))?implode(', ',$s_met):'--' ?></span>
                        </div>
                    
                        <label for="other" class="col-md-2">Others</label>
                        <div class="col-md-4">
                            <span><?=$student->other ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="adm_date" class="col-md-2">Admission Date</label>
                        <div class="col-md-4">
                            <span><?=date('d,M Y',strtotime($student->adm_date)) ?></span>
                        </div>

                        <label for="added_at" class="col-md-2">Added Date</label>
                        <div class="col-md-4">
                            <span><?=date('d M, Y', strtotime($student->added_at)) ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="adm_by" class="col-md-2">Admission By</label>
                        <div class="col-sm-4">
                            <span class="badge badge-primary"><?=$student->adm_by?></span>
                        </div>
                        <label for="status" class="col-md-2">Status</label>
                        <div class="col-sm-4">
                            <?php if($student->status == 1)
                                echo '<span class="btn btn-success btn-sm">Active</span>';
                            else
                                echo '<span class="btn btn-warning btn-sm">Inactive</span>';
                            ?>
                        </div>
                        
                    </div>
                    
                    <a href="<?=base_url('/admin/admissions') ?>" class="btn btn-primary">Back</a>
                    </div> <!-- card body-->
                </div>
            </div>
        </div>
    </div>
<?=$this->endSection()?>