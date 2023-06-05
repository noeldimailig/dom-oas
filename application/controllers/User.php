<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Mpdf\Mpdf;

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function download($id)
    {
        $this->load->model('Appointment_model', 'app_model');
        $this->load->model('User_model', 'user_model');
        $this->load->model('WorkInfo_model', 'work_model');

        $data['appointment'] = $this->app_model->get_appointment($id);
        $data['profile'] = $this->user_model->user_details($_SESSION['user_id']);

        $data['title'] = 'Appointment Detail - DepED Online Appointment System';

        $html = $this->load->view('appointment_details_pdf', $data, true);

        $mpdf = new mPDF();
        $mpdf->WriteHTML($html);
        // $mpdf->Output();
        $mpdf->Output(strtoupper($data['profile']['last_name'] . '_' . $data['profile']['first_name']) . '.pdf', 'D');

        redirect('user/appointment/' . $id);
    }

    private function templates($page, $data)
    {
        $this->load->view('includes/header', $data);
        $this->load->view('includes/topbar', $data);
        $this->load->view('includes/sidebar', $data);
        $this->load->view($page, $data);
        $this->load->view('includes/footer');
    }

    public function index()
    {
        $data['title'] = 'Dashboard - DepED Online Appointment System';

        $this->load->model('Appointment_model', 'app_model');

        $data['appointments'] = $this->app_model->get_appointments($_SESSION['user_id']);

        $this->templates('user_dashboard', $data);
    }

    public function appointment($id)
    {
        $data['title'] = 'Appointment Detail - DepED Online Appointment System';

        $this->load->model('Appointment_model', 'app_model');
        $this->load->model('User_model', 'user_model');
        $this->load->model('WorkInfo_model', 'work_model');

        $data['appointment'] = $this->app_model->get_appointment($id);

        $data['genders'] = $this->work_model->get_genders();
        $data['sectors'] = $this->work_model->get_vul_sectors();
        $data['positions'] = $this->work_model->get_positions();
        $data['schools'] = $this->work_model->get_schools();
        $data['levels'] = $this->work_model->get_levels();
        $data['divisions'] = $this->work_model->get_divisions();
        $data['districts'] = $this->work_model->get_districts();
        $data['usovs'] = $this->work_model->get_usovs();
        $data['profile'] = $this->user_model->user_details($_SESSION['user_id']);

        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        $this->templates('appointment_details', $data);
    }

    public function cancelapp($appid)
    {
        $this->load->model('Appointment_model', 'app_model');

        $data = [
            'appointment_id' => $appid,
            'status' => 'cancelled'
        ];

        if ($this->app_model->cancel_appointment($data)) {
            $this->session->set_flashdata('success', 'Appointment cancelled successfully.');
            redirect('user');
        } else {
            $this->session->set_flashdata('danger', 'Appointment cancellation failed.');
            redirect('user');
        }
    }

    public function profile()
    {
        $data['title'] = 'My Profile - DepED Online Appointment System';

        $this->load->model('User_model', 'user_model');
        $this->load->model('WorkInfo_model', 'work_model');

        $data['genders'] = $this->work_model->get_genders();
        $data['sectors'] = $this->work_model->get_vul_sectors();
        $data['profile'] = $this->user_model->user_details($_SESSION['user_id']);

        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        $this->templates('profile', $data);
    }

    public function upinfo($appid = NULL)
    {
        $this->load->model('User_model', 'user_model');

        if ($appid != NULL) {
            $this->form_validation->set_rules('school', 'School', 'required');
            $this->form_validation->set_rules('position', 'Position', 'required');
            $this->form_validation->set_rules('level', 'Level', 'required');
            $this->form_validation->set_rules('division', 'Division', 'required');
            $this->form_validation->set_rules('district', 'District', 'required');
            $this->form_validation->set_rules('usov', 'Unit/Section/Office to Visit', 'required');
            $this->form_validation->set_rules('purpose', 'Purpose', 'required');
        }

        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        $this->form_validation->set_rules('mname', 'Middle Name', 'required');
        $this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('contact', 'Contact Number', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('vulnerable-sector', 'Vulnerable Sector', 'required');

        if ($this->form_validation->run()) {
            $data = [];

            if ($appid != NULL) {
                if ($this->input->post('date-of-visit') == "") {
                    $data['work_info'] = [
                        'appointment_id' => $appid,
                        'school_in_id' => $this->input->post('school'),
                        'position_id' => $this->input->post('position'),
                        'level_id' => $this->input->post('level'),
                        'func_div_id' => $this->input->post('division'),
                        'district_id' => $this->input->post('district'),
                        'usov_id' => $this->input->post('usov'),
                        'purpose' => $this->input->post('purpose'),
                    ];
                } else {
                    $data['work_info'] = [
                        'appointment_id' => $appid,
                        'school_in_id' => $this->input->post('school'),
                        'position_id' => $this->input->post('position'),
                        'level_id' => $this->input->post('level'),
                        'func_div_id' => $this->input->post('division'),
                        'district_id' => $this->input->post('district'),
                        'usov_id' => $this->input->post('usov'),
                        'purpose' => $this->input->post('purpose'),
                        'date_of_visit' => $this->input->post('date-of-visit'),
                        'time_slot_id' => $this->input->post('selected-time-slot'),
                        'status' => 'booked'
                    ];
                }
                $data['user_info'] = [
                    'user_id' => $_SESSION['user_id'],
                    'last_name' => $this->input->post('lname'),
                    'middle_name' => $this->input->post('mname'),
                    'first_name' => $this->input->post('fname'),
                    'contact_no' => $this->input->post('contact'),
                    'gender_id' => $this->input->post('gender'),
                    'vul_sec_id' => $this->input->post('vulnerable-sector')
                ];
            }
            $data['user_info'] = [
                'user_id' => $_SESSION['user_id'],
                'last_name' => $this->input->post('lname'),
                'middle_name' => $this->input->post('mname'),
                'first_name' => $this->input->post('fname'),
                'contact_no' => $this->input->post('contact'),
                'gender_id' => $this->input->post('gender'),
                'vul_sec_id' => $this->input->post('vulnerable-sector')
            ];

            if ($this->user_model->update_info($data)) {
                if ($appid != NULL) {
                    $this->session->set_flashdata('success', 'Appointment details updated successfully.');
                    redirect('user/appointment/' . $appid);
                }
                $this->session->set_flashdata('success', 'Personal information updated successfully.');
                redirect('user/profile');
            } else {
                if ($appid != NULL) {
                    $this->session->set_flashdata('danger', 'Please check the information you provided');
                    redirect('user/appointment/' . $appid);
                }
                $this->session->set_flashdata('danger', 'Please check the information you provided');
                redirect('user/profile');
            }
        } else {
            $this->session->set_flashdata('danger', 'Please check the information you provided');
            redirect('user/profile');
        }
    }

    public function changepass()
    {
        $this->load->model('User_model', 'user_model');

        $this->form_validation->set_rules('old_password', 'Old Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

        if ($this->form_validation->run()) {
            $current_password = $this->user_model->user_details($_SESSION['user_id'])['password'];

            if (!passwordverify($this->input->post('old_password'), $current_password)) {
                $this->session->set_flashdata('danger', 'Please check the information you provided');
                redirect('user/setting');
            }

            $data['user_info'] = [
                'user_id' => $_SESSION['user_id'],
                'password' => passwordhash($this->input->post('new_password')),
            ];

            if ($this->user_model->update_info($data)) {
                $this->session->set_flashdata('success', 'Password has been changed successfully. Log in with your new password.');
                redirect('logout');
            } else {
                $this->session->set_flashdata('danger', 'Please check the information you provideds');
                redirect('user/setting');
            }
        } else {
            $this->session->set_flashdata('danger', 'Please check the information you provided');
            redirect('user/setting');
        }
    }

    public function setting()
    {
        $data['title'] = 'Setting - DepED Online Appointment System';

        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        $this->templates('settings', $data);
    }

    public function set()
    {
        if (complete_profile()) {
            $this->session->set_flashdata('warning', 'Please comple your profile first as some of the information are needed to set an appointment.');
            redirect('user/index');
        }

        $data['title'] = 'DepEd Online Appointment System';

        $this->load->model('WorkInfo_model', 'work_model');
        $this->load->model('Appointment_model', 'app_model');
        $this->load->model('User_model', 'user_model');

        $data['districts'] = $this->work_model->get_districts();
        $data['levels'] = $this->work_model->get_levels();
        $data['sectors'] = $this->work_model->get_vul_sectors();
        $data['visits'] = $this->work_model->get_usovs();
        $data['schools'] = $this->work_model->get_schools();
        $data['divisions'] = $this->work_model->get_divisions();
        $data['positions'] = $this->work_model->get_positions();
        $data['genders'] = $this->work_model->get_genders();

        $data['slots'] = $this->app_model->get_timeslots();

        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        $data['profile'] = $this->user_model->user_details($_SESSION['user_id']);

        $this->templates('create_appointment', $data);
    }

    public function book()
    {
        $this->load->model('Appointment_model', 'app_model');

        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        $this->form_validation->set_rules('mname', 'Middle Name', 'required');
        $this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('contact', 'Contact Number', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('vulnerable-sector', 'Vulnerable Sector', 'required');
        $this->form_validation->set_rules('school', 'School', 'required');
        $this->form_validation->set_rules('position', 'Position', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('division', 'Division', 'required');
        $this->form_validation->set_rules('district', 'District', 'required');
        $this->form_validation->set_rules('usov', 'Unit/Section/Office to Visit', 'required');
        $this->form_validation->set_rules('purpose', 'Purpose', 'required');
        $this->form_validation->set_rules('date-of-visit', 'Date of Visit', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'user_info' => [
                    'last_name' => $this->input->post('lname'),
                    'middle_name' => $this->input->post('mname'),
                    'first_name' => $this->input->post('fname'),
                    'contact_no' => $this->input->post('contact'),
                    'gender_id' => $this->input->post('gender'),
                    'vul_sec_id' => $this->input->post('vulnerable-sector'),
                ],
                'work_info' => [
                    'user_id' => $_SESSION['user_id'],
                    'school_in_id' => $this->input->post('school'),
                    'position_id' => $this->input->post('position'),
                    'level_id' => $this->input->post('level'),
                    'func_div_id' => $this->input->post('division'),
                    'district_id' => $this->input->post('district'),
                    'usov_id' => $this->input->post('usov'),
                    'purpose' => $this->input->post('purpose'),
                    'date_of_visit' => $this->input->post('date-of-visit'),
                    'time_slot_id' => $this->input->post('selected-time-slot'),
                    'status' => 'booked'
                ]
            ];

            if ($this->app_model->set_appointment($data)) {
                $this->session->set_flashdata('success', 'Appointment has been set.');
                redirect('user/index');
            }
        } else {
            $this->session->set_flashdata('danger', 'Please check the information you provided');
            redirect('user/set');
        }
    }

    public function slots()
    {
        if (!$this->input->is_ajax_request()) {
            exit('Forbidden Access');
        }

        $this->load->model('Appointment_model', 'app_model');

        $date = $this->input->post('date');
        $result = $this->app_model->check_date($date);

        $slots = $this->app_model->get_timeslots();

        $output = '';
        $output .= '<h6 class="p-3">Legend<small class="mx-3"><i class="bi bi-circle-fill activity-badge text-primary align-self-start"></i> - Available</small> <small><i class="bi bi-circle-fill activity-badge text-secondary align-self-start"></i> - Not Available</small>
                    </h6>';

        $output .= '<div class="row row-cols-5 g-5 p-3">';
        foreach ($slots as $slot) {
            $color = 'primary';
            $is_available = 'true';
            $title = 'The time is still available.';

            foreach ($result as $slot_id) {

                if ($slot_id['time_slot_id'] == $slot['time_slot_id']) {
                    if ($slot_id['status'] != 'booked') {
                        $color = 'primary';
                        $is_available = 'true';
                        $title = 'The time is still available.';
                        break;
                    } else {
                        $color = 'secondary';
                        $is_available = 'false';
                        $title = 'The time is not available.';
                        break;
                    }
                }
            }
            $output .= '<div class="col col-lg-3 col-md-4 col-6 text-center">
                            <span data-bs-toggle="tooltip" data-title="' . $title . '" data-availability="' . $is_available . '" data-time-slot-id="' . $slot['time_slot_id'] . '" class="time-slot p-2 border border-' . $color . ' text-' . $color . ' rounded">'
                . change_date_format($slot['time_slot'], 'h:i A') .
                '</span></div>';
        }
        $output .= '</div>';

        $data['time_slots'] = $output;

        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
