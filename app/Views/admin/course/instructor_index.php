<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="card-title card-title-dash">Instructor</h4>
                                <!-- <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p> -->
                            </div>
                            <?php if(is_privilege(14,2)){ ?>
                            <div>
                                <a href="<?=base_url('admin/instructor_cu')?>" class="btn btn-primary btn-sm text-white mb-0 me-0" role="button"> Add Instructor</a>
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
                                    <th>Photo</th>
                                    <th>Instructor Name</th>
                                    <th>Post</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($instructor)){
                                    $sn=1;
                                    foreach($instructor as $list){ ?>
                                    <tr>
                                        <td><?=$sn++?></td>
                                        <td><?php if($list->ins_image != ''){?><img src="<?=base_url('public/assets/upload/images/'.$list->ins_image)?>" width="100px" height="80px" /><?php }else{echo '--';} ?></td>
                                        <td><?=$list->ins_name?></td>
                                        <td><?=$list->post?></td>
                                        <td><?=($list->status==1)?'<span class="badge badge-success">Active</span>':'<span class="badge badge-warning">Inactive</span>'?></td>
                                        <td>
                                            <?php if(is_privilege(14,3)){ ?>
                                            <a href="<?= base_url('/admin/instructor_cu/'.$list->ins_id) ?>" class="btn btn-outline-info" title="Edit"><i class="fas fa-edit"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php } } else { ?>
                                        <tr><td colspan="6" class="text-center">No Data Available</td></tr>
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
