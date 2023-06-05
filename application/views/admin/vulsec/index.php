<main id="main" class="main">

    <div class="pagetitle">
        <h1>Vulnerable Sectors</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Vulnerable Sector</li>
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
                        <h5>Add Vulnerable Sector</h5>
                    </div>
                    <div class="card-body p-4">
                        <form method="post" action="<?php echo site_url('admin/addsec'); ?>">
                            <div class="mb-3 col-12">
                                <label for="sector" class="form-label">Vulnerable Sector</label>
                                <input type="text" class="form-control form-control-sm" id="sector" name="sector" placeholder="Vulnerable Sector" <?php echo set_value('sector'); ?> required>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" required>
                                <div class="invalid-feedback"><?php echo form_error('sector'); ?></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit" name="addsec">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Update Vulnerable Sector</h5>
                    </div>
                    <div class="card-body p-4">
                        <form method="post" action="<?php echo site_url('admin/upsec'); ?>">
                            <div class="mb-3 col-12">
                                <label for="sector" class="form-label">Vulnerable Sector</label>
                                <input type="text" class="form-control form-control-sm" id="sector" name="sector" placeholder="Vulnerable Sector" <?php echo set_value('sector'); ?> value="<?php echo $sector->vulnerable_sector ?? ''; ?>" required>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" required>
                                <input type="hidden" name="vulsecid" value="<?php echo $sector->vul_sec_id ?? ''; ?>" required>
                                <div class="invalid-feedback"><?php echo form_error('sector'); ?></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-secondary w-100" type="submit" name="upsec">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Vulnerable Sectors List</h5>
                    </div>
                    <div class="card-body p-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Vulnerable Sector</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($sectors as $sector) { ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $sector['vulnerable_sector']; ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-secondary <?php echo is_table_referenced('vulnerable_sector', ['vul_sec_id' => $sector['vul_sec_id']]); ?>" href="<?php echo site_url('admin/sector/' . $sector['vul_sec_id']); ?>">Update</a>
                                            <a class="btn btn-sm btn-danger <?php echo is_table_referenced('vulnerable_sector', ['vul_sec_id' => $sector['vul_sec_id']]); ?>" href="<?php echo site_url('admin/delsec/' . $sector['vul_sec_id']); ?>">Delete</a>
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