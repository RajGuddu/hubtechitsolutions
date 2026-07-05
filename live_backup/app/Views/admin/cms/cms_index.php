<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="card-title card-title-dash">CMS</h4>
                                <!-- <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p> -->
                            </div>
                            <?php if(is_privilege(7,2)){ ?>
                            <div>
                                <a href="<?=base_url('admin/add_edit_cms')?>" class="btn btn-primary btn-sm text-white mb-0 me-0" role="button"> Add CMS</a>
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
                                    <th>Page Name</th>
                                    <th>Banner Title</th>
                                    <th>Banner Heading</th>
                                    <th>Cms Banner</th>
                                    <!--<th>Description1</th>-->
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($cms)){
                                    $sn=1;
                                    foreach($cms as $list){ 
                                    if($list->status == 1){
                                        $status = '<span class="badge badge-success">Active</span>'; 
                                    }else{
                                        $status = '<span class="badge badge-warning">Inactive</span>';
                                    }    
                                    ?>
                                    <tr>
                                        <td><?=$sn++?></td>
                                        
                                        <td><?=$list->page?></td>
                                        <td><?=$list->banner_title?></td>
                                        <td><?=substr($list->banner_head,0,30)?></td>
                                        <td>
                                            <img class="img-thumbnail" src="<?=base_url('public/assets/upload/images/'.$list->cms_banner) ?>"/>
                                        </td>
                                        
                                        <td><?=$status?></td>
                                        <td>
                                            <?php if(is_privilege(7,3)){ ?>
                                            <a href="<?= base_url('/admin/add_edit_cms/'.$list->id) ?>" class="btn btn-outline-info" role="button" title="Edit"><i class="fas fa-edit"></i></a>
                                            <?php }if(is_privilege(7,4)){ ?>
                                            <a href="<?= base_url('/admin/delete_cms/'.$list->id) ?>" onclick="return confirm('Are you sure?')" class="btn btn-outline-info" role="button" style="color:red" title="Delete"><i class="fas fa-trash"></i></a>
                                            <?php } ?>
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
