<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>

<style>
    .student-card {
        transition: all .2s;
    }

    .student-card:hover {
        background: #f8f9fa;
    }

    .student-card.active {
        background: #eef5ff;
        border-left: 5px solid #0d6efd !important;
    }
</style>

<div class="content-wrapper">
    <!-- Main Content -->
    <div class="row mb-3">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body py-2">

                    <form method="post" action="<?=base_url('admin/intern-students')?>">
                        <?=csrf_field()?>
                        <div class="row">

                            <div class="col-md-9">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Search by Name, Email, Phone & Application ID"
                                    value="<?=session('intern_student_search')?>">
                            </div>

                            <div class="col-md-3 d-flex gap-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    Search
                                </button>

                                <?php if(session('intern_student_search')){ ?>
                                <a href="<?=base_url('admin/intern-students/reset-search')?>" class="btn btn-secondary">
                                    Reset
                                </a>
                                <?php } ?>

                            </div>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
    <div class="row">

        <!-- Student List -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Intern Students (
                        <?=$caption?>)
                    </h5>
                </div>

                <div class="card-body">
                    <?php $selected_id = service('uri')->getSegment(3); ?>
                    <?php if(!empty($records)){
                    foreach($records as $list){ 
                    if(!$selected_id) $selected_id = $list->ie_id;
                    ?>

                    <div class="border rounded p-2 mb-2 student-card <?=($selected_id == $list->ie_id)?'active':''?>">
                        <strong><?=ucwords($list->stu_name)?></strong><br>
                        <small><?=$list->email?></small><br>
                        <small><?=$list->phone?></small><br>
                        <div class="mt-2 d-flex align-items-center justify-content-between">
                            <span class="badge bg-success">Approved</span>

                            <div>
                                <?php $viewUrl = base_url('admin/intern-students/'.$list->ie_id);
                                if(isset($_GET['page'])){
                                    $viewUrl = base_url('admin/intern-students/'.$list->ie_id).'?page='.$_GET['page'];
                                }
                                ?>

                                <a href="<?=$viewUrl?>"
                                    class="btn btn-primary btn-sm">
                                    <i class="mdi mdi-eye"></i>
                                </a>

                                <?php /* 
                                <a href="#" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    <i class="mdi mdi-delete"></i>
                                </a> */ ?>
                            </div>
                        </div>
                    </div>
                    <?php } }else{
                        echo '<small class="text-center text-danger">No Record Available</small>'; 
                    } ?>

                </div>
            </div>
        </div>

        <!-- Details -->
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Student Details <strong
                            class="text-primary">(<?=ucwords($record->stu_name??'') ?>)</strong></h5>
                </div>
                <div class="card-body">
                    <?php if(!empty($record)){ ?>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Personal Information</h6>
                            <p><strong>Name:</strong> <?=ucwords($record->stu_name) ?></p>
                            <p><strong>Email:</strong> <?=$record->email ?></p>
                            <p><strong>Phone:</strong> <?=$record->phone ?></p>
                            <p><strong>Gender:</strong> <?=($record->genger == 'M')?'Male':'Female'?></p>
                            <p><strong>Submit Date:</strong>
                                <?=date('d M Y h:i A',strtotime($record->added_at))?>
                            </p>
                        </div>

                        <div class="col-md-6">
                            <h6>Academic Information</h6>
                            <p><strong>College:</strong> <?=ucwords($record->college_name)?></p>
                            <p><strong>Class:</strong> <?=$record->class?></p>
                            <p><strong>MJC:</strong> <?=strtoupper($record->sub_name)?></p>
                            <p><strong>University Roll No:</strong> <?=$record->uni_roll_no?></p>
                            <p><strong>University Reg No:</strong> <?=$record->uni_reg_no?></p>
                        </div>
                    </div>

                    <hr>

                    <h6 class="mb-3">Internship Programs</h6>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <div class="card border">
                                <div class="card-body">
                                    <h6><?=ucwords(strtolower($record->ic_name))?></h6>
                                    <p class="mb-2">Application ID : <?=$record->enroll_id?></p>
                                    <p class="mb-2">Session : <?=$record->session?></p>
                                    <p class="mb-2">Semester : <?=$record->semester?></p>
                                    <span class="badge bg-success">Approved</span>
                                    <?php /*
                                    <hr>
                                    <button class="btn btn-primary btn-sm w-100">
                                        View Details
                                    </button> */ ?>
                                </div>
                            </div>
                        </div>

                        <?php /* 
                        <div class="col-md-6 mb-3">
                            <div class="card border">
                                <div class="card-body">
                                    <h6>Data Science</h6>
                                    <p class="mb-2">Application ID : APP002</p>
                                    <span class="badge bg-warning">Pending</span>
                                    <hr>
                                    <button class="btn btn-primary btn-sm w-100">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div> */ ?>

                    </div>

                    <?php /* 
                    <div class="text-end mt-4">
                        <button class="btn btn-danger">
                            Change Status
                        </button>
                    </div> */ ?>
                    <?php }else{
                        echo '<small class="text-center text-danger">No Record Available</small>';
                    } ?>

                </div>

            </div>

        </div>
        <div class="col-md-12">
            <?php /*<div class="d-flex justify-content-center gap-1 mt-3">
                <a href="#" class="btn btn-outline-secondary btn-sm"><<</a>
                <a href="#" class="btn btn-outline-secondary btn-sm"><</a>

                <a href="#" class="btn btn-outline-primary btn-sm active">1</a>

                <a href="#" class="btn btn-outline-primary btn-sm ">2</a>

                <a href="#" class="btn btn-outline-primary btn-sm">3</a>
                <a href="#" class="btn btn-outline-primary btn-sm">4</a>
                <a href="#" class="btn btn-outline-primary btn-sm">5</a>

                <a href="#" class="btn btn-outline-secondary btn-sm">></a>
                <a href="#" class="btn btn-outline-secondary btn-sm">>></a>

            </div> */ ?>
            <?php echo $pagination?>
        </div>

    </div>

</div>

<?=$this->endSection() ?>