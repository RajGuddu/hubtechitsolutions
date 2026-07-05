<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="card-title card-title-dash">Banners</h4>
                                <!-- <p class="card-subtitle card-subtitle-dash">You have 50+ new requests</p> -->
                            </div>
                            <?php if(is_privilege(11,2)){ ?>
                            <div>
                                <a href="<?=base_url('admin/add_edit_banner')?>" class="btn btn-primary btn-sm text-white mb-0 me-0" role="button"> Add Banner</a>
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
                                    <th>Banner Main Title</th>
                                    <th>Banner Sub Title</th>
                                    <th>Page For</th>
                                    <!--<th>Url</th>-->
                                    <th>Brochure</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($banner)){
                                    $sn=1;
                                    foreach($banner as $list){ ?>
                                    <tr>
                                        <td><?=$sn++?></td>
                                        <td><?=$list->main_title?></td>
                                        <td><?=$list->sub_title?></td>
                                        <td><?=$list->page_name?></td>
                                        <!--<td><?=$list->url?></td>-->
                                        <td>
                                            <img alt="image" src="<?=($list->brochure != '')?base_url('public/assets/upload/images/'.$list->brochure):base_url('public/assets/upload/images/dummy.png')?>" weight="100px" height="80"/>
                                        </td>
                                        <td><?=($list->status=='1')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-warning">InActive</span>'?></td>
                                        <td>
                                            <?php if(is_privilege(11,3)){ ?>
                                            <a href="<?= base_url('/admin/add_edit_banner/'.$list->id) ?>" class="btn btn-outline-info"><i class="far fa-edit"></i></a>
                                            <?php } ?>
                                            <!--<a href="<?= base_url('/admin/users/view_one/'.$list->id) ?>"><i class="far fa-eye"></i></a>-->
                                            <?php if(is_privilege(11,4)){ ?>
                                            <a href="<?= base_url('/admin/delete_banner/'.$list->id) ?>" onclick="return confirm('Are you sure?')" class="btn btn-outline-info" style="color:red"><i class="fas fa-trash"></i></a>
                                            <?php } ?>
                                            
                                        </td>
                                    </tr>
                                    <?php } } else { ?>
                                        <tr><td colspan="8" class="text-center text-danger">No Data Available</td></tr>
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
