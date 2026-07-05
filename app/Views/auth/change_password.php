<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                    <h4 class="card-title">Change Password</h4>
                    <?php if(session()->has('message')){
                        echo session()->get('message');
                    } ?>
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <div class="row">
                        <div class="col-md-8">
                            <form class="forms-sample" autocomplete="off" action="<?=base_url('/profile'); ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <label for="pwd">Password</label>
                                <input type="password" class="form-control" name="pwd" id="pwd" value="<?=set_value('pwd'); ?>" placeholder="Enter Password">
                                <span class="text-danger"><?=isset($validation)?$validation->showError('pwd'):''; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="cpwd">Confirm Password</label>
                                <input type="password" class="form-control" name="cpwd" id="cpwd" value="<?=set_value('cpwd'); ?>" placeholder="Enter Confirm Password">
                                <span class="text-danger"><?=isset($validation)?$validation->showError('cpwd'):''; ?></span>
                            </div>
                                
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                                
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?=$this->endSection()?>