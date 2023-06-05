<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url('admin/dashboard'); ?>">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Widgets -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Booked Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title">Appointments <span>| Booked</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-calendar-check"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $booked_count; ?></h6>
                                        <span class="text-success small pt-1 fw-bold">As of:</span>
                                        <span class="text-muted small pt-2 ps-1"><?php echo date('l, F j, Y, h:i A'); ?></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Booked Card -->

                    <!-- Cancelled Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Appointments <span>| Cancelled</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-calendar-x"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $cancelled_count; ?></h6>
                                        <span class="text-danger small pt-1 fw-bold">As of:</span>
                                        <span class="text-muted small pt-2 ps-1"><?php echo date('l, F j, Y, h:i A'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Cancelled Card -->
                </div>
            </div>
            <!-- End Widgets -->

            <div class="col-lg-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Recent Appointments</h5>

                        <div class="table-responsive">
                            <div class="d-flex flex-column flex-md-row align-items-center justify-content-center mb-4">
                                <div class="col-md">
                                    <div class="d-flex justify-content-md-start align-items-center mt-3 mt-md-0">
                                        <label for="app-filter-range" class="me-2 col-form-label fw-bold">Filter by date range:</label>
                                        <div class="col-sm-6">
                                            <input class="form-control form-control-sm" type="text" name="app-filter-range" id="app-filter-range">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="d-flex justify-content-md-end mt-3 mt-md-0" id="export-buttons">
                                        <!-- <button class="btn btn-sm btn-success me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Export as Spreadsheet"><i class="bi bi-filetype-xlsx"></i></button>
                                        <button class="btn btn-sm btn-danger me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Export as PDF"><i class="bi bi-filetype-pdf"></i></button>
                                        <button id="print-pdf" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Print a Copy"><i class="bi bi-printer"></i></button> -->
                                        <button class="btn btn-sm btn-success me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Export as Spreadsheet" data-url="<?php echo base_url('export-spreadsheet'); ?>" data-type="export-spreadsheet"><i class="bi bi-filetype-xlsx"></i></button>
                                        <button class="btn btn-sm btn-danger me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Export as PDF" data-url="<?php echo base_url('export-pdf'); ?>" data-type="export-pdf"><i class="bi bi-filetype-pdf"></i></button>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Print a Copy" data-url="<?php echo base_url('print-copy'); ?>" data-type="print-copy"><i class="bi bi-printer"></i></button>

                                    </div>
                                </div>
                            </div>


                            <table id="appointments-table" class="table datatable-table">
                                <thead>
                                    <tr>
                                        <th><span>No.</span></th>
                                        <th><span>Full Name</span></th>
                                        <th><span>Date of Visit</span></th>
                                        <th><span>Time Slot</span></th>
                                        <th><span>Purpose</span></th>
                                        <th><span>Status</span></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->