<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="card-title card-title-dash"><?=$page_title?></h4>
                                <!-- <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p> -->
                            </div>
                            <?php /* if(is_privilege(13,2)){ ?>
                            <div>
                                <a href="<?=base_url('admin/add_edit_course')?>" class="btn btn-primary btn-sm text-white mb-0 me-0" role="button"> Add Course</a>
                            </div>
                            <?php } */ ?>
                        </div>
                        <div class="py-2">
                            <a href="<?=current_url();?>" class="btn btn-outline-primary btn-fw <?=(!isset($_GET['st']))?'active':''?>">New (<?=$count_new?>)</a>
                            <a href="<?=current_url().'?st=2';?>" class="btn btn-outline-primary btn-fw <?=(isset($_GET['st']) && $_GET['st'] == 2)?'active':''?>">Admitted (<?=$count_admitted?>)</a>
                            <a href="<?=current_url().'?st=3';?>" class="btn btn-outline-primary btn-fw <?=(isset($_GET['st']) && $_GET['st'] == 3)?'active':''?>">Cancelled (<?=$count_cancelled?>)</a>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <?php if($page_type == 'Enrolled'){
                                        echo '<th>Course Name</th>';
                                    }?>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($listing)){
                                    $sn=1;
                                    foreach($listing as $list){ 
                                    if($list->status == 2){
                                        $status = '<span class="btn btn-success btn-sm">Admitted</span>'; 
                                    }else if($list->status == 3){
                                        $status = '<span class="btn btn-danger btn-sm">Cancelled</span>';
                                    }else{
                                        $status = '<span class="btn btn-primary btn-sm">New</span>';
                                    }    
                                    ?>
                                    <tr>
                                        <td><?=$sn++?></td>
                                        
                                        <td><?=$list->name?></td>
                                        <td><a href="mailto:<?=$list->email?>"><?=$list->email?></a></td>
                                        <td><?=$list->phone?></td>
                                        <?php if($page_type == 'Enrolled'){
                                            echo '<th>'.$list->course_full_name.'</th>';
                                        }?>
                                        <td><?php echo substr($list->message,0,30)?> ...</td>
                                        <td>
                                            <?=date('d M, Y', strtotime($list->added_at)); ?>
                                        </td>
                                        
                                        <td><?=$status?></td>
                                        <td style="width:70%">
                                            <?php if(is_privilege(15,3) || is_privilege(16,3)){ ?>
                                            <a href="<?= base_url('/admin/enq_status/'.$list->id) ?>" class="btn btn-outline-info" role="button" title="Edit"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                            <?php } ?>
                                            <?php /* if(is_privilege(13,5)){ ?>
                                            <a href="<?= base_url('/admin/delete_course/'.$list->course_id) ?>" onclick="return confirm('Are you sure?')" class="btn btn-outline-info" role="button" style="color:red" title="Delete"><i class="fa fa-address-card" aria-hidden="true"></i></a>
                                            <?php } */?>
                                        </td>
                                    </tr>
                                    <?php } } else { ?>
                                        <tr><td colspan="3">No Data Available</td></tr>
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
