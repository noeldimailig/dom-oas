<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo $title; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?php echo base_url(); ?>assets/img/sdo logo.png" rel="icon">
    <link href="<?php echo base_url(); ?>assets/img/sdo logo.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
</head>

<body>

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6 d-flex flex-column justify-content-center">

                            <div class="d-flex flex-column align-items-center py-2">
                                <a href="<?php echo base_url(); ?>" class="logo w-100 d-flex justify-content-between">
                                    <img style="max-height:56px;" src="<?php echo base_url(); ?>assets/img/sdo logo.png" alt="Division of Oriental Mindoro Logo">
                                    <span class="text-center">Division of Oriental Mindoro</span>
                                    <img style="max-height:56px;" src="<?php echo base_url(); ?>assets/img/doas-logo.png" alt="Online Appointment Sytem Logo">
                                </a>
                                <p class="pt-2 fs-6 text-danger">Online Appointment System</p>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Set New Password</h5>
                                        <p class="text-center small">Enter and confirm your new password</p>
                                    </div>

                                    <?php echo validation_errors(); ?>
                                    <?php if (!isset($csrf)) {
                                        $csrf = array(
                                            'name' => $this->security->get_csrf_token_name(),
                                            'hash' => $this->security->get_csrf_hash()
                                        );
                                    } ?>
                                    <form id="signup" method="post" action="<?php echo site_url('setpass'); ?>" class="row g-3">
                                        <?php
                                        $flashdata = $this->session->flashdata();
                                        if ($flashdata) {
                                            foreach ($flashdata as $key => $value) {
                                                echo '<div class="alert alert-' . $key . '">' . $value . '</div>';
                                            }
                                        }
                                        ?>
                                        <div class="mb-0 col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Please enter your password" <?php echo set_value('password'); ?> required>
                                            <input type="hidden" name="token" value="<?php echo $token; ?>">
                                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" required>
                                            <div class="invalid-feedback"><?php echo form_error('password'); ?></div>
                                        </div>
                                        <div class="mb-0 col-12">
                                            <label for="confirm_password" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control form-control-sm" id="confirm_password" name="confirm_password" placeholder="Please confirm your password" <?php echo set_value('confirm_password'); ?> required>
                                            <div class="invalid-feedback"><?php echo form_error('confirm_password'); ?></div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Set New Password</button>
                                        </div>
                                        <div class="col-12 small d-flex justify-content-between">
                                            <a href="signin">Log in</a>
                                            <a href="signup">Create Account</a>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <!-- Vendor -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/flatpickr.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/form-validation.js"></script>

    <!-- Template Main JS File -->
    <script src="<?php echo base_url(); ?>assets/vendor/tinymce/tinymce.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>

</body>

</html>