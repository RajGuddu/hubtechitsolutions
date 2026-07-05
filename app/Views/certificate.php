

    <div class="edu-breadcrumb-area breadcrumb-style-2 bg-image bg-image--19">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="page-title">
                    <h1 class="title">Your Certificates</h1>
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
                        <input type="text" name="cert_no" value="<?=(isset($_GET['cert_no'])?$_GET['cert_no']:'')?>" class="form-control" placeholder="Enter Certificate Number/Enrollment No" required>

                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="edu-btn" >Search</button>
                    <a href="<?=base_url('/certificate-verification')?>" class="edu-btn" style="overflow: initial">Reset</a>
                </div>
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
        <div class="container px-4 py-4">
            <div class="row">
                <div class="offset-md-2 col-md-8">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th><strong>Certificate Details</strong></th>
                                <th><span class="btn btn-success">Approved</span></th>
                            </tr>
                            <tr>
                                <td>Student's Name</td>
                                <td><?=$certDtls->student_name?></td>
                            </tr>
                            <tr>
                                <td>Father's Name</td>
                                <td><?=$certDtls->f_name?></td>
                            </tr>
                            <tr>
                                <td>Course</td>
                                <td><?=$certDtls->course?></td>
                            </tr>
                            <tr>
                                <td>Certificate No</td>
                                <td><?=$certDtls->cert_no?></td>
                            </tr>
                            <tr>
                                <td>Enrollment No</td>
                                <td><?=$certDtls->enrollment_no?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><span class="text-primary"><strong>Note:- For more information please contact the office.</strong></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>
            
        