<style>
    .form-card {
        width: 100%;
        max-width: 800px;
        background: #fff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    }

    .form-control {
        border: 1px solid #ced4da !important;
    }

    /* Label color black */
    .form-label {
        color: #000 !important;
        font-weight: 600;
    }

    /* Input and Select size increase */
    .form-control,
    .form-select {
        height: 55px;
        font-size: 18px;
    }

    /* Select option text size */
    .form-select option {
        font-size: 18px;
    }

    /* Placeholder size */
    .form-control::placeholder {
        font-size: 18px;
    }

    .submit-btn {
        background: linear-gradient(45deg, #0d6efd, #4f46e5);
        border: none;
        color: white;
        padding: 12px 40px;
        font-size: 18px;
        font-weight: 600;
        border-radius: 30px;
        transition: all .3s ease;
        box-shadow: 0 5px 15px rgba(13, 110, 253, .3);
    }

    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(13, 110, 253, .4);
    }

    .submit-btn:active {
        transform: scale(.97);
    }

    .form-check {
        padding-left: 0 !important;
        margin-top: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-check-input {
        width: 20px;
        height: 20px;
        cursor: pointer;
        border: 2px solid #0d6efd;
    }

    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .form-check-label {
        color: #000;
        font-size: 17px;
        font-weight: 500;
        cursor: pointer;
    }
</style>

<div class="container min-vh-100 d-flex justify-content-center align-items-center">
    <div class="form-card">

        <h2 class="text-center mb-4">
            Student Enrollment Form
        </h2>
        <?php if(session()->getFlashdata('success') != NULL){ ?>
        <div class="col-md-12">
            <div class="alert alert-success">
                <?php echo session()->getFlashdata('success'); unset($_SESSION['success']);?>
            </div>
        </div>
        <?php } ?>
        <?php if(session()->getFlashdata('err') != NULL){ ?>
        <div class="col-md-12">
            <div class="alert alert-danger">
                <?php echo session()->getFlashdata('err'); unset($_SESSION['err']);?>
            </div>
        </div>
        <?php } ?>

        <form action="<?=current_url()?>" method="post">
            <?=csrf_field() ?>

            <div class="row">

                <!-- Textboxes -->

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Student Name
                    </label>
                    <input type="text" class="form-control" name="stu_name" value="<?=set_value('stu_name'); ?>">
                    <span class="text-danger">
                        <?= isset($validation) ? display_error($validation, 'stu_name') : '' ?>
                    </span>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Email
                    </label>
                    <input type="email" class="form-control" name="email" value="<?=set_value('email'); ?>">
                    <span class="text-danger">
                        <?= isset($validation) ? display_error($validation, 'email') : '' ?>
                    </span>

                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Mobile No
                    </label>
                    <input type="text" class="form-control" name="phone" value="<?=set_value('phone'); ?>">
                    <span class="text-danger">
                        <?= isset($validation) ? display_error($validation, 'phone') : '' ?>
                    </span>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        University Roll No
                    </label>
                    <input type="text" class="form-control" name="uni_roll_no" value="<?=set_value('uni_roll_no'); ?>">
                    <span class="text-danger">
                        <?= isset($validation) ? display_error($validation, 'uni_roll_no') : '' ?>
                    </span>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        University Registration No
                    </label>
                    <input type="text" class="form-control" name="uni_reg_no" value="<?=set_value('uni_reg_no'); ?>">
                    <span class="text-danger">
                        <?= isset($validation) ? display_error($validation, 'uni_reg_no') : '' ?>
                    </span>
                </div>

                <!-- Select Boxes -->

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Gender
                    </label>
                    <select class="form-select" name="gender">
                        <option value="">Select Gender</option>
                        <option value="M" <?=set_select('gender', 'M' ) ?>>Male</option>
                        <option value="F" <?=set_select('gender', 'F' ) ?>>Female</option>
                        <option value="O" <?=set_select('gender', 'O' ) ?>>Other</option>
                    </select>
                    <span class="text-danger">
                        <?= isset($validation) ? display_error($validation, 'gender') : '' ?>
                    </span>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Class
                    </label>
                    <select class="form-select" name="class">
                        <option value="">Select Class</option>
                        <option value="BA" <?=set_select('class','BA') ?>>BA</option>
                        <option value="B.Sc" <?=set_select('class','B.Sc') ?>>B.Sc</option>
                        <option value="B.Com" <?=set_select('class','B.Com') ?>>B.Com</option>
                    </select>
                    <span class="text-danger">
                        <?= isset($validation) ? display_error($validation, 'class') : '' ?>
                    </span>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        MJC Subject
                    </label>
                    <select class="form-select" name="mjc_id">
                        <option value="">Select Department</option>
                        <?php if(!empty($mjc)){
                            foreach($mjc as $list){ ?>
                        <option value="<?=$list->mjc_id?>" <?=set_select('mjc_id', $list->mjc_id)
                            ?>><?=$list->sub_name?></option>
                        <?php }
                        } ?>
                    </select>
                    <span class="text-danger">
                        <?= isset($validation) ? display_error($validation, 'mjc_id') : '' ?>
                    </span>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Session
                    </label>
                    <select class="form-select" name="session">
                        <option value="">Select Session</option>
                        <option value="2023-2027" <?=set_select('session', '2023-2027' ) ?> >2023-2027</option>
                        <option value="2024-2028" <?=set_select('session', '2023-2027' ) ?> >2024-2028</option>
                    </select>
                    <span class="text-danger">
                        <?= isset($validation) ? display_error($validation, 'session') : '' ?>
                    </span>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Semester
                    </label>
                    <select class="form-select" name="semester">
                        <option value="">Select Semester</option>
                        <option value="5" <?=set_select('session', '5' ) ?>>5</option>
                    </select>
                    <span class="text-danger">
                        <?= isset($validation) ? display_error($validation, 'semester') : '' ?>
                    </span>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        College/Institute
                    </label>
                    <select class="form-select" name="clg_id">
                        <option value="">Select College/Institute</option>
                        <?php if(!empty($colleges)){
                            foreach($colleges as $list){ ?>
                        <option value="<?=$list->clg_id?>" <?=set_select('clg_id', $list->clg_id)
                            ?>><?=$list->college_name?></option>
                        <?php }
                        } ?>
                    </select>
                    <span class="text-danger">
                        <?= isset($validation) ? display_error($validation, 'clg_id') : '' ?>
                    </span>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Internship Course
                    </label>
                    <select class="form-select" name="ic_id">
                        <option value="">Select Course</option>
                        <?php if(!empty($icourses)){
                            foreach($icourses as $list){ ?>
                        <option value="<?=$list->ic_id?>" <?=set_select('ic_id', $list->ic_id) ?>><?=$list->ic_name?>
                        </option>
                        <?php }
                        } ?>
                    </select>
                    <span class="text-danger">
                        <?= isset($validation) ? display_error($validation, 'ic_id') : '' ?>
                    </span>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Duration
                    </label>
                    <select class="form-select" name="duration">
                        <option value="">Select Duration</option>
                        <option value="120" <?=set_select('duration', '120' ) ?>>120 Hrs</option>
                    </select>
                    <span class="text-danger">
                        <?= isset($validation) ? display_error($validation, 'duration') : '' ?>
                    </span>
                </div>

            </div>

            <!-- Terms Checkbox -->
            <div class="">
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" id="terms" name="terms" value="1"
                        <?=set_checkbox('terms','1'); ?>>
                    <label class="form-check-label" for="terms">
                        I agree to Terms & Conditions
                    </label>
                </div>
                <span class="text-danger">
                    <?= isset($validation) ? display_error($validation, 'terms') : '' ?>
                </span>
            </div>

            <!-- Submit Button -->

            <div class="text-center mt-4">
                <button type="submit" class="submit-btn">
                    Pay &#x20B9;300 & Submit
                </button>
            </div>

        </form>

    </div>
</div>