<div class="container-fluid py-0">
    <div class="row g-4">
        <!-- Sidebar -->
        <?= view('internship/sidebar'); ?>
        <!-- Right Content -->
        <div class="col-lg-10">
            <!-- Welcome -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body bg-linear p-4 text-white rounded">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="text-white mb-2">
                                Welcome Back 👋
                            </h3>
                            <p class="mb-0 text-white-50">
                                Manage your internship, study, exam
                                and download your certificate from one dashboard.
                            </p>
                        </div>
                        <div class="col-md-4 text-end d-none d-md-block">
                            <i class="bx bx-desktop display-1 text-white opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Stats -->
            <div class="row g-4 mb-4">
                <div class="col-md-6 col-xl-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <small class="text-muted">
                                        Profile Complete
                                    </small>
                                    <h3 class="mt-2">
                                        <?php if($profile->profile_completed < 1){
                                            $percent = 20;
                                        }elseif($profile->profile_completed && ($profile->full_address == NULL || $profile->academic == NULL)){
                                            $percent = 80;
                                        }else{
                                            $percent = 100;
                                        } 
                                        echo $percent.'%';
                                        ?>
                                    </h3>
                                </div>
                                <div class="fs-1 text-primary">
                                    <i class="fa fa-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <small class="text-muted">
                                        Total Applied Courses
                                    </small>
                                    <h3 class="mt-2">
                                        <?= $totApplied ?>
                                    </h3>
                                </div>
                                <div class="fs-1 text-success">
                                    <i class="bx bx-notepad"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <small class="text-muted">
                                        Total Incomplete Courses
                                    </small>
                                    <h3 class="mt-2">
                                        <?=  $totIncmp ?>
                                    </h3>
                                </div>
                                <div class="fs-1 text-warning">
                                    <i class="bx bx-line-chart"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <small class="text-muted">
                                        Total Complete Courses
                                    </small>
                                    <h3 class="mt-2">
                                        <?= $totCmp ?>
                                    </h3>
                                </div>
                                <div class="fs-1 text-danger">
                                    <i class="bx bx-award"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- Bottom -->
            <div class="row g-4">
                <!-- <div class="col-lg-7">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white">
                            <strong>Recent Activities</strong>
                        </div>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item">
                                ✅ Daily Report submitted successfully.
                            </div>
                            <div class="list-group-item">
                                📅 Attendance marked.
                            </div>
                            <div class="list-group-item">
                                👨‍🏫 Mentor reviewed your report.
                            </div>
                            <div class="list-group-item">
                                🎉 Week 3 completed.
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white">
                            <strong>Notice Board</strong>
                        </div>
                        
                        <div class="card-body">
                            <div class="alert alert-danger mb-3">
                                <marquee behavior="scroll" direction="left" scrollamount="5">
                                    🔔 महत्वपूर्ण सूचना: छात्र अब अपने डैशबोर्ड से पासवर्ड बदल सकते हैं, स्टडी मैटेरियल देख और पढ़ सकते हैं, नए इंटर्नशिप कोर्स जोड़ (Add Course) सकते हैं तथा <strong>ऑनलाइन परीक्षा (Exam) शुरू/पूर्ण होने से पहले तक</strong> अपने कोर्स की जानकारी संपादित (Edit) कर सकते हैं। परीक्षा पूर्ण होने के बाद कोर्स में किसी प्रकार का संशोधन (Edit) संभव नहीं होगा।
                                </marquee>
                            </div>
                            <div class="alert alert-info">
                                Student registration and secure login to create a personal internship account.
                            </div>
                            <div class="alert alert-warning">
                                Complete your profile to unlock full access to all internship features, including course enrollment, learning materials, examinations, and certificate download.
                            </div>
                            <div class="alert alert-success">
                                Apply for one or multiple internship courses from the dashboard.
                            </div>
                            <div class="alert alert-primary">
                                Complete the course enrollment by making the required online payment.
                            </div>
                            <div class="alert alert-info ">
                                Access and study the course materials after successful enrollment.
                            </div>
                            <div class="alert alert-success mb-0">
                                Appear for the online examination and, upon passing, download the internship certificate instantly from the dashboard.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>