<div class="container-fluid py-0">
    <div class="row g-4">
        <!-- Sidebar -->
        <?= view('internship/sidebar'); ?>
        <!-- Right Content -->
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-linear py-3 d-flex justify-content-between align-items-center">
                    <h4 class="text-white mb-0">
                        <i class="bx bx-user-circle me-2"></i>
                        Internship Courses
                    </h4>
                    <a href="javascript:void(0)" class="btn btn-primary btn-lg text-white px-4"
                        onclick="return confirm('Under development')">Add Course</a>
                </div>
                <div class="card-body">
                    <div class="row g-4">

                        <!-- Card-->
                        <?php if(!empty($records)){
                        foreach($records as $list){ 
                           $studentData = base64_encode(json_encode([
                                'internship_course'    => $list->ic_name,
                                'student_name'         => ucwords($list->stu_name),
                                'email'                => $list->email,
                                'mobile'               => $list->phone,
                                'university_roll_no'   => $list->uni_roll_no,
                                'university_reg_no'    => $list->uni_reg_no,
                                'class'                => $list->class,
                                'mjc'                  => $list->mjc_subject,
                                'session'              => $list->session,
                                'semester'             => $list->semester,
                                'college'              => $list->college_name,
                                'status'               => get_intern_program_status($list->status), // HTML Badge
                                'image'                => !empty($list->image)
                                                            ? base_url(IMAGE_PATH.$list->image)
                                                            : 'https://ui-avatars.com/api/?name='.$list->stu_name.'&background=80082b&color=fff&size=150',
                                'enroll_id'            => $list->enroll_id,
                                'attendence'           => $list->attendence,
                            ])); 
                        ?>
                        <div class="col-md-6">
                            <div class="card h-100 shadow-lg" style="border:1px solid #dee2e6; border-radius:12px;">

                                <div class="card-header bg-white border-bottom">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0 fw-semibold"><?=ucwords(strtolower($list->ic_name)) ?></h5>
                                        <small class="text-muted">Application No:
                                            <?= $list->enroll_id ?>
                                        </small>
                                    </div>
                                    <small class="text-muted">Applied on
                                        <?= date('d M Y',strtotime($list->added_at)) ?>
                                    </small>
                                </div>

                                <div class="card-body">

                                    <p class="text-muted mb-3">
                                        Learn HTML, CSS, JavaScript, PHP, Laravel and MySQL with real-time projects.
                                        Complete the course, pass the examination and receive your internship
                                        certificate.
                                    </p>

                                    <?= get_intern_program_status($list->status) ?>
                                    <?php if($list->status == 1){ ?>
                                        <p class="text-danger mt-0 mb-1"><strong>Note:</strong> You have successfully applied for this course. Complete your studies and pass the examination to download your certificate.</p>
                                    <?php } ?>

                                    <div class="d-flex gap-2 mt-3 flex-wrap">
                                        
                                        <a href="javascript:void(0)" class="btn btn-primary btn-lg"
                                            onclick="return confirm('Under development')">
                                            <i class="ri-book-open-line"></i> Study
                                        </a>
                                        <?php if($list->status == 1){ ?>
                                        
                                        <a href="#" class="btn btn-warning btn-lg" onclick="return confirm('Under development')">
                                            <i class="ri-edit-line"></i> Edit Course
                                        </a>
                                        <a href="<?=base_url('download-intern-letter/'.$list->ia_id)?>" class="btn btn-success btn-lg" onclick="return confirm('Are u sure to download?')">
                                            <i class="ri-download-2-line"></i> Download Letter
                                        </a>
                                        
                                        <a href="javascript:void(0)" class="btn btn-danger btn-lg"
                                            onclick="return confirm('Under development')">
                                            <i class="ri-edit-2-line"></i> Start Exam
                                        </a>
                                        
                                        <?php }else{ ?>
                                        <a href="#" class="btn btn-success">
                                            <i class="bi bi-cash"></i> Pay Course Fee
                                        </a>

                                        <a href="#" class="btn  btn-danger">
                                            <i class="bi bi-trash-fill"></i> Delete
                                        </a>
                                        <?php } ?>
                                    </div>

                                </div>

                                <div class="card-footer bg-white border-top-0 pt-2">
                                    <a href="javascript:void(0)" class="btn btn-dark btn-lg w-100 student-details"
                                        data-bs-toggle="modal" data-bs-target="#studentDetailsModal" data-student="<?= esc($studentData, 'attr') ?>">
                                        View Details
                                    </a>
                                </div>

                            </div>
                        </div>
                        <?php } }else{
                            echo '<p class="text-danger text-center">You have not apply in any courses!</p>';
                        } ?>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<!-- Student Details Modal -->
<div class="modal fade" id="studentDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">

            <div class="modal-header bg-linear">
                <h5 class="modal-title text-light">
                    <i class="ri-user-3-line me-2 text-primary"></i>
                    Student Course Details
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="row">

                    <!-- Left Side -->
                    <div class="col-md-8">

                        <table class="table table-borderless mb-0">

                            <tr>
                                <th width="35%">Course</th>
                                <td id="m_course"></td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td id="m_email"></td>
                            </tr>

                            <tr>
                                <th>Mobile</th>
                                <td id="m_mobile"></td>
                            </tr>

                            <tr>
                                <th>University Roll No</th>
                                <td id="m_university_roll_no"></td>
                            </tr>

                            <tr>
                                <th>University Reg No</th>
                                <td id="m_university_reg_no"></td>
                            </tr>

                            <tr>
                                <th>Class</th>
                                <td id="m_class"></td>
                            </tr>

                            <tr>
                                <th>MJC</th>
                                <td id="m_mjc"></td>
                            </tr>

                            <tr>
                                <th>Session</th>
                                <td id="m_session"></td>
                            </tr>

                            <tr>
                                <th>Semester</th>
                                <td id="m_semester"></td>
                            </tr>

                            <tr>
                                <th>College/Institute</th>
                                <td id="m_college"></td>
                            </tr>
                            <tr>
                                <th>Attendence</th>
                                <td id="m_atn"></td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td id="m_status"></td>
                            </tr>

                        </table>

                    </div>

                    <!-- Right Side -->
                    <div class="col-md-4 text-center border-start">

                        <img src="" class="img-fluid rounded shadow-sm border p-2"
                            style="max-height:200px;" id="m_image">

                        <h6 class="mt-3 mb-1 fw-bold" id="m_student_name"></h6>

                        <small class="text-muted">
                            Application ID : <span id="enroll_id"></span>
                        </small>

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary btn-lg" data-bs-dismiss="modal">
                    <i class="ri-close-line me-1"></i>
                    Close
                </button>

            </div>

        </div>
    </div>
</div>

<script>
    $(document).on('click', '.student-details', function () {

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

    });
</script>