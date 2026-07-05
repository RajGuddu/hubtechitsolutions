<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <script language="Javascript" src="<?php echo base_url('editor/scripts/innovaeditor.js'); ?>"></script>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                    <h4 class="card-title"><?php echo (isset($ccdata))?'Update Course Category':'Create Course Category'; ?></h4>
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="course_category_name">Course Category Name</label>
                            <input type="text" class="form-control" id="course_category_name" name="course_category_name" value="<?=set_value('course_category_name', (isset($ccdata->course_category_name))?$ccdata->course_category_name:''); ?>" placeholder="Course Category Name">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'course_category_name') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1, (isset($ccdata->status) && $ccdata->status == '1')?true:'')?>> Active </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($ccdata->status) && $ccdata->status == '0')?true:'')?>> Inactive </label>
                            </div>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button type="reset" class="btn btn-info">Reset</button>
                        <a href="<?=base_url('admin/course_category')?>" class="btn btn-warning">Cancel</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?=$this->endSection()?>