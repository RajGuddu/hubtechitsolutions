<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                    <h4 class="card-title"><?php echo (isset($faq))?'Edit Faq':'Add Faq'; ?></h4>
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="faq_title">Faq Title</label>
                            <input type="text" class="form-control" id="faq_title" name="faq_title" value="<?=(isset($faq->faq_title))?$faq->faq_title:set_value('faq_title'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'faq_title') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="faq_description">Faq Description</label>
                            <textarea class="form-control" id="faq_description" name="faq_description" rows="7" cols="50"><?=(isset($faq->faq_description))?$faq->faq_description:set_value('faq_description'); ?></textarea>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'faq_description') : '' ?></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="faq_status">Status</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="faq_status" id="faq_status" value="1" <?=set_radio('faq_status', 1, (isset($faq->faq_status) && $faq->faq_status == '1')?true:'')?>> Active </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="faq_status" id="faq_status2" value="0" <?=set_radio('faq_status', 0, (isset($faq->faq_status) && $faq->faq_status == '0')?true:'')?>> Inactive </label>
                            </div>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'faq_status') : '' ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button type="reset" class="btn btn-info">Reset</button>
                        <a href="<?=base_url('admin/faq')?>" class="btn btn-warning">Cancel</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?=$this->endSection()?>