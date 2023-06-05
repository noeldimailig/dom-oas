<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Details - DepED Oriental Mindoro</title>
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

    <h1 class="text-center title" style="font-size:22px;margin-top:20px;">Appointment Slip</h1>

    <hr style="color:black;">

    <h3>Booked</h3>
    <i>Created on <?php echo change_date_format($appointment['created_at'], 'l, F j, Y h:i A'); ?></i>

    <h5 class="title">Personal Information</h5>
    <table style="width: 80%;">
        <tbody>
            <tr>
                <td class="legend">First Name</td>
                <td><?php echo $profile['first_name']; ?></td>
            </tr>

            <tr>
                <td class="legend">Middle Name</td>
                <td><?php echo $profile['middle_name']; ?></td>
            </tr>

            <tr>
                <td class="legend">Last Name</td>
                <td><?php echo $profile['last_name']; ?></td>
            </tr>

            <tr>
                <td class="legend">Gender</td>
                <td><?php echo gender($profile['gender_id']); ?></td>
            </tr>

            <tr>
                <td class="legend">Vulnerable Sector</td>
                <td><?php echo vulnerable_sector($profile['vul_sec_id']); ?></td>
            </tr>
            <tr>
                <td class="legend">Position</td>
                <td><?php echo position($appointment['position_id']); ?></td>
            </tr>

            <tr>
                <td class="legend">School ID - School Name</td>
                <td><?php echo school_id_name($appointment['school_in_id']); ?></td>
            </tr>

            <tr>
                <td class="legend">Level</td>
                <td><?php echo level($appointment['level_id']); ?></td>
            </tr>

            <tr>
                <td class="legend">District</td>
                <td><?php echo district($appointment['district_id']); ?></td>
            </tr>

            <tr>
                <td class="legend">Functional Division</td>
                <td><?php echo functional_division($appointment['func_div_id']); ?></td>
            </tr>

            <tr>
                <td class="legend">Unit, Section, Office to Visit</td>
                <td><?php echo usov($appointment['usov_id']); ?></td>
            </tr>
        </tbody>
    </table>

    <h5 class="title">Contact Information</h5>
    <table style="width: 80%;">
        <tbody>
            <tr>
                <td class="legend">Email</td>
                <td><?php echo $profile['email']; ?></td>
            </tr>

            <tr>
                <td class="legend">Contact Number</td>
                <td><?php echo $profile['contact_no']; ?></td>
            </tr>
        </tbody>
    </table>

    <h5 class="title">Appointment Schedule</h5>

    <table style="width: 80%;">
        <tbody>
            <tr>
                <td class="legend">Date of Visit</td>
                <td><?php echo change_date_format($appointment['date_of_visit'], 'F d, Y'); ?></td>
            </tr>

            <tr>
                <td class="legend">Time</td>
                <td><?php echo change_date_format(time_slot($appointment['time_slot_id']), 'h:i A'); ?></td>
            </tr>
        </tbody>
    </table>

    <h5 class="title">Purpose</h5>
    <table style="width: 80%;">
        <tbody>
            <tr>
                <td class="legend">Purpose</td>
                <td><?php echo $appointment['purpose']; ?></td>
            </tr>
        </tbody>
    </table>
</body>

</html>