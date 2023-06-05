<main id="main" class="main">

    <div class="pagetitle">
        <h1>Positions</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Position</li>
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
                        <h5>Add Position</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo site_url('admin/addpos'); ?>" method="post">
                            <div class="mb-3 col-12">
                                <label for="position" class="form-label">Position</label>
                                <input type="text" class="form-control form-control-sm" id="position" name="position" placeholder="Position" <?php echo set_value('position'); ?> required>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" required>
                                <div class="invalid-feedback"><?php echo form_error('position'); ?></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit" name="addpos">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Update Position</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo site_url('admin/uppos'); ?>" method="post">
                            <div class="mb-3 col-12">
                                <label for="position" class="form-label">Position</label>
                                <input type="text" class="form-control form-control-sm" id="position" name="position" placeholder="Position" <?php echo set_value('position'); ?> value="<?php echo $position->position ?? ''; ?>" required>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" required>
                                <input type="hidden" name="posid" value="<?php echo $position->position_id ?? ''; ?>" required>
                                <div class="invalid-feedback"><?php echo form_error('position'); ?></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-secondary w-100" type="submit" name="uppos">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Positions List</h5>
                    </div>
                    <div class="card-body p-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Position</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($positions as $position) { ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $position['position']; ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-secondary <?php echo is_table_referenced('position', ['position_id' => $position['position_id']]); ?>" href="<?php echo site_url('admin/position/' . $position['position_id']); ?>">Update</a>
                                            <a class="btn btn-sm btn-danger <?php echo is_table_referenced('position', ['position_id' => $position['position_id']]); ?>" href="<?php echo site_url('admin/delpos/' . $position['position_id']); ?>">Delete</a>
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