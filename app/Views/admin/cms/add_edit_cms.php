<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <script language="Javascript" src="<?php echo base_url('editor/scripts/innovaeditor.js'); ?>"></script>
    <div class="content-wrapper">
        <div class="row flex-grow">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                    <h4 class="card-title"><?php echo (isset($cms))?'Edit CMS':'Add CMS'; ?></h4>
                    <!-- <p class="card-description">
                        Basic form elements
                    </p> -->
                    <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="page">Page Name</label>
                            <input type="text" class="form-control" id="page" name="page" value="<?=set_value('page', (isset($cms->page))?$cms->page:''); ?>" placeholder="Page Name">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'page') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="banner_title">Banner Title</label>
                            <input type="text" class="form-control" id="banner_title" name="banner_title" value="<?=set_value('banner_title', (isset($cms->banner_title))?$cms->banner_title:''); ?>" placeholder="Banner Title">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'banner_title') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="banner_head">Banner Heading</label>
                            <input class="form-control" type="text" id="banner_head" name="banner_head" value="<?=(isset($cms->banner_head))?$cms->banner_head:set_value('banner_head'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'banner_head') : '' ?></span>
                        </div>
                        <div class="row">
                            <?php if(isset($cms->cms_banner) && $cms->cms_banner != ''){ ?>
                                <div class="col-md-6">
                                    <img src="<?=base_url('public/assets/upload/images/'.$cms->cms_banner) ?>" width="150px" height="80px" />
                                </div>
                            <?php } ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>CMS Banner</label>
                                    <input type="file" class="form-control" id="cms_banner" name="cms_banner">
                                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'cms_banner') : '' ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="description1">Description1</label>
                            <textarea class="form-control" id="description1" name="description1" rows="10"><?=(isset($cms->description1))?$cms->description1:set_value('description1'); ?></textarea>
                            <script>
                                var oEdit1 = new InnovaEditor("oEdit1");					
                                oEdit1.width='100%';
                                oEdit1.height=400;			
                                oEdit1.arrStyle = ["BODY",false,"","margin:5px; padding:0px; font-family:Verdana, Tahoma, Arial, Helvetica, sans-serif; font-size:10pt;"];
                                oEdit1.features=["Save","Preview","|","Undo","Redo","|","Numbering","Bullets","|","Indent","Outdent","|","Superscript","Subscript","|","Image","Flash","Media","|","Table","Guidelines","Absolute","|","Characters","Line","Form","Hyperlink","ClearAll","BRK","StyleAndFormatting","TextFormatting","ListFormatting","BoxFormatting","ParagraphFormatting","CssText","Styles","|","Paragraph","FontName","FontSize","|","Bold","Italic","Underline","Strikethrough","|","ForeColor","BackColor","|","JustifyLeft","JustifyCenter","JustifyRight","JustifyFull","|","XHTMLSource","Clean"];
                                oEdit1.cmdAssetManager = "modalDialogShow('<?php echo base_url(); ?>editor/assetmanager/assetmanager.php',640,465)"; //Command to open the Asset Manager add-on.
                                oEdit1.onSave = new Function("submitEditContentForm()");
                                oEdit1.REPLACE("description1");		
                                oEdit1.mode="XHTMLBody";
                            </script>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'description1') : '' ?></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="status">Status</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1, (isset($cms->status) && $cms->status == '1')?true:'')?>> Active </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($cms->status) && $cms->status == '0')?true:'')?>> Inactive </label>
                            </div>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button type="reset" class="btn btn-info">Reset</button>
                        <a href="<?=base_url('admin/cms')?>" class="btn btn-warning">Cancel</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?=$this->endSection()?>