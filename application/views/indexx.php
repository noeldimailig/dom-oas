<?php //include 'includes/header.php'; 
?>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="container">
        <a href="/" class="logo">
            <img src="<?php echo base_url(); ?>assets/img/deped-logo.png" alt="">
            <span>DepEd Online Appointment System</span>
        </a>
    </div><!-- End Logo -->

</header><!-- End Header -->

<div class="mt-5 p-5 container">
    <form id="appointment-details" action="<?php echo site_url('user/bookapp'); ?>" method="post" novalidate>
        <div class="card step">
            <div class="card-header">
                <h4>Data Privacy Notice</h4>
            </div>
            <div class="card-body p-3">

                <p>In accordance with the Department of Education’s (DepEd) mandate to protect and promote the right to and access to quality basic education, DepEd Oriental Mindoro collects various data and information, including personal information, from various subjects using different systems.</p>

                <p> In the processing of these data and information, DepEd Oriental Mindoro is committed to ensure the free flow of information as required under the Freedom of Information Act (Executive Order No. 2, s. 2016) and to protect and respect the confidentiality and privacy of these data and information as required under the Data Privacy Act of 2012 (Republic Act No. 10173).</p>

                <p>Request for data and information, unless access is denied when such data and information fall under any of the exceptions enshrined in the Constitution, existing law or jurisprudence, shall be guided by the DepEd Freedom of Information Manual (Department Order No. 72, s. 2016).</p>

                <p>Only authorized DepEd Oriental Mindoro personnel have access to personal information collected, the exchange of which will be facilitated through email and web applications. These will be stored in a database in accordance with government policies, rules, regulations, and guidelines.</p>

                <p>You have the right to ask for a copy of any personal information DepEd Oriental Mindoro holds about you, as well as the right to ask for its correction, if found erroneous, or deletion on reasonable grounds.</p>

                <p>I agree with the statement above</p>
                <div class="form-check">
                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" required>
                    <input class="form-check-input" type="checkbox" name="data-privacy" id="data-privacy" required>
                    <small class="error-message"></small>
                    <label class="form-check-label" for="data-privacy">
                        Data Protection Act 2012-Declaration
                    </label>
                </div>

            </div>
            <div class="card-footer text-end">
                <button type="button" class="btn btn-primary next-button">Next</button>
            </div>
        </div>

        <div class="card step">
            <div class="card-header">
                <h4>Personal Information</h4>
            </div>
            <div class="card-body p-3">
                <div class="row g-3">
                    <div class="mb-3 col-md-4">
                        <label for="fname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required>
                        <small class="error-message"></small>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="mname" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name" required>
                        <small class="error-message"></small>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="lname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required>
                        <small class="error-message"></small>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                        <small class="error-message"></small>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="contact" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="contact" name="contact" placeholder="09XXXXXXXXX" required>
                        <small class="error-message"></small>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <?php foreach ($genders as $gender) : ?>
                                <option value="<?= $gender['gender_id']; ?>"><?= $gender['gender']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="error-message"></small>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="vulnerable-sector" class="form-label">Vulnerable Sectors</label>
                        <select class="form-select" id="vulnerable-sector" name="vulnerable-sector" required>
                            <?php foreach ($sectors as $sector) : ?>
                                <option value="<?= $sector['vul_sec_id']; ?>"><?= $sector['vulnerable_sector']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="error-message"></small>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="button" class="btn btn-secondary prev-button">Previous</button>
                <button type="button" class="btn btn-primary next-button">Next</button>
            </div>
        </div>
        <div class="card step">
            <div class="card-header">
                <h4>Work Information</h4>
            </div>
            <div class="card-body p-3">
                <div class="row g-3">
                    <div class="mb-3 col-md-12">
                        <label for="school" class="form-label">School ID - School Name</label>
                        <label for="school" class="form-label mt-0 fs--2 text-muted d-block">Sorted by School ID. If your school is not included, please contact your IT Officer.</label>
                        <select class="form-select" id="school" name="school" required>
                            <?php foreach ($schools as $school) : ?>
                                <option value="<?= $school['school_in_id']; ?>"><?= $school['school_id'] . ' - ' . $school['school_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="error-message"></small>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="position" class="form-label">Position</label>
                        <select class="form-select" id="position" name="position" required>
                            <?php foreach ($positions as $position) : ?>
                                <option value="<?= $position['position_id']; ?>"><?= $position['position']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="error-message"></small>
                    </div>


                    <div class="mb-3 col-md-6">
                        <label for="level" class="form-label">Level</label>
                        <select class="form-select" id="level" name="level" required>
                            <?php foreach ($levels as $level) : ?>
                                <option value="<?= $level['level_id']; ?>"><?= $level['level']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="error-message"></small>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="division" class="form-label">Functional Division</label>
                        <select class="form-select" id="division" name="division" required>
                            <?php foreach ($divisions as $division) : ?>
                                <option value="<?= $division['func_div_id']; ?>"><?= $division['functional_division']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="error-message"></small>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="district" class="form-label">District</label>
                        <select class="form-select" id="district" name="district" required>
                            <?php foreach ($districts as $district) : ?>
                                <option value="<?= $district['district_id']; ?>"><?= $district['district']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="error-message"></small>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="visit" class="form-label">Unit/Section/Office to Visit</label>
                        <select class="form-select" id="visit" name="visit" required>
                            <?php foreach ($visits as $visit) : ?>
                                <option value="<?= $visit['usov_id']; ?>"><?= $visit['usov']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="error-message"></small>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="button" class="btn btn-secondary prev-button">Previous</button>
                <button type="button" class="btn btn-primary next-button">Next</button>
            </div>
        </div>

        <div class="card step">
            <div class="card-header">
                <h4>Purpose</h4>
            </div>
            <div class="card-body p-3">
                <div class="mb-3">
                    <label for="purpose" class="form-label">Purpose</label>
                    <label for="school" class="form-label mt-0 fs--2 text-muted d-block">Note: N/A or NONE is not allowed.</label>
                    <textarea class="form-control" id="purpose" name="purpose" placeholder="Purpose" required></textarea>
                    <small class="error-message"></small>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="button" class="btn btn-secondary prev-button">Previous</button>
                <button type="button" class="btn btn-primary next-button">Next</button>
            </div>
        </div>

        <div class="card step">
            <div class="card-header">
                <h4>Schedule</h4>
            </div>
            <div class="card-body p-3">
                <div class="mb-2">
                    <label for="date-of-visit" class="form-label">Date of Visit</label>
                    <input data-link="<?php echo site_url('user/slots'); ?>" data-hash="<?php echo $csrf['hash']; ?>" data-name="<?php echo $csrf['name']; ?>" type="text" class="form-control" id="date-of-visit" name="date-of-visit" placeholder="Pick a date" required>
                    <input type="hidden" class="form-control" id="time-slot" name="time-slot" required>
                </div>
                <small class="error-message"></small>
            </div>
            <h6 class="p-3">
                Legend<small class="mx-3"><i class="bi bi-circle-fill activity-badge text-primary align-self-start"></i> - Available</small> <small><i class="bi bi-circle-fill activity-badge text-secondary align-self-start"></i> - Full</small>
            </h6>

            <div class="col-md-6 d-flex p-3">

                <?php foreach ($slots as $slot) : ?>
                    <?php
                    $color = 'primary';
                    if ($slot['status'] != 'available') {
                        $color = 'secondary';
                    }
                    ?>
                    <div class="col text-center">
                        <span class="time-slot p-2 bg-white border border-<?= $color; ?> rounded text-<?= $color; ?>"><?php echo change_date_format($slot['time_slot'], 'h:i A'); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="card-footer text-end">
                <button type="button" class="btn btn-secondary prev-button">Previous</button>
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </div>
        </div>
    </form>
</div>
<script>
    csrf_name = $("#date-of-visit").data("name");
    csrf_hash = $("#date-of-visit").data("hash");
</script>
<!-- </div>
</div> -->
<!-- </body>

</html> -->
<?php //include 'includes/footer.php'; 
?>