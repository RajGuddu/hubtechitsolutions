<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<?php
$tableCol = 12;
$formCol = 0;
$formClass = 'd-none';

if (isset($_GET['add']) || isset($record->ic_id)) {
    $tableCol = 8;
    $formCol = 4;
    $formClass = '';
}
?>
<div class="content-wrapper">
    <!-- Main Content -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4 class="mb-0">Internship Course</h4>

        <a href="<?= base_url('admin/intern_course').'?add=1' ?>" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Add Course
        </a>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <?php if(session()->getFlashdata('message') !== NULL){
                echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
            } ?>
        </div>
    </div>
    <div class="row">
        <!-- Student List -->
        <div class="col-lg-<?= $tableCol ?>">
            <div class="card">
                <div class="table-responsive">

                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Subject Name</th>
                                <!-- <th>Fee (₹)</th> -->
                                <!-- <th>Duration (Hrs)</th> -->
                                <th>Exam Ques.</th>
                                <th>Exam Duration</th>
                                <th>PDF</th>
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
                                <td>
                                    <?= $n++ ?>
                                </td>
                                <td>
                                    <?= esc($list->ic_name) ?>
                                </td>
                                <!-- <td>₹
                                    <?php // esc($list->fee) ?>
                                </td> -->
                                <!-- <td>
                                    <?php // esc($list->duration) ?>
                                </td> -->
                                <td>
                                    <?php echo $list->exam_ques != '' ? $list->exam_ques : 'N/A'  ?>
                                </td>
                                <td>
                                    <?= $list->exam_duration != '' ? $list->exam_duration : 'N/A' ?>
                                </td>

                                <td>
                                    <?php if (!empty($list->c_pdf)) { ?>
                                    <button class="btn btn-primary btn-sm viewPdfBtn" data-pdf="<?= base_url('admin/view_pdf/' . $list->c_pdf) ?>" data-title="Study PDF">
                                        Study PDF
                                    </button>
                                    <?php }else{ echo 'Not Uploaded Yet!'; } ?>

                                    <?php /*  if (!empty($list->project_part2)) : ?>
                                    <button class="btn btn-secondary btn-sm viewPdfBtn"
                                        data-pdf="<?= site_url('secure/pdf/' . $list->project_part2) ?>">
                                        Project Part-2
                                    </button>
                                    <?php endif; */ ?>
                                </td>

                                <td>
                                    <?= $status ?>
                                </td>

                                <td
                                    class="<?= (isset($record) && $record->ic_id == $list->ic_id) ? 'bg-success' : '' ?>">
                                    <a class="btn btn-sm btn-outline-primary"
                                        href="<?= site_url('admin/intern_course/' . $list->ic_id) ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <a class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')"
                                        href="<?= site_url('admin/delete_intern_course/' . $list->ic_id) ?>">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <?php endforeach; ?>

                            <?php else : ?>

                            <tr>
                                <td colspan="9" class="text-center text-danger">
                                    No Record Available!
                                </td>
                            </tr>

                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-lg-<?= $formCol ?> <?= $formClass ?>">
            <div class="card shadow-sm">

                <div class="card-header fw-bold">
                    <?= isset($record->ic_id) ? 'Edit' : 'Add' ?> Course
                </div>

                <div class="card-body">
                    <form method="post" action="<?= current_url(true) ?>" enctype="multipart/form-data">

                        <?= csrf_field() ?>

                        <input type="hidden" name="id" value="<?= $record->ic_id ?? '' ?>">

                        <div class="mb-3">
                            <label class="form-label">Subject Name <span class="text-danger">*</span></label>
                            <input type="text" name="ic_name" value="<?= set_value('ic_name', $record->ic_name ?? '') ?>"
                                class="form-control">
                            <span class="text-danger">
                                <?= isset($validation) ? display_error($validation, 'ic_name') : '' ?>
                            </span>
                        </div>

                        <?php /* <div class="mb-3">
                            <label class="form-label">Short Description <span class="text-danger">*</span></label>
                            <textarea name="short_desc" rows="3"
                                class="form-control"><?= set_value('short_desc', $record->short_desc ?? '') ?></textarea>
                            <span class="text-danger">
                                <?= isset($validation) ? display_error($validation, 'center_name') : '' ?>
                            </span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fee <span class="text-danger">*</span></label>
                            <input type="number" name="fee" value="<?= set_value('fee', $record->fee ?? '') ?>"
                                class="form-control">
                            <span class="text-danger">
                                <?= isset($validation) ? display_error($validation, 'center_name') : '' ?>
                            </span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Duration (Hrs) <span class="text-danger">*</span></label>
                            <input type="number" name="duration" value="<?= set_value('duration', $record->duration ?? '') ?>"
                                class="form-control">
                            <span class="text-danger">
                                <?= isset($validation) ? display_error($validation, 'center_name') : '' ?>
                            </span>
                        </div> */ ?>

                        <div class="mb-3">
                            <label class="form-label">Study Material <span class="text-danger">*(PDF)</span></label>
                            <input type="file" name="c_pdf" class="form-control">
                            <input type="hidden" name="old_c_pdf" value="<?= $record->c_pdf ?? '' ?>">
                            <span class="text-danger">
                                <?= isset($validation) ? display_error($validation, 'c_pdf') : '' ?>
                            </span>
                        </div>

                        <?php /* <div class="mb-3">
                            <label class="form-label">Project Part-2 <span class="text-danger">*(PDF)</span></label>
                            <input type="file" name="project_part2" class="form-control">
                            <input type="hidden" name="old_project_part2" value="<?= $record->project_part2 ?? '' ?>">
                            <span class="text-danger">
                                <?= isset($validation) ? display_error($validation, 'center_name') : '' ?>
                            </span>
                        </div> */ ?>

                        <hr>

                        <h6 class="text-danger">Examination Section</h6>

                        <div class="mb-3">
                            <label class="form-label">Total Questions in Exam <span class="text-danger">*</span></label>
                            <input type="number" name="exam_ques"
                                value="<?= set_value('exam_ques', $record->exam_ques ?? '') ?>" class="form-control">
                            <span class="text-danger">
                                <?= isset($validation) ? display_error($validation, 'exam_ques') : '' ?>
                            </span>
                        </div>

                        <?php
                        $totalMinutes = '';

                        if (isset($record->exam_duration) && !empty($record->exam_duration)) {
                            list($hours, $minutes, $seconds) = explode(':', $record->exam_duration);
                            $totalMinutes = ($hours * 60) + $minutes + ($seconds / 60);
                        }
                        ?>

                        <div class="mb-3">
                            <label class="form-label">Exam Duration (Minutes) <span class="text-danger">*</span></label>
                            <input type="number" name="exam_duration" value="<?= set_value('exam_duration', $totalMinutes) ?>"
                                class="form-control">
                            <span class="text-danger">
                                <?= isset($validation) ? display_error($validation, 'exam_duration') : '' ?>
                            </span>
                        </div>

                        <?php /*
                        <div class="mb-3">
                            <label class="form-label">Degree Level</label>
                            <select name="dl_id" class="form-select">
                                <?php if (!empty($degrees)) : ?>
                                <?php foreach ($degrees as $list) : ?>
                                <option value="<?= $list->dl_id ?>" <?=(isset($record) && $record->dl_id == $list->dl_id) ?
                                    'selected' : '' ?>>
                                    <?= esc($list->dl_name) ?>
                                </option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                                </select>
                                <span class="text-danger">
                                    <?= validation_show_error('dl_id') ?>
                                </span>
                        </div>
                        */ ?>

                        <div class="mb-3">
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

                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Save
                        </button>

                        <a href="<?= site_url('admin/intern_course') ?>" class="btn btn-secondary">
                            <i class="fa-solid fa-xmark me-1"></i> Cancel
                        </a>

                    </form>
                </div>

            </div>
        </div>

        <div class="col-md-12">
            <?php // echo $pagination; ?>
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