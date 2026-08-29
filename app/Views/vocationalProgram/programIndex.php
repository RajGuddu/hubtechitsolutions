<div class="container-fluid py-0">
    <div class="row g-4">
        <!-- Sidebar -->
        <?= view('internship/sidebar'); ?>
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body bg-linear p-4 text-white rounded">
                    <div class="row align-items-center">
                        <div class="col-md-9">
                            <div class="d-flex align-items-center mb-2">
                                <div class="course-header-icon me-3">
                                    <i class="ri-book-open-line"></i>
                                </div>
                                <div>
                                    <h3 class="text-white mb-0">
                                        Vocational Courses
                                    </h3>
                                    <small class="text-white-50">
                                        अपना Course चुनें और अपने Career की ओर एक कदम बढ़ाएँ
                                    </small>
                                </div>
                            </div>
                            <!-- <p class="mb-0 text-white-50 mt-3">
                                अपनी पसंद का Vocational Course चुनकर Apply करें,
                                Online Exam दें और सफलतापूर्वक Course पूरा करने के बाद
                                अपना Certificate प्राप्त करें।
                            </p> -->
                        </div>
                        <div class="col-md-3 text-end d-none d-md-block">
                            <div class="header-course-icon">
                                <i class="ri-computer-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(session()->getFlashdata('message') !== NULL){
                echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
            } ?>
            <!-- =====================================================
                 COURSE PROCESS INFORMATION
            ====================================================== -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center justify-content-between gap-3">
                        <div class="d-flex align-items-center">
                            <div class="dashboard-section-icon bg-primary-subtle text-primary me-3">
                                <i class="ri-information-line"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">
                                    Course कैसे पूरा करें?
                                </h5>
                                <p class="text-muted small mb-0">
                                    Course पूरा करने की पूरी प्रक्रिया यहाँ देखें
                                </p>
                            </div>
                        </div>
                        <button class="btn btn-primary rounded-pill px-3" type="button" data-bs-toggle="collapse"
                            data-bs-target="#courseProcess" aria-expanded="false" aria-controls="courseProcess">
                            <i class="ri-arrow-down-s-line me-1"></i>
                            <span class="process-button-text">
                                Show Details
                            </span>
                        </button>
                    </div>
                </div>
                <div class="collapse" id="courseProcess">
                    <div class="card-body border-top p-4">
                        <!-- Information -->
                        <!-- <div class="course-info-alert mb-4">
                            <div class="course-info-alert-icon">
                                <i class="bx bx-bulb"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">
                                    Course पूरा करने का तरीका
                                </h6>
                                <p class="small text-muted mb-0">
                                    नीचे दिए गए सभी Steps को पूरा करके आप अपना
                                    Vocational Course सफलतापूर्वक Complete कर सकते हैं।
                                </p>
                            </div>
                        </div> -->
                        <!-- Process Steps -->
                        <div class="row g-3">
                            <!-- Step 01 -->
                            <div class="col-md-6 col-xl-3">
                                <div class="info-step-card info-primary">
                                    <div class="info-step-number">
                                        01
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">
                                            Course Apply करें
                                        </h6>
                                        <p class="small text-muted mb-0">
                                            अपनी पसंद के Course के लिए
                                            Application Submit करें।
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Step 02 -->
                            <div class="col-md-6 col-xl-3">
                                <div class="info-step-card info-warning">
                                    <div class="info-step-number">
                                        02
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">
                                            Exam Fee जमा करें
                                        </h6>
                                        <p class="small text-muted mb-0">
                                            निर्धारित Exam Fee का Online
                                            Payment करें।
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Step 03 -->
                            <div class="col-md-6 col-xl-3">
                                <div class="info-step-card info-info">
                                    <div class="info-step-number">
                                        03
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">
                                            Online Exam दें
                                        </h6>
                                        <p class="small text-muted mb-0">
                                            Exam देकर Course में
                                            सफलता प्राप्त करें।
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Step 04 -->
                            <div class="col-md-6 col-xl-3">
                                <div class="info-step-card info-success">
                                    <div class="info-step-number">
                                        04
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">
                                            Certificate प्राप्त करें
                                        </h6>
                                        <p class="small text-muted mb-0">
                                            Course Fee जमा करके अपना
                                            Certificate Download करें।
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- =====================================================
                 MY SELECTED COURSES
            ====================================================== -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <!-- Card Header -->
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="dashboard-section-icon bg-success-subtle text-success me-3">
                            <i class="ri-bookmark-3-line"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">
                                My Selected Courses
                            </h5>
                            <p class="text-muted small mb-0">
                                आपके enrolled courses और उनकी current progress
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pb-4 pt-2">
                    <?php if(!empty($appliedCourses)){
                    foreach($appliedCourses as $cList){ 
                    $courseDtls = json_decode($cList->course_details) ;   
                    ?>
                    <div class="selected-course-card mb-4">
                        <!-- Course Header -->
                        <div class="selected-course-header">
                            <div class="d-flex align-items-center">
                                <div class="selected-course-logo course-logo-<?=$courseDtls->icon_color?>">
                                    <i class="<?=$courseDtls->icon?>"></i>
                                </div>
                                <div class="ms-3">
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <h5 class="fw-bold mb-0">
                                            <?=$courseDtls->course_short_name?>
                                        </h5>
                                        <?= get_intern_program_status($cList->status) ?>
                                    </div>
                                    <p class="text-muted small mb-0 mt-1">
                                        <?=$courseDtls->course_name?>
                                    </p>
                                </div>
                            </div>
                            <!-- Reg No -->
                            <div class="course-progress-badge">
                                <strong><?=$cList->reg_no?></strong>
                                <span>Registration No</span>
                            </div>
                        </div>
                        <!-- Progress Bar -->
                        <!-- <div class="course-main-progress">
                            <div class="d-flex justify-content-between mb-2">
                                <small class="text-muted">
                                    Course Progress
                                </small>
                                <small class="fw-semibold text-primary">
                                    2 of 5 Steps Completed
                                </small>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-primary" style="width:40%;">
                                </div>
                            </div>
                        </div> -->
                        <!-- Horizontal Steps -->
                        <div class="course-horizontal-steps">
                            <!-- Step 1 -->
                            <div class="horizontal-step completed">
                                <div class="horizontal-step-circle">
                                    <i class="ri-check-line"></i>
                                </div>
                                <div class="horizontal-step-content">
                                    <h6>
                                        Applied
                                    </h6>
                                    <span>
                                        Application Submitted
                                    </span>
                                    
                                    <button type="button" class="btn btn-outline-success btn-xs view-course-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewCourseModal"
                                        data-record='<?= base64_encode(json_encode($cList)) ?>'
                                        data-status="<?= htmlspecialchars(get_intern_program_status($cList->status), ENT_QUOTES, 'UTF-8') ?>">
                                        <i class="ri-eye-line"></i>
                                        View
                                    </button>
                                </div>
                            </div>
                            <!-- Step 2 -->
                            <div class="horizontal-step completed">
                                <div class="horizontal-step-circle">
                                    <i class="ri-check-line"></i>
                                </div>
                                <div class="horizontal-step-content">
                                    <h6>
                                        Exam Fee
                                    </h6>
                                    <span>
                                        Payment Completed
                                    </span>
                                    <button class="btn btn-outline-success btn-xs viewPdfBtn"
                                        data-pdf="<?= base_url('vocational/exam_fee_receipt_pdf/' . base64_encode($cList->va_id)) ?>" data-title="Payment Receipt">
                                        <i class="ri-file-list-line"></i>
                                        Receipt
                                    </button>
                                </div>
                            </div>
                            <!-- Step 3 -->
                            <div class="horizontal-step active">
                                <div class="horizontal-step-circle">
                                    3
                                </div>
                                <div class="horizontal-step-content">
                                    <h6>
                                        Online Exam
                                    </h6>
                                    <span>
                                        Exam Available
                                    </span>
                                    <button class="btn btn-primary btn-xs" onclick="alert('Online Exam सुविधा अभी Development में है। कृपया बाद में पुनः प्रयास करें।');">
                                        <i class="ri-edit-line"></i>
                                        Start Exam
                                    </button>
                                </div>
                            </div>
                            <!-- Step 4 -->
                            <div class="horizontal-step">
                                <div class="horizontal-step-circle">
                                    4
                                </div>
                                <div class="horizontal-step-content">
                                    <h6>
                                        Course Fee
                                    </h6>
                                    <span>
                                        After Exam
                                    </span>
                                    <button class="btn btn-outline-secondary btn-xs" disabled>
                                        <i class="ri-lock-line"></i>
                                        Locked
                                    </button>
                                </div>
                            </div>
                            <!-- Step 5 -->
                            <div class="horizontal-step">
                                <div class="horizontal-step-circle">
                                    5
                                </div>
                                <div class="horizontal-step-content">
                                    <h6>
                                        Certificate
                                    </h6>
                                    <span>
                                        Course Complete
                                    </span>
                                    <button class="btn btn-outline-secondary btn-xs" disabled>
                                        <i class="ri-lock-line"></i>
                                        Locked
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } else{ ?>
                    <div class="text-center py-1">
                        <i class="ri-bookmark-line text-danger fs-3"></i>
                        <div class="text-danger fw-semibold small mt-1">
                            Not Applied Yet
                        </div>
                    </div>
                    <?php } ?>
                    
                    <?php /* <div class="selected-course-card">
                        <!-- Course Header -->
                        <div class="selected-course-header">
                            <div class="d-flex align-items-center">
                                <div class="selected-course-logo course-logo-green">
                                    <i class="bx bx-code-alt"></i>
                                </div>
                                <div class="ms-3">
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <h5 class="fw-bold mb-0">
                                            ADCA
                                        </h5>
                                        <span class="badge bg-success-subtle text-success">
                                            Completed
                                        </span>
                                    </div>
                                    <p class="text-muted small mb-0 mt-1">
                                        Advanced Diploma in Computer Applications
                                    </p>
                                </div>
                            </div>
                            <div class="course-progress-badge success">
                                <strong>100%</strong>
                                <span>Completed</span>
                            </div>
                        </div>
                        <!-- Progress Bar -->
                        <div class="course-main-progress">
                            <div class="d-flex justify-content-between mb-2">
                                <small class="text-muted">
                                    Course Progress
                                </small>
                                <small class="fw-semibold text-success">
                                    Course Completed
                                </small>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-success" style="width:100%;">
                                </div>
                            </div>
                        </div>
                        <!-- Horizontal Steps -->
                        <div class="course-horizontal-steps">
                            <!-- Step 1 -->
                            <div class="horizontal-step completed">
                                <div class="horizontal-step-circle">
                                    <i class="bx bx-check"></i>
                                </div>
                                <div class="horizontal-step-content">
                                    <h6>
                                        Applied
                                    </h6>
                                    <span>
                                        Completed
                                    </span>
                                    <button class="btn btn-outline-success btn-xs">
                                        <i class="bx bx-show"></i>
                                        View
                                    </button>
                                </div>
                            </div>
                            <!-- Step 2 -->
                            <div class="horizontal-step completed">
                                <div class="horizontal-step-circle">
                                    <i class="bx bx-check"></i>
                                </div>
                                <div class="horizontal-step-content">
                                    <h6>
                                        Exam Fee
                                    </h6>
                                    <span>
                                        Paid
                                    </span>
                                    <button class="btn btn-outline-success btn-xs">
                                        <i class="bx bx-receipt"></i>
                                        Receipt
                                    </button>
                                </div>
                            </div>
                            <!-- Step 3 -->
                            <div class="horizontal-step completed">
                                <div class="horizontal-step-circle">
                                    <i class="bx bx-check"></i>
                                </div>
                                <div class="horizontal-step-content">
                                    <h6>
                                        Online Exam
                                    </h6>
                                    <span>
                                        Exam Passed
                                    </span>
                                    <button class="btn btn-outline-success btn-xs">
                                        <i class="bx bx-file"></i>
                                        Result
                                    </button>
                                </div>
                            </div>
                            <!-- Step 4 -->
                            <div class="horizontal-step completed">
                                <div class="horizontal-step-circle">
                                    <i class="bx bx-check"></i>
                                </div>
                                <div class="horizontal-step-content">
                                    <h6>
                                        Course Fee
                                    </h6>
                                    <span>
                                        Payment Done
                                    </span>
                                    <button class="btn btn-outline-success btn-xs">
                                        <i class="ri-award-line"></i>
                                        Receipt
                                    </button>
                                </div>
                            </div>
                            <!-- Step 5 -->
                            <div class="horizontal-step completed">
                                <div class="horizontal-step-circle">
                                    <i class="bx bx-check"></i>
                                </div>
                                <div class="horizontal-step-content">
                                    <h6>
                                        Certificate
                                    </h6>
                                    <span>
                                        Available
                                    </span>
                                    <button class="btn btn-success btn-xs">
                                        <i class="bx bx-download"></i>
                                        Download
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div> */ ?>
                </div>
            </div>
            <!-- =====================================================
                 AVAILABLE COURSES
            ====================================================== -->
            <div class="card border-0 shadow-sm rounded-4">
                <!-- Header -->
                <div class="card-header bg-white border-0 p-4">
                    <div class="d-flex align-items-center">
                        <div class="dashboard-section-icon bg-warning-subtle text-warning me-3">
                            <i class="ri-apps-2-line"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">
                                Available Courses
                            </h5>
                            <p class="text-muted small mb-0">
                                अपनी पसंद का Course चुनकर Apply करें
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Courses -->
                <div class="card-body p-4">
                    <div class="row g-4">
                        <?php if(!empty($vCourses)){
                        foreach($vCourses as $list){ ?>
                        <div class="col-12 col-sm-6 col-xl-3">
                            <div class="available-course-card course-<?=$list->icon_color?> h-100">
                                <div class="course-card-top">
                                    <div class="course-card-icon">
                                        <i class="<?=$list->icon?>"></i>
                                    </div>
                                    <span class="course-code">
                                        <?=$list->course_short_name?>
                                    </span>
                                </div>
                                <h6 class="course-card-title">
                                    <?=$list->course_name?>
                                </h6>
                                <!-- <p class="course-card-description">
                                    Computer applications और basic IT
                                    skills से संबंधित vocational course।
                                </p> -->
                                <div class="course-fees">
                                    <div class="fee-item">
                                        <span>
                                            Exam Fee
                                        </span>
                                        <strong>
                                            ₹<?=$list->exam_fee?>
                                        </strong>
                                    </div>
                                    <div class="fee-divider"></div>
                                    <div class="fee-item">
                                        <span>
                                            Course Fee
                                        </span>
                                        <strong>
                                            ₹<?=$list->course_fee?>
                                        </strong>
                                    </div>
                                </div>
                                <button class="btn btn-<?=$list->icon_color?> w-100 rounded-pill mt-3 apply-course-btn"
                                    data-bs-toggle="modal" data-bs-target="#applyCourseModal"
                                    data-course="<?=$list->course_name?>" data-fee="₹<?=$list->exam_fee?>" data-course_id="<?=base64_encode($list->vc_id)?>">
                                    <i class="ri-send-plane-line me-1"></i>
                                    Apply Now
                                </button>
                            </div>
                        </div>
                        <?php } }else{ ?>
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body">
                                <div class="course-empty-state text-center">
                                    <!-- Icon -->
                                    <div class="course-empty-icon">
                                        <i class="ri-book-open-line"></i>
                                    </div>
                                    <!-- Title -->
                                    <h5 class="fw-bold mb-2">
                                        अभी कोई Course उपलब्ध नहीं है
                                    </h5>
                                    <!-- Description -->
                                    <p class="text-muted small mb-0">
                                        वर्तमान में कोई Vocational Course उपलब्ध नहीं है।
                                        नए Courses उपलब्ध होते ही यहाँ दिखाई देंगे।
                                    </p>
                                    <!-- Optional Information -->
                                    <div class="course-empty-info mt-3">
                                        <i class="ri-information-line me-1"></i>
                                        कृपया कुछ समय बाद फिर से इस section को देखें।
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ViewCourseModal -->
<div class="modal fade" id="viewCourseModal" tabindex="-1"
     aria-labelledby="viewCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header border-0 bg-primary text-white">
                <h5 class="modal-title fw-bold" id="viewCourseModalLabel">
                    <i class="ri-book-open-line me-1"></i>
                    Course Details
                </h5>
                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <h5 class="fw-bold mb-1" id="viewCourseName">
                        DCA
                    </h5>
                    <small class="text-muted" id="viewCourseShort">
                        Diploma in Computer Applications
                    </small>
                </div>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="bg-light rounded-3 p-3">
                            <small class="text-muted d-block">
                                Registration No.
                            </small>
                            <strong id="viewRegistrationNo">
                                DCA-2026-000001
                            </strong>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="border rounded-3 p-3">
                            <small class="text-muted d-block">
                                Registration Fee
                            </small>
                            <strong id="viewRegistrationFee">
                                ₹100
                            </strong>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="border rounded-3 p-3">
                            <small class="text-muted d-block">
                                Course Fee
                            </small>
                            <strong id="viewCourseFee">
                                ₹1,500
                            </strong>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="border rounded-3 p-3">
                            <small class="text-muted d-block">
                                Duration
                            </small>
                            <strong id="viewDuration">
                                6 Months
                            </strong>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="border rounded-3 p-3">
                            <small class="text-muted d-block">
                                Status
                            </small>
                            <span class="badge bg-success"
                                  id="viewStatus">
                                Registered
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button"
                        class="btn btn-light rounded-pill px-4"
                        data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- =====================================================
     APPLY COURSE MODAL
===================================================== -->
<div class="modal fade" id="applyCourseModal" tabindex="-1" aria-labelledby="applyCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <form action="<?=current_url()?>" method="post">
            <?=csrf_field()?>
            <input type="hidden" name="course_id" value="" id="modalCourseId">
            <input type="hidden" name="form_id" value="reg_fee" id="reg_fee">
            <!-- Header -->
            <div class="modal-header border-0 bg-primary text-white px-4 py-3">
                <div>
                    <h4 class="modal-title fw-bold mb-1" id="applyCourseModalLabel">
                        Apply for Course
                    </h4>
                    <small class="text-white-50">
                        Course Application
                    </small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <!-- Body -->
            <div class="modal-body p-4">
                <!-- Course -->
                <div class="text-center mb-3">
                    <div class="apply-modal-icon mx-auto mb-3">
                        <i class="ri-book-open-line"></i>
                    </div>
                    <div class="text-muted small mb-1">
                        Selected Course
                    </div>
                    <h5 class="fw-bold mb-0" id="modalCourseName">
                        Diploma in Computer Applications
                    </h5>
                </div>
                <!-- Registration Fee -->
                <div class="registration-fee-box text-center mb-4">
                    <div class="small text-muted mb-1">
                        Registration Fee
                    </div>
                    <div class="registration-fee" id="modalCourseFee">
                        ₹100
                    </div>
                </div>
                <!-- Message -->
                <div class="alert alert-info border-0 rounded-3 mb-0">
                    <div class="d-flex align-items-start">
                        <i class="ri-information-line fs-4 me-2"></i>
                        <div class="small">
                            <strong>Payment Information</strong>
                            <p class="mb-0 mt-1">
                                आगे बढ़ने पर आपको सुरक्षित
                                <strong>Payment Gateway</strong> पर
                                भेजा जाएगा, जहाँ आप Registration Fee
                                का भुगतान कर सकेंगे।
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <div class="modal-footer border-0 px-4 pb-4 pt-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary rounded-pill px-4" id="proceedPaymentBtn">
                    <i class="ri-secure-payment-line me-1"></i>
                    Proceed to Payment
                </button>
            </div>
            </form>
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
<script>
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
document.querySelectorAll('.view-course-btn').forEach(function (button) {
    button.addEventListener('click', function () {
        const record = JSON.parse(
            atob(this.dataset.record)
        );
        console.log(record);
        const courseDtls = JSON.parse(
            record.course_details
        );
        document.getElementById('viewCourseName').textContent =
            courseDtls.course_name ?? '-';
        document.getElementById('viewCourseShort').textContent =
            courseDtls.course_short_name ?? '-';
        document.getElementById('viewRegistrationNo').textContent =
            record.reg_no ?? '-';
        document.getElementById('viewRegistrationFee').textContent =
            '₹' + (record.amount ?? '0');
        document.getElementById('viewCourseFee').textContent =
            '₹' + (courseDtls.course_fee ?? '0');
        document.getElementById('viewDuration').textContent =
            courseDtls.duration ?? '-';
        document.getElementById('viewStatus').innerHTML =
            this.dataset.status;
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const applyButtons = document.querySelectorAll('.apply-course-btn');
    const modalCourseName = document.getElementById('modalCourseName');
    const modalCourseFee = document.getElementById('modalCourseFee');
    const modalCourseId = document.getElementById('modalCourseId');
    applyButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const courseName = this.getAttribute('data-course');
            const courseFee = this.getAttribute('data-fee');
            const courseId = this.getAttribute('data-course_id');
            modalCourseName.textContent = courseName;
            modalCourseFee.textContent = courseFee;
            modalCourseId.value = courseId;
        });
    });
});
</script>
<!-- =============================================================
     CSS
============================================================= -->
<style>
    /* =====================================================
   APPLY COURSE MODAL
===================================================== */
.apply-modal-icon {
    width: 55px;
    height: 55px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e7f1ff;
    color: #0d6efd;
    font-size: 27px;
}
.registration-fee-box {
    background: #f8f9fa;
    border: 1px dashed #ced4da;
    border-radius: 14px;
    padding: 16px;
}
.registration-fee {
    font-size: 32px;
    font-weight: 700;
    color: #0d6efd;
    line-height: 1.2;
}
#applyCourseModal .modal-content {
    animation: applyModalIn .2s ease;
}
@keyframes applyModalIn {
    from {
        transform: scale(.96);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}
    /* =============================================================
   HEADER
============================================================= */
    .course-header-icon {
        width: 45px;
        height: 45px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, .16);
        font-size: 24px;
    }
    .header-course-icon {
        width: 60px;
        height: 60px;
        margin-left: auto;
        border-radius: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, .12);
        font-size: 41px;
    }
    /* =============================================================
   SECTION ICON
============================================================= */
    .dashboard-section-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }
    /* =============================================================
   COURSE INFORMATION
============================================================= */
    .course-info-alert {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 15px 17px;
        background: #f8faff;
        border: 1px solid #e5edff;
        border-radius: 13px;
    }
    .course-info-alert-icon {
        width: 40px;
        height: 40px;
        border-radius: 11px;
        background: #e7f1ff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
        flex-shrink: 0;
    }
    /* =============================================================
   INFORMATION STEP CARDS
============================================================= */
    .info-step-card {
        height: 100%;
        padding: 17px;
        border-radius: 14px;
        border: 1px solid #edf0f4;
        display: flex;
        align-items: flex-start;
        gap: 13px;
        transition: all .2s ease;
    }
    .info-step-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 18px rgba(0, 0, 0, .06);
    }
    .info-step-number {
        width: 40px;
        height: 40px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        flex-shrink: 0;
    }
    /* Blue */
    .info-primary {
        background: #f8fbff;
    }
    .info-primary .info-step-number {
        background: #e7f1ff;
        color: #0d6efd;
    }
    /* Yellow */
    .info-warning {
        background: #fffdf7;
    }
    .info-warning .info-step-number {
        background: #fff3cd;
        color: #997404;
    }
    /* Cyan */
    .info-info {
        background: #f5fcff;
    }
    .info-info .info-step-number {
        background: #cff4fc;
        color: #087990;
    }
    /* Green */
    .info-success {
        background: #f7fcf9;
    }
    .info-success .info-step-number {
        background: #d1e7dd;
        color: #146c43;
    }
    /* =============================================================
   SELECTED COURSE
============================================================= */
    .selected-course-card {
        border: 1px solid #e9edf2;
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .025);
    }
    .selected-course-header {
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        background: linear-gradient(180deg,
                #ffffff 0%,
                #fbfcfe 100%);
    }
    .selected-course-logo {
        width: 46px;
        height: 46px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
    }
    /* Primary / Blue */
.course-logo-primary {
    background: #e7f1ff;
    color: #0d6efd;
}
/* Success / Green */
.course-logo-success {
    background: #dff3e7;
    color: #198754;
}
/* Warning / Orange */
.course-logo-warning {
    background: #fff0cf;
    color: #c58a00;
}
/* Purple */
.course-logo-purple {
    background: #eee7fb;
    color: #6f42c1;
}
/* Danger / Red */
.course-logo-danger {
    background: #fde2e2;
    color: #dc3545;
}
/* Info / Cyan */
.course-logo-info {
    background: #dff7fb;
    color: #0aa2c0;
}
/* Secondary / Gray */
.course-logo-secondary {
    background: #e9ecef;
    color: #6c757d;
}
/* Dark */
.course-logo-dark {
    background: #e9ecef;
    color: #212529;
}
    /* Progress Badge */
    .course-progress-badge {
        min-width: 70px;
        padding: 6px 10px;
        border-radius: 10px;
        background: #edf4ff;
        color: #0d6efd;
        text-align: center;
        display: flex;
        flex-direction: column;
    }
    .course-progress-badge strong {
        font-size: 16px;
        line-height: 1.2;
    }
    .course-progress-badge span {
        font-size: 12px;
    }
    .course-progress-badge.success {
        background: #eaf7ef;
        color: #198754;
    }
    /* =============================================================
   PROGRESS BAR
============================================================= */
    .course-main-progress {
        padding: 0 20px 13px;
    }
    .course-main-progress .progress {
        height: 6px;
        background: #edf0f3;
        border-radius: 10px;
    }
    .course-main-progress .progress-bar {
        border-radius: 10px;
    }
    /* =============================================================
   HORIZONTAL COURSE STEPS
============================================================= */
    .course-horizontal-steps {
        display: flex;
        align-items: flex-start;
        padding: 5px 15px 18px;
        overflow-x: auto;
        scrollbar-width: thin;
    }
    .horizontal-step {
        flex: 1;
        min-width: 125px;
        position: relative;
        text-align: center;
    }
    /* Connecting Line */
    .horizontal-step:not(:last-child)::after {
        content: "";
        position: absolute;
        top: 16px;
        left: 50%;
        width: 100%;
        height: 2px;
        background: #e5e7eb;
        z-index: 0;
    }
    /* Completed Line */
    .horizontal-step.completed:not(:last-child)::after {
        background: #198754;
    }
    /* Circle */
    .horizontal-step-circle {
        width: 34px;
        height: 34px;
        margin: 0 auto;
        border-radius: 50%;
        background: #f1f3f5;
        border: 2px solid #fff;
        box-shadow: 0 0 0 2px #dfe3e7;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 700;
        color: #6c757d;
        position: relative;
        z-index: 2;
    }
    /* Completed */
    .horizontal-step.completed .horizontal-step-circle {
        background: #198754;
        color: #fff;
        box-shadow: 0 0 0 2px #198754;
    }
    /* Active */
    .horizontal-step.active .horizontal-step-circle {
        background: #0d6efd;
        color: #fff;
        box-shadow:
            0 0 0 2px #0d6efd,
            0 0 0 5px rgba(13, 110, 253, .10);
    }
    /* Step Content */
    .horizontal-step-content {
        padding: 7px 4px 0;
    }
    .horizontal-step-content h6 {
        font-size: 11px;
        font-weight: 700;
        margin: 0 0 2px;
    }
    .horizontal-step-content span {
        display: block;
        color: #6c757d;
        font-size: 9px;
        min-height: 25px;
        line-height: 1.35;
        margin-bottom: 5px;
    }
    /* Small Buttons */
    .btn-xs {
        padding: 3px 8px;
        font-size: 9px;
        border-radius: 20px;
        line-height: 1.4;
        white-space: nowrap;
    }
    .btn-xs i {
        font-size: 11px;
        vertical-align: -1px;
    }
    /* =============================================================
   AVAILABLE COURSES
============================================================= */
    .available-course-card {
        position: relative;
        padding: 19px;
        border-radius: 17px;
        border: 1px solid #e9edf2;
        background: #fff;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transition: all .25s ease;
    }
    .available-course-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
    }
    .available-course-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
    }
    /* ================================
   COURSE CARD COLORS
================================ */
    /* Primary / Blue */
    .course-primary {
        background: linear-gradient(180deg,
                #ffffff 0%,
                #f8fbff 100%);
    }
    .course-primary::before {
        background: #0d6efd;
    }
    /* Success / Green */
    .course-success {
        background: linear-gradient(180deg,
                #ffffff 0%,
                #f7fcf9 100%);
    }
    .course-success::before {
        background: #198754;
    }
    /* Warning / Orange */
    .course-warning {
        background: linear-gradient(180deg,
                #ffffff 0%,
                #fffaf2 100%);
    }
    .course-warning::before {
        background: #f0ad00;
    }
    /* Purple */
    .course-purple {
        background: linear-gradient(180deg,
                #ffffff 0%,
                #faf8ff 100%);
    }
    .course-purple::before {
        background: #6f42c1;
    }
    /* Danger / Red */
    .course-danger {
        background: linear-gradient(180deg,
                #ffffff 0%,
                #fff8f8 100%);
    }
    .course-danger::before {
        background: #dc3545;
    }
    /* Info / Cyan */
    .course-info {
        background: linear-gradient(180deg,
                #ffffff 0%,
                #f5fcff 100%);
    }
    .course-info::before {
        background: #0dcaf0;
    }
    /* Secondary / Gray */
    .course-secondary {
        background: linear-gradient(180deg,
                #ffffff 0%,
                #f8f9fa 100%);
    }
    .course-secondary::before {
        background: #6c757d;
    }
    /* Dark */
    .course-dark {
        background: linear-gradient(180deg,
                #ffffff 0%,
                #f5f5f5 100%);
    }
    .course-dark::before {
        background: #212529;
    }
    /* =============================================================
   AVAILABLE COURSE CONTENT
============================================================= */
    .course-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 13px;
    }
    .course-card-icon {
        width: 50px;
        height: 50px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
    }
    /* Primary / Blue */
    .course-primary .course-card-icon {
        background: #e7f1ff;
        color: #0d6efd;
    }
    /* Success / Green */
    .course-success .course-card-icon {
        background: #dff3e7;
        color: #198754;
    }
    /* Warning / Orange */
    .course-warning .course-card-icon {
        background: #fff0cf;
        color: #c58a00;
    }
    /* Purple */
    .course-purple .course-card-icon {
        background: #eee7fb;
        color: #6f42c1;
    }
    /* Danger / Red */
    .course-danger .course-card-icon {
        background: #fde2e2;
        color: #dc3545;
    }
    /* Info / Cyan */
    .course-info .course-card-icon {
        background: #dff7fb;
        color: #0aa2c0;
    }
    /* Secondary / Gray */
    .course-secondary .course-card-icon {
        background: #e9ecef;
        color: #6c757d;
    }
    /* Dark */
    .course-dark .course-card-icon {
        background: #e9ecef;
        color: #212529;
    }
    .course-code {
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .6px;
        padding: 4px 9px;
        border-radius: 7px;
        background: rgba(0, 0, 0, .04);
    }
    .course-card-title {
        font-size: 14px;
        line-height: 1.4;
        min-height: 40px;
        margin-bottom: 7px;
    }
    .course-card-description {
        font-size: 11px;
        line-height: 1.55;
        color: #6c757d;
        min-height: 51px;
        margin-bottom: 13px;
    }
    /* =============================================================
   COURSE FEES
============================================================= */
    .course-fees {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 7px;
        padding: 10px;
        border-radius: 11px;
        background: rgba(255, 255, 255, .85);
        border: 1px solid rgba(0, 0, 0, .05);
        margin-top: auto;
    }
    .fee-item {
        display: flex;
        flex-direction: column;
    }
    .fee-item span {
        font-size: 9px;
        color: #6c757d;
        margin-bottom: 1px;
    }
    .fee-item strong {
        font-size: 13px;
    }
    .fee-divider {
        width: 1px;
        height: 27px;
        background: #dee2e6;
    }
    /* =============================================================
   MOBILE
============================================================= */
    @media (max-width: 767.98px) {
        .selected-course-header {
            padding: 15px;
        }
        .course-main-progress {
            padding-left: 15px;
            padding-right: 15px;
        }
        .course-horizontal-steps {
            padding-left: 10px;
            padding-right: 10px;
        }
        .horizontal-step {
            min-width: 115px;
        }
        .selected-course-logo {
            width: 42px;
            height: 42px;
            font-size: 21px;
        }
    }
    @media (max-width: 575.98px) {
        .selected-course-header {
            align-items: flex-start;
        }
        .course-progress-badge {
            min-width: 62px;
        }
        .course-info-alert {
            align-items: flex-start;
        }
        .dashboard-section-icon {
            width: 41px;
            height: 41px;
            font-size: 20px;
        }
        .info-step-card {
            padding: 14px;
        }
    }
    /* =============================================================
   SCROLLBAR
============================================================= */
    .course-horizontal-steps::-webkit-scrollbar {
        height: 4px;
    }
    .course-horizontal-steps::-webkit-scrollbar-track {
        background: #f1f3f5;
        border-radius: 10px;
    }
    .course-horizontal-steps::-webkit-scrollbar-thumb {
        background: #ced4da;
        border-radius: 10px;
    }
    /* =====================================================
   COURSE EMPTY STATE
===================================================== */
    .course-empty-state {
        padding: 0px 20px 40px;
    }
    .course-empty-icon {
        width: 65px;
        height: 65px;
        margin: 0 auto 15px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f5ff;
        color: #0d6efd;
        font-size: 30px;
    }
    .course-empty-state h5 {
        color: #343a40;
    }
    .course-empty-info {
        display: inline-flex;
        align-items: center;
        padding: 7px 13px;
        border-radius: 20px;
        background: #f8f9fa;
        color: #6c757d;
        font-size: 11px;
    }
</style>
<!-- =============================================================
     SHOW / HIDE BUTTON TEXT
============================================================= -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const processBox = document.getElementById('courseProcess');
        const button = document.querySelector(
            '[data-bs-target="#courseProcess"]'
        );
        if (!processBox || !button) {
            return;
        }
        const buttonText = button.querySelector('.process-button-text');
        const buttonIcon = button.querySelector('i');
        processBox.addEventListener('show.bs.collapse', function () {
            buttonText.textContent = 'Hide Details';
            buttonIcon.classList.remove('bx-chevron-down');
            buttonIcon.classList.add('bx-chevron-up');
        });
        processBox.addEventListener('hide.bs.collapse', function () {
            buttonText.textContent = 'Show Details';
            buttonIcon.classList.remove('bx-chevron-up');
            buttonIcon.classList.add('bx-chevron-down');
        });
    });
</script>