<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                    <h4 class="card-title"><?=session('name')?>'s Profile</h4>
                    <?php if(session()->has('message')){
                        echo session()->get('message');
                    } ?>
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" autocomplete="off" action="<?=base_url('/profile'); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Profile Image</label> <br>
                                <img src="<?=base_url('public/assets/upload/users/'.$profile->image); ?>" alt="profile image" height="80px" length="70px">
                            </div>
                            <div class="col-sm-6">
                                <label>Change Profile Image</label>
                                <input type="file" class="file-upload-default" id="image" name="image">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                </div>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'image') : '' ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?=set_value('name', isset($profile)?$profile->name:''); ?>" placeholder="Enter Username">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?=set_value('email', $profile->email); ?>" placeholder="Enter email">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                        </div>
                        
                        <div class="form-group row">
                            <label for="phone">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="<?=set_value('phone', $profile->phone); ?>" placeholder="Enter Phone Number">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'phone') : '' ?></span>  
                        </div>
                        <div class="form-group row">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?=set_value('address', $profile->address); ?>" placeholder="Enter Address">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'address') : '' ?></span>  
                        </div>
                        
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?=$this->endSection()?>