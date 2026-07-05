<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                    <h4 class="card-title">Edit User</h4>
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="name">User Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?=set_value('name',$user->name); ?>" placeholder="Enter Username">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?=set_value('email',$user->email); ?>" placeholder="Enter email" <?=($user->user_id==1)?'readonly':''?>>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                        </div>
                        
                        <div class="form-group row">
                            <label for="phone">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="<?=set_value('phone',$user->phone); ?>" placeholder="Enter Phone Number">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'phone') : '' ?></span>  
                        </div>
                        <div class="form-group row">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?=set_value('address',$user->address); ?>" placeholder="Enter Address">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'address') : '' ?></span>  
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label>Profile Image</label>
                            </div>
                            <div class="col-md-6">
                                <input type="file" class="form-control" id="image" name="image">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'image') : '' ?></span>
                            </div>
                            <div class="col-md-6">
                                <img src="<?=base_url('public/assets/upload/users/'.$user->image)?>" alt="Image" width="50px" height="50px">
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="privilege_id">Privilege</label>
                            <?php if($user->user_id == 1){
                                echo ($user->privilege_id == 1)?'<span class="badge badge-warning">Admin</span>':'<span class="badge badge-danger">Undefined</span>';
                            }else{ ?>
                            <select name="privilege_id" id="privilege_id" class="form-control">
                                <option value="">Select Privilege</option>
                                <?php if(!empty($rolePrivilege)){
                                    foreach($rolePrivilege as $list){ 
                                        $true = '';
                                        if($list->privilege_id == $user->privilege_id){ $true = true; }
                                    ?>
                                    <option value="<?=$list->privilege_id?>" <?=set_select('privilege_id', $list->privilege_id, $true)?>><?=$list->post_name?></option>
                                <?php }
                                } ?>
                            </select>
                            <span class="text-danger"><?= isset($validation) ? get_error($validation, 'privilege_id') : '' ?></span>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <?php if($user->user_id == 1){
                                echo ($user->status == 1)?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Undefined</span>';
                            }else{ ?>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1,($user->status==1)?true:'')?>> Active </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0,($user->status==0)?true:'')?>> Inactive </label>
                            </div>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                            <?php } ?>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button type="reset" class="btn btn-info me-2">Reset</button>
                        <a href="<?=base_url('admin/users')?>" class="btn btn-warning">Cancel</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?=$this->endSection()?>