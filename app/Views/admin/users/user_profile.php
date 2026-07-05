<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                    <h4 class="card-title"><?=$user->name ?> Profile</h4>
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <div class="form-group row">
                        <label for="name" class="col-md-2">User Name</label>
                        <div class="col-md-4">
                            <span><?=$user->name ?></span>
                        </div>
                        <div class="col-md-2">
                            <img src="<?=base_url('public/assets/upload/users/'.$user->image) ?>" alt="image" width="65" height="75">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-2">Email address</label>
                        <div class="col-md-10">
                            <span><?=$user->email ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-2">Ip Address</label>
                        <div class="col-md-10">
                            <span><?=$user->ip_address ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-2">Phone</label>
                        <div class="col-md-10">
                            <span><?=$user->phone ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-md-2">Address</label>
                        <div class="col-md-10">
                            <span><?=$user->address ?></span>
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="status" class="col-md-2">Status</label>
                        <div class="col-sm-10">
                            <?php if($user->status == 1)
                            echo '<span class="badge badge-success">Active</span>';
                            else
                            echo '<span class="badge badge-warning">Inactive</span>';
                            ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-md-2">Privilege</label>
                        <div class="col-sm-10">
                            <span class="badge badge-primary"><?=$user->post_name?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-md-2">Created Date</label>
                        <div class="col-md-10">
                            <span><?=date('M d, Y', strtotime($user->created)) ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-md-2">Updated Date</label>
                        <div class="col-md-10">
                            <?php if($user->updated != '0000-00-00 00:00:00')
                            echo '<span>'.date('M d, Y', strtotime($user->updated)).'</span>';
                            else
                            echo '<span class="text-danger">Not Update</span>';
                            ?>
                        </div>
                    </div>
                    <a href="<?=base_url('/admin/users') ?>" class="btn btn-primary">Back</a>
                    </div> <!-- card body-->
                </div>
            </div>
        </div>
    </div>
<?=$this->endSection()?>