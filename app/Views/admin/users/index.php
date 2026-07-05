<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="card-title card-title-dash">Users</h4>
                                <!-- <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p> -->
                            </div>
                            <?php if(is_privilege(1,2)){ ?>
                            <div>
                                <a href="<?=base_url('admin/add_user')?>" class="btn btn-primary btn-sm text-white mb-0 me-0" role="button"> Add User</a>
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
                                    <th>Profile Image</th>
                                    <th>Name</th>
                                    <th>Privilege</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($users)){
                                    $sn = 1;
                                    foreach($users as $list){
                                    if($list->status == 1){
                                        $status = '<span class="badge badge-success">Active</span>'; 
                                    }else{
                                        $status = '<span class="badge badge-warning">Inactive</span>';
                                    }
                                    ?>
                                <tr>
                                    <td><?=$sn;?></td>
                                    <td class="py-1"><img src="<?=base_url('public/assets/upload/users/'.$list->image) ?>" alt="image" width="75" height="85"></td>
                                    <td><?=$list->name?></td>
                                    <td><?=$list->post_name?></td>
                                    <td><?=$list->email?></td>
                                    <td><?=$list->phone?></td>
                                    <td><?=$status?></td>
                                    <td>
                                        <?php if(is_privilege(1,3)){ ?>
                                        <a href="<?=base_url('/admin/edit_user/'.$list->user_id) ?>"><i class="fas fa-edit"></i></a>
                                        <?php }if(is_privilege(1,4)){ ?>
                                        <a href="<?=base_url('/admin/user_profile/'.$list->user_id) ?>"><i class="fas fa-eye"></i></a>
                                        <?php }if(is_privilege(1,5)){ ?>
                                        <?php if($list->user_id != 1){?>
                                        <a href="<?=base_url('/admin/user_delete/'.$list->user_id) ?>" onclick="return confirm('Are you sure?');" style="color:red"><i class="fas fa-trash"></i></a>
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
