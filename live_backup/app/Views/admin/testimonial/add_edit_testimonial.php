<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                    <h4 class="card-title"><?php echo (isset($testimonial))?'Edit Testimonial':'Add Testimonial'; ?></h4>
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="name" >Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?=(isset($testimonial->name))?$testimonial->name:set_value('name'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" cols="50"><?=(isset($testimonial->description))?$testimonial->description:set_value('description'); ?></textarea>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'description') : '' ?></span>
                        </div>
                        
                        <div class="row">
                            <?php if(isset($testimonial->logo) && $testimonial->logo != ''){ ?>
                                <div class="col-md-6">
                                    <img src="<?=base_url('public/assets/upload/images/'.$testimonial->logo) ?>" width="150px" height="80px" />
                                </div>
                            <?php } ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" id="logo" name="logo">
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'logo') : '' ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="post">Position</label>
                            <input type="text" class="form-control" id="post" name="post" value="<?=(isset($testimonial->post))?$testimonial->post:set_value('post'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'post') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1, (isset($testimonial->status) && $testimonial->status == '1')?true:'')?>> Active </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($testimonial->status) && $testimonial->status == '0')?true:'')?>> Inactive </label>
                            </div>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button type="reset" class="btn btn-info">Reset</button>
                        <a href="<?=base_url('admin/testimonial')?>" class="btn btn-warning">Cancel</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("body").on("keyup","#blog_title", function(event){	
            var urlval = $(this).val();
            var newurl = urlval.replace(/[_\s]/g, '-').replace(/[^a-z0-9-\s]/gi, '');
            $('#blog_url').val(newurl.toLowerCase());
        });  
    </script>
<?=$this->endSection()?>