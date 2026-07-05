<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="card-title card-title-dash">Testimonial</h4>
                                <!-- <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p> -->
                            </div>
                            <?php if(is_privilege(10,2)){ ?>
                            <div>
                                <a href="<?=base_url('admin/add_edit_testimonial')?>" class="btn btn-primary btn-sm text-white mb-0 me-0" role="button"> Add Testimonial</a>
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
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Post</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($testimonial)){
                                    $sn=1;
                                    foreach($testimonial as $list){ ?>
                                    <tr>
                                        <td><?=$sn++?></td>
                                        <td>
                                            <img alt="image" src="<?=($list->logo != '')?base_url('public/assets/upload/images/'.$list->logo):base_url('public/assets/upload/images/dummy2.png')?>" weight="70px" height="50"/>
                                        </td>
                                        <td><?=$list->name?></td>
                                        <td><?=substr($list->description,0,50).'...'?></td>
                                        <td><?=$list->post?></td>
                                        <td><?=($list->status=='1')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-warning">InActive</span>'?></td>
                                        <td>
                                            <?php if(is_privilege(10,3)){ ?>
                                            <a href="<?= base_url('/admin/add_edit_testimonial/'.$list->id) ?>" class="btn btn-outline-info"><i class="far fa-edit"></i></a>
                                            <?php } ?>
                                            <!--<a href="<?= base_url('/admin/users/view_one/'.$list->id) ?>"><i class="far fa-eye"></i></a>-->
                                            <?php if(is_privilege(10,4)){ ?>
                                            <a href="<?= base_url('/admin/delete_testimonial/'.$list->id) ?>" onclick="return confirm('Are you sure?')"  class="btn btn-outline-info" style="color:red"><i class="fas fa-trash"></i></a>
                                            <?php } ?>
                                            
                                        </td>
                                    </tr>
                                    <?php } } else { ?>
                                        <tr><td colspan="3">No Data Available</td></tr>
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
