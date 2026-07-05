<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="card-title card-title-dash">User Groups</h4>
                                <!-- <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p> -->
                            </div>
                            <?php if(is_privilege(2,2)){ ?>
                            <div>
                                <a href="<?= base_url('admin/addgroup') ?>" class="btn btn-primary btn-sm text-white mb-0 me-0" role="button"> Add User Group</a>
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
                                    <th>Group</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($usersgrouplist)){
                                    $sn = 1;
                                    foreach($usersgrouplist as $list){
                                    if($list->status == 1){
                                        $status = '<span class="badge badge-success">Active</span>'; 
                                    }else{
                                        $status = '<span class="badge badge-warning">Inactive</span>';
                                    }
                                    ?>
                                <tr>
                                    <td><?=$sn;?></td>
                                    <td><?= $list->post_name ?></td>
                                    <td><?=$status?></td>
                                    <td>
                                        <?php if(is_privilege(2,3)){ ?>
                                        <a href="<?= base_url('/admin/editgroup/'.$list->privilege_id) ?>"><i class="fas fa-edit"></i></a>
                                        <?php }if(is_privilege(2,4)){ ?>
                                        <?php if($list->privilege_id != 1){ ?>
                                        <a href="<?= base_url('/admin/deletegroup/'.$list->privilege_id) ?>" onclick="return confirm('Are you sure?');"><i class="fas fa-trash" style="color:red"></i></a>
                                        <?php } }?>
                                    </td>
                                </tr>

                                <?php $sn++; }
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?=$this->endSection()?>
