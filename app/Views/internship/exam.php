<style>
    input[type="radio"]~label::before {
        border: 1px solid #0b1f6b;
        border-radius: 50%;
    }

    input[type="radio"]:checked~label::before {
        border: 2px solid #000 !important;
        background: #80082b !important;
    }

    #examTimer {
        width: 220px;
        display: inline-block;
        text-align: center;
        font-family: monospace;
        font-size: 3.5rem !important;
        /* Bada font */
        font-weight: 700;
        letter-spacing: 2px;
    }

    @media (max-width: 768px) {
        #examTimer {
            font-size: 2.5rem !important;
        }
    }
</style>
<div class="container-fluid py-0">
    <div class="row g-4">
        <!-- Sidebar -->
        <?= view('internship/sidebar'); ?>
        <!-- Right Content -->
        <?php 
                $s = date('s',strtotime($examineeDtls->exam_duration ?? date('Y-m-d H:i:s')));
                $m = date('i',strtotime($examineeDtls->exam_duration ?? date('Y-m-d H:i:s')));
                $h = date('H',strtotime($examineeDtls->exam_duration ?? date('Y-m-d H:i:s'))); 
                $tot_sec = ($h*60*60) + ($m*60) + $s;
                // echo $tot_sec; exit;
                $ia_id = $examineeDtls->ia_id ?? ''; 
            ?>
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-linear py-3 d-flex justify-content-between align-items-center">
                    <div class="">
                        <h3 class="mb-0 text-white ">
                            <?= ucwords($examineeDtls->ic_name ?? '') ?> Examination
                        </h3>
                        <p class="mb-0 text-white ">
                            Total Questions:
                            <?= $examineeDtls->exam_ques ?? '' ?>
                        </p>
                    </div>
                    <div id="examTimer" data-s="<?= $s ?>" data-m="<?= $m ?>" data-h="<?= $h ?>"
                        data-tot_sec="<?= $tot_sec ?>" data-id="<?= $ia_id ?>" class="fw-bold text-white fs-2">
                        00:00:00
                    </div>
                </div>
                <?php if(session()->getFlashdata('message') !== NULL){
                    echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
                } ?>
                <div class="card-body">
                    <div style="max-height: 700px; overflow-y: auto; padding-right:10px;">
                        <form action="<?= current_url() ?>" method="post" id="internExamForm">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="examinee_id" value="<?= $examineeDtls->ia_id ?>">
                            <input type="hidden" name="tot_ques" value="<?= $examineeDtls->exam_ques ?>">
                            <?php
                            $n = 1;
                            $k = 0;
                            ?>
                            <?php if ($examineeDtls->ex_submit != '') : ?>
                            <?php $subQuestions = json_decode($examineeDtls->ex_submit); ?>
                            <?php foreach ($subQuestions as $list) : ?>
                            <input type="hidden" name="qno[<?= $k ?>]" value="<?= $list->qno ?>">
                            <input type="hidden" name="c_ans[<?= $k ?>]" value="<?= $list->c_ans ?>">
                            <input type="hidden" name="q_title[<?= $k ?>]" value="<?= esc($list->q_title) ?>">
                            <input type="hidden" name="opt1[<?= $k ?>]" value="<?= esc($list->opt1) ?>">
                            <input type="hidden" name="opt2[<?= $k ?>]" value="<?= esc($list->opt2) ?>">
                            <input type="hidden" name="opt3[<?= $k ?>]" value="<?= esc($list->opt3) ?>">
                            <input type="hidden" name="opt4[<?= $k ?>]" value="<?= esc($list->opt4) ?>">
                            <div class="card mb-3 p-3">
                                <label class="fw-bold mb-3">
                                    Q.
                                    <?= $n . '. ' . esc($list->q_title) ?>
                                </label>
                                <div class="form-check ms-4 mb-2">
                                    <input class="form-check-input" type="radio" name="answer[<?= $k ?>]" value="A"
                                        id="optA<?= $n ?>" <?=($list->answer == 'A') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="optA<?= $n ?>">
                                        <?= esc($list->opt1) ?>
                                    </label>
                                </div>
                                <div class="form-check ms-4 mb-2">
                                    <input class="form-check-input" type="radio" name="answer[<?= $k ?>]" value="B"
                                        id="optB<?= $n ?>" <?=($list->answer == 'B') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="optB<?= $n ?>">
                                        <?= esc($list->opt2) ?>
                                    </label>
                                </div>
                                <div class="form-check ms-4 mb-2">
                                    <input class="form-check-input" type="radio" name="answer[<?= $k ?>]" value="C"
                                        id="optC<?= $n ?>" <?=($list->answer == 'C') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="optC<?= $n ?>">
                                        <?= esc($list->opt3) ?>
                                    </label>
                                </div>
                                <div class="form-check ms-4 mb-2">
                                    <input class="form-check-input" type="radio" name="answer[<?= $k ?>]" value="D"
                                        id="optD<?= $n ?>" <?=($list->answer == 'D') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="optD<?= $n ?>">
                                        <?= esc($list->opt4) ?>
                                    </label>
                                </div>
                            </div>
                            <?php
                            $n++;
                            $k++;
                            ?>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if (!empty($questions)) : ?>
                            <?php foreach ($questions as $list) : ?>
                            <input type="hidden" name="qno[<?= $k ?>]" value="<?= $list->q_id ?>">
                            <input type="hidden" name="c_ans[<?= $k ?>]" value="<?= $list->correct_opt ?>">
                            <input type="hidden" name="q_title[<?= $k ?>]" value="<?= esc($list->question_title) ?>">
                            <input type="hidden" name="opt1[<?= $k ?>]" value="<?= esc($list->opt_a) ?>">
                            <input type="hidden" name="opt2[<?= $k ?>]" value="<?= esc($list->opt_b) ?>">
                            <input type="hidden" name="opt3[<?= $k ?>]" value="<?= esc($list->opt_c) ?>">
                            <input type="hidden" name="opt4[<?= $k ?>]" value="<?= esc($list->opt_d) ?>">
                            <div class="card mb-3 p-3">
                                <label class="fw-bold mb-3">
                                    Q.
                                    <?= $n . '. ' . esc($list->question_title) ?>
                                </label>
                                <div class="form-check ms-4 mb-2">
                                    <input class="form-check-input" type="radio" name="answer[<?= $k ?>]" value="A"
                                        id="optA<?= $n ?>">
                                    <label class="form-check-label" for="optA<?= $n ?>">
                                        <?= esc($list->opt_a) ?>
                                    </label>
                                </div>
                                <div class="form-check ms-4 mb-2">
                                    <input class="form-check-input" type="radio" name="answer[<?= $k ?>]" value="B"
                                        id="optB<?= $n ?>">
                                    <label class="form-check-label" for="optB<?= $n ?>">
                                        <?= esc($list->opt_b) ?>
                                    </label>
                                </div>
                                <div class="form-check ms-4 mb-2">
                                    <input class="form-check-input" type="radio" name="answer[<?= $k ?>]" value="C"
                                        id="optC<?= $n ?>">
                                    <label class="form-check-label" for="optC<?= $n ?>">
                                        <?= esc($list->opt_c) ?>
                                    </label>
                                </div>
                                <div class="form-check ms-4 mb-2">
                                    <input class="form-check-input" type="radio" name="answer[<?= $k ?>]" value="D"
                                        id="optD<?= $n ?>">
                                    <label class="form-check-label" for="optD<?= $n ?>">
                                        <?= esc($list->opt_d) ?>
                                    </label>
                                </div>
                            </div>
                            <?php
                            $n++;
                            $k++;
                            ?>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if ($examineeDtls->ex_submit == '' && empty($questions)) : ?>
                            <p class="text-danger">Something Wrong!</p>
                            <?php else : ?>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success btn-lg">
                                    Submit Exam
                                </button>
                            </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {

        let form = document.getElementById("internExamForm");

        // 👉 अगर form ही नहीं है तो कुछ मत करो
        if (!form) return;

        // 👉 सिर्फ उसी form के अंदर वाले radio buttons select करो
        let radios = form.querySelectorAll('input[type="radio"]');

        if (!radios.length) return;

        radios.forEach(function (radio) {
            radio.addEventListener("click", function () {

                let formData = new FormData(form);
                let url = "<?=base_url('/intern-exam-save-result')?>";

                fetch(url, {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(res => {
                    console.log(res);
                })
                .catch(err => console.error(err));

            });
        });

    });
    document.addEventListener("DOMContentLoaded", function () {

        let span = document.getElementById('examTimer');

        if (!span) return;

        let s = parseInt(span.dataset.s);
        let m = parseInt(span.dataset.m);
        let h = parseInt(span.dataset.h);
        let tot_sec = parseInt(span.dataset.total);
        let id = parseInt(span.dataset.id);

        let intVal = null;

        function formatTime(h, m, s) {
            return ("0" + h).slice(-2) + ":" +
                ("0" + m).slice(-2) + ":" +
                ("0" + s).slice(-2);
        }

        function time() {

            if (tot_sec < 1 || (s === 0 && m === 0 && h === 0)) {

                span.textContent = formatTime(h, m, s);

                let form = document.getElementById("internExamForm");
                if (form) form.submit();

                clearInterval(intVal);

                let loader = document.getElementById("loader");
                if (loader) loader.style.display = "block";

                return;
            } else {
                $.ajax({
                    type: 'POST',
                    url: "<?=base_url('intern-update-examinee-duration')?>",
                    data: {s:s, m:m, h:h, id:id},
                    success: function(res){

                    }
                });
            }

            if (s < 1) {
                m--;
                s = 59;
            }

            if (m < 0 && h > 0) {
                h--;
                m = 59;
            }

            span.textContent = formatTime(h, m, s);

            s--;
            tot_sec--;
        }

        intVal = setInterval(time, 1000);

    });

</script>