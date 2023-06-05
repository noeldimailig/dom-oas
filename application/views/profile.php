<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Profile</li>
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
            <div class="col-xl-10">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8"><?php echo $profile['first_name'] . ' ' . $profile['middle_name'] . ' ' . $profile['last_name']; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8"><?php echo $profile['email']; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Contact Number</div>
                                    <div class="col-lg-9 col-md-8"><?php echo $profile['contact_no']; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Gender</div>
                                    <div class="col-lg-9 col-md-8"><?php echo gender($profile['gender_id']); ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Vulnerable Sector</div>
                                    <div class="col-lg-9 col-md-8"><?php echo vulnerable_sector($profile['vul_sec_id']); ?></div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form method="post" action="<?php echo site_url('user/upinfo'); ?>" class="needs-validation" novalidate>
                                    <div class="row mb-3">
                                        <label for="fname" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" required>
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