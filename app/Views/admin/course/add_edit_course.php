<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <script language="Javascript" src="<?php echo base_url('editor/scripts/innovaeditor.js'); ?>"></script>
    <style>
        .nav-pills .nav-link{
            padding: 0.3rem 1rem;
        }
    </style>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                    <h4 class="card-title"><?php echo (isset($course))?'Update <span class="text-danger">'.$course->course_full_name.'</span>':'Add Course'; ?></h4>
                    <?php if(session()->getFlashdata('message') !== NULL){
                        echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
                    } ?>
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <?php $active1 = $showactive1 = $active2 = $showactive2 = 
                        $active3 = $showactive3 = $active4 = $showactive4 = 
                        $active5 = $showactive5 = $active6 = $showactive6 = '';
                    if(isset($course) && $course->complete_tab == 1){
                        $active2 = 'active';
                        $showactive2 = 'show active';
                    }else if(isset($course) && $course->complete_tab == 2){
                        $active3 = 'active';
                        $showactive3 = 'show active';
                    }else if(isset($course) && $course->complete_tab == 3){
                        $active4 = 'active';
                        $showactive4 = 'show active';
                    }else if(isset($course) && $course->complete_tab == 4){
                        $active5 = 'active';
                        $showactive5 = 'show active';
                    }else if(isset($course) && $course->complete_tab == 5){
                        $active6 = 'active';
                        $showactive6 = 'show active';
                    }else{
                        $active1 = 'active';
                        $showactive1 = 'show active';
                    }
                    ?>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?=$active1?>" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Basic</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?=$active2?>" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Syllabus</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?=$active3?>" id="pills-learn-tab" data-bs-toggle="pill" data-bs-target="#pills-learn" type="button" role="tab" aria-controls="pills-learn" aria-selected="false">What you'll Learn</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?=$active4?>" id="pills-require-tab" data-bs-toggle="pill" data-bs-target="#pills-require" type="button" role="tab" aria-controls="pills-require" aria-selected="false">Requirements</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?=$active5?>" id="pills-instructors-tab" data-bs-toggle="pill" data-bs-target="#pills-instructors" type="button" role="tab" aria-controls="pills-instructors" aria-selected="false">Course Includes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?=$active6?>" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Publish</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade <?=$showactive1?>" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="course_id" value="<?=isset($course)?$course->course_id:''?>">
                            <div class="form-group">
                                <label for="course_name">Course Name</label>
                                <input type="text" class="form-control" id="course_name" name="course_name" value="<?=set_value('course_name', (isset($course->course_name))?$course->course_name:''); ?>" placeholder="Course Name">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'course_name') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="course_full_name">Course Full Name</label>
                                <input type="text" class="form-control" id="course_full_name" name="course_full_name" value="<?=set_value('course_full_name', (isset($course->course_full_name))?$course->course_full_name:''); ?>" placeholder="Course Full Name">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'course_full_name') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="url">Url</label>
                                <input type="text" class="form-control" id="url" name="url" value="<?=set_value('url', (isset($course))?$course->url:''); ?>" placeholder="Url" readonly>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'url') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="ccat_id">Course Category</label>
                                <select name="ccat_id" id="ccat_id" class="form-control">
                                    <option value="">Select Course Category</option>
                                    <?php if(!empty($course_category)){
                                        foreach($course_category as $list){ 
                                        $true = (isset($course->ccat_id) && $course->ccat_id == $list->ccat_id)?true:''?>
                                        <option value="<?=$list->ccat_id?>" <?=set_select('ccat_id',$list->ccat_id, $true)?>><?=$list->course_category_name?></option>

                                    <?php }
                                    } ?>
                                </select>
                                
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'ccat_id') : '' ?></span>
                            </div>
                            <div class="row">
                                <?php if(isset($course->image) && $course->image != ''){ ?>
                                    <div class="col-md-6">
                                        <img src="<?=base_url('public/assets/upload/images/'.$course->image) ?>" width="150px" height="80px" />
                                    </div>
                                <?php } ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'image') : '' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="short_description">Short Description</label>
                                <textarea name="short_description" id="short_description" cols="30" rows="4" class="form-control" placeholder="Short Description"><?=set_value('short_description', isset($course->short_description)?$course->short_description:'')?></textarea>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'short_description') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="description">About Course</label>
                                <textarea name="description" id="description" cols="30" rows="4" class="form-control" placeholder="Description"><?=set_value('description', isset($course->description)?$course->description:'')?></textarea>
                                <script>
                                    var oEdit1 = new InnovaEditor("oEdit1");					
                                    oEdit1.width='100%';
                                    oEdit1.height=400;			
                                    oEdit1.arrStyle = ["BODY",false,"","margin:5px; padding:0px; font-family:Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size:10pt;"];
                                    oEdit1.features=["Save","Preview","|","Undo","Redo","|","Numbering","Bullets","|","Indent","Outdent","|","Superscript","Subscript","|","Image","Flash","Media","|","Table","Guidelines","Absolute","|","Characters","Line","Form","Hyperlink","ClearAll","BRK","StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","|","Paragraph","FontName","FontSize","|","Bold","Italic","Underline","Strikethrough","|","ForeColor","BackColor","|","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","|","XHTMLSource","Clean"];
                                    oEdit1.cmdAssetManager = "modalDialogShow('<?php echo base_url(); ?>editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
                                    oEdit1.onSave = new Function("submitEditContentForm()");
                                    oEdit1.REPLACE("description");		
                                    oEdit1.mode="XHTMLBody";
                                </script>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'description') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="youtube_vlink">Youtube Link (if available)</label>
                                <input type="text" class="form-control" id="youtube_vlink" name="youtube_vlink" value="<?=set_value('youtube_vlink', (isset($course->youtube_vlink))?$course->youtube_vlink:''); ?>" placeholder="Youtube Link (if available)">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'youtube_vlink') : '' ?></span>
                            </div>

                            <input type="hidden" name="submit" value="basic">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <!-- <button type="reset" class="btn btn-info">Reset</button> -->
                            <a href="<?=base_url('admin/courses')?>" class="btn btn-warning">Cancel</a>
                            </form>

                        </div>

                        <!-- syllabus tab -->
                        <div class="tab-pane fade <?=$showactive2?>" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="course_id" value="<?=isset($course)?$course->course_id:''?>">

                            <?php if(isset($course) && $course->syllabus != ''){
                                $syllabus = json_decode($course->syllabus);
                               //print_r(explode(',',$syllabus[0]->syllabus));exit;
                            }
                            ?>
                            <div class="form-group">
                                <label for="module_name1">Module Name 1</label>
                                <input class="form-control" type="text" id="module_name1" name="module_name[0]" placeholder="Module name 1" value="<?=(isset($syllabus[0]))?$syllabus[0]->module_name:set_value('module_name[0]'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'module_name[0]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="syllabus1">Module 1 Syllabus <span class="text-danger">(Use COMA , between two subject)</span></label>
                                <textarea name="syllabus[0]" id="syllabus1" cols="30" rows="6" class="form-control" placeholder="Module 1 Syllabus"><?=(isset($syllabus[0]))?$syllabus[0]->syllabus:set_value('syllabus[0]')?></textarea>
                                <?php /*<script>
                                    var oEdit2 = new InnovaEditor("oEdit2");					
                                    oEdit2.width='100%';
                                    oEdit2.height=200;			
                                    oEdit2.arrStyle = ["BODY",false,"","margin:5px; padding:0px; font-family:Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size:10pt;"];
                                    oEdit2.features=["Save","Preview","|","Undo","Redo","|","Numbering","Bullets","|","Indent","Outdent","|","Superscript","Subscript","|","Image","Flash","Media","|","Table","Guidelines","Absolute","|","Characters","Line","Form","Hyperlink","ClearAll","BRK","StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","|","Paragraph","FontName","FontSize","|","Bold","Italic","Underline","Strikethrough","|","ForeColor","BackColor","|","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","|","XHTMLSource","Clean"];
                                    oEdit2.cmdAssetManager = "modalDialogShow('<?php echo base_url(); ?>editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
                                    oEdit2.onSave = new Function("submitEditContentForm()");
                                    oEdit2.REPLACE("");		
                                    oEdit2.mode="XHTMLBody";
                                </script> */ ?>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'syllabus[0]') : '' ?></span>
                            </div>

                            <div class="form-group">
                                <label for="module_name2">Module Name 2 </label>
                                <input class="form-control" type="text" id="module_name2" name="module_name[1]" placeholder="Module name 2" value="<?=(isset($syllabus[1]))?$syllabus[1]->module_name:set_value('module_name[1]'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'module_name[1]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="syllabus2">Module 2 Syllabus <span class="text-danger">(Use COMA , between two subject)</span></label>
                                <textarea name="syllabus[1]" id="syllabus2" cols="30" rows="6" class="form-control" placeholder="Module 2 Syllabus"><?=(isset($syllabus[1]))?$syllabus[1]->syllabus:set_value('syllabus[1]')?></textarea>
                                <?php /* <script>
                                    var oEdit3 = new InnovaEditor("oEdit3");					
                                    oEdit3.width='100%';
                                    oEdit3.height=200;			
                                    oEdit3.arrStyle = ["BODY",false,"","margin:5px; padding:0px; font-family:Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size:10pt;"];
                                    oEdit3.features=["Save","Preview","|","Undo","Redo","|","Numbering","Bullets","|","Indent","Outdent","|","Superscript","Subscript","|","Image","Flash","Media","|","Table","Guidelines","Absolute","|","Characters","Line","Form","Hyperlink","ClearAll","BRK","StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","|","Paragraph","FontName","FontSize","|","Bold","Italic","Underline","Strikethrough","|","ForeColor","BackColor","|","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","|","XHTMLSource","Clean"];
                                    oEdit3.cmdAssetManager = "modalDialogShow('<?php echo base_url(); ?>editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
                                    oEdit3.onSave = new Function("submitEditContentForm()");
                                    oEdit3.REPLACE("");		
                                    oEdit3.mode="XHTMLBody";
                                </script> */ ?>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'syllabus[1]') : '' ?></span>
                            </div>

                            <div class="form-group">
                                <label for="module_name3">Module Name 3</label>
                                <input class="form-control" type="text" id="module_name3" name="module_name[2]" placeholder="Module name 3" value="<?=(isset($syllabus[2]))?$syllabus[2]->module_name:set_value('module_name[2]'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'module_name[2]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="syllabus3">Module 3 Syllabus <span class="text-danger">(Use COMA , between two subject)</span></label>
                                <textarea name="syllabus[2]" id="syllabus3" cols="30" rows="6" class="form-control" placeholder="Module 3 Syllabus"><?=(isset($syllabus[2]))?$syllabus[2]->syllabus:set_value('syllabus[2]')?></textarea>
                                <?php /* <script>
                                    var oEdit4 = new InnovaEditor("oEdit4");					
                                    oEdit4.width='100%';
                                    oEdit4.height=200;			
                                    oEdit4.arrStyle = ["BODY",false,"","margin:5px; padding:0px; font-family:Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size:10pt;"];
                                    oEdit4.features=["Save","Preview","|","Undo","Redo","|","Numbering","Bullets","|","Indent","Outdent","|","Superscript","Subscript","|","Image","Flash","Media","|","Table","Guidelines","Absolute","|","Characters","Line","Form","Hyperlink","ClearAll","BRK","StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","|","Paragraph","FontName","FontSize","|","Bold","Italic","Underline","Strikethrough","|","ForeColor","BackColor","|","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","|","XHTMLSource","Clean"];
                                    oEdit4.cmdAssetManager = "modalDialogShow('<?php echo base_url(); ?>editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
                                    oEdit4.onSave = new Function("submitEditContentForm()");
                                    oEdit4.REPLACE("syllabus3");		
                                    oEdit4.mode="XHTMLBody";
                                </script> */ ?>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'syllabus[2]') : '' ?></span>
                            </div>

                            <div class="form-group">
                                <label for="module_name4">Module Name 4</label>
                                <input class="form-control" type="text" id="module_name4" name="module_name[3]" placeholder="Module name 4" value="<?=(isset($syllabus[3]))?$syllabus[3]->module_name:set_value('module_name[3]'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'module_name[3]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="syllabus4">Module 4 Syllabus <span class="text-danger">(Use COMA , between two subject)</span></label>
                                <textarea name="syllabus[3]" id="syllabus4" cols="30" rows="6" class="form-control" placeholder="Module 4 Syllabus"><?=(isset($syllabus[3]))?$syllabus[3]->syllabus:set_value('syllabus[3]')?></textarea>
                                <?php /* <script>
                                    var oEdit5 = new InnovaEditor("oEdit5");					
                                    oEdit5.width='100%';
                                    oEdit5.height=200;			
                                    oEdit5.arrStyle = ["BODY",false,"","margin:5px; padding:0px; font-family:Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size:10pt;"];
                                    oEdit5.features=["Save","Preview","|","Undo","Redo","|","Numbering","Bullets","|","Indent","Outdent","|","Superscript","Subscript","|","Image","Flash","Media","|","Table","Guidelines","Absolute","|","Characters","Line","Form","Hyperlink","ClearAll","BRK","StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","|","Paragraph","FontName","FontSize","|","Bold","Italic","Underline","Strikethrough","|","ForeColor","BackColor","|","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","|","XHTMLSource","Clean"];
                                    oEdit5.cmdAssetManager = "modalDialogShow('<?php echo base_url(); ?>editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
                                    oEdit5.onSave = new Function("submitEditContentForm()");
                                    oEdit5.REPLACE("syllabus4");		
                                    oEdit5.mode="XHTMLBody";
                                </script> */ ?>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'syllabus[3]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="module_name5">Module Name 5</label>
                                <input class="form-control" type="text" id="module_name5" name="module_name[4]" placeholder="Module name 5" value="<?=(isset($syllabus[4]))?$syllabus[4]->module_name:set_value('module_name[4]'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'module_name[4]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="syllabus5">Module 5 Syllabus <span class="text-danger">(Use COMA , between two subject)</span></label>
                                <textarea name="syllabus[4]" id="syllabus5" cols="30" rows="6" class="form-control" placeholder="Module 5 Syllabus"><?=(isset($syllabus[4]))?$syllabus[4]->syllabus:set_value('syllabus[4]')?></textarea>
                                <?php /*<script>
                                    var oEdit6 = new InnovaEditor("oEdit6");					
                                    oEdit6.width='100%';
                                    oEdit6.height=200;			
                                    oEdit6.arrStyle = ["BODY",false,"","margin:5px; padding:0px; font-family:Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size:10pt;"];
                                    oEdit6.features=["Save","Preview","|","Undo","Redo","|","Numbering","Bullets","|","Indent","Outdent","|","Superscript","Subscript","|","Image","Flash","Media","|","Table","Guidelines","Absolute","|","Characters","Line","Form","Hyperlink","ClearAll","BRK","StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","|","Paragraph","FontName","FontSize","|","Bold","Italic","Underline","Strikethrough","|","ForeColor","BackColor","|","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","|","XHTMLSource","Clean"];
                                    oEdit6.cmdAssetManager = "modalDialogShow('<?php echo base_url(); ?>editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
                                    oEdit6.onSave = new Function("submitEditContentForm()");
                                    oEdit6.REPLACE("syllabus5");		
                                    oEdit6.mode="XHTMLBody";
                                </script> */ ?>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'syllabus[4]') : '' ?></span>
                            </div>

                            <input type="hidden" name="submit" value="slbs">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <!-- <button type="reset" class="btn btn-info">Reset</button> -->
                            <a href="<?=base_url('admin/courses')?>" class="btn btn-warning">Cancel</a>
                            </form>
                        </div>
                        <!-- what you'll learn tab -->
                        <div class="tab-pane fade <?=$showactive3?>" id="pills-learn" role="tabpanel" aria-labelledby="pills-learn-tab">
                            <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="course_id" value="<?=isset($course)?$course->course_id:''?>">
                            <?php if(isset($course) && $course->what_learn != ''){
                                $what_learnArr = json_decode($course->what_learn);
                               //print_r(explode(',',$syllabus[0]->syllabus));exit;
                            }
                            ?>
                            <div class="form-group">
                                <label for="what_learn1">What you'll learn (line 1) </label>
                                <input class="form-control" type="text" id="what_learn1" name="what_learn[0]" placeholder="What you'll learn (line 1) " value="<?=(isset($what_learnArr[0]))?$what_learnArr[0]:set_value('what_learn[0]'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'what_learn[0]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="what_learn2">What you'll learn (line 2) </label>
                                <input class="form-control" type="text" id="what_learn2" name="what_learn[1]" placeholder="What you'll learn (line 2) " value="<?=(isset($what_learnArr[1]))?$what_learnArr[1]:set_value('what_learn[1]'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'what_learn[1]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="what_learn3">What you'll learn (line 3) </label>
                                <input class="form-control" type="text" id="what_learn3" name="what_learn[2]" placeholder="What you'll learn (line 3) " value="<?=(isset($what_learnArr[2]))?$what_learnArr[2]:set_value('what_learn[2]'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'what_learn[2]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="what_learn4">What you'll learn (line 4) </label>
                                <input class="form-control" type="text" id="what_learn4" name="what_learn[3]" placeholder="What you'll learn (line 4) " value="<?=(isset($what_learnArr[3]))?$what_learnArr[3]:set_value('what_learn[3]'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'what_learn[3]') : '' ?></span>
                            </div>
                            <input type="hidden" name="submit" value="learn">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <!-- <button type="reset" class="btn btn-info">Reset</button> -->
                            <a href="<?=base_url('admin/courses')?>" class="btn btn-warning">Cancel</a>
                            </form>
                        </div>
                        <div class="tab-pane fade <?=$showactive4?>" id="pills-require" role="tabpanel" aria-labelledby="pills-require-tab">
                            <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="course_id" value="<?=isset($course)?$course->course_id:''?>">
                            <?php if(isset($course) && $course->requirements != ''){
                                $requirementsArr = json_decode($course->requirements);
                               //print_r(explode(',',$syllabus[0]->syllabus));exit;
                            }
                            ?>
                            <div class="form-group">
                                <label for="requirements1">Requirements (line 1) </label>
                                <input class="form-control" type="text" id="requirements1" name="requirements[0]" placeholder="Requirements (line 1) " value="<?=(isset($requirementsArr[0]))?$requirementsArr[0]:set_value('requirements[0]'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'requirements[0]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="requirements2">Requirements (line 2) </label>
                                <input class="form-control" type="text" id="requirements2" name="requirements[1]" placeholder="Requirements (line 2) " value="<?=(isset($requirementsArr[1]))?$requirementsArr[1]:set_value('requirements[1]'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'requirements[1]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="requirements3">Requirements (line 3) </label>
                                <input class="form-control" type="text" id="requirements3" name="requirements[2]" placeholder="Requirements (line 3) " value="<?=(isset($requirementsArr[2]))?$requirementsArr[2]:set_value('requirements[2]'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'requirements[2]') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="requirements4">Requirements (line 4) </label>
                                <input class="form-control" type="text" id="requirements4" name="requirements[3]" placeholder="Requirements (line 4) " value="<?=(isset($requirementsArr[3]))?$requirementsArr[3]:set_value('requirements[3]'); ?>">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'requirements[3]') : '' ?></span>
                            </div>
                            <input type="hidden" name="submit" value="require">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <!-- <button type="reset" class="btn btn-info">Reset</button> -->
                            <a href="<?=base_url('admin/courses')?>" class="btn btn-warning">Cancel</a>
                            </form>
                        </div>
                        <div class="tab-pane fade <?=$showactive5?>" id="pills-instructors" role="tabpanel" aria-labelledby="pills-instructors-tab">
                            <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="course_id" value="<?=isset($course)?$course->course_id:''?>">

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="course_fee">Course Fee </label>
                                    <input class="form-control" type="text" id="course_fee" name="course_fee" placeholder="Course Fee" value="<?=(isset($course))?$course->course_fee:set_value('course_fee'); ?>">
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'course_fee') : '' ?></span>
                                </div>
                                <div class="col-sm-6">
                                <!-- </div>
                                <div class="form-group"> -->
                                    <label for="adm_fee">Admission Fee </label>
                                    <input class="form-control" type="text" id="adm_fee" name="adm_fee" placeholder="Admission Fee " value="<?=(isset($course))?$course->adm_fee:set_value('adm_fee'); ?>">
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'adm_fee') : '' ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="ins_fee">Installment Fee </label>
                                    <input class="form-control" type="text" id="ins_fee" name="ins_fee" placeholder="Installment Fee " value="<?=(isset($course))?$course->ins_fee:set_value('ins_fee'); ?>">
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'ins_fee') : '' ?></span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="duration">Duration </label>
                                    <input class="form-control" type="text" id="duration" name="duration" placeholder="Duration " value="<?=(isset($course))?$course->duration:set_value('duration'); ?>">
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'duration') : '' ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="ins_id">Instructor </label>
                                    <select name="ins_id" id="ins_id" class="form-control form-control-lg">
                                        <option value="">Select Instructor</option>
                                        <?php if(!empty($instructors)){
                                            foreach($instructors as $list){ 
                                                $true = (isset($course) && $course->ins_id == $list->ins_id)?true:''?>
                                                <option value="<?=$list->ins_id?>" <?=set_select('ins_id', $list->ins_id, $true)?>><?=$list->ins_name?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'ins_id') : '' ?></span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="enrolled">Enrolled </label>
                                    <input class="form-control" type="text" id="enrolled" name="enrolled" placeholder="Enrolled " value="<?=(isset($course))?$course->enrolled:set_value('enrolled'); ?>">
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'enrolled') : '' ?></span>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="lesson">Lesson </label>
                                    <input class="form-control" type="text" id="lesson" name="lesson" placeholder="Lesson " value="<?=(isset($course))?$course->lesson:set_value('lesson'); ?>">
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'lesson') : '' ?></span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="course_level">Course Level </label>
                                    <select name="course_level" id="course_level" class="form-control form-control-lg">
                                        <option value="">Select One</option>
                                        <option value="B" <?=set_select('course_level', 'B', (isset($course) && $course->course_level == 'B')?true:'')?>>Beginner</option>
                                        <option value="A" <?=set_select('course_level', 'A', (isset($course) && $course->course_level == 'A')?true:'')?>>Advanced</option>
                                        <option value="I" <?=set_select('course_level', 'I', (isset($course) && $course->course_level == 'I')?true:'')?>>Intermediate</option>
                                    </select>
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'course_level') : '' ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="language">Language </label>
                                    <select name="language" id="language" class="form-control">
                                        <option value="">Select One</option>
                                        <option value="H" <?=set_select('language', 'H', (isset($course) && $course->language == 'H')?true:'')?>>Hindi</option>
                                        <option value="E" <?=set_select('language', 'E', (isset($course) && $course->language == 'E')?true:'')?>>English</option>
                                        <option value="HE" <?=set_select('language', 'HE', (isset($course) && $course->language == 'HE')?true:'')?>>English/Hindi</option>
                                    </select>
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'language') : '' ?></span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="is_cert">Certificate </label>
                                    <select name="is_cert" id="is_cert" class="form-control">
                                        <option value="">Select One</option>
                                        <option value="Yes" <?=set_select('is_cert', 'YES', (isset($course) && $course->is_cert == 'Yes')?true:'')?>>Yes</option>
                                        <option value="No" <?=set_select('is_cert', 'No', (isset($course) && $course->is_cert == 'No')?true:'')?>>No</option>
                                    </select>
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'is_cert') : '' ?></span>
                                </div>
                            </div>
                            <input type="hidden" name="submit" value="courseincludes">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <!-- <button type="reset" class="btn btn-info">Reset</button> -->
                            <a href="<?=base_url('admin/courses')?>" class="btn btn-warning">Cancel</a>
                            </form>
                        </div>
                        <div class="tab-pane fade <?=$showactive6?>" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="course_id" value="<?=isset($course)?$course->course_id:''?>">
                            <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="is_popular">Is Popular (Show on Home page?) </label>
                                <select name="is_popular" id="is_popular" class="form-control">
                                    <option value="">Select One</option>
                                    <option value="1" <?=set_select('is_popular', '1', (isset($course) && $course->is_popular == '1')?true:'')?>>Yes</option>
                                    <option value="0" <?=set_select('is_popular', '0', (isset($course) && $course->is_popular == '0')?true:'')?>>No</option>
                                </select>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'is_popular') : '' ?></span>
                            </div>
                            </div>
                            <div class="form-group">
                                <label for="blog_status">Publish</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1, (isset($course->status) && $course->status == 1)?true:'')?>> Yes </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($course->status) && $course->status == 0)?true:'')?>> No </label>
                                </div>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                            </div>
                            <input type="hidden" name="submit" value="publish">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <!-- <button type="reset" class="btn btn-info">Reset</button> -->
                            <a href="<?=base_url('admin/courses')?>" class="btn btn-warning">Cancel</a>
                            </form>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $("body").on("keyup","#course_full_name", function(event){	
            var urlval = $(this).val();
            var newurl = urlval.replace(/[_\s]/g, '-').replace(/[^a-z0-9-\s]/gi, '');
            $('#url').val(newurl.toLowerCase());
        });
    </script>
<?=$this->endSection()?>