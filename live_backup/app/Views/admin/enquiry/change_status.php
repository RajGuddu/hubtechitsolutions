<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <script language="Javascript" src="<?php echo base_url('editor/scripts/innovaeditor.js'); ?>"></script>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                    <?php $name = (isset($value->name))?$value->name:''; ?>
                    <h4 class="card-title"><?php echo $page_title.' ('.$name.')'; ?></h4>
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1, (isset($value->status) && $value->status == 1)?true:'')?>> New </label>
                            </div>
                            <?php if(isset($value->course_id) && $value->course_id >= 1){ ?>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status2" value="2" <?=set_radio('status', 2, (isset($value->status) && $value->status == 2)?true:'')?>> Admit </label>
                            </div>
                            <?php } ?>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status3" value="3" <?=set_radio('status', 3, (isset($value->status) && $value->status == 3)?true:'')?>> Cancelled </label>
                            </div>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <!-- <button type="reset" class="btn btn-info">Reset</button> -->
                        <?php if(isset($value->course_id) && $value->course_id >= 1) {
                            $backURL = base_url('admin/enrolled_listing');
                        }else{
                            $backURL = base_url('admin/contact_us_listing');
                        } ?>
                        <?=form_hidden('back_url', $backURL); ?>
                        <a href="<?=$backURL?>" class="btn btn-warning">Cancel</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?=$this->endSection()?>