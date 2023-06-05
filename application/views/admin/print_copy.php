<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments - DepED Oriental Mindoro</title>
</head>
<style>
    * {
        font-family: Verdana, Arial, Helvetica, sans-serif;
    }

    .text-center {
        text-align: center;
    }

    .title {
        color: #012970;
        font-weight: bold;
        text-align: center;
    }

    .logo {
        width: 100px;
        height: 100px;
    }

    /* Define table styles */
    table {
        /* width: 100%; */
        border-collapse: collapse;
        margin-bottom: 10px;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        margin-left: auto;
        margin-right: auto;
    }

    .header {
        border: none;
    }

    th,
    td {
        border: 1px solid #dddddd;
        padding: 5px;
        text-align: left;
        font-family: Verdana, Arial, Helvetica, sans-serif;
    }

    th {
        font-weight: bold;
        background-color: #f2f2f2;
    }

    .legend {
        background-color: #f2f2f2;
        width: 35%;
        text-align: right;
    }
</style>
</head>

<body>
    <table style="width:100%;">
        <tbody>
            <tr>
                <td class="header" style="text-align: left;">
                    <img class="logo" src="<?php echo base_url(); ?>assets/img/kne logo.png" alt="Logo Left">
                </td>
                <td class="header text-center">
                    <div>
                        <h6>Republic of the Philippines</h6>
                        <h4>Department of Education</h4>
                        <h5>MIMAROPA Region</h5>
                        <h4 class="title">Schools Division of Oriental Mindoro</h4>
                        <p style="font-size: 10px;">Sta. Isabel, Calapan City</p>
                        <h6 style="font-size: 12px; color: #DE423A;">Online Appointment System</h6>
                    </div>
                </td>
                <td class="header" style="text-align:right;">
                    <img class="logo" src="<?php echo base_url(); ?>assets/img/sdo logo.png" alt="Logo Right">
                </td>
                </div>
            </tr>
        </tbody>
    </table>

    <h1 class="text-center title" style="font-size:22px;margin-top:20px;">Appointments from <?php echo $start_date . ' - ' . $end_date; ?></h1>

    <hr style="color:black;">

    <!-- <h5 class="title">Personal Information</h5> -->
    <table style="width: 100%;">
        <thead>
            <tr>
                <th class="title">No.</th>
                <th class="title">Full Name</th>
                <th class="title">Date of Visit</th>
                <th class="title">Time Slot</th>
                <th class="title">Purpose</th>
                <th class="title">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            $color = 'red';
            foreach ($appointments as $appointment) { ?>
                <?php if ($appointment->status == 'booked') {
                    $color = 'green';
                } else {
                    $color = 'red';
                } ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $appointment->full_name; ?></td>
                    <td><?php echo change_date_format($appointment->date_of_visit); ?></td>
                    <td><?php echo change_date_format($appointment->time_slot, 'h:i A'); ?></td>
                    <td><?php echo $appointment->purpose; ?></td>
                    <td style="color:<?php echo $color; ?>;"><?php echo strtoupper($appointment->status); ?></td>
                </tr>
            <?php $no++;
            } ?>
        </tbody>
    </table>
</body>

</html>