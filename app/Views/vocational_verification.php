<div class="edu-breadcrumb-area breadcrumb-style-2 ">
    <img src="<?= base_url('public/assets/images/bg/bg-image-19.webp') ?>" class="breadcrumb-bg" alt="">
    <div class="container breadcrumb-content">
        <div class="breadcrumb-inner">
            <div class="page-title">
                <h1 class="title">Vocational Verification</h1>
            </div>
        </div>
    </div>
</div>
<div class="edu-brand-area brand-area-2 bg-image">
    <div class="container">
        <form action="<?=current_url()?>" method="get">
            <div class="row g-5">
                <div class="col-md-8">
                    <div class="form-group">
                        <input type="text" name="cert_no" value="<?=(isset($_GET['cert_no'])?$_GET['cert_no']:'')?>"
                            class="form-control" placeholder="Enter Certificate Number/Enrollment No" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="edu-btn">Search</button>
                    <a href="<?=base_url('/vocational-certificate-verification')?>" class="edu-btn"
                        style="overflow: initial">Reset</a>
                </div>
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
            </div>
        </form>
    </div>
    <?php if(isset($certDtls) && !empty($certDtls)){ ?>
    <div class="container px-3 px-md-4 py-4">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">

                <table class="table align-middle mb-0">
                    <tbody>

                        <!-- Header -->
                        <tr>
                            <th style="width:60%;">
                                <strong>Student Details</strong>
                            </th>

                            <?php if ($certDtls->image != '') { ?>
                            <th style="width:40%; text-align:center;">

                                <div class="student-photo">
                                    <img src="<?= base_url(IMAGE_PATH.$certDtls->image) ?>" alt="Student Photo"
                                        class="student-img">

                                    <!-- Verified Stamp -->
                                    <img src="<?= base_url(IMAGE_PATH.'verified.png') ?>" alt="Verified"
                                        class="verified-stamp">
                                </div>

                            </th>
                            <?php } ?>
                        </tr>

                        <tr>
                            <td>Enrollment No</td>
                            <td colspan="2">
                                <?= $certDtls->reg_no ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Student's Name</td>
                            <td colspan="2">
                                <?= ucwords($certDtls->stu_name) ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Internship Course</td>
                            <td colspan="2">
                                <?= $certDtls->course_name ?>
                            </td>
                        </tr>

                        <?php if ($certDtls->cert_no != '' && $certDtls->status == 5) { ?>

                        <tr>
                            <td>Certificate No</td>
                            <td colspan="2">
                                <?= $certDtls->cert_no ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Grade</td>
                            <td colspan="2">
                                <?= $certDtls->grade ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Completion Date</td>
                            <td colspan="2">
                                <?= date('d M Y', strtotime($certDtls->completion_date)) ?>
                            </td>
                        </tr>

                        <?php } ?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <?php } ?>
</div>