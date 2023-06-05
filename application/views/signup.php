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
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
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
                                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                        <p class="text-center small">Enter your personal details to create account</p>
                                    </div>

                                    <form id="signup" method="post" action="register" class="row g-3">
                                        <?php
                                        $flashdata = $this->session->flashdata();
                                        if ($flashdata) {
                                            foreach ($flashdata as $key => $value) {
                                                echo '<div class="alert alert-' . $key . '">' . $value . '</div>';
                                            }
                                        }
                                        ?>
                                        <div class="mb-0 col-12">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" required>
                                            <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="name@example.com" value="<?php echo set_value('email'); ?>" required>
                                            <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                                            <div class="invalid-feedback"><?php echo form_error('email'); ?></div>
                                        </div>
                                        <div class="mb-0 col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Please enter your password" required>
                                            <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="mb-0 col-12">
                                            <label for="confirm_password" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control form-control-sm" id="confirm_password" name="confirm_password" placeholder="Please confirm your password" required>
                                            <?php echo form_error('confirm_password', '<div class="error">', '</div>'); ?>
                                            <div class="invalid-feedback"><?php echo form_error('confirm_password'); ?></div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="terms" type="checkbox" value="<?php echo set_checkbox('terms', '1'); ?>" id="acceptTerms" required>
                                                <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                                                <?php echo form_error('terms', '<div class="error">', '</div>'); ?>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Already have an account? <a href="signin">Log in</a></p>
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
    <script src="assets/js/jquery-3.6.4.min.js"></script>
    <script src="assets/js/flatpickr.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/form-validation.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/vendor/tinymce/tinymce.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>