<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                    <h4 class="card-title">Add User</h4>
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="name">User Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?=set_value('name'); ?>" placeholder="Enter Username">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?=set_value('email'); ?>" placeholder="Enter email">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?=set_value('password'); ?>" placeholder="Password">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="cpassword">Confirm Password</label>
                            <input type="password" class="form-control" id="cpassword" name="cpassword" value="<?=set_value('cpassword'); ?>" placeholder="Confirm Password">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'cpassword') : '' ?></span>
                        </div>
                        <div class="form-group row">
                            <label for="phone">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="<?=set_value('phone'); ?>" placeholder="Enter Phone Number">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'phone') : '' ?></span>  
                        </div>
                        <div class="form-group row">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?=set_value('address'); ?>" placeholder="Enter Address">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'address') : '' ?></span>  
                        </div>
                        <div class="form-group">
                            <label>Profile Image</label>
                            <input type="file" class="file-upload-default" id="image" name="image">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'image') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="privilege_id">Privilege</label>
                            <select name="privilege_id" id="privilege_id" class="form-control">
                                <option value="">Select Privilege</option>
                                <?php if(!empty($rolePrivilege)){
                                    foreach($rolePrivilege as $list){ ?>
                                    <option value="<?=$list->privilege_id?>" <?=set_select('privilege_id', $list->privilege_id)?>><?=$list->post_name?></option>
                                <?php }
                                } ?>
                            </select>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'privilege_id') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1)?>> Active </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0)?>> Inactive </label>
                            </div>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button type="reset" class="btn btn-info">Reset</button>
                        <a href="<?=base_url('admin/users')?>" class="btn btn-warning">Cancel</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?=$this->endSection()?>