<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <script language="Javascript" src="<?php echo base_url('editor/scripts/innovaeditor.js'); ?>"></script>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-8 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                    <h4 class="card-title"><?php echo (isset($ccdata))?'Update Instructor':'Create Instructor'; ?></h4>
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="ins_name">Instructor Name</label>
                            <input type="text" class="form-control" id="ins_name" name="ins_name" value="<?=set_value('ins_name', (isset($ccdata->ins_name))?$ccdata->ins_name:''); ?>" placeholder="Instructor Name">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'ins_name') : '' ?></span>
                        </div>
                        <div class="row">
                            <?php if(isset($ccdata->ins_image) && $ccdata->ins_image != ''){ ?>
                                <div class="col-md-6">
                                    <img src="<?=base_url('public/assets/upload/images/'.$ccdata->ins_image) ?>" width="150px" height="80px" />
                                </div>
                            <?php } ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Photo</label>
                                    <input type="file" class="form-control" id="ins_image" name="ins_image">
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'ins_image') : '' ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="post">Post</label>
                            <input type="text" class="form-control" id="post" name="post" value="<?=set_value('post', (isset($ccdata->post))?$ccdata->post:''); ?>" placeholder="Post">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'post') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="details">About Instructor</label>
                            <textarea name="details" id="details" cols="30" rows="4" class="form-control" placeholder="About Instructor"><?=set_value('details', isset($ccdata->details)?$ccdata->details:'')?></textarea>
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
                        </div>
                        <div class="form-group">
                            <label for="facebook_link">Facebook Link</label>
                            <input type="text" class="form-control" id="facebook_link" name="facebook_link" value="<?=set_value('facebook_link', (isset($ccdata->facebook_link))?$ccdata->facebook_link:''); ?>" placeholder="Facebook Link">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'facebook_link') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="twitor_link">Twitor Link</label>
                            <input type="text" class="form-control" id="twitor_link" name="twitor_link" value="<?=set_value('twitor_link', (isset($ccdata->twitor_link))?$ccdata->twitor_link:''); ?>" placeholder="Twitor Link">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'twitor_link') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="linkedin_link">Linkedin Link</label>
                            <input type="text" class="form-control" id="linkedin_link" name="linkedin_link" value="<?=set_value('linkedin_link', (isset($ccdata->linkedin_link))?$ccdata->linkedin_link:''); ?>" placeholder="Linked Link">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'linkedin_link') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="youtube_link">Youtube Link</label>
                            <input type="text" class="form-control" id="youtube_link" name="youtube_link" value="<?=set_value('youtube_link', (isset($ccdata->youtube_link))?$ccdata->youtube_link:''); ?>" placeholder="Linked Link">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'youtube_link') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1, (isset($ccdata->status) && $ccdata->status == 1)?true:'')?>> Active </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($ccdata->status) && $ccdata->status == 0)?true:'')?>> Inactive </label>
                            </div>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button type="reset" class="btn btn-info">Reset</button>
                        <a href="<?=base_url('admin/instructor')?>" class="btn btn-warning">Cancel</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?=$this->endSection()?>