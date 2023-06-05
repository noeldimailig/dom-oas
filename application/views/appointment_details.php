<main id="main" class="main">

    <div class="pagetitle">
        <h1>Appointment Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="breadcrumb-item">My Appointments</li>
                <li class="breadcrumb-item active">Appointment Details</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <?php
            $flashdata = $this->session->flashdata();
            if ($flashdata) {
                foreach ($flashdata as $key => $value) {
                    echo '<div class="alert alert-' . $key . '">' . $value . '</div>';
                }
            }
            ?>
            <div class="col-xl-12">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button id="show-edit-details" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Appointment Details</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h3 class="text-center fw-bold mt-3" style="color:#012970;">Appointment Details</h3>

                                <div class="row">
                                    <div class="col-md-8 col-lg-7">
                                        <h5 class="card-title">Personal Information</h5>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">First Name</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $profile['first_name']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Middle Name</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $profile['middle_name']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Last Name</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $profile['last_name']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Gender</div>
                                            <div class="col-lg-9 col-md-8"><?php echo gender($profile['gender_id']); ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Vulnerable Sector</div>
                                            <div class="col-lg-9 col-md-8"><?php echo vulnerable_sector($profile['vul_sec_id']); ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Position</div>
                                            <div class="col-lg-9 col-md-8"><?php echo position($appointment['position_id']); ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">School ID - School Name</div>
                                            <div class="col-lg-9 col-md-8"><?php echo school_id_name($appointment['school_in_id']); ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Level</div>
                                            <div class="col-lg-9 col-md-8"><?php echo level($appointment['level_id']); ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">District</div>
                                            <div class="col-lg-9 col-md-8"><?php echo district($appointment['district_id']); ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Functional Division</div>
                                            <div class="col-lg-9 col-md-8"><?php echo functional_division($appointment['func_div_id']); ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Unit, Section, Office to Visit</div>
                                            <div class="col-lg-9 col-md-8"><?php echo usov($appointment['usov_id']); ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Purpose</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $appointment['purpose']; ?></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-5">
                                        <h5 class="card-title">Appointment Schedule</h5>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Date of Visit</div>
                                            <div class="col-lg-9 col-md-8"><?php echo change_date_format($appointment['date_of_visit'], 'F d, Y'); ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Time</div>
                                            <div class="col-lg-9 col-md-8"><?php echo change_date_format(time_slot($appointment['time_slot_id']), 'h:i A'); ?></div>
                                        </div>

                                        <h5 class="card-title">Contact Information</h5>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Email</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $profile['email']; ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Contact Number</div>
                                            <div class="col-lg-9 col-md-8"><?php echo $profile['contact_no']; ?></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a href="<?php echo site_url('user/cancelapp/' . $appointment['appointment_id']); ?>" role="button" class="btn btn-sm btn-danger"><i class="bi bi-x-square"></i> Cancel Appointment</a>

                                    <button id="reschedule-appointment" type="button" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i> Reschedule Appointment</button>

                                    <a href="<?php echo site_url('user/download/' . $appointment['appointment_id']); ?>" role="button" class="btn btn-sm btn-success"><i class="bi bi-download"></i> Download Copy</a>
                                </div>
                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form method="post" action="<?php echo site_url('user/upinfo/' . $appointment['appointment_id']); ?>" class="needs-validation" novalidate>
                                    <div class="row mb-3">
                                        <label for="fname" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input id="csrf" type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" required>
                                            <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php echo $profile['first_name']; ?>" required>
                                            <small class="error-message"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="mname" class="col-md-4 col-lg-3 col-form-label">Middle Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name" value="<?php echo $profile['middle_name']; ?>" required>
                                            <small class="error-message"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="lname" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php echo $profile['last_name']; ?>" required>
                                            <small class="error-message"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?php echo $profile['email']; ?>" required>
                                            <small class="error-message"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="contact" class="col-md-4 col-lg-3 col-form-label">Contact Number</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="contact" name="contact" placeholder="09XXXXXXXXX" value="<?php echo $profile['contact_no']; ?>" required>
                                            <small class="error-message"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="gender" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" id="gender" name="gender" required>
                                                <option value="-- Select Gender --">-- Select Gender --</option>
                                                <?php foreach ($genders as $gender) { ?>
                                                    <?php if ($gender['gender_id'] == $profile['gender_id']) { ?>
                                                        <option value="<?= $gender['gender_id']; ?>" selected><?= $gender['gender']; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $gender['gender_id']; ?>"><?= $gender['gender']; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <small class="error-message"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="vulnerable-sector" class="col-md-4 col-lg-3 col-form-label">Vulnerable Sectors</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" id="vulnerable-sector" name="vulnerable-sector" required>
                                                <option value="-- Select Vulnerable Sector --">-- Select Vulnerable Sector --</option>
                                                <?php foreach ($sectors as $sector) { ?>
                                                    <?php if ($sector['vul_sec_id'] == $profile['vul_sec_id']) { ?>
                                                        <option value="<?= $sector['vul_sec_id']; ?>" selected><?= $sector['vulnerable_sector']; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $sector['vul_sec_id']; ?>"><?= $sector['vulnerable_sector']; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <small class="error-message"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="position" class="col-md-4 col-lg-3 col-form-label">Position</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" id="position" name="position" required>
                                                <option value="-- Select Position --">-- Select Position --</option>
                                                <?php foreach ($positions as $position) { ?>
                                                    <?php if ($position['position_id'] == $appointment['position_id']) { ?>
                                                        <option value="<?= $position['position_id']; ?>" selected><?= $position['position']; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $position['position_id']; ?>"><?= $position['position']; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <small class="error-message"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="school" class="col-md-4 col-lg-3 col-form-label">School ID - School Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" id="school" name="school" required>
                                                <option value="-- Select School --">-- Select School --</option>
                                                <?php foreach ($schools as $school) { ?>
                                                    <?php if ($school['school_in_id'] == $appointment['school_in_id']) { ?>
                                                        <option value="<?= $school['school_in_id']; ?>" selected><?= $school['school_id'] . ' - ' . $school['school_name']; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $school['school_in_id']; ?>"><?= $school['school_id'] . ' - ' . $school['school_name']; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <small class="error-message"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="level" class="col-md-4 col-lg-3 col-form-label">Level</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" id="level" name="level" required>
                                                <option value="-- Select Level --">-- Select Level --</option>
                                                <?php foreach ($levels as $level) { ?>
                                                    <?php if ($level['level_id'] == $appointment['level_id']) { ?>
                                                        <option value="<?= $level['level_id']; ?>" selected><?= $level['level']; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $level['level_id']; ?>"><?= $level['level']; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <small class="error-message"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="district" class="col-md-4 col-lg-3 col-form-label">District</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" id="district" name="district" required>
                                                <option value="-- Select district --">-- Select District --</option>
                                                <?php foreach ($districts as $district) { ?>
                                                    <?php if ($district['district_id'] == $appointment['district_id']) { ?>
                                                        <option value="<?= $district['district_id']; ?>" selected><?= $district['district']; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $district['district_id']; ?>"><?= $district['district']; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <small class="error-message"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="division" class="col-md-4 col-lg-3 col-form-label">Functional Division</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" id="division" name="division" required>
                                                <option value="-- Select division --">-- Select Functional Division --</option>
                                                <?php foreach ($divisions as $division) { ?>
                                                    <?php if ($division['func_div_id'] == $appointment['func_div_id']) { ?>
                                                        <option value="<?= $division['func_div_id']; ?>" selected><?= $division['functional_division']; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $division['func_div_id']; ?>"><?= $division['functional_division']; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <small class="error-message"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="usov" class="col-md-4 col-lg-3 col-form-label">Unit, Section, Office to Visit</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" id="usov" name="usov" required>
                                                <option value="-- Select Unit, Section, Office to Visit --">-- Select Unit, Section, Office to Visit --</option>
                                                <?php foreach ($usovs as $usov) { ?>
                                                    <?php if ($usov['usov_id'] == $appointment['usov_id']) { ?>
                                                        <option value="<?= $usov['usov_id']; ?>" selected><?= $usov['usov']; ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $usov['usov_id']; ?>"><?= $usov['usov']; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <small class="error-message"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="purpose" class="col-md-4 col-lg-3 col-form-label">Purpose</label>
                                        <div class="col-md-8 col-lg-9">
                                            <label for="purpose" style="font-size:12px;" class="form-label mt-0 text-info d-block">Note: N/A or NONE is not allowed.</label>
                                            <textarea class="form-control" id="purpose" name="purpose" placeholder="Purpose" required><?php echo $appointment['purpose']; ?></textarea>
                                            <small class="error-message"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="cur-date-of-visit" class="col-md-4 col-lg-3 col-form-label">Current Date of Visit and Time Schedule</label>
                                        <div class="col-md-8 col-lg-9">
                                            <label for="purpose" style="font-size:12px;" class="form-label mt-0 text-info d-block">Note: Pick another date and time to change the current appoinment schedule.</label>
                                            <input type="text" class="form-control" name="cur-date-of-visit" id="cur-date-of-visit" value="<?php echo change_date_format($appointment['date_of_visit'], 'F d, Y') . ' - ' . change_date_format(time_slot($appointment['time_slot_id']), 'h:i A'); ?>" disabled>
                                            <small class=" error-message"></small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="date-of-visit" class="col-md-4 col-lg-3 col-form-label">Date of Visit</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input data-link="<?php echo site_url('user/slots'); ?>" type="text" class="form-control" id="date-of-visit" name="date-of-visit" placeholder="Pick a date" required autocomplete="off" readonly>
                                            <input type="hidden" class="form-control" id="selected-time-slot" name="selected-time-slot">
                                            <small class="error-message"></small>
                                        </div>
                                    </div>

                                    <div id="time-slots" class="d-none">
                                        <!-- CONTENT FROM AJAX BASE ON SELECTED DATE ABOVE -->
                                    </div>
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-primary" value="Save Changes">
                                    </div>
                                </form><!-- End Profile Edit Form -->
                            </div>
                        </div>
                    </div><!-- End Bordered Tabs -->
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->