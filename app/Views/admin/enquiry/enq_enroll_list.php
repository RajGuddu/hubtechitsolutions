<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<div class="content-wrapper">
    <!-- Page Header - Separate from Card -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1">
                <?=$page_title?>
            </h3>
            <p class="text-muted mb-0">Manage contacts and follow-up activities</p>
        </div>
    </div>
    <!-- Status Tabs -->
    <div class="mb-4">
        <div class="d-flex flex-wrap gap-2">
            <a href="<?=current_url()?>"
                class="btn <?=(!isset($_GET['st']))?'btn-primary':'btn-outline-primary'?> btn-sm">
                <i class="fa fa-inbox me-1"></i> New
                <span class="badge <?=(!isset($_GET['st']))?'bg-white text-primary':'bg-light text-dark'?> ms-1">
                    <?=$count_new?>
                </span>
            </a>
            <a href="<?=current_url()?>?st=2"
                class="btn <?=(isset($_GET['st']) && $_GET['st']==2)?'btn-primary':'btn-outline-primary'?> btn-sm">
                <i class="fa fa-phone me-1"></i> Follow-up
                <span class="badge bg-light text-dark ms-1">
                    <?=$count_followup?>
                </span>
            </a>
            <a href="<?=current_url()?>?st=3"
                class="btn <?=(isset($_GET['st']) && $_GET['st']==3)?'btn-warning':'btn-outline-warning'?> btn-sm">
                <i class="fa fa-calendar me-1"></i> Today
                <span class="badge bg-light text-dark ms-1">
                    <?=$count_today?>
                </span>
            </a>
            <!-- Replace status values with your actual status IDs -->
            <a href="<?=current_url()?>?st=4"
                class="btn <?=(isset($_GET['st']) && $_GET['st']==4)?'btn-success':'btn-outline-success'?> btn-sm">
                <i class="fa fa-check-circle me-1"></i> Converted
                <span class="badge bg-light text-dark ms-1">
                    <?=$count_converted?>
                </span>
            </a>
            <a href="<?=current_url()?>?st=5"
                class="btn <?=(isset($_GET['st']) && $_GET['st']==5)?'btn-danger':'btn-outline-danger'?> btn-sm">
                <i class="fa fa-ban me-1"></i> Not Interested
                <span class="badge bg-light text-dark ms-1">
                    <?=$count_notinterest?>
                </span>
            </a>
            <a href="<?=current_url()?>?st=all"
                class="btn <?=(isset($_GET['st']) && $_GET['st']=='all')?'btn-primary':'btn-outline-primary'?> btn-sm">
                <i class="fa fa-users me-1"></i> All
                <span class="badge bg-light text-dark ms-1">
                    <?=$count_all?>
                </span>
            </a>
        </div>
    </div>
    <!-- Contact Listing Card -->
    <div class="card card-rounded shadow-sm">
        <div class="card-body">
            <?php if(session()->getFlashdata('message') !== NULL) {
                echo alertBS(
                    session()->getFlashdata('message'),
                    session()->getFlashdata('type')
                );
            } ?>
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Submit From</th>
                            <th>Status</th>
                            <?php 
                            $colspan = 8;
                            if(isset($_GET['st']) && ($_GET['st'] == 2 || $_GET['st'] == 3)){
                                echo '<th>Followup Date</th>';
                                 $colspan = 9;
                            } ?>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($listing)) {
                        $sn = 1;
                        foreach($listing as $list) {
                        
                    ?>
                        <tr>
                            <td>
                                <?=$sn++?>
                            </td>
                            <td class="text-nowrap">
                                <?=date('d-m-Y', strtotime($list->added_at))?>
                            </td>
                            <td class="fw-semibold"><?=$list->name?></td>
                            <td>
                                <a href="mailto:<?=$list->email?>">
                                    <?=$list->email?>
                                </a>
                            </td>
                            <td class="text-nowrap"><?=$list->phone?></td>
                            
                            <td>
                                <?=get_contact_submit_from($list->submit_from)?>
                            </td>
                            <td><?=get_contact_status($list->status)?></td>
                            <?php if(isset($_GET['st']) && ($_GET['st'] == 2 || $_GET['st'] == 3)){
                               
                                if($list->next_followup_date != NULL){
                                    echo '<td>'.date('d-m-Y',strtotime($list->next_followup_date)).'</td>';
                                }else{
                                    echo '<td>--</td>';
                                }
                            } ?>
                            <td class="text-nowrap">
                                <?php if(is_privilege(15,3) || is_privilege(16,3)) { ?>
                                <?php /* <a href="<?=base_url('admin/enq_status/'.$list->id)?>"
                                    class="btn btn-outline-info btn-sm" title="Update Follow-up">
                                    <i class="fa fa-pencil-square"></i>
                                </a> */ ?>
                                <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#followupModal" data-id="<?=$list->id?>" data-name="<?=esc($list->name)?>" data-email="<?=esc($list->email)?>" data-phone="<?=esc($list->phone)?>" data-date="<?=date('d-m-Y', strtotime($list->added_at))?>" data-message="<?=esc($list->message ?? '')?>" data-status-label="<?=esc(strip_tags(get_contact_status($list->status)))?>" data-submit-from="<?=esc(get_contact_submit_from($list->submit_from))?>" data-course-name="<?=esc($list->course_full_name)?>" title="Update Follow-up"

                                data-address="<?=esc($list->address ?? '')?>"
                                data-state="<?=esc($list->state ?? '')?>"
                                data-district="<?=esc($list->district ?? '')?>"
                                data-last-qly="<?=esc($list->last_qly ?? '')?>"
                                data-study-center="<?=esc($list->study_center ?? '')?>"
                                data-occupation="<?=esc($list->occupation ?? '')?>"
                                data-submit-from-code="<?= esc($list->submit_from) ?>"
                                >
                                    <i class="fa fa-phone"></i> Update Follow-up 
                                </button>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } } else { ?>
                        <tr>
                            <td colspan="<?=$colspan?>" class="text-center text-muted py-4">
                                <i class="fa fa-inbox fa-2x d-block mb-2"></i>
                                No contacts found.
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Follow-up Modal -->
<div class="modal fade" id="followupModal" tabindex="-1"
     aria-labelledby="followupModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered ">
        <div class="modal-content border-0 shadow">

            <!-- Header -->
            <div class="modal-header bg-primary text-white">
                <div>
                    <h5 class="modal-title fw-bold" id="followupModalLabel">
                        <i class="fa fa-phone me-2"></i>Update Follow-up
                    </h5>
                    <small>Contact details and follow-up activity</small>
                </div>
                <button type="button" class="btn-close btn-close-white"
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="followupForm" method="post" action="<?=base_url('admin/enq_status')?>">

                <?=csrf_field()?>

                <div class="modal-body p-4">

                    <!-- Contact Details -->
                    <h6 class="fw-bold mb-3">
                        <i class="fa fa-user me-2 text-primary"></i>
                        Contact Details
                    </h6>

                    <div class="border rounded-3 p-3 mb-4 bg-light">
                        <div class="row g-3">

                            <div class="col-md-4">
                                <small class="text-muted d-block">Name</small>
                                <strong id="contactName">-</strong>
                            </div>

                            <div class="col-md-4">
                                <small class="text-muted d-block">Email</small>
                                <span id="contactEmail">-</span>
                            </div>

                            <div class="col-md-4">
                                <small class="text-muted d-block">Phone</small>
                                <strong id="contactPhone">-</strong>
                            </div>
                            
                            <div class="col-md-4">
                                <small class="text-muted d-block">Contact Date</small>
                                <strong id="contactDate">-</strong>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted d-block">Current Status</small>
                                <span id="contactStatus" class="badge bg-secondary">-</span>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted d-block">Submit From</small>
                                <span id="submitFrom">-</span>
                            </div>

                            <div class="col-md-12">
                                <small class="text-muted d-block">Message</small>
                                <div id="contactMessage" class="text-break">-</div>
                            </div>

                        </div>
                        <div id="fcDetails" class="row g-3" style="display:none;">

                            <div class="col-md-4">
                                <small class="text-muted d-block">Address</small>
                                <span id="contactAddress">-</span>
                            </div>

                            <div class="col-md-4">
                                <small class="text-muted d-block">State</small>
                                <span id="contactState">-</span>
                            </div>

                            <div class="col-md-4">
                                <small class="text-muted d-block">District</small>
                                <span id="contactDistrict">-</span>
                            </div>

                            <div class="col-md-4">
                                <small class="text-muted d-block">Last Qualification</small>
                                <span id="centerName">-</span>
                            </div>

                            <div class="col-md-4">
                                <small class="text-muted d-block">Study Center/School/College</small>
                                <span id="centerAddress">-</span>
                            </div>

                            <div class="col-md-4">
                                <small class="text-muted d-block">Occupation</small>
                                <span id="contactOccupation">-</span>
                            </div>

                        </div>
                    </div>

                    <hr>

                    <!-- Follow-up Form -->
                    <h6 class="fw-bold mb-3">
                        <i class="fa fa-clipboard-list me-2 text-primary"></i>
                        Follow-up Details
                    </h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="followupStatus" class="form-label">
                                Change Status <span class="text-danger">*</span>
                            </label>

                            <select name="status" id="followupStatus" class="form-select" required>
                                <option value="2">Follow-up</option>
                                <option value="4">Converted</option>
                                <option value="5">Not Interested</option>
                            </select>
                        </div>

                        <div class="col-md-6" id="nextFollowupGroup">
                            <label for="nextFollowupDate" class="form-label">
                                Next Follow-up Date <span class="text-danger">*</span>
                            </label>

                            <input type="date" name="next_followup_date" id="nextFollowupDate" class="form-control">
                        </div>

                        <div class="col-12">
                            <label for="followupRemark" class="form-label">
                                Remark <span class="text-danger">*</span>
                            </label>

                            <textarea name="remark" id="followupRemark"
                                      class="form-control" rows="3"
                                      placeholder="Enter call details or customer response..."
                                      required></textarea>
                        </div>

                    </div>
                    <hr class="my-4">

                    <!-- Follow-up History -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">
                            <i class="fa fa-history me-2 text-primary"></i>
                            Follow-up History
                        </h6>
                        <span class="badge bg-light text-dark" id="historyCount">0 Records</span>
                    </div>

                    <div id="followupHistory" class="border rounded-3 p-3">
                        <div class="text-center text-muted py-3">
                            <i class="fa fa-history fa-2x mb-2"></i>
                            <p class="mb-0">Loading follow-up history...</p>
                        </div>
                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save me-1"></i> Save Follow-up
                    </button>
                </div>

            </form>

            

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('followupModal');
    const form = document.getElementById('followupForm');

    const statusField = document.getElementById('followupStatus');
    const dateField = document.getElementById('nextFollowupDate');
    const dateGroup = document.getElementById('nextFollowupGroup');

    modal.addEventListener('show.bs.modal', function (event) {

        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name') || '-';
        const email = button.getAttribute('data-email') || '-';
        const phone = button.getAttribute('data-phone') || '-';
        const date = button.getAttribute('data-date') || '-';
        const message = button.getAttribute('data-message') || '-';
        const currentStatus = button.getAttribute('data-status-label');
        const submitFrom = button.getAttribute('data-submit-from');
        const courseName = button.getAttribute('data-course-name');
        const submitFromCode = button.getAttribute('data-submit-from-code');

        document.getElementById('contactName').textContent = name;
        document.getElementById('contactEmail').textContent = email;
        document.getElementById('contactPhone').textContent = phone;
        document.getElementById('contactDate').textContent = date;
        document.getElementById('contactMessage').textContent = message;

        document.getElementById('contactStatus').textContent = currentStatus || '-';
        document.getElementById('submitFrom').textContent = courseName ? `${submitFrom} (${courseName})` : submitFrom;

        const fcDetails = document.getElementById('fcDetails');

        if (submitFromCode === 'FC') {

            fcDetails.style.display = 'flex';

            document.getElementById('contactAddress').textContent =
                button.getAttribute('data-address') || '-';

            document.getElementById('contactState').textContent =
                button.getAttribute('data-state') || '-';

            document.getElementById('contactDistrict').textContent =
                button.getAttribute('data-district') || '-';

            document.getElementById('centerName').textContent =
                button.getAttribute('data-last-qly') || '-';

            document.getElementById('centerAddress').textContent =
                button.getAttribute('data-study-center') || '-';

            document.getElementById('contactOccupation').textContent =
                button.getAttribute('data-occupation') || '-';

        } else {
            fcDetails.style.display = 'none';
        }

        // Set the selected contact ID in the form URL
        form.action = "<?=base_url('admin/enq_status')?>/" + encodeURIComponent(id);

        // Reset fields whenever a different contact is opened
        form.reset();

        statusField.value = '2';
        dateField.value = '';

        updateFollowupDate();
        loadFollowupHistory(id);
    });

    statusField.addEventListener('change', updateFollowupDate);

    function updateFollowupDate() {

        const isFollowup = statusField.value === '2';

        dateGroup.style.display = isFollowup ? '' : 'none';
        dateField.required = isFollowup;

        if (!isFollowup) {
            dateField.value = '';
        }
    }
    function loadFollowupHistory(id) {

        const container = document.getElementById('followupHistory');
        const count = document.getElementById('historyCount');

        container.innerHTML = `
            <div class="text-center text-muted py-3">
                Loading history...
            </div>`;

        count.textContent = 'Loading...';

        fetch("<?=base_url('admin/contact_followup_history')?>/" + encodeURIComponent(id))
            .then(response => {
                if (!response.ok) {
                    throw new Error('Unable to load history');
                }
                return response.json();
            })
            .then(data => {

                if (!data.success || !Array.isArray(data.history)) {
                    throw new Error('Invalid history response');
                }

                count.textContent = data.history.length + ' Records';

                if (data.history.length === 0) {
                    container.innerHTML = `
                        <div class="text-center text-muted py-4">
                            <i class="fa fa-history fa-2x mb-2"></i>
                            <p class="mb-0">No follow-up history available.</p>
                        </div>`;
                    return;
                }

                container.replaceChildren();

                data.history.forEach(item => {

                    const entry = document.createElement('div');
                    entry.className = 'border-bottom pb-3 mb-3';

                    const heading = document.createElement('div');
                    heading.className =
                        'd-flex justify-content-between flex-wrap gap-2 mb-2';

                    const status = document.createElement('strong');
                    status.textContent = item.status_label || 'Follow-up';

                    const date = document.createElement('small');
                    date.className = 'text-muted';
                    date.textContent = item.date || '';

                    heading.append(status, date);

                    const remark = document.createElement('p');
                    remark.className = 'mb-2 text-break';
                    remark.textContent = item.remark || 'No remark';

                    entry.append(heading, remark);

                    if (item.next_followup_date) {
                        const next = document.createElement('small');
                        next.className = 'text-muted d-block mb-1';
                        next.textContent =
                            'Next Follow-up: ' + item.next_followup_date;
                        entry.append(next);
                    }

                    if (item.admin_name) {
                        const admin = document.createElement('small');
                        admin.className = 'text-muted';
                        admin.textContent = 'By: ' + item.admin_name;
                        entry.append(admin);
                    }

                    container.append(entry);
                });
            })
            .catch(() => {
                count.textContent = 'Unavailable';
                container.textContent =
                    'Unable to load follow-up history. Please try again.';
            });
    }


});
</script>


<?=$this->endSection()?>