<main id="main" class="main">

    <div class="pagetitle">
        <h1>Unit, Section, Office, to Visits</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Unit, Section, Office, to Visit</li>
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
                        <h5>Add Unit, Section, Office, to Visit</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo site_url('admin/addusov'); ?>" method="post">
                            <div class="mb-3 col-12">
                                <label for="usov" class="form-label">Unit, Section, Office, to Visit</label>
                                <input type="text" class="form-control form-control-sm" id="usov" name="usov" placeholder="Unit, Section, Office, to Visit" <?php echo set_value('usov'); ?> required>
                                <input type="hidden" name="<?php echo $csrf['name'];
                                                            ?>" value="<?php echo $csrf['hash'];
                                                                        ?>" required>
                                <div class="invalid-feedback"><?php echo form_error('usov'); ?></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit" name="addusov">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Update Unit, Section, Office, to Visit</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo site_url('admin/upusov'); ?>" method="post">
                            <div class="mb-3 col-12">
                                <label for="usov" class="form-label">Unit, Section, Office, to Visit</label>
                                <input type="text" class="form-control form-control-sm" id="usov" name="usov" placeholder="Unit, Section, Office, to Visit" <?php echo set_value('usov'); ?> value="<?php echo $usov->usov ?? ''; ?>" required>
                                <input type="hidden" name="<?php echo $csrf['name'];
                                                            ?>" value="<?php echo $csrf['hash'];
                                                                        ?>" required>
                                <input type="hidden" name="usovid" value="<?php echo $usov->usov_id ?? ''; ?>" required>
                                <div class="invalid-feedback"><?php echo form_error('usov'); ?></div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-secondary w-100" type="submit" name="upusov">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-header">
                        <h5>Unit, Section, Office to Visits List</h5>
                    </div>
                    <div class="card-body p-4 pb-0">
                        <!-- <div class="row g-5">
                            <div class="col-lg-6">
                                Showing <?php //echo $offset + 1; 
                                        ?> to <?php //echo $offset + $number_page; 
                                                ?> of <?php //echo $allrecords; 
                                                        ?> entries
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  is-empty" style="margin:0px !important;">
                                    <input type="text" id="search" name="search" value="<?php //if (!empty($search)) {
                                                                                        //echo $search;
                                                                                        //} 
                                                                                        ?>" class="form-control" placeholder="Search here...">
                                    <button type="submit" class="btn btn-primary rounded d-inline-block">
                                        <i class="bi bi-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 mb-3">
                            <?php //echo form_open(base_url('admin/usov'), ['method' => 'GET']); 
                            ?>
                            <table class="search_bar">
                                <tr>
                                    <td>
                                        <div class="form-group  is-empty" style="margin:0px !important;">
                                            <input type="hidden" name="<?php //echo $csrf['name']; 
                                                                        ?>" value="<?php //echo $csrf['hash']; 
                                                                                    ?>" required>
                                            <input type="text" id="search" name="search" value="<?php //if (!empty($search)) {
                                                                                                //echo $search;
                                                                                                //} 
                                                                                                ?>" class="form-control" placeholder="Search here...">
                                        </div>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary rounded d-inline-block">
                                            <i class="bi bi-search"></i></button>
                                    </td>
                                </tr>
                            </table>
                            <?php //echo form_close(); 
                            ?>
                        </div> -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Unit, Section, Office to Visit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($usovs == null) { ?>
                                    <tr>
                                        <td colspan="3" class="text-center">No records found.</td>
                                    </tr>
                                <?php } else { ?>
                                    <?php $count = 1; ?>
                                    <?php foreach ($usovs as $usov) { ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $usov['usov']; ?></td>
                                            <td>
                                                <a class="btn btn-sm btn-secondary <?php echo is_table_referenced('usov', ['usov_id' => $usov['usov_id']]); ?>" href="<?php echo site_url('admin/usov/' . $usov['usov_id']); ?>">Update</a>
                                                <a class="btn btn-sm btn-danger <?php echo is_table_referenced('usov', ['usov_id' => $usov['usov_id']]); ?>" href="<?php echo site_url('admin/delusov/' . $usov['usov_id']); ?>">Delete</a>
                                            </td>
                                        </tr>
                                        <?php $count++; ?>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                    <!-- <nav class="py-0 px-4 pb-2 my-0 d-flex align-items-center justify-content-center"><?php //echo $this->pagination->create_links(); 
                                                                                                            ?></nav> -->
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->