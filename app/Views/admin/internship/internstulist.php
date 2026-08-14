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
                                    placeholder="Search by Name, Email & Phone"
                                    value="<?=session('intern_student_search')?>" required>
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
            <?php if(session()->getFlashdata('message') !== NULL){
                echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
            } ?>
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
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <?php
                                $photo = !empty($list->image)
                                    ? base_url(IMAGE_PATH.$list->image)
                                    : base_url('assets/images/user.png'); // Default Image
                                ?>
                                <img src="<?= $photo ?>" alt="Student Photo" class="rounded-circle border" width="60"
                                    height="60" style="object-fit:cover;">
                            </div>
                            <div class="flex-grow-1">
                                <strong>
                                    <?= ucwords($list->stu_name) ?>
                                </strong><br>
                                <small>
                                    <?= $list->email ?>
                                </small><br>
                                <small>
                                    <?= $list->phone ?>
                                </small>
                            </div>
                        </div>
                        <div class="mt-2 d-flex align-items-center justify-content-between">
                            <?= get_intern_stu_status($list->status); ?>
                            <div>
                                <?php
                                $viewUrl = base_url('admin/intern-students/'.$list->ie_id);
                                if(isset($_GET['page'])){
                                    $viewUrl .= '?page='.$_GET['page'];
                                }
                                ?>
                                <a href="<?= $viewUrl ?>" class="btn btn-primary btn-sm">
                                    <i class="mdi mdi-eye"></i>
                                </a>
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
                            <?php $academic = ($record->academic != NULL)?json_decode($record->academic):''; ?>
                            <p><strong>10th Board:</strong> <?=ucwords($academic->board1 ?? 'N/A')?></p>
                            <p><strong>10th Passing Year:</strong> <?=$academic->passyear1 ?? 'N/A'?></p>
                            <p><strong>10th Percentage:</strong> <?=$academic->percentage1 ?? 'N/A'?></p>
                            <br>
                            <p><strong>12th Board:</strong> <?=ucwords($academic->board2 ?? 'N/A')?></p>
                            <p><strong>12th Passing Year:</strong> <?=$academic->passyear2 ?? 'N/A'?></p>
                            <p><strong>12th Percentage:</strong> <?=$academic->percentage2 ?? 'N/A'?></p>
                        </div>
                    </div>
                    <hr>
                    <h6 class="mb-3">Internship Programs</h6>
                    <div class="row">
                        <?php if(isset($courses) && !empty($courses)){
                        foreach($courses as $course){ 
                            $studentData = base64_encode(json_encode([
                                'internship_course'    => $course->ic_name,
                                'student_name'         => ucwords($course->stu_name),
                                'email'                => $course->email,
                                'mobile'               => $course->phone,
                                'university_roll_no'   => $course->uni_roll_no,
                                'university_reg_no'    => $course->uni_reg_no,
                                'class'                => $course->class,
                                'mjc'                  => $course->mjc_subject,
                                'session'              => $course->session,
                                'semester'             => $course->semester,
                                'college'              => $course->college_name,
                                'status'               => get_intern_program_status($course->status), // HTML Badge
                                'image'                => !empty($course->image)
                                                            ? base_url(IMAGE_PATH.$course->image)
                                                            : 'https://ui-avatars.com/api/?name='.$course->stu_name.'&background=80082b&color=fff&size=150',
                                'enroll_id'            => $course->enroll_id,
                                'attendence'           => $course->attendence,
                            ]));    
                        ?>
                        <div class="col-md-6 mb-3">
                            <div class="card border">
                                <div class="card-body">
                                    <h6><?=ucwords(strtolower($course->ic_name))?></h6>
                                    <p class="mb-2">Application ID : <?=$course->enroll_id?></p>
                                    <p class="mb-2">Session : <?=$course->session?></p>
                                    <p class="mb-2">Semester : <?=$course->semester?></p>
                                    <?= get_intern_program_status($course->status) ?>
                                    
                                    <!-- Action Buttons -->
                                    <div class="d-flex justify-content-center gap-2 my-1">
                                        <?php if($course->status == 5){ ?>
                                        <a href="<?=base_url('admin/update_refund_status/'.$course->ia_id)?>" class="btn btn-outline-danger btn-sm"
                                            data-bs-toggle="tooltip" title="Refresh Status">
                                            <i class="fa-solid fa-rotate"></i>
                                        </a>
                                        <div class="ms-auto">
                                            <small>Refund Status: <span class="text-danger"><?=ucwords($course->refund_status)?></span></small>
                                            <small>Refund Amount: <span class="text-danger">₹ <?=$course->refund_amount?></span></small>
                                        </div>
                                        <?php }else{ ?>
                                        <a href="javascript:void(0)" class="btn btn-outline-primary btn-sm viewPdfBtn"
                                            data-bs-toggle="tooltip" title="Download Letter"
                                            data-pdf="<?= base_url('admin/get_offer_letter_pdf/'.$course->ia_id) ?>"
                                            data-title="Offer Letter">
                                            <i class="fa-solid fa-file-lines"></i>
                                        </a>
                                        <?php if($course->status == 1){ ?>
                                        <a href="javascript:void(0)" class="btn btn-outline-warning btn-sm btnRefund"
                                            data-ia_id="<?= $course->ia_id; ?>" data-bs-toggle="tooltip" title="Refund">
                                            <i class="fa-solid fa-money-bill-wave"></i>
                                        </a>
                                        <?php }elseif($course->status == 3){ ?>
                                        <a href="javascript:void(0)" class="btn btn-outline-success btn-sm viewPdfBtn"
                                            data-bs-toggle="tooltip" title="Attendance Certificate" data-pdf="<?= base_url('admin/atten_cert_pdf/'.base64_encode($course->ia_id)) ?>" data-title="Attendance Certificate">
                                            <i class="fa-solid fa-calendar-check"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-outline-success btn-sm viewPdfBtn" data-bs-toggle="tooltip" title="Cover Page" data-pdf="<?= base_url('admin/cover_page_pdf/'.base64_encode($course->ia_id)) ?>" data-title="Cover Page">
                                            <i class="fa-solid fa-file-arrow-down"></i>
                                        </a>
                                        <?php $project_part2 = $course->project_part2 != '' ? $course->project_part2 : 'NULL' ?>
                                        <a href="javascript:void(0)" class="btn btn-outline-success btn-sm viewPdfBtn"
                                            data-bs-toggle="tooltip" title="Project" data-pdf="<?= base_url('admin/view_pdf/'.$project_part2) ?>" data-title="Project">
                                            <i class="fa-solid fa-folder-open"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-outline-success btn-sm viewPdfBtn"
                                            data-bs-toggle="tooltip" title="Download Certificate" data-pdf="<?= base_url('admin/intern_cert_pdf/'.base64_encode($course->ia_id)) ?>" data-title="Internship Certificate">
                                            <i class="fa-solid fa-award"></i>
                                        </a>
                                        
                                        <?php } } ?>
                                    </div>
                                    <button class="btn btn-primary btn-sm w-100 student-details"
                                        data-student="<?= esc($studentData, 'attr') ?>">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php } }else{
                            echo '<p class="text-danger text-center">No record available!</p>';
                        } ?>
                    </div>
                    <?php }else{
                        echo '<small class="text-center text-danger">No Record Available</small>';
                    } ?>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <?php echo $pagination; ?>
        </div>
    </div>
</div>
<!-- Student Details Modal -->
<div class="modal fade" id="studentDetailsModal" tabindex="-1">
    <div class="modal-dialog" style="max-width:800px;">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="ri-user-3-line me-2 text-primary"></i>
                    Student Course Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-1">
                <div class="row">
                    <!-- Left Side -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <small class="text-muted d-block">Course</small>
                                <strong id="m_course"></strong>
                            </div>
                            <div class="col-md-6 mb-2">
                                <small class="text-muted d-block">Email</small>
                                <strong id="m_email"></strong>
                            </div>
                            <div class="col-md-6 mb-2">
                                <small class="text-muted d-block">Mobile</small>
                                <strong id="m_mobile"></strong>
                            </div>
                            <div class="col-md-6 mb-2">
                                <small class="text-muted d-block">University Roll No</small>
                                <strong id="m_university_roll_no"></strong>
                            </div>
                            <div class="col-md-6 mb-2">
                                <small class="text-muted d-block">University Reg No</small>
                                <strong id="m_university_reg_no"></strong>
                            </div>
                            <div class="col-md-6 mb-2">
                                <small class="text-muted d-block">Class</small>
                                <strong id="m_class"></strong>
                            </div>
                            <div class="col-md-6 mb-2">
                                <small class="text-muted d-block">MJC</small>
                                <strong id="m_mjc"></strong>
                            </div>
                            <div class="col-md-6 mb-2">
                                <small class="text-muted d-block">Session</small>
                                <strong id="m_session"></strong>
                            </div>
                            <div class="col-md-6 mb-2">
                                <small class="text-muted d-block">Semester</small>
                                <strong id="m_semester"></strong>
                            </div>
                            <div class="col-md-6 mb-2">
                                <small class="text-muted d-block">College/Institute</small>
                                <strong id="m_college"></strong>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block">Attendance</small>
                                <strong id="m_atn"></strong>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block">Status</small>
                                <span id="m_status"></span>
                            </div>
                        </div>
                    </div>
                    <!-- Right Side -->
                    <div class="col-md-4 text-center border-start">
                        <img src="" class="img-fluid rounded shadow-sm border p-2" style="max-height:200px;"
                            id="m_image">
                        <h6 class="mt-3 mb-1 fw-bold" id="m_student_name"></h6>
                        <small class="text-muted">
                            Application ID : <span id="enroll_id"></span>
                        </small>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-0">
                <button class="btn btn-primary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- PDF View Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1">
    <div class="modal-dialog modal-xl mt-0">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">View PDF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <iframe id="pdfFrame" src="" style="width:100%; height:80vh;"></iframe>
            </div>
        </div>
    </div>
</div>
<!-- Refund Modal -->
<div class="modal fade" id="refundModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url('/admin/refund_amount')?>" method="post" id="refundForm" >
                <?=csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-money-bill-wave me-2"></i>
                        Refund Request
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ia_id" id="course_id">
                    <div class="mb-2">
                        <label class="form-label">Refund Amount<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="amount" id="amount" min="1" step="0.01" >
                        <div class="invalid-feedback" id="amount_error"></div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Reason<span class="text-danger">*</span></label>
                        <textarea class="form-control" name="reason" id="reason" rows="4" ></textarea>
                        <div class="invalid-feedback" id="reason_error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fa-solid fa-paper-plane"></i>
                        Submit Refund
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?=$this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    $(function () {
        // Open Modal
        $(document).on('click', '.btnRefund', function () {
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').html('');
            let course_id = $(this).data('ia_id');
            $('#course_id').val(course_id);
            $('#amount').val('');
            $('#reason').val('');
            $('#refundModal').modal('show');
        });
        // Submit Form
        $('#refundForm').on('submit', function (e) {
            let valid = true;

            // Reset Errors
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').html('');

            let amount = $.trim($('#amount').val());
            let reason = $.trim($('#reason').val());

            if (amount == '' || parseFloat(amount) <= 0) {
                $('#amount').addClass('is-invalid');
                $('#amount_error').html('Please enter a valid refund amount.');
                valid = false;
            }

            if (reason == '') {
                $('#reason').addClass('is-invalid');
                $('#reason_error').html('Please enter refund reason.');
                valid = false;
            }
            if (!valid) {
                e.preventDefault();
                return;
            }

            if (!confirm('Are you sure you want to submit this refund request?')) {
                e.preventDefault();
            }
        });
    });
    $(document).ready(function () {
        $('.viewPdfBtn').on('click', function () {
            var pdfUrl = $(this).data('pdf');
            var title = $(this).data('title');
            //alert(pdfUrl) ; return 0;
            $('#modal-title').text(title);
            $('#pdfFrame').attr('src', pdfUrl + '?t=' + new Date().getTime());
            $('#pdfModal').modal('show');
        });
        $('#pdfModal').on('hidden.bs.modal', function () {
            $('#pdfFrame').attr('src', '');
        });
    });
    $(document).on('click', '.student-details', function (e) {
        // alert('Hi'); return false;
        let data = JSON.parse(atob($(this).data('student')));
        $('#m_course').text(data.internship_course);
        $('#m_student_name').text(data.student_name);
        $('#m_email').text(data.email);
        $('#m_mobile').text(data.mobile);
        $('#m_university_roll_no').text(data.university_roll_no);
        $('#m_university_reg_no').text(data.university_reg_no);
        $('#m_class').text(data.class);
        $('#m_mjc').text(data.mjc);
        $('#m_session').text(data.session);
        $('#m_semester').text(data.semester);
        $('#m_college').text(data.college);
        // $('#m_internship_course').text(data.internship_course);
        $('#m_status').html(data.status);
        $('#m_image').attr('src', data.image);
        $('#enroll_id').text(data.enroll_id);
        $('#m_atn').text(data.attendence + '%');
        // Open Modal
        $('#studentDetailsModal').modal('show');
    });
</script>
<?= $this->endSection() ?>