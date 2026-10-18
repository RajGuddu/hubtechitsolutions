<?php $request = \Config\Services::request();
        $uri = $request->getUri();
        $segment2 = $uri->getSegment(2);?>
<section class="festival-section py-5">
    <div class="container">
        <div class="festival-card">
            <div class="row g-0">
                <div class="col-lg-12">
                    <?php if(session()->getFlashdata('message') !== NULL){
                        echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
                    } ?>
                </div>
                <?php if(!empty($record)){ ?>
                <!-- Left Side -->
                <div class="col-lg-6">
                    <div class="festival-cover">
                        <img src="<?= base_url(IMAGE_PATH.$record->image) ?>" alt="<?=ucwords($record->festival_title)?>"
                            class="festival-cover-img">
                        <div class="festival-overlay"></div>
                        <div class="festival-cover-content">
                            <span class="festival-label">
                                FESTIVAL SPECIAL
                            </span>
                            <h1>
                                <?=ucwords($record->festival_title)?>
                            </h1>
                            <p>
                                Celebrate the spirit of <?=ucwords($record->festival_title)?> with us
                                and receive your special <?=ucwords($record->festival_title)?> certificate.
                            </p>
                            <div class="festival-date">
                                <i class="bi bi-calendar-event"></i>
                                Festival Celebration <?=date('Y')?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right Side -->
                <div class="col-lg-6" style="<?=($segment2 == '')?'':'display:none'?>">
                    <div class="festival-form-wrapper">

                        <div class="festival-form-header">
                            <span class="form-small-title">
                                <?=strtoupper($record->festival_title)?> FESTIVAL CERTIFICATE
                            </span>
                            <h2>
                                Celebrate &amp;
                                <span>Get Certified</span>
                            </h2>
                            <p>
                                Fill in your basic details to receive
                                your <?=ucwords($record->festival_title)?> Festival Certificate.
                            </p>
                        </div>
                        
                        <form action="<?=current_url()?>" method="post">
                            <?=csrf_field()?>
                            <input type="hidden" name="fes_id" value="<?=$record->id ?? ''?>">
                            <!-- Full Name -->
                            <div class="mb-3">
                                <label class="form-label">
                                    Full Name <span>*</span>
                                </label>
                                <input type="text" name="name" value="<?=set_value('name')?>" class="form-control festival-input"
                                    placeholder="Enter your full name" >
                                <span class="text-danger">
                                    <?= isset($validation) ? display_error($validation, 'name') : '' ?>
                                </span>
                            </div>
                            <div class="row">
                                <!-- Mobile -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Mobile Number <span>*</span>
                                        </label>
                                        <input type="tel" name="phone" value="<?=set_value('name')?>" class="form-control festival-input"
                                            placeholder="10 digit mobile" maxlength="10" >
                                        <span class="text-danger">
                                            <?= isset($validation) ? display_error($validation, 'phone') : '' ?>
                                        </span>
                                    </div>
                                </div>
                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Email Address<span>*</span>
                                        </label>
                                        <input type="email" name="email" value="<?=set_value('email')?>" class="form-control festival-input"
                                            placeholder="Enter Email address">
                                        <span class="text-danger">
                                            <?= isset($validation) ? display_error($validation, 'email') : '' ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Last Qualification <span>*</span>
                                        </label>
                                        <input type="text" name="last_qly" value="<?=set_value('last_qly')?>" class="form-control festival-input" placeholder="Enter Last Qualification">
                                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'last_qly') : '' ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Study center/School/College <span>*</span>
                                        </label>
                                        <input type="text" name="study_center" value="<?=set_value('study_center')?>" class="form-control festival-input" placeholder="Enter Study center/School/College">
                                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'study_center') : '' ?></span>
                                    </div>
                                </div>
                            </div>
                            <!-- Address -->
                            <div class="mb-3">
                                <label class="form-label">
                                    Address
                                </label>
                                <input type="text" name="address" value="<?=set_value('address')?>" class="form-control festival-input"
                                    placeholder="Enter your address">
                            </div>
                            <div class="row">
                                <!-- State -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            State 
                                        </label>
                                        <select name="state" id="state" class="form-select festival-input">
                                            <option value="">Select state</option>
                                            <?php if(!empty($states)){
                                                foreach($states as $list){
                                                    echo '<option value="'.esc($list->name).'" '.set_select('state', $list->name).'>'.esc($list->name).'</option>';
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- district -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            District
                                        </label>
                                        <select name="district" id="district" class="form-select festival-input">
                                            <option value="">Select District</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <!-- Occupation -->
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Occupation
                                        </label>
                                        <select name="occupation" class="form-select festival-input">
                                            <option value="">Select occupation</option>
                                            <option value="Student" <?= set_select('occupation', 'Student') ?>>Student</option>
                                            <option value="Job" <?= set_select('occupation', 'Job') ?>>Job</option>
                                            <option value="Business" <?= set_select('occupation', 'Business') ?>>Business</option>
                                            <option value="Self Employed" <?= set_select('occupation', 'Self Employed') ?>>Self Employed</option>
                                            <option value="Other" <?= set_select('occupation', 'Other') ?>>Other</option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            <?php /*
                            <div class="mb-3">
                                <label class="form-label">
                                    Center Address <span>*</span>
                                </label>
                                <input type="text" name="center_address" value="<?=set_value('center_address')?>" class="form-control festival-input" placeholder="Enter center address">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'center_address') : '' ?></span>

                            </div> */ ?>
                            <!-- Consent -->
                            <div class="festival-consent">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="consent" value="1" id="festivalConsent" <?= set_checkbox('consent', '1') ?>>
                                    <label class="form-check-label" for="festivalConsent">
                                        I agree to provide my personal
                                        information for registration and
                                        issuance of the Festival Certificate.
                                    </label>
                                </div>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'consent') : '' ?></span>
                            </div>
                            <input type="hidden" name="token" id="token" value="">
                            <!-- Button -->
                            <button type="submit" class="festival-submit-btn">
                                Get My Festival Certificate
                                <i class="bi bi-arrow-right"></i>
                            </button>
                            <div class="certificate-note">
                                <i class="bi bi-shield-check"></i>
                                Your information is secure and used for
                                certificate-related purposes.
                            </div>
                        </form>


                    </div>
                </div>
                <div class="col-lg-6" style="<?=($segment2 != '')?'':'display:none'?>">
                    <div class="festival-form-wrapper">
                        <div class="festival-pdf-header">
                            <div> 
                                <?php /* <span class="form-small-title"> <?=ucwords($record->festival_title)?> CERTIFICATE </span> */ ?>
                                <h2 > <span style="color:#80082b"><?=strtoupper($record->festival_title)?> CERTIFICATE <span></h2>
                                <p style="color:#0c2778"> Your certificate has been generated successfully. </p>
                            </div>
                        </div> <!-- Actual PDF -->
                        <?php if(!empty($fesData)){ ?>
                        <div class="festival-pdf-viewer"> 
                            <iframe src="<?= base_url('get-festival-certificate/'.$fesData->fes_cert_no) ?>" class="festival-pdf-frame"> </iframe> 
                        </div> <!-- PDF Button -->
                        <div class="festival-pdf-actions"> <a href="<?= base_url('get-festival-certificate/'.$fesData->fes_cert_no.'/'.'D') ?>"
                            class="festival-pdf-btn" onclick="return confirm('Are u sure to download?')"> <i class="bi bi-file-earmark-pdf"></i> Download PDF
                            </a> 
                        </div>
                        <?php }else{
                            echo '<div class="text-center text-danger fw-4">Certificate Not Found!</div>';
                        }?>
                    </div>
                </div> <!-- end-6 -->
                <?php }else{
                    echo '<div class="col-lg-12 text-center text-danger">No Festival at this time!</div>';
                }?>
            </div>
        </div>
    </div>
</section>

<script src="https://www.google.com/recaptcha/api.js?render=<?=$siteKey?>"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('<?=$siteKey?>', {action: 'submit'}).then(function(token) {
            var response = document.getElementById("token");
            response.value = token;
        });
    });
</script>
<script>
$(document).ready(function () {

    $('#state').on('change', function () {

        let state = $(this).val();

        $('#district').html('<option value="">Loading...</option>');

        if (state === '') {
            $('#district').html('<option value="">Select District</option>');
            return;
        }

        $.ajax({
            url: "<?= base_url('get-districts') ?>",
            type: "POST",
            data: {
                state: state
            },
            dataType: "json",

            success: function (response) {
                let options = '<option value="">Select District</option>';

                if (response.length > 0) {
                    $.each(response, function (index, district) {
                        options += '<option value="' + $('<div>').text(district.city).html() + '">'
                            + $('<div>').text(district.city).html()
                            + '</option>';
                    });
                } else {
                    options = '<option value="">No districts found</option>';
                }

                $('#district').html(options);
            },

            error: function () {
                $('#district').html('<option value="">Unable to load districts</option>');
            }
        });

    });

});
</script>
