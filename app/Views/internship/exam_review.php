<div class="container-fluid py-0">
    <div class="row g-4">
        <!-- Sidebar -->
        <?= view('internship/sidebar'); ?>
        <!-- Right Content -->

        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-linear py-3 d-flex justify-content-between align-items-center">
                    <div class="">
                        <h3 class="mb-0 text-white ">
                            Examination Review
                        </h3>
                        <p class="text-muted mb-0">
                            View your examination attempts and answers.
                        </p>
                    </div>

                </div>
                <?php if(session()->getFlashdata('message') !== NULL){
                    echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
                } ?>
                
                <?php if(!empty($records)){
                $total_attempts = count($records) ;
                $exam_no = $total_attempts;
                foreach($records as $list){?>
                <div class="card border-0 shadow-sm mb-4">

                    <!-- Exam Header -->
                    <div class="card-header border-bottom py-3 " style="background-color: #f0fbff;">
                        <div class="row g-3 align-items-center">

                            <div class="col-lg-7 col-md-6">
                                <h5 class="fw-bold mb-1">
                                    <?=$list->ic_name?>
                                </h5>
                                <small class="text-muted">
                                    Examination Attempt #<?=$exam_no?>
                                </small>
                            </div>

                            <div class="col-lg-5 col-md-6">
                                <div class="d-flex flex-wrap gap-2 justify-content-md-end">

                                    <span class="badge bg-success-subtle text-dark px-3 py-2">
                                        Grade: <?=$list->grade?>
                                    </span>

                                    <span class="badge bg-primary-subtle text-dark px-3 py-2">
                                        Percentage: <?=$list->result?>%
                                    </span>

                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- Exam Summary -->
                    <div class="card-body border-bottom">

                        <div class="row g-3">

                            <!-- Total Questions -->
                            <div class="col-6 col-md-3">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block">
                                        Total Questions
                                    </small>
                                    <h5 class="fw-bold mb-0 mt-1">
                                        <?=$list->tot_ques?>
                                    </h5>
                                </div>
                            </div>

                            <!-- True Answers -->
                            <div class="col-6 col-md-3">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block">
                                        True Answers
                                    </small>
                                    <h5 class="fw-bold text-success mb-0 mt-1">
                                        <?=$list->true_ans?>
                                    </h5>
                                </div>
                            </div>

                            <!-- False Answers -->
                            <div class="col-6 col-md-3">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block">
                                        False Answers
                                    </small>
                                    <h5 class="fw-bold text-danger mb-0 mt-1">
                                        <?=$list->false_ans?>
                                    </h5>
                                </div>
                            </div>

                            <!-- Completion Date -->
                            <div class="col-6 col-md-3">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block">
                                        Completion Date
                                    </small>
                                    <h6 class="fw-bold mb-0 mt-1">
                                        <?=date('d M Y',strtotime($list->completion_date))?>
                                    </h6>
                                </div>
                            </div>

                        </div>

                    </div>


                    <!-- Questions -->
                    <div class="card-body">

                        <h6 class="fw-bold mb-3">
                            <i class="bi bi-list-check me-2"></i>
                            Question & Answer Review
                        </h6>

                        <?php $ex_submit = json_decode($list->ex_submit);
                        $qno = 1;
                        foreach($ex_submit as $li){
                        ?>
                        <!-- Question 1 -->
                        <div class="border rounded p-3 mb-3">

                            <div class="d-flex justify-content-between align-items-start gap-2 mb-3">

                                <div>
                                    <span class="badge bg-secondary me-2">
                                        Q.<?=$qno?>
                                    </span>

                                    <span class="fw-semibold">
                                        <?=htmlspecialchars($li->q_title, ENT_QUOTES, 'UTF-8')?>
                                    </span>
                                </div>
                                <?php if($li->remark == 'TRUE'){ ?>
                                <span class="badge bg-success-subtle text-dark">
                                    Correct
                                </span>
                                <?php }elseif($li->remark == 'FALSE'){ ?>
                                <span class="badge bg-danger-subtle text-dark" style="background-color: #f8d7da; color: #842029;">
                                    Wrong
                                </span>
                                <?php }else{ ?>
                                <span class="badge bg-danger-subtle text-dark" style="background-color: #f8d7da; color: #842029;">
                                    N/A
                                </span>
                                <?php } ?>

                            </div>


                            <!-- Options -->
                            <div class="row g-2 mb-3">

                                <div class="col-12 col-md-6">
                                    <div class="border rounded p-2">
                                        <strong>A.</strong>
                                        <?=htmlspecialchars($li->opt1, ENT_QUOTES, 'UTF-8')?>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="border rounded p-2">
                                        <strong>B.</strong>
                                        <?=htmlspecialchars($li->opt2, ENT_QUOTES, 'UTF-8')?>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="border rounded p-2">
                                        <strong>C.</strong>
                                        <?=htmlspecialchars($li->opt3, ENT_QUOTES, 'UTF-8')?>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="border rounded p-2">
                                        <strong>D.</strong>
                                        <?=htmlspecialchars($li->opt4, ENT_QUOTES, 'UTF-8')?>
                                    </div>
                                </div>

                            </div>


                            <!-- Answer Information -->
                            <div class="row g-2">

                                <div class="col-12 col-md-4">
                                    <div class="bg-light rounded p-2">
                                        <small class="text-muted d-block">
                                            Correct Answer
                                        </small>
                                        <strong class="text-success">
                                            <?=$li->c_ans?>
                                        </strong>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="bg-light rounded p-2">
                                        <small class="text-muted d-block">
                                            Given Answer
                                        </small>
                                        <strong>
                                            <?=$li->answer?>
                                        </strong>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="bg-light rounded p-2">
                                        <small class="text-muted d-block">
                                            Remark
                                        </small>
                                        <strong class="text-<?=($li->remark == 'TRUE')?'success':'danger'?>">
                                            <?=$li->remark?>
                                        </strong>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <?php $qno++; } ?>

                        

                    </div>

                </div>
                <?php $exam_no--; }}else{ ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">

                        <i class="bi bi-journal-x fs-1 text-muted"></i>

                        <h5 class="fw-bold mt-3 mb-2">
                            No Examination Record Found
                        </h5>

                        <p class="text-muted mb-0">
                            You have not attempted any examination yet.
                        </p>

                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>