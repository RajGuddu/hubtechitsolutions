<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="card-title card-title-dash">Faqs</h4>
                                <!-- <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p> -->
                            </div>
                            <?php if(is_privilege(9,2)){ ?>
                            <div>
                                <a href="<?=base_url('admin/add_edit_faq')?>" class="btn btn-primary btn-sm text-white mb-0 me-0" role="button"> Add Faq</a>
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
                                    <th>Faq Title</th>
                                    <th>Description</th>
                                    <!-- <th>Position</th> -->
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($faqs)){
                                    $sn=1;
                                    foreach($faqs as $list){ ?>
                                    <tr>
                                        <td><?=$sn++?></td>
                                        <td><?=$list->faq_title?></td>
                                        <td><?=substr($list->faq_description,0,50).'...'?></td>
                                        <!-- <td><?=$list->faq_position?></td> -->
                                        <td><?=($list->faq_status=='1')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-warning">Inactive</span>'?></td>
                                        <td>
                                            <?php if(is_privilege(9,3)){ ?>
                                            <a href="<?= base_url('/admin/add_edit_faq/'.$list->faq_id) ?>" class="btn btn-outline-info" title="Edit"><i class="fas fa-edit"></i></a>
                                            <?php } ?>
                                            <!--<a href="<?= base_url('/admin/users/view_one/'.$list->faq_id) ?>"><i class="far fa-eye"></i></a>-->
                                            <?php if(is_privilege(9,4)){ ?>
                                            <a href="<?= base_url('/admin/delete_faq/'.$list->faq_id) ?>" class="btn btn-outline-info" title="Delete" onclick="return confirm('Are you sure?')" style="color:red"><i class="fas fa-trash"></i></a>
                                            <?php } ?>
                                            
                                        </td>
                                    </tr>
                                    <?php } } else { ?>
                                        <tr><td colspan="6" class="text-center">No Data Available</td></tr>
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
