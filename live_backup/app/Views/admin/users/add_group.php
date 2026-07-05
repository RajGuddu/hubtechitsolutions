<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start pb-2">
                            <div>
                                <h4 class="card-title card-title-dash">Add Group</h4>
                                <!-- <p class="card-description">
                                    Basic form elements
                                </p> -->
                            </div>
                            <div>
                                <a href="<?=base_url('admin/user_groups')?>" class="btn btn-primary btn-sm text-white mb-0 me-0" role="button"> Back</a>
                            </div>
                        </div>
                        <?php if(session()->getFlashdata('message') !== NULL){
                            echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
                        } ?>
                        <form action="<?=current_url(); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group row">
                            <label for="post_name" class="col-sm-2">Group Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="post_name" value="<?=set_value('post_name')?>" id="post_name" placeholder="Group Name">
                                <span class="text-danger"><?= isset($validation) ? get_error($validation, 'post_name') : '' ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 mb-3 mb-sm-0">Add Privilege:</label>
                            <div class="col-sm-10">
                                <?php if(count($menulist) > 0){ ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!-- <input class="form-check-input" type="checkbox" name="" value="" id="AllPrivilege" >
                                            <label class="form-check-label" for="AllPrivilege">All Privilege</label> -->
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" id="AllPrivilege">All Privilege 
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <?php foreach($menulist as $key=>$menu){ 
                                $disable = '';
                                if($menu->menu_id == 2){
                                    $disable = 'disabled';
                                }
                                ?>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-check">
                                                <label class="form-check-label" data-toggle="tooltip" data-placement="right" title="<?=$menu->menu_id ?>">
                                                    <input type="checkbox" class="form-check-input" name="menu_id[<?=$key?>]" value="<?=$menu->menu_id?>" id="<?=$menu->menu_name?>" <?=$disable?>><?=$menu->menu_name?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="hidden" name="crudid[<?=$key?>][]" id="Listingh<?=$key?>" value="1">
                                            <div class="row">
                                            <?php if($menu->function != ''){
                                                $value = 2;
                                                $functionArr = explode(',', $menu->function);
                                                foreach($functionArr as $fun){ ?>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label" data-toggle="tooltip" data-placement="right" title="<?= $value ?>">
                                                                <input type="checkbox" class="form-check-input" name="crudid[<?=$key?>][]" id="<?=$fun.$key?>" value="<?= $value ?>" <?=$disable?>>
                                                                <?= $fun ?>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <?php $value++; ?>
                                            <?php }
                                            } ?>
                                                    
                                            </div>
                                        </div>
                                    </div>
                                <?php } } ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 mb-3 mb-sm-0">Status:</label>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <label class="form-check-label" for="exampleRadios1">
                                        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1" >
                                        Active
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" for="exampleRadios2">
                                        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="0" >
                                        In Active
                                    </label>
                                </div>
                                <span class="text-danger"><?= isset($validation) ? get_error($validation, 'status') : '' ?></span> 
                            </div>
                        </div>
                            
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="Reset" class="btn btn-info">Reset</button>
                        <a href="<?= base_url('admin/user_groups') ?>" class="btn btn-warning">Cancel</a>
                        </form>
                    
                    </div> <!-- card body-->
                </div>
            </div>
        </div>
    </div>
    <script>
    //check all
    $("#AllPrivilege").click(function() {
        $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
    });

    $("input[type=checkbox]").click(function() {
        if (!$(this).prop("checked")) {
        $("#AllPrivilege").prop("checked", false);
        }
    });
    </script>
<?=$this->endSection()?>