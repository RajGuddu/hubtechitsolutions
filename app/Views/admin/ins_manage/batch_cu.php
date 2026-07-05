<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
    <script language="Javascript" src="<?php echo base_url('editor/scripts/innovaeditor.js'); ?>"></script>
    
        <div class="content-wrapper">
            <form class="" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card bg-info">
                        <div class="card-body">
                        <h4 class="card-title"><?php echo (isset($batch))?'Update Batch':'Create Batch'; ?></h4>
                        <!-- <p class="card-description">
                            Basic form elements
                        </p> -->
                        
                        <?= csrf_field(); ?>
                            <div class="form-group">
                                <label for="batch_name">Batch Name</label>
                                <input type="text" class="form-control" id="batch_name" name="batch_name" value="<?=set_value('batch_name', (isset($batch->batch_name))?$batch->batch_name:''); ?>" placeholder="Batch Name">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'batch_name') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="date_from">Date from</label>
                                <input type="date" class="form-control" id="date_from" name="date_from" value="<?=set_value('date_from', (isset($batch->date_from))?$batch->date_from:''); ?>" placeholder="Date From">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'date_from') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="date_to">Date To</label>
                                <input type="date" class="form-control" id="date_to" name="date_to" value="<?=set_value('date_to', (isset($batch->date_to))?$batch->date_to:''); ?>" placeholder="Date To">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'date_to') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="time_from">Time From</label>
                                <input type="text" class="form-control" id="time_from" name="time_from" value="<?=set_value('time_from', (isset($batch->time_from))?$batch->time_from:''); ?>" placeholder="Time From">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'time_from') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="time_to">Time To</label>
                                <input type="text" class="form-control" id="time_to" name="time_to" value="<?=set_value('time_to', (isset($batch->time_to))?$batch->time_to:''); ?>" placeholder="Time To">
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'time_to') : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1, (isset($batch->status) && $batch->status == 1)?true:'')?>> Active </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($batch->status) && $batch->status == 0)?true:'')?>> Inactive </label>
                                </div>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button type="reset" class="btn btn-info">Reset</button>
                            <a href="<?=base_url('admin/batches')?>" class="btn btn-warning">Cancel</a>
                            
                        </div>
                    </div>
                </div>
                <?php /*<div class="col-md-6 grid-margin stretch-card">
                    <div class="card bg-info">
                        <div class="card-body">
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

                        </div>
                    </div>
                </div> */ ?>

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