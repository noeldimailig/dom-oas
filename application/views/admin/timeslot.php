<main id="main" class="main">

    <div class="pagetitle">
        <h1>Time Slots</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Time Slot</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <?php
            $flashdata = $this->session->flashdata();
            if ($flashdata) {
                foreach ($flashdata as $key => $value) {
                    echo '<div class="alert alert-' . $key . '">' . $value . '</div>';
                }
            }
            ?>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Add Time Slot</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo site_url('admin/addslot'); ?>" method="post">
                            <div class="mb-3 col-12">
                                <label for="time-slot-add" class="form-label">Time Slot</label>
                                <input type="text" class="form-control form-control-sm" id="time-slot-add" name="time-slot-add" placeholder="Pick a time" <?php echo set_value('time-slot-add'); ?> required>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" required>
                                <div class="invalid-feedback"><?php echo form_error('time-slot-add'); ?></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit" name="addslot">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Update Time Slot</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo site_url('admin/upslot'); ?>" method="post">
                            <div class="mb-3 col-12">
                                <label for="time-slot-up" class="form-label">Time Slot</label>
                                <input type="text" class="form-control form-control-sm" id="time-slot-up" name="time-slot-up" placeholder="Pick a time" <?php echo set_value('time-slot-up'); ?> value="<?php echo $slot->time_slot ?? ''; ?>" required>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" required>
                                <input type="hidden" name="slotid" value="<?php echo $slot->time_slot_id ?? ''; ?>" required>
                                <div class="invalid-feedback"><?php echo form_error('time-slot-up'); ?></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-secondary w-100" type="submit" name="upslot">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Time Slots List</h5>
                    </div>
                    <div class="card-body p-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Time Slot</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($slots as $slot) { ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo change_date_format($slot['time_slot'], 'h:i A'); ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-secondary <?php echo is_table_referenced('time_slot', ['time_slot_id' => $slot['time_slot_id']]); ?>" href="<?php echo site_url('admin/timeslot/' . $slot['time_slot_id']); ?>">Update</a>
                                            <a class="btn btn-sm btn-danger <?php echo is_table_referenced('time_slot', ['time_slot_id' => $slot['time_slot_id']]); ?>" href="<?php echo site_url('admin/delslot/' . $slot['time_slot_id']); ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php $count++; ?>
                                <?php } ?>
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->