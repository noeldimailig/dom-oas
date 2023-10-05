<main id="main" class="main">

    <div class="pagetitle">
        <h1>Genders</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Gender</li>
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
                        <h5>Add Gender</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo site_url('admin/addgen'); ?>" method="post">
                            <div class="mb-3 col-12">
                                <label for="gender" class="form-label">Gender</label>
                                <input type="text" class="form-control form-control-sm" id="gender" name="gender" placeholder="Gender" <?php echo set_value('gender'); ?> required>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" required>
                                <div class="invalid-feedback"><?php echo form_error('gender'); ?></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit" name="addgen">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Update Gender</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo site_url('admin/upgen'); ?>" method="post">
                            <div class="mb-3 col-12">
                                <label for="gender" class="form-label">Gender</label>
                                <input type="text" class="form-control form-control-sm" id="gender" name="gender" placeholder="Gender" <?php echo set_value('gender'); ?> value="<?php echo $gender->gender ?? ''; ?>" required>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" required>
                                <input type="hidden" name="genderid" value="<?php echo $gender->gender_id ?? ''; ?>" required>
                                <div class="invalid-feedback"><?php echo form_error('gender'); ?></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-secondary w-100" type="submit" name="upgen">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Genders List</h5>
                    </div>
                    <div class="card-body p-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Gender</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($genders as $gender) { ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $gender['gender']; ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-secondary <?php echo is_table_referenced('gender', ['gender_id' => $gender['gender_id']]); ?>" href="<?php echo site_url('admin/gender/' . $gender['gender_id']); ?>">Update</a>
                                            <a class="btn btn-sm btn-danger <?php echo is_table_referenced('gender', ['gender_id' => $gender['gender_id']]); ?>" href="<?php echo site_url('admin/delgen/' . $gender['gender_id']); ?>">Delete</a>
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