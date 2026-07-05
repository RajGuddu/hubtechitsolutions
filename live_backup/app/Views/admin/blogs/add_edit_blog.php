<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                    <h4 class="card-title"><?php echo (isset($cms))?'Edit Blog':'Add Blog'; ?></h4>
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="blog_title">Title</label>
                            <input type="text" class="form-control" id="blog_title" name="blog_title" value="<?=(isset($blog->blog_title))?$blog->blog_title:set_value('blog_title'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'blog_title') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="blog_url">Url</label>
                            <input type="text" class="form-control" id="blog_url" name="blog_url" value="<?=(isset($blog->blog_url))?$blog->blog_url:set_value('blog_url'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'blog_url') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="blog_details">Description</label>
                            <textarea class="form-control" id="blog_details" name="blog_details" rows="4" cols="50"><?=(isset($blog->blog_details))?trim(strip_tags($blog->blog_details)):set_value('blog_details'); ?></textarea>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'blog_details') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?=(isset($blog->meta_title))?$blog->meta_title:set_value('meta_title'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'meta_title') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="meta_description">Cms Meta Description</label>
                            <input type="text" class="form-control" id="meta_description" name="meta_description" value="<?=(isset($blog->meta_description))?$blog->meta_description:set_value('meta_description'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'meta_description') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="meta_keyword">Cms Meta Keyword</label>
                            <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="<?=(isset($blog->meta_keyword))?$blog->meta_keyword:set_value('meta_keyword'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'meta_keyword') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="post_date">Posted At</label>
                            <input type="date" class="form-control" id="post_date" name="post_date" value="<?=(isset($blog->post_date))?$blog->post_date:set_value('post_date'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'post_date') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="blog_added_by">Added By</label>
                            <input type="text" class="form-control" id="blog_added_by" name="blog_added_by" value="<?=(isset($blog->blog_added_by))?$blog->blog_added_by:set_value('blog_added_by'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'blog_added_by') : '' ?></span>
                        </div>
                        <div class="row">
                            <?php if(isset($blog->blog_image) && $blog->blog_image != ''){ ?>
                                <div class="col-md-6">
                                    <img src="<?=base_url('public/assets/upload/images/'.$blog->blog_image) ?>" width="150px" height="80px" />
                                </div>
                            <?php } ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" id="blog_image" name="blog_image">
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'blog_image') : '' ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="blog_status">Status</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="blog_status" id="blog_status" value="1" <?=set_radio('status', 1, (isset($blog->blog_status) && $blog->blog_status == '1')?true:'')?>> Active </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="blog_status" id="blog_status2" value="0" <?=set_radio('status', 0, (isset($blog->blog_status) && $blog->blog_status == '0')?true:'')?>> Inactive </label>
                            </div>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'blog_status') : '' ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button type="reset" class="btn btn-info">Reset</button>
                        <a href="<?=base_url('admin/blogs')?>" class="btn btn-warning">Cancel</a>
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