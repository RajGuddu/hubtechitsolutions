<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<?php
$tableCol = 12;
$formCol = 0;
$formClass = 'd-none';

if (isset($_GET['add']) || isset($record->vc_id)) {
    $tableCol = 8;
    $formCol = 4;
    $formClass = '';
}
?>
<div class="content-wrapper">
    <!-- Main Content -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4 class="mb-0">Vocational Course</h4>

        <div class="">
        <a href="<?= base_url('admin/vocational-course').'?add=1' ?>" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Add Course
        </a>
        <?php if($formCol != 0){ ?>
        <a href="<?= site_url('admin/vocational-course') ?>" class="btn btn-danger">
            <i class="fa-solid fa-xmark me-1"></i> Cancel
        </a>
        <?php } ?>
        </div>
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
                                <th>Sort Order</th>
                                <th>Course Name</th>
                                <th>Course Category</th>
                                <th>Course Short Name</th>
                                <th>Duration</th>
                                <th>Exam Fee (₹)</th>
                                <th>Course Fee (₹)</th>
                                <th>Exam Ques.</th>
                                <th>Exam Duration (Min)</th>
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
                            
                            $totalMinutes = '';

                            if (isset($list->exam_duration) && !empty($list->exam_duration)) {
                                list($hours, $minutes, $seconds) = explode(':', $list->exam_duration);
                                $totalMinutes = ($hours * 60) + $minutes + ($seconds / 60);
                            }
                            $courseCat = '<span class="badge bg-success">Computer</span>';
                            if($list->course_cat == 'B'){
                                $courseCat = '<span class="badge bg-primary">Beautician</span>';
                            }elseif($list->course_cat == 'T'){
                                $courseCat = '<span class="badge bg-warning">Tailoring</span>';
                            }
                            ?>

                            <tr>
                                <td><?= $n++ ?></td>
                                <td><?= $list->sort_order ?></td>
                                <td><?= esc($list->course_name) ?></td>
                                <td><?= $courseCat ?></td>
                                <td><?= esc($list->course_short_name) ?></td>
                                <td><?= esc($list->duration) ?></td>
                                <td>₹<?= esc($list->exam_fee) ?></td>
                                <td>₹<?= esc($list->course_fee) ?></td>
                                <td><?= esc($list->total_questions) ?></td>
                                <td><?php echo $totalMinutes ?></td>
                                <td><?= $status ?></td>

                                <td
                                    class="<?= (isset($record) && $record->vc_id == $list->vc_id) ? 'bg-success' : '' ?>">
                                    <a class="btn btn-sm btn-outline-primary"
                                        href="<?= site_url('admin/vocational-course/' . $list->vc_id) ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <a class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')"
                                        href="<?= site_url('admin/delete_v_course/' . $list->vc_id) ?>">
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
                    <?= isset($record->vc_id) ? 'Edit' : 'Add' ?> V-Course
                </div>

                <div class="card-body">
                    <form method="post" action="<?= current_url(true) ?>" enctype="multipart/form-data">

                        <?= csrf_field() ?>

                        <input type="hidden" name="id" value="<?= $record->vc_id ?? '' ?>">
                        <input type="hidden" name="old_order" value="<?= $record->sort_order ?? $newOrder ?>">
                        <input type="hidden" name="new_order" value="<?= $newOrder ?>">

                        <div class="mb-3">
                            <label class="form-label">Course Short Name <span class="text-danger">*</span></label>
                            <input type="text" name="course_short_name" value="<?= set_value('course_short_name', $record->course_short_name ?? '') ?>" class="form-control">
                            <span class="text-danger">
                                <?= isset($validation) ? display_error($validation, 'course_short_name') : '' ?>
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Course Name <span class="text-danger">*</span></label>
                            <input type="text" name="course_name" value="<?= set_value('course_name', $record->course_name ?? '') ?>" class="form-control">
                            <span class="text-danger">
                                <?= isset($validation) ? display_error($validation, 'course_name') : '' ?>
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Course Category <span class="text-danger">*</span></label>
                            <select class="form-select" name="course_cat" id="course_cat">
                                <option value="C" <?=set_select('course_cat', 'C', (isset($record->course_cat) && $record->course_cat == 'C')?TRUE:FALSE) ?>>Computer</option>
                                <option value="B" <?=set_select('course_cat', 'B', (isset($record->course_cat) && $record->course_cat == 'B')?TRUE:FALSE) ?>>Beautician </option>
                                <option value="T" <?=set_select('course_cat', 'T', (isset($record->course_cat) && $record->course_cat == 'T')?TRUE:FALSE) ?>>Tailoring  </option>
                            </select>
                            <span class="text-danger">
                                <?= isset($validation) ? display_error($validation, 'course_cat') : '' ?>
                            </span>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Duration</label>
                            <select name="duration" class="form-select">
                                <option value="">Select One</option>
                                <?php for ($i = 1; $i <= 12; $i++): ?>
                                    <?php $duration = $i . ' Month' . ($i > 1 ? 's' : ''); ?>

                                    <option value="<?= $duration ?>"
                                        <?= set_select('duration', $duration, (isset($record->duration) && $record->duration== $duration)) ?>>
                                        <?= $duration ?>
                                    </option>
                                <?php endfor; ?>
                                
                            </select>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'duration') : '' ?></span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Exam Fee <span class="text-danger">*</span></label>
                            <input type="text" name="exam_fee" value="<?= set_value('exam_fee', $record->exam_fee ?? '') ?>"
                                class="form-control">
                            <span class="text-danger">
                                <?= isset($validation) ? display_error($validation, 'exam_fee') : '' ?>
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Course Fee <span class="text-danger">*</span></label>
                            <input type="text" name="course_fee" value="<?= set_value('course_fee', $record->course_fee ?? '') ?>"
                                class="form-control">
                            <span class="text-danger">
                                <?= isset($validation) ? display_error($validation, 'course_fee') : '' ?>
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sort Order <span class="text-danger">*</span></label>
                            <input type="text" name="sort_order" value="<?= set_value('sort_order', $record->sort_order ?? $newOrder) ?>"
                                class="form-control">
                            <span class="text-danger">
                                <?= isset($validation) ? display_error($validation, 'sort_order') : '' ?>
                            </span>
                        </div>

                        <hr>
                        <h6 class="text-danger">Examination Section</h6>

                        <div class="mb-3">
                            <label class="form-label">Total Questions in Exam <span class="text-danger">*</span></label>
                            <input type="text" name="total_questions"
                                value="<?= set_value('total_questions', $record->total_questions ?? '') ?>" class="form-control">
                            <span class="text-danger">
                                <?= isset($validation) ? display_error($validation, 'total_questions') : '' ?>
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
                            <input type="text" name="exam_duration" value="<?= set_value('exam_duration', $totalMinutes) ?>"
                                class="form-control">
                            <span class="text-danger">
                                <?= isset($validation) ? display_error($validation, 'exam_duration') : '' ?>
                            </span>
                        </div>

                        <hr>
                        <h6 class="text-danger">Icon Section</h6>
                        <div class="mb-3">
                            <label class="form-label">Icon</label>
                            <select name="icon" class="form-select">
                                <option value="">Select One</option>
                                <?php $icons = ['ri-computer-line','ri-code-line','ri-calculator-line','ri-code-s-slash-line','ri-palette-line','ri-volume-up-line','ri-money-dollar-circle-line','ri-file-word-line','ri-keyboard-line','ri-shield-keyhole-line'];
                                    foreach ($icons as $icon): ?>
                                    <option value="<?= $icon ?>"
                                        <?= set_select('icon', $icon, (isset($record->icon) && $record->icon== $icon)) ?>>
                                        <?= $icon ?>
                                    </option>
                                <?php endforeach; ?>
                                
                            </select>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'icon') : '' ?></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon Color</label>
                            <select name="icon_color" class="form-select">
                                <option value="">Select One</option>
                                <?php $iconColor = ['primary','success','warning','danger','info'];
                                    foreach ($iconColor as $color): ?>
                                    <option value="<?= $color ?>"
                                        <?= set_select('icon_color', $color, (isset($record->icon_color) && $record->icon_color== $color)) ?>>
                                        <?= $color ?>
                                    </option>
                                <?php endforeach; ?>
                                
                            </select>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'icon_color') : '' ?></span>
                        </div>

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

                        <a href="<?= site_url('admin/vocational-course') ?>" class="btn btn-danger">
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