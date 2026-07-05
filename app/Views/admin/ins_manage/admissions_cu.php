<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <script language="Javascript" src="<?php echo base_url('editor/scripts/innovaeditor.js'); ?>"></script>
    
        <div class="content-wrapper">
            <form class="" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card bg-info">
                        <div class="card-body">
                        <h4 class="card-title"><?php echo (isset($adm_data))?'Update Admissions':'Create Admissions'; ?></h4>
                        <!-- <p class="card-description">
                            Basic form elements
                        </p> -->
                        
                        <?= csrf_field(); ?>
                            <div class="form-group">
                                <label for="adm_date">Date of Admission</label>
                                <input type="date" class="form-control" id="adm_date" name="adm_date" value="<?=set_value('adm_date', (isset($adm_data->adm_date))?$adm_data->adm_date:''); ?>" placeholder="Date of Admission">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'adm_date') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="stu_name">Student Name</label>
                                <input type="text" class="form-control" id="stu_name" name="stu_name" value="<?=set_value('stu_name', (isset($adm_data->stu_name))?$adm_data->stu_name:''); ?>" placeholder="Student's Name">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'stu_name') : '' ?></span>
                            </div>
                            <div class="row">
                                <?php if(isset($adm_data->stu_image) && $adm_data->stu_image != ''){ ?>
                                    <div class="col-md-6">
                                        <img src="<?=base_url('public/assets/upload/images/'.$adm_data->stu_image) ?>" width="150px" height="80px" />
                                    </div>
                                <?php } ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Photo</label>
                                        <input type="file" class="form-control" id="stu_image" name="stu_image">
                                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'stu_image') : '' ?></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="f_name">Father's Name</label>
                                <input type="text" class="form-control" id="f_name" name="f_name" value="<?=set_value('f_name', (isset($adm_data->f_name))?$adm_data->f_name:''); ?>" placeholder="Father's name">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'f_name') : '' ?></span>
                            </div>
                            <?php /* <div class="form-group">
                                <label for="details">About Instructor</label>
                                <textarea name="details" id="details" cols="30" rows="4" class="form-control" placeholder="About Instructor"><?=set_value('details', isset($adm_data->details)?$adm_data->details:'')?></textarea>
                                <script>
                                    var oEdit1 = new InnovaEditor("oEdit1");					
                                    oEdit1.width='100%';
                                    oEdit1.height=300;			
                                    oEdit1.arrStyle = ["BODY",false,"","margin:5px; padding:0px; font-family:Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size:10pt;"];
                                    oEdit1.features=["Save","Preview","|","Undo","Redo","|","Numbering","Bullets","|","Indent","Outdent","|","Superscript","Subscript","|","Image","Flash","Media","|","Table","Guidelines","Absolute","|","Characters","Line","Form","Hyperlink","ClearAll","BRK","StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","|","Paragraph","FontName","FontSize","|","Bold","Italic","Underline","Strikethrough","|","ForeColor","BackColor","|","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","|","XHTMLSource","Clean"];
                                    oEdit1.cmdAssetManager = "modalDialogShow('<?php echo base_url(); ?>editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
                                    oEdit1.onSave = new Function("submitEditContentForm()");
                                    oEdit1.REPLACE("details");		
                                    oEdit1.mode="XHTMLBody";
                                </script>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'details') : '' ?></span>
                            </div> */ ?>
                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob" value="<?=set_value('dob', (isset($adm_data->dob))?$adm_data->dob:''); ?>" placeholder="DOB">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'dob') : '' ?></span>
                            </div>
                            <script>
                                $("#dob").change(function(){
                                    var dob = $("#dob").val();
                                    dob = new Date(dob);
                                    var today = new Date();
                                    var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                                    $('#age').val(age);
                                });
                            </script>
                            <div class="form-group">
                                <label for="age">Age </label>
                                <input type="number" class="form-control" id="age" name="age" value="<?=set_value('age', (isset($adm_data->age))?$adm_data->age:''); ?>" placeholder="Age" readonly>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'age') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="phone1">Phone 1</label>
                                <input type="text" class="form-control" id="phone1" name="phone1" value="<?=set_value('phone1', (isset($adm_data->phone1))?$adm_data->phone1:''); ?>" placeholder="Phone 1">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'phone1') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="phone2">Phone 2</label>
                                <input type="text" class="form-control" id="phone2" name="phone2" value="<?=set_value('phone2', (isset($adm_data->phone2))?$adm_data->phone2:''); ?>" placeholder="Phone 2">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'phone2') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?=set_value('email', (isset($adm_data->email))?$adm_data->email:''); ?>" placeholder="Email">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card bg-info">
                        <div class="card-body">
                            
                            <div class="form-group">
                                <label for="batch_id">Select Batch</label>
                                <select name="batch_id" id="batch_id" class="form-control">
                                    <option value="">Select One</option>
                                    <?php if(!empty($batches)){
                                        foreach($batches as $list){ 
                                            $true = (isset($adm_data) && $adm_data->batch_id == $list->batch_id)?true:''?>
                                            <option value="<?=$list->batch_id ?>" <?=set_select('batch_id', $list->batch_id,$true)?>><?=$list->batch_name?></option>
                                    <?php }
                                    } ?>
                                </select>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'batch_id') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="qualification">Last Qualification</label>
                                <select name="qualification" id="qualification" class="form-control">
                                    <option value="">Select One</option>
                                    <?php if(!empty($qualification)){
                                        foreach($qualification as $list){ 
                                            $true = (isset($adm_data) && $adm_data->qualification == $list->qly_id)?true:''?>
                                            <option value="<?=$list->qly_id?>" <?=set_select('qualification', $list->qly_id,$true)?>><?=$list->qualification?></option>
                                    <?php }
                                    } ?>
                                    <option value="other">Other Qualification</option>
                                </select>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'qualification') : '' ?></span>
                            </div>
                            <div class="form-group" style="display:none;" id="other_qly">
                                <label for="qualification"><strong> Other Qualification</strong></label>
                                <input type="text" name="other_qly" class="form-control" value="" placeholder="Other Qualification">
                            </div>
                            
                            <div class="form-group">
                                <label for="course_id">Course</label>
                                <select name="course_id" id="course_id" class="form-control">
                                    <option value="">Select Course</option>
                                    <?php if(!empty($courses)){
                                        $true = '';
                                        foreach($courses as $value){ 
                                            $true = (isset($adm_data->course_id) && $value->course_id==$adm_data->course_id)?TRUE:''?>
                                            <option value="<?=$value->course_id?>" <?=set_select('course_id',$value->course_id, $true)?>><?=$value->course_name?></option>
                                    <?php }
                                    } ?>
                                </select>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'course_id') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="co_address">Correspondence Address</label>
                                <input type="text" class="form-control" id="co_address" name="co_address" value="<?=set_value('co_address', (isset($adm_data->co_address))?$adm_data->co_address:''); ?>" placeholder="Correspondence Address">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'co_address') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="p_address">Permanent Address</label>
                                <input type="text" class="form-control" id="p_address" name="p_address" value="<?=set_value('p_address', (isset($adm_data->p_address))?$adm_data->p_address:''); ?>" placeholder="Permanent Address">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'p_address') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="study_meterial">Study Meterial</label>
                                <?php if(isset($adm_data->study_meterial) && $adm_data->study_meterial != ''){
                                    $study_meterialArr = explode(',', $adm_data->study_meterial);
                                } ?>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="study_meterial[]" value="1" <?=(isset($study_meterialArr) && in_array('1', $study_meterialArr))?'checked':''?>>
                                            Bag
                                            <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="study_meterial[]" value="2" <?=(isset($study_meterialArr) && in_array('2', $study_meterialArr))?'checked':''?>>
                                            I.Card
                                            <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="study_meterial[]" value="3" <?=(isset($study_meterialArr) && in_array('3', $study_meterialArr))?'checked':''?>>
                                            Book
                                            <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="other">Others</label>
                                <input type="text" class="form-control" id="other" name="other" value="<?=set_value('other', (isset($adm_data->other))?$adm_data->other:''); ?>" placeholder="Permanent Address">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'other') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1, (isset($adm_data->status) && $adm_data->status == 1)?true:'')?>> Active </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($adm_data->status) && $adm_data->status == 0)?true:'')?>> Inactive </label>
                                </div>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button type="reset" class="btn btn-info">Reset</button>
                            <a href="<?=base_url('admin/admissions')?>" class="btn btn-warning">Cancel</a>

                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    
    <script>
        $("#qualification").change(function(){
            var qly = $("#qualification").val();
            if(qly == 'other'){
                $("#other_qly").show();
            }else{
                $("#other_qly").hide();
            }
        });
    </script>
    
<?=$this->endSection()?>