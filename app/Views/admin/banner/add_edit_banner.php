<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                    <h4 class="card-title"><?php echo (isset($banner))?'Edit Banner':'Add Banner'; ?></h4>
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="page">Page For</label>
                            <select class="form-control" name="page" id="page">
                                <option value="">Select Page</option>
                                <?php if($pages){ 
                                    foreach($pages as $value) { 
                                    $true = (isset($banner->page) && $banner->page == $value->id)?true:''?>
                                    <option value="<?=$value->id ?>" <?=set_select('page', $value->id, $true)?>><?=$value->page_name ?></option>
                                <?php  }  } ?>
                            </select>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'page') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="main_title">Banner Title</label>
                            <input type="text" class="form-control" id="main_title" name="main_title" value="<?=(isset($banner->main_title))?$banner->main_title:set_value('main_title'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'main_title') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="sub_title">Banner Sub Title</label>
                            <input type="text" class="form-control" id="sub_title" name="sub_title" value="<?=(isset($banner->sub_title))?$banner->sub_title:set_value('sub_title'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'sub_title') : '' ?></span>
                        </div>
                        <div class="row">
                            <?php if(isset($banner->brochure) && $banner->brochure != ''){ ?>
                                <div class="col-md-6">
                                    <img src="<?=base_url('public/assets/upload/images/'.$banner->brochure) ?>" width="150px" height="80px" />
                                </div>
                            <?php } ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" id="brochure" name="brochure">
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'brochure') : '' ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="status">Status</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1, (isset($banner->status) && $banner->status == '1')?true:'')?>> Active </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($banner->status) && $banner->status == '0')?true:'')?>> Inactive </label>
                            </div>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button type="reset" class="btn btn-info">Reset</button>
                        <a href="<?=base_url('admin/banner')?>" class="btn btn-warning">Cancel</a>
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