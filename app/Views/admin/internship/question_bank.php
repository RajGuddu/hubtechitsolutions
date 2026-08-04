<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<?php
$formClass = 'd-none';

if (isset($_GET['add']) || isset($record->q_id)) {
    $formClass = '';
}
?>
<div class="content-wrapper">
    <!-- Main Content -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4 class="mb-0">Question Bank (<?=$caption?>)</h4>

        <a href="<?= base_url('admin/question_bank').'?add=1' ?>" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Add Question
        </a>
    </div>
    <div class="row mb-2">
        <div class="col-md-12">
            <?php if(session()->getFlashdata('message') !== NULL){
                echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
            } ?>
        </div>
    </div>
    <div class="row">
        
        <div class="col-lg-12 mb-2 <?= $formClass ?>">
            <div class="card shadow-sm">

                <div class="card-header fw-bold">
                    <?= isset($record->q_id) ? 'Edit' : 'Add' ?> Question
                </div>

                <div class="card-body">
                    <form method="post" action="<?= current_url(true) ?>" enctype="multipart/form-data">

                        <?= csrf_field() ?>

                        <input type="hidden" name="id" value="<?= $record->q_id ?? '' ?>">
                        <input type="hidden" name="form" value="question_form">

                        <div class="mb-2">
                            <label class="form-label">Select Subject <span class="text-danger">*</span></label>
                            <select name="ic_id" id="ic_id" class="form-select">
                                <option value="">Select any one!</option>
                                <?php if(!empty($subjects)){
                                foreach($subjects as $list){ ?>
                                    <option value="<?=$list->ic_id?>" <?=set_select('ic_id', $list->ic_id,((isset($record) && $record->ic_id == $list->ic_id) || session('ic_id')==$list->ic_id)?true:'') ?>><?=$list->ic_name?></option>
                                <?php } } ?>
                            </select>
                            <span class="text-danger">
                                <?= isset($validation) ? display_error($validation, 'ic_id') : '' ?>
                            </span>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-12 mb-2">
                                <label class="form-label"> Question Title<span class="text-danger">*</span></label>
                                <input type="text" name="question_title" value="<?=set_value('question_title', $record->question_title ?? '')?>" class="form-control">
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'question_title') : '' ?>
                                </span>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Option A<span class="text-danger">*</span></label>
                                <input type="text" name="opt_a" value="<?=set_value('opt_a', $record->opt_a ?? '')?>" class="form-control">
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'opt_a') : '' ?>
                                </span>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Option B<span class="text-danger">*</span></label>
                                <input type="text" name="opt_b" value="<?=set_value('opt_b', $record->opt_b ?? '')?>" class="form-control">
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'opt_b') : '' ?>
                                </span>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Option C<span class="text-danger">*</span></label>
                                <input type="text" name="opt_c" value="<?=set_value('opt_c', $record->opt_c ?? '')?>" class="form-control">
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'opt_c') : '' ?>
                                </span>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Option D<span class="text-danger">*</span></label>
                                <input type="text" name="opt_d" value="<?=set_value('opt_d', $record->opt_d ?? '')?>" class="form-control">
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'opt_d') : '' ?>
                                </span>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Correct Option<span class="text-danger">*</span></label>
                                <select name="correct_opt" id="correct_opt" class="form-select">
                                    <option value="">Select any one!</option>
                                    <option value="A" <?=set_select('correct_opt','A',(isset($record) && $record->correct_opt == 'A')?true:'')?>>A</option>
                                    <option value="B" <?=set_select('correct_opt','B',(isset($record) && $record->correct_opt == 'B')?true:'')?>>B</option>
                                    <option value="C" <?=set_select('correct_opt','C',(isset($record) && $record->correct_opt == 'C')?true:'')?>>C</option>
                                    <option value="D" <?=set_select('correct_opt','D',(isset($record) && $record->correct_opt == 'D')?true:'')?>>D</option>
                                </select>
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'correct_opt') : '' ?>
                                </span>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select">
                                    <option value="1" <?=(isset($record) && $record->status == 1) ? 'selected' : '' ?>>
                                        Active
                                    </option>
                                    <option value="0" <?=(isset($record) && $record->status == 0) ? 'selected' : '' ?>>
                                        Inactive
                                    </option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Save
                        </button>

                        <a href="<?= site_url('admin/question_bank') ?>" class="btn btn-secondary">
                            <i class="fa-solid fa-xmark me-1"></i> Cancel
                        </a>

                    </form>
                </div>

            </div>
        </div>
        <div class="col-md-12 mb-2">
            <div class="card">
                <div class="card-body py-2">
                    <form method="post" action="<?=base_url('admin/question_bank')?>">
                        <?=csrf_field()?>
                        <input type="hidden" name="form" value="search_form">
                        <div class="row">
                            <div class="col-md-9">
                                <select name="s_ic_id" id="s_ic_id" class="form-select">
                                    <option value="">Select any one!</option>
                                    <?php if(!empty($subjects)){
                                    foreach($subjects as $list){ ?>
                                        <option value="<?=$list->ic_id?>" <?=set_select('s_ic_id', $list->ic_id,(session('s_ic_id')==$list->ic_id)?true:'') ?>><?=$list->ic_name?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex gap-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    Search
                                </button>
                                <?php if(session('s_ic_id')){ ?>
                                <a href="<?=base_url('admin/question_reset_search')?>" class="btn btn-secondary">
                                    Reset
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
        <!-- Question List -->
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Subject Name</th>
                                    <th>Question Title</th>
                                    <th>OPT A</th>
                                    <th>OPT B</th>
                                    <th>OPT C</th>
                                    <th>OPT D</th>
                                    <th>Correct Option</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if (isset($records) && !empty($records)) : ?>
                                <?php $n = 1; ?>

                                <?php foreach ($records as $list) : ?>

                                <?php
                                $status = ($list->status == 1)
                                    ? '<span class="badge bg-success">Active</span>'
                                    : '<span class="badge bg-danger">Inactive</span>';
                                ?>

                                <tr>
                                    <td><?= $n++ ?> </td>
                                    <td><?= esc($list->ic_name) ?></td>
                                    <td><?php echo $list->question_title  ?></td>
                                    <td><?= $list->opt_a ?></td>
                                    <td><?= $list->opt_b ?></td>
                                    <td><?= $list->opt_c ?></td>
                                    <td><?= $list->opt_d ?></td>
                                    <td><?= $list->correct_opt ?></td>
                                    <td><?= $status ?></td>

                                    <td
                                        class="<?= (isset($record) && $record->q_id == $list->q_id) ? 'bg-success' : '' ?>">
                                        <a class="btn btn-sm btn-outline-primary"
                                            href="<?= site_url('admin/question_bank/' . $list->q_id) ?>">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        <a class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')"
                                            href="<?= site_url('admin/delete_question/' . $list->q_id) ?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                <?php endforeach; ?>

                                <?php else : ?>

                                <tr>
                                    <td colspan="10" class="text-center text-danger">
                                        No Record Available!
                                    </td>
                                </tr>

                                <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
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
            <form action="<?=base_url('/admin/refund_amount')?>" method="post" id="refundForm">
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
                        <input type="number" class="form-control" name="amount" id="amount" min="1" step="0.01">
                        <div class="invalid-feedback" id="amount_error"></div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Reason<span class="text-danger">*</span></label>
                        <textarea class="form-control" name="reason" id="reason" rows="4"></textarea>
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