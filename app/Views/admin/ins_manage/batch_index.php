<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <style>
        select.form-control{
            height : 35px
        }
    </style>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="card-title card-title-dash">Batch List</h4>
                                <!-- <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p> -->
                            </div>
                            <?php if(is_privilege(18,2)){ ?>
                            <div>
                                <a href="<?=base_url('admin/batch_cu')?>" class="btn btn-primary btn-sm text-white mb-0 me-0" role="button"> New New Batch</a>
                            </div>
                            <?php } ?>
                        </div>
                        <?php /*
                        <form action="<?=base_url('admin/admissions')?>" method="get">
                        <div class="form-group row pt-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="s" value="<?=(isset($_GET['s'])?$_GET['s']:'')?>" placeholder="Name, Phone or email">
                            </div>
                            <div class="col-md-2">
                                <label for="">Select Multiple course</label>
                            </div>
                            <div class="col-md-4">
                                <select name="course[]" id="course_id" class="js-example-basic-multiple form-control form-control-lg " multiple >
                                    <!-- <option value="">Select Course (multiple)</option> -->
                                    <?php if(!empty($courses)){
                                        foreach($courses as $list){ ?>
                                            <option value="<?=$list->course_id?>" <?=(isset($_GET['course']) && !empty($_GET['course']) && in_array($list->course_id,$_GET['course']))?'selected':''?>><?=$list->course_name?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="col-md-2 pt-2">
                                <label for="">Select Multiple Batch</label>
                            </div>
                            <div class="col-md-4 pt-2">
                                <select name="batch[]" id="batch_id" class="js-example-basic-multiple form-control form-control-lg " multiple >
                                    <!-- <option value="">Select Course (multiple)</option> -->
                                    <?php if(!empty($batches)){
                                        foreach($batches as $list){ ?>
                                            <option value="<?=$list->batch_id ?>" <?=(isset($_GET['batch']) && !empty($_GET['batch']) && in_array($list->batch_id,$_GET['batch']))?'selected':''?>><?=$list->batch_name?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="col-md-2 pt-2">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="1" <?=(isset($_GET['status']) && $_GET['status'] == '1')?'selected':''?>>Active</option>
                                    <option value="o" <?=(isset($_GET['status']) && $_GET['status'] == 'o')?'selected':''?>>Inactive</option>
                                </select>
                            </div>
                            
                            <div class="col-md-2 pt-2">
                                <button class="btn btn-primary" type="submit" title="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
                                <a href="<?=base_url('admin/adm_list_url_reset')?>" class="btn btn-warning" title="Reset"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        </form> */ ?>
                        
                        <?php if(session()->getFlashdata('message') !== NULL){
                            echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
                        } ?>
                        <!-- <p class="card-description">
                        Add class <code>.table-striped</code>
                        </p> -->
                        <div class="table-responsive pt-2">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Batch Name</th>
                                    <th>Date From</th>
                                    <th>Date To</th>
                                    <th>Time From</th>
                                    <th>Time To</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($batches)){
                                    $sn=1;
                                    foreach($batches as $list){ 
                                    if($list->status < 1){
                                        $status = '<span class="btn btn-warning btn-sm">Inactive</span>'; 
                                    }else{
                                        $status = '<span class="btn btn-success btn-sm">Active</span>';
                                    }    
                                    ?>
                                    <tr>
                                        <td><?=$sn++?></td>
                                        <td><?=$list->batch_name?></td>
                                        <td><?=date('d, M Y',strtotime($list->date_from))?></td>
                                        <td><?=date('d, M Y',strtotime($list->date_to))?></td>
                                        <td><?=date('H:i A',strtotime($list->time_from))?></td>
                                        <td><?=date('H:i A',strtotime($list->time_to))?></td>
                                        <td><?=$status?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <?php if(is_privilege(18,3)){ ?>
                                                <a href="<?= base_url('/admin/batch_cu/'.$list->batch_id) ?>" class="btn btn-outline-primary" role="button" title="Edit"><i class="fas fa-edit"></i></a>
                                                <?php } ?>
                                                <?php /*if(is_privilege(18,4)){ ?>
                                                <a href="<?= base_url('/admin/admissions_r/'.$list->id) ?>" class="btn btn-outline-info" role="button" title="View"><i class="fas fa-eye"></i></a>
                                                <?php } ?>
                                                <?php if(is_privilege(18,5)){ ?>
                                                <a href="<?= base_url('/admin/delete_course/'.$list->id) ?>" onclick="return confirm('Are you sure?')" class="btn btn-outline-success" role="button" title="Cert Issue"><i class="fa fa-certificate" aria-hidden="true"></i></a>
                                                <?php } ?>
                                                <?php if(is_privilege(18,5)){ ?>
                                                <a href="<?= base_url('/admin/delete_course/'.$list->id) ?>" onclick="return confirm('Are you sure?')" class="btn btn-outline-danger" role="button" style="color:red" title="Delete"><i class="fas fa-trash"></i></a>
                                                <?php } */?>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } } else { ?>
                                        <tr><td colspan="11" class="text-center"><span class="text-danger"> No Data Available</span></td></tr>
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
