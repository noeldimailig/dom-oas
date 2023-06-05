<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Get user info
 */
if (!function_exists('user')) {
    function user()
    {
        $CI = &get_instance();
        return $CI->db->table('user')
            ->select('*')
            ->where('user_id', $_SESSION['user_id'])
            ->get();
    }
}

if (!function_exists('gender')) {
    function gender($id)
    {
        $CI = &get_instance();
        $result = $CI->db->get_where('gender', ['gender_id' => $id])
            ->row_array();

        if (!empty($result)) {
            return $result['gender'];
        }

        return '<p class="text-danger">Not Available. Edit your profile to specify</p>';
    }
}

if (!function_exists('vulnerable_sector')) {
    function vulnerable_sector($id)
    {
        $CI = &get_instance();
        $result = $CI->db->get_where('vulnerable_sector', ['vul_sec_id' => $id])
            ->row_array();

        if (!empty($result)) {
            return $result['vulnerable_sector'];
        }

        return '<p class="text-danger">Not Available. Edit your profile to specify</p>';
    }
}

if (!function_exists('position')) {
    function position($id)
    {
        $CI = &get_instance();
        $result = $CI->db->get_where('position', ['position_id' => $id])
            ->row_array();

        if (!empty($result)) {
            return $result['position'];
        }
    }
}

if (!function_exists('school_id_name')) {
    function school_id_name($id)
    {
        $CI = &get_instance();
        $result = $CI->db->get_where('school_id_name', ['school_in_id' => $id])
            ->row_array();

        if (!empty($result)) {
            return $result['school_id'] . ' - ' . $result['school_name'];
        }
    }
}

if (!function_exists('level')) {
    function level($id)
    {
        $CI = &get_instance();
        $result = $CI->db->get_where('level', ['level_id' => $id])
            ->row_array();

        if (!empty($result)) {
            return $result['level'];
        }
    }
}

if (!function_exists('district')) {
    function district($id)
    {
        $CI = &get_instance();
        $result = $CI->db->get_where('district', ['district_id' => $id])
            ->row_array();

        if (!empty($result)) {
            return $result['district'];
        }
    }
}

if (!function_exists('functional_division')) {
    function functional_division($id)
    {
        $CI = &get_instance();
        $result = $CI->db->get_where('functional_division', ['func_div_id' => $id])
            ->row_array();

        if (!empty($result)) {
            return $result['functional_division'];
        }
    }
}

if (!function_exists('usov')) {
    function usov($id)
    {
        $CI = &get_instance();
        $result = $CI->db->get_where('usov', ['usov_id' => $id])
            ->row_array();

        if (!empty($result)) {
            return $result['usov'];
        }
    }
}

if (!function_exists('time_slot')) {
    function time_slot($id)
    {
        $CI = &get_instance();
        $result = $CI->db->get_where('time_slot', ['time_slot_id' => $id])
            ->row_array();

        if (!empty($result)) {
            return $result['time_slot'];
        }
    }
}



if (!function_exists('check_appointment_status')) {
    function check_appointment_status($id)
    {
        $CI = &get_instance();
        $result = $CI->db->get_where('appointment_details', ['appointment_id' => $id])
            ->row_array();

        if (!empty($result)) {
            if (strtotime(date_today()) > strtotime($result['date_of_visit']) && $result['status'] != 'cancelled') {
                return '<button type="button" disabled class="btn btn-sm btn-dark">Already Expired</button>';
            }
            if ($result['status'] == 'cancelled') {
                return '<button type="button" disabled class="btn btn-sm btn-danger">Already Cancelled</button>';
            } else {
                return '<a class="btn btn-sm btn-success" href="' . site_url('user/appointment/' . $result['appointment_id']) . '">View Details</a>
                <a class="btn btn-sm btn-warning" href="' . site_url('user/cancelapp/' . $result['appointment_id']) . '">Cancel Appointment</a>';
            }
        }
    }
}

if (!function_exists('is_profile_complete')) {
    function is_profile_complete()
    {
        $CI = &get_instance();
        $query = $CI->db->query("select * from user where user_id = " . $_SESSION['user_id'] . " and (last_name IS NULL or middle_name IS NULL or first_name IS NULL or contact_no IS NULL or gender_id IS NULL or vul_sec_id IS NULL)");

        $result = $query->row_array();

        if (!empty($result)) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i>
            Please complete your profile! <a href=' . site_url('user/profile') . '>Click here</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }
}

if (!function_exists('complete_profile')) {
    function complete_profile()
    {
        $CI = &get_instance();
        $query = $CI->db->query("select * from user where user_id = " . $_SESSION['user_id'] . " and (last_name IS NULL or middle_name IS NULL or first_name IS NULL or contact_no IS NULL or gender_id IS NULL or vul_sec_id IS NULL)");

        $result = $query->row_array();

        if (!empty($result)) {
            return true;
        }
    }
}

/**
 * Check if user is logged in
 */
if (!function_exists('is_logged_in')) {
    function is_logged_in()
    {
        $CI = &get_instance();
        if ($CI->session->userdata('logged_in') == 1)
            return true;
    }
}

/**
 * Check user type of logged ion user and redirect to corresponding portal
 */
if (!function_exists('check_logged_in_user_type')) {
    function check_logged_in_user_type()
    {
        $CI = &get_instance();
        if ($CI->session->userdata('user_type') == "user") {
            if (complete_profile()) {
                $CI->session->set_flashdata('warning', 'Please comple your profile first as some of the information are needed to set an appointment.');
                redirect('user/profile');
            }
            redirect('user');
        } elseif ($CI->session->userdata('user_type') == "admin")
            redirect('admin');
        else
            redirect('auth');
    }
}
