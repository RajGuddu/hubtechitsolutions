

    <div class="edu-breadcrumb-area breadcrumb-style-2 bg-image bg-image--19">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="page-title">
                    <h1 class="title">Internship Verification</h1>
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
                    <a href="<?=base_url('/intern-certificate-verification')?>" class="edu-btn" style="overflow: initial">Reset</a>
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
                                <td><?=$certDtls->stu_name?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?=$certDtls->email?></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td><?=$certDtls->phone?></td>
                            </tr>
                            <tr>
                                <td>Course</td>
                                <td><?=$certDtls->ic_name?></td>
                            </tr>
                            <tr>
                                <td>University Roll No</td>
                                <td><?=$certDtls->uni_roll_no?></td>
                            </tr>
                            <tr>
                                <td>University Reg No</td>
                                <td><?=$certDtls->uni_reg_no?></td>
                            </tr>
                            <tr>
                                <td>Enrollment No</td>
                                <td><?=$certDtls->enroll_id?></td>
                            </tr>
                            <tr>
                                <?php /* <td colspan="2" class="text-center"><button type="button" class="btn btn-success btn-lg px-5" onclick="alert('Download feature is currently under development.')">Download Letter</button></td> */ ?>
                                <td colspan="2" class="text-center"><a href="<?=base_url('download-intern-letter/'.$certDtls->ie_id)?>" class="btn btn-success btn-lg px-5" >Download Letter</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>
            
        