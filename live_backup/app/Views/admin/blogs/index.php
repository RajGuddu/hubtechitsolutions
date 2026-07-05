<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="card-title card-title-dash">Blogs</h4>
                                <!-- <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p> -->
                            </div>
                            <?php if(is_privilege(8,2)){ ?>
                            <div>
                                <a href="<?=base_url('admin/add_edit_blog')?>" class="btn btn-primary btn-sm text-white mb-0 me-0" role="button"> Add Blog</a>
                            </div>
                            <?php } ?>
                        </div>
                        <?php if(session()->getFlashdata('message') !== NULL){
                            echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
                        } ?>
                        <!-- <p class="card-description">
                        Add class <code>.table-striped</code>
                        </p> -->
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Url</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($blogs)){
                                    $sn=1;
                                    foreach($blogs as $list){ ?>
                                    <tr>
                                        <td><?=$sn++?></td>
                                        <td><?=$list->blog_title?></td>
                                        <td><?=$list->blog_url?></td>
                                        <td><?=substr($list->blog_details,0,50).'...'?></td>
                                        <td><img alt="image" width="150px" height="70px" src="<?=($list->blog_image != '')?base_url('public/assets/upload/images/'.$list->blog_image):base_url('public/assets/upload/images/dummy2.png')?>" />
                                        </td>
                                        <td><?=($list->blog_status=='1')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-warning">InActive</span>'?></td>
                                        <td>
                                            <?php if(is_privilege(8,3)){ ?>
                                            <a href="<?= base_url('/admin/add_edit_blog/'.$list->blg_id) ?>" class="btn btn-outline-info"><i class="far fa-edit"></i></a>
                                            <?php } ?>

                                            <!--<a href="<?= base_url('/admin/users/view_one/'.$list->blg_id) ?>"><i class="far fa-eye"></i></a>-->

                                            <?php if(is_privilege(8,4)){ ?>
                                            <a href="<?= base_url('/admin/delete_blog/'.$list->blg_id) ?>" onclick="return confirm('Are you sure?')" class="btn btn-outline-info" style="color:red"><i class="fas fa-trash"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } } else { ?>
                                        <tr><td colspan="7">No Data Available</td></tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?=$this->endSection()?>
