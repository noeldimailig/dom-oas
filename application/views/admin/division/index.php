<main id="main" class="main">

    <div class="pagetitle">
        <h1>Divisions</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Division</li>
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
                        <h5>Add Functional Division</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo site_url('admin/adddiv'); ?>" method="post">
                            <div class="mb-3 col-12">
                                <label for="division" class="form-label">Functional Division</label>
                                <input type="text" class="form-control form-control-sm" id="division" name="division" placeholder="Functional Division" <?php echo set_value('division'); ?> required>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" required>
                                <div class="invalid-feedback"><?php echo form_error('division'); ?></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit" name="adddiv">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Update Functional Division</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo site_url('admin/updiv'); ?>" method="post">
                            <div class="mb-3 col-12">
                                <label for="division" class="form-label">Functional Division</label>
                                <input type="text" class="form-control form-control-sm" id="division" name="division" placeholder="Functional Division" <?php echo set_value('division'); ?> value="<?php echo $division->functional_division ?? ''; ?>" required>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" required>
                                <input type="hidden" name="divid" value="<?php echo $division->func_div_id ?? ''; ?>" required>
                                <div class="invalid-feedback"><?php echo form_error('division'); ?></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-secondary w-100" type="submit" name="updiv">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Functional Divisions List</h5>
                    </div>
                    <div class="card-body p-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Division</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($divisions as $division) { ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $division['functional_division']; ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-secondary <?php echo is_table_referenced('functional_division', ['func_div_id' => $division['func_div_id']]); ?>" href="<?php echo site_url('admin/division/' . $division['func_div_id']); ?>">Update</a>
                                            <a class="btn btn-sm btn-danger <?php echo is_table_referenced('functional_division', ['func_div_id' => $division['func_div_id']]); ?>" href="<?php echo site_url('admin/deldiv/' . $division['func_div_id']); ?>">Delete</a>
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