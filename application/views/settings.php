<main id="main" class="main">

    <div class="pagetitle">
        <h1>Settings</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Settings</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section settings">
        <div class="row">
            <?php
            $flashdata = $this->session->flashdata();
            if ($flashdata) {
                foreach ($flashdata as $key => $value) {
                    echo '<div class="alert alert-' . $key . '">' . $value . '</div>';
                }
            }
            ?>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Change Password</h5>
                    </div>
                    <div class="card-body pt-3">
                        <!-- Change Password Form -->
                        <form method="post" action="<?php echo site_url('user/changepass'); ?>" class="needs-validation" novalidate>
                            <div class="row mb-3">
                                <label for="old_password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" required>
                                    <input name="old_password" type="password" class="form-control" id="old_password" placeholder="Your old password" required>
                                    <?php echo form_error('old_password'); ?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="new_password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="new_password" type="password" class="form-control" id="new_password" placeholder="Your new password" required>
                                    <?php echo form_error('new_password'); ?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="confirm_password" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="confirm_password" type="password" class="form-control" id="confirm_password" placeholder="Confirm your new password" required>
                                    <?php echo form_error('confirm_password'); ?>
                                </div>
                            </div>

                            <div class="text-center">
                                <input type="submit" class="btn btn-primary" value="Change Password">
                            </div>
                        </form><!-- End Change Password Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->