<main id="main" class="main">
    <?php echo is_profile_complete(); ?>
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('user'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <?php
        $flashdata = $this->session->flashdata();
        if ($flashdata) {
            foreach ($flashdata as $key => $value) {
                echo '<div class="alert alert-' . $key . '">' . $value . '</div>';
            }
        }
        ?>
        <div class="row p-0">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>My Appointments</h5>
                    <a class="btn btn-sm btn-primary" href="<?php echo site_url('user/set'); ?>">New Appointment</a>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Purpose</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($appointments as $appointment) { ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $appointment['purpose']; ?></td>
                                        <td><?php echo change_date_format($appointment['date_of_visit'], 'F d, Y'); ?></td>
                                        <td><?php echo change_date_format($appointment['time_slot'], 'h:i A'); ?></td>
                                        <td>
                                            <?php echo check_appointment_status($appointment['appointment_id']); ?>
                                        </td>
                                    </tr>
                                    <?php $count++; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>

</main><!-- End #main -->