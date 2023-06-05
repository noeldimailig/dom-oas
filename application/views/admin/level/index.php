<main id="main" class="main">

    <div class="pagetitle">
        <h1>Levels</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Level</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Add Level</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo site_url('admin/addlevel'); ?>" method="post">
                            <div class="mb-3 col-12">
                                <label for="level" class="form-label">Level</label>
                                <input type="text" class="form-control form-control-sm" id="level" name="level" placeholder="Level" <?php echo set_value('level'); ?> required>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" required>
                                <div class="invalid-feedback"><?php echo form_error('level'); ?></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit" name="addlevel">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Update Level</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo site_url('admin/uplevel'); ?>" method="post">
                            <div class="mb-3 col-12">
                                <label for="level" class="form-label">Level</label>
                                <input type="text" class="form-control form-control-sm" id="level" name="level" placeholder="Level" <?php echo set_value('level'); ?> value="<?php echo $level->level ?? ''; ?>" required>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" required>
                                <input type="hidden" name="levelid" value="<?php echo $level->level_id ?? ''; ?>" required>
                                <div class="invalid-feedback"><?php echo form_error('level'); ?></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-secondary w-100" type="submit" name="uplevel">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Levels List</h5>
                    </div>
                    <div class="card-body p-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($levels as $level) { ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $level['level']; ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-secondary <?php echo is_table_referenced('level', ['level_id' => $level['level_id']]); ?>" href="<?php echo site_url('admin/level/' . $level['level_id']); ?>">Update</a>
                                            <a class="btn btn-sm btn-danger <?php echo is_table_referenced('level', ['level_id' => $level['level_id']]); ?>" href="<?php echo site_url('admin/dellevel/' . $level['level_id']); ?>">Delete</a>
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