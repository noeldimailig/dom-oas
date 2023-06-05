<main id="main" class="main">

    <div class="pagetitle">
        <h1>Schools</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Home</a></li>
                <li class="breadcrumb-item active">School</li>
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
                        <h5>Add School Details</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo site_url('admin/addschool'); ?>" method="post">
                            <div class="mb-3 col-12">
                                <label for="school-id" class="form-label">School ID</label>
                                <input type="text" class="form-control form-control-sm" id="school-id" name="school-id" placeholder="School ID" <?php echo set_value('school-id'); ?> required>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" required>
                                <div class="invalid-feedback"><?php echo form_error('school-id'); ?></div>
                            </div>
                            <div class="mb-3 col-12">
                                <label for="school-name" class="form-label">School Name</label>
                                <input type="text" class="form-control form-control-sm" id="school-name" name="school-name" placeholder="School Name" <?php echo set_value('school-name'); ?> required>
                                <div class="invalid-feedback"><?php echo form_error('school-name'); ?></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit" name="addschool">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Update School Details</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo site_url('admin/upschool'); ?>" method="post">
                            <div class="mb-3 col-12">
                                <label for="school-id" class="form-label">School ID</label>
                                <input type="text" class="form-control form-control-sm" id="school-id" name="school-id" placeholder="School ID" <?php echo set_value('school-id'); ?> value="<?php echo $school->school_id ?? ''; ?>" required>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" required>
                                <input type="hidden" name="schoolid" value="<?php echo $school->school_in_id ?? ''; ?>" required>
                                <div class="invalid-feedback"><?php echo form_error('school-id'); ?></div>
                            </div>
                            <div class="mb-3 col-12">
                                <label for="school-name" class="form-label">School Name</label>
                                <input type="text" class="form-control form-control-sm" id="school-name" name="school-name" placeholder="School Name" <?php echo set_value('school-name'); ?> value="<?php echo $school->school_name ?? ''; ?>" required>
                                <div class="invalid-feedback"><?php echo form_error('school-name'); ?></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-secondary w-100" type="submit" name="upschool">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Schools List</h5>
                    </div>
                    <div class="card-body p-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>School ID</th>
                                    <th>School Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($schools as $school) { ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $school['school_id']; ?></td>
                                        <td><?php echo $school['school_name']; ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-secondary <?php echo is_table_referenced('school_id_name', ['school_in_id' => $school['school_in_id']]); ?>" href="<?php echo site_url('admin/school/' . $school['school_in_id']); ?>">Update</a>
                                            <a class="btn btn-sm btn-danger <?php echo is_table_referenced('school_id_name', ['school_in_id' => $school['school_in_id']]); ?>" href="<?php echo site_url('admin/delschool/' . $school['school_in_id']); ?>">Delete</a>
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