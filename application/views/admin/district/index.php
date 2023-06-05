<main id="main" class="main">

    <div class="pagetitle">
        <h1>Districts</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Home</a></li>
                <li class="breadcrumb-item active">District</li>
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
                        <h5>Add District</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo site_url('admin/adddistrict'); ?>" method="post">
                            <div class="mb-3 col-12">
                                <label for="district" class="form-label">District</label>
                                <input type="text" class="form-control form-control-sm" id="district" name="district" placeholder="District" <?php echo set_value('district'); ?> required>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" required>
                                <div class="invalid-feedback"><?php echo form_error('district'); ?></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit" name="adddistrict">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Update District</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo site_url('admin/updistrict'); ?>" method="post">
                            <div class="mb-3 col-12">
                                <label for="district" class="form-label">District</label>
                                <input type="text" class="form-control form-control-sm" id="district" name="district" placeholder="District" <?php echo set_value('district'); ?> value="<?php echo $district->district ?? ''; ?>" required>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" required>
                                <input type="hidden" name="districtid" value="<?php echo $district->district_id ?? ''; ?>" required>
                                <div class="invalid-feedback"><?php echo form_error('district'); ?></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-secondary w-100" type="submit" name="updistrict">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Districts List</h5>
                    </div>
                    <div class="card-body p-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>District</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($districts as $district) { ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $district['district']; ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-secondary <?php echo is_table_referenced('district', ['district_id' => $district['district_id']]); ?>" href="<?php echo site_url('admin/district/' . $district['district_id']); ?>">Update</a>
                                            <a class="btn btn-sm btn-danger <?php echo is_table_referenced('district', ['district_id' => $district['district_id']]); ?>" href="<?php echo site_url('admin/deldis/' . $district['district_id']); ?>">Delete</a>
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