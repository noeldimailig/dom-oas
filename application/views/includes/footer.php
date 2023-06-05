<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?php echo base_url(); ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/chart.js/chart.umd.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/echarts/echarts.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/quill/quill.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/tinymce/tinymce.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/php-email-form/validate.js"></script>
<script src="<?php echo base_url(); ?>assets/js/flatpickr.js"></script>

<!-- Template Main JS File -->
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.cookie.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/form-validation.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/step.js"></script>
<!-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/b-print-2.3.6/r-2.4.1/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.1/daterangepicker.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var table = null;
        var token = "<?php echo $this->security->get_csrf_hash(); ?>";
        var _start = '';
        var _end = '';

        fetch_appointments();

        function fetch_appointments(start_date = '', end_date = '') {

            table = $('#appointments-table').DataTable({
                // dom: 'Blfrtip',
                // buttons: [{
                //         extend: 'copy',
                //         text: '<i class="bi bi-clipboard"></i>',
                //         titleAttr: 'Copy Paste',
                //         className: 'btn btn-sm btn-secondary me-2 rounded',
                //         attr: {
                //             'data-bs-toggle': 'tooltip',
                //             'data-bs-placement': 'top',
                //             'title': 'Copy Paste'
                //         }
                //     },
                //     {
                //         extend: 'excel',
                //         text: '<i class="bi bi-filetype-xlsx"></i>',
                //         titleAttr: 'Export as Excel',
                //         className: 'btn btn-sm btn-success me-2 rounded',
                //         attr: {
                //             'data-bs-toggle': 'tooltip',
                //             'data-bs-placement': 'top',
                //             'title': 'Export as Spreadsheet'
                //         }
                //     },
                //     {
                //         extend: 'pdf',
                //         text: '<i class="bi bi-filetype-pdf"></i>',
                //         titleAttr: 'Export as PDF',
                //         className: 'btn btn-sm btn-danger me-2 rounded',
                //         attr: {
                //             'data-bs-toggle': 'tooltip',
                //             'data-bs-placement': 'top',
                //             'title': 'Export as PDF'
                //         }
                //     },
                //     {
                //         extend: 'print',
                //         text: '<i class="bi bi-printer"></i>',
                //         titleAttr: 'Print a Copy',
                //         className: 'btn btn-sm btn-warning rounded',
                //         attr: {
                //             'data-bs-toggle': 'tooltip',
                //             'data-bs-placement': 'top',
                //             'title': 'Print a Copy'
                //         }
                //     }
                // ],
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "ordering": true,
                "order": [
                    [0, "asc"]
                ],
                "ajax": {
                    type: "POST",
                    url: "<?php echo base_url('get-appointments'); ?>",
                    data: function(d) {
                        d.<?php echo $this->security->get_csrf_token_name(); ?> = token;
                        d.start_date = start_date;
                        d.end_date = end_date;
                    }
                },
                "deferRender": true,
                "columns": [{
                        "data": "no"
                    },
                    {
                        "data": "full_name"
                    },
                    {
                        "data": "date_of_visit"
                    },
                    {
                        "data": "time_slot"
                    },
                    {
                        "data": "purpose"
                    },
                    {
                        "data": "status"
                    }
                ],
                "lengthMenu": [10, 25, 50, 100],
                "pageLength": 10,
                "searching": true,
                "info": true,
                "paging": true,
            })
            // Remove default tooltips
            $('.dt-button').removeAttr('title');

            // Initialize Bootstrap Tooltip
            $('#export-buttons').tooltip({
                selector: '[data-bs-toggle="tooltip"]',
                container: '#export-buttons',
                trigger: 'hover'
            });
            table.buttons().container().appendTo("#export-buttons");
            table.on('xhr.dt', function(e, settings, json, xhr) {
                token = json.<?php echo $this->security->get_csrf_token_name(); ?>;
            });

            // Add an event listener to the export/print button
            $('#export-buttons').off('click', 'button').on('click', 'button', function() {
                var url = $(this).data('url');
                var buttonType = $(this).data('type');
                export_data(url, buttonType);
            });

        }

        function export_data(url, buttonType) {
            var filteredData = table.rows({
                search: 'applied'
            }).data().toArray();

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    filteredData: filteredData,
                    start_date: _start,
                    end_date: _end
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response, status, xhr) {
                    if (xhr.status === 200) {
                        if (buttonType === 'export-spreadsheet') {
                            var filename = 'file.xlsx';

                            var disposition = xhr.getResponseHeader('content-disposition');
                            if (disposition && disposition.indexOf('attachment') !== -1) {
                                var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                                var matches = filenameRegex.exec(disposition);
                                if (matches != null && matches[1]) {
                                    filename = matches[1].replace(/['"]/g, '');
                                }
                            }

                            var blob = new Blob([response], {
                                type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                            });

                            // Create a temporary URL for the Blob
                            var blobUrl = URL.createObjectURL(blob);

                            // Create a link element and set its attributes
                            var link = document.createElement('a');
                            link.href = blobUrl;
                            link.download = filename;

                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                            URL.revokeObjectURL(blobUrl);
                        } else if (buttonType === 'export-pdf') {
                            var filename = 'file.pdf';

                            var disposition = xhr.getResponseHeader('content-disposition');
                            if (disposition && disposition.indexOf('attachment') !== -1) {
                                var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                                var matches = filenameRegex.exec(disposition);
                                if (matches != null && matches[1]) {
                                    filename = matches[1].replace(/['"]/g, '');
                                }
                            }

                            var blob = new Blob([response], {
                                type: 'application/pdf'
                            });

                            // Create a temporary URL for the Blob
                            var blobUrl = URL.createObjectURL(blob);

                            // Create a link element and set its attributes
                            var link = document.createElement('a');
                            link.href = blobUrl;
                            link.download = filename;

                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                            URL.revokeObjectURL(blobUrl);

                        } else if (buttonType === 'print-copy') {
                            // Open a new window with the print view
                            var blob = new Blob([response], {
                                type: 'application/pdf'
                            });
                            var blobUrl = URL.createObjectURL(blob);

                            var printWindow = window.open(blobUrl, '_blank');
                            printWindow.onload = function() {
                                printWindow.print();
                            };
                        }
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                }
            });
        }

        $('#app-filter-range').daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            format: 'YYYY-MM-DD'
        }, function(start, end) {

            _start = start.format('YYYY-MM-DD');
            _end = end.format('YYYY-MM-DD');

            $('#appointments-table').DataTable().destroy();

            fetch_appointments(_start, _end);

        });
    });
</script>

</script>
</body>

</html>