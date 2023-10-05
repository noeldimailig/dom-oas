<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        if (!is_logged_in()) {
            redirect('signin');
        }
    }

    public function templates($page = NULL, $data = [])
    {
        $this->load->view('includes/header', $data);
        $this->load->view('includes/topbar', $data);
        $this->load->view('includes/sidebar', $data);
        $this->load->view('admin/' . $page, $data);
        $this->load->view('includes/footer');
    }

    public function index()
    {
        $data['title'] = 'Dashboard - DepEd Online Appointment System';
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        $this->load->model('Admin_model', 'admin_model');
        $data['booked_count'] = $this->admin_model->count_booked();
        $data['cancelled_count'] = $this->admin_model->count_cancelled();

        $this->templates('index', $data);
    }

    public function dashboard()
    {
        $this->index();
    }

    public function appointments()
    {
        $data['title'] = 'Appointments - DepEd Online Appointment System';
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        $this->load->model('Admin_model', 'admin_model');
        $data['booked_count'] = $this->admin_model->count_booked();
        $data['cancelled_count'] = $this->admin_model->count_cancelled();

        $this->templates('appointments', $data);
    }

    public function get_appointments()
    {
        // POST data
        $postdata = $this->input->post();

        // Get data
        $csrf_name = $this->security->get_csrf_token_name();
        $csrf_hash = $this->security->get_csrf_hash();
        $this->load->model('Appointment_model', 'app_model');
        $data = $this->app_model->appointments($csrf_name, $csrf_hash, $postdata);
        echo json_encode($data);
    }

    public function export_pdf()
    {
        $this->load->model('Appointment_model', 'app_model');
        $filteredData = $this->input->post('filteredData');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        $data['appointments'] = $this->app_model->get_id_of_appointment($filteredData);
        $data['start_date'] = change_date_format($start_date, 'F j, Y');
        $data['end_date'] = change_date_format($end_date, 'F j, Y');

        $data['title'] = 'Appointments - DepED Online Appointment System';

        $html = $this->load->view('admin/print_copy', $data, true);

        // Set the headers to tell the browser to download the file.
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment;');

        $mpdf = new mPDF();
        $mpdf->WriteHTML($html);

        if ($data['start_date'] == '' || $data['start_date'] == NULL) {
            echo $mpdf->Output('Appointment Lists.pdf', 'D');
        } else {
            echo $mpdf->Output('AppointmentLists' . $data['start_date'] . ' - ' . $data['end_date'] . '.pdf', 'D');
        }
    }

    public function print_copy()
    {
        $this->load->model('Appointment_model', 'app_model');
        $filteredData = $this->input->post('filteredData');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        $data['appointments'] = $this->app_model->get_id_of_appointment($filteredData);
        $data['start_date'] = change_date_format($start_date, 'F j, Y');
        $data['end_date'] = change_date_format($end_date, 'F j, Y');

        $data['title'] = 'Appointments - DepED Online Appointment System';

        $html = $this->load->view('admin/print_copy', $data, true);

        // Set the headers to tell the browser to download the file.
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment;');

        $mpdf = new mPDF();
        $mpdf->WriteHTML($html);
        echo $mpdf->Output();
    }

    public function export_spreadsheet()
    {
        $this->load->model('Appointment_model', 'app_model');
        $filteredData = $this->input->post('filteredData');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        $data['appointments'] = $this->app_model->export_spreadsheet($filteredData);
        $data['start_date'] = change_date_format($start_date, 'F j, Y');
        $data['end_date'] = change_date_format($end_date, 'F j, Y');

        // Get the root directory
        $root_dir = realpath(APPPATH . '../');

        $template_file = $root_dir . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'Appointments.xlsx';

        if (file_exists($template_file)) {
            $spreadsheet = IOFactory::load($template_file);
            $worksheet = $spreadsheet->getActiveSheet();

            $row = 3;
            $count = 1;
            foreach ($data['appointments'] as $appointment) {
                $col = 1;
                foreach ($appointment as $key => $value) {
                    if ($key == 'appointment_id') {
                        $worksheet->setCellValue([$col, $row], $count);
                    } else {
                        $worksheet->setCellValue([$col, $row], ucfirst($value));
                    }
                    // Add borders to the cell
                    $cell = $worksheet->getCell([$col, $row]);
                    $style = $cell->getStyle();
                    $borders = $style->getBorders();
                    $borders->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                    $col++;
                }
                $row++;
                $count++;
            }

            $export_file_name = 'Appointment List' . '.xlsx';
            $export_file = $root_dir . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $export_file_name;
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($export_file);

            // Download the temporary file
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $export_file_name . '"');
            header('Cache-Control: max-age=0');
            readfile($export_file);

            // Delete the temporary file
            unlink($export_file);
        }
    }

    #region slots
    public function timeslot($id = NULL)
    {
        $this->load->model('Appointment_model', 'app_model');
        $data['title'] = 'Time Slots - DepEd Online Appointment System';
        $data['slots'] = $this->app_model->get_timeslots();

        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        if ($id != NULL) {
            $data['slot'] = $this->app_model->get_timeslot($id);
        }

        $this->templates('timeslot', $data);
    }

    public function addslot()
    {
        $this->form_validation->set_rules('time-slot-add', 'Time Slot', 'required');

        $data = [
            'time_slot' => date('h:i A', strtotime($this->input->post('time-slot-add')))
        ];

        if ($this->form_validation->run()) {
            $this->load->model('Appointment_model', 'app_model');

            if ($this->app_model->add_timeslot($data)) {
                $this->session->set_flashdata('success', 'Time added successfully.');
                redirect('admin/timeslot');
            } else {
                $this->session->set_flashdata('danger', 'Adding time slot failed.');
                redirect('admin/timeslot');
            }
        } else {
            redirect('admin/timeslot');
        }
    }

    public function upslot()
    {
        $this->form_validation->set_rules('slotid', 'ID', 'required');
        $this->form_validation->set_rules('time-slot-up', 'Vulnerable timeslot', 'required');

        $data = [
            'time_slot_id' => $this->input->post('slotid'),
            'time_slot' => date('h:i A', strtotime($this->input->post('time-slot-up')))
        ];

        if ($this->form_validation->run()) {
            $this->load->model('Appointment_model', 'app_model');

            if ($this->app_model->update_timeslot($data)) {
                $this->session->set_flashdata('success', 'Time slot updated successfully.');
                redirect('admin/timeslot');
            } else {
                $this->session->set_flashdata('danger', 'Time slot update failed.');
                redirect('admin/timeslot/' . $data['time_slot_id']);
            }
        } else {
            redirect('admin/timeslot/' . $data['time_slot_id']);
        }
    }

    public function delslot($id)
    {
        $this->load->model('Appointment_model', 'app_model');
        if ($this->app_model->delete_timeslot($id)) {
            $this->session->set_flashdata('success', 'Time slot deleted successfully.');
            redirect('admin/timeslot');
        } else {
            $this->session->set_flashdata('danger', 'Deleting time slot failed.');
            redirect('admin/timeslot');
        }
    }
    #endregion slots

    #region sectors
    public function sector($id = NULL)
    {
        $this->load->model('WorkInfo_model', 'work_model');
        $data['title'] = 'Vulnerable Sector - DepEd Online Appointment System';
        $data['sectors'] = $this->work_model->get_vul_sectors();

        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        if ($id != NULL) {
            $data['sector'] = $this->work_model->get_vul_sector($id);
        }

        $this->templates('vulsec/index', $data);
    }

    public function addsec()
    {
        $this->form_validation->set_rules('sector', 'Vulnerable Sector', 'required');

        $data = [
            'vulnerable_sector' => $this->input->post('sector')
        ];

        if ($this->form_validation->run()) {
            $this->load->model('WorkInfo_model', 'work_model');

            if ($this->work_model->add_sector($data)) {
                $this->session->set_flashdata('success', 'Vulnerable sector added successfully.');
                redirect('admin/sector');
            } else {
                $this->session->set_flashdata('danger', 'Adding vulnerable sector failed.');
                redirect('admin/sector');
            }
        } else {
            redirect('admin/sector');
        }
    }

    public function upsec()
    {
        $this->form_validation->set_rules('vulsecid', 'ID', 'required');
        $this->form_validation->set_rules('sector', 'Vulnerable Sector', 'required');

        $data = [
            'vul_sec_id' => $this->input->post('vulsecid'),
            'vulnerable_sector' => $this->input->post('sector')
        ];

        if ($this->form_validation->run()) {
            $this->load->model('WorkInfo_model', 'work_model');

            if ($this->work_model->update_sector($data)) {
                $this->session->set_flashdata('success', 'Vulnerable sector updated successfully.');
                redirect('admin/sector');
            } else {
                $this->session->set_flashdata('danger', 'Vulnerable sector update failed.');
                redirect('admin/sector/' . $data['vul_sec_id']);
            }
        } else {
            redirect('admin/sector/' . $data['vul_sec_id']);
        }
    }

    public function delsec($id)
    {
        $this->load->model('WorkInfo_model', 'work_model');
        if ($this->work_model->delete_sector($id)) {
            $this->session->set_flashdata('success', 'Vulnerable sector deleted successfully.');
            redirect('admin/sector');
        } else {
            $this->session->set_flashdata('danger', 'Deleting vulnerable sector failed.');
            redirect('admin/sector');
        }
    }
    #endregion sectors

    #region levels
    public function level($id = NULL)
    {
        $this->load->model('WorkInfo_model', 'work_model');

        $data['title'] = 'Level - DepEd Online Appointment System';
        $data['levels'] = $this->work_model->get_levels();
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        if ($id != NULL) {
            $data['level'] = $this->work_model->get_level($id);
        }

        $this->templates('level/index', $data);
    }

    public function addlevel()
    {
        $this->form_validation->set_rules('level', 'level', 'required');

        $data = [
            'level' => $this->input->post('level')
        ];

        if ($this->form_validation->run()) {
            $this->load->model('WorkInfo_model', 'work_model');

            if ($this->work_model->add_level($data)) {
                $this->session->set_flashdata('success', 'Level added successfully.');
                redirect('admin/level');
            } else {
                $this->session->set_flashdata('danger', 'Adding level failed.');
                redirect('admin/level');
            }
        } else {
            redirect('admin/level');
        }
    }

    public function uplevel()
    {
        $this->form_validation->set_rules('levelid', 'ID', 'required');
        $this->form_validation->set_rules('level', 'level', 'required');

        $data = [
            'level_id' => $this->input->post('levelid'),
            'level' => $this->input->post('level')
        ];

        if ($this->form_validation->run()) {
            $this->load->model('WorkInfo_model', 'work_model');

            if ($this->work_model->update_level($data)) {
                $this->session->set_flashdata('success', 'Level updated successfully.');
                redirect('admin/level');
            } else {
                $this->session->set_flashdata('danger', 'Updating level failed.');
                redirect('admin/level/' . $data['level_id']);
            }
        } else {
            redirect('admin/level/' . $data['level_id']);
        }
    }

    public function dellevel($id)
    {
        $this->load->model('WorkInfo_model', 'work_model');
        if ($this->work_model->delete_level($id)) {
            $this->session->set_flashdata('success', 'Level deleted successfully.');
            redirect('admin/level');
        } else {
            $this->session->set_flashdata('danger', 'Deleting level failed.');
            redirect('admin/level');
        }
    }
    #endregion levels

    #region genders
    public function gender($id = NULL)
    {
        $this->load->model('WorkInfo_model', 'work_model');

        $data['title'] = 'Gender - DepEd Online Appointment System';
        $data['genders'] = $this->work_model->get_genders();
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        if ($id != NULL) {
            $data['gender'] = $this->work_model->get_gender($id);
        }

        $this->templates('gender/index', $data);
    }

    public function addgen()
    {
        $this->form_validation->set_rules('gender', 'Gender', 'required');

        $data = [
            'gender' => $this->input->post('gender')
        ];

        if ($this->form_validation->run()) {
            $this->load->model('WorkInfo_model', 'work_model');

            if ($this->work_model->add_gender($data)) {
                $this->session->set_flashdata('success', 'Gender added successfully.');
                redirect('admin/gender');
            } else {
                $this->session->set_flashdata('danger', 'Adding gender failed.');
                redirect('admin/gender');
            }
        } else {
            redirect('admin/gender');
        }
    }

    public function upgen()
    {
        $this->form_validation->set_rules('genderid', 'ID', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');

        $data = [
            'gender_id' => $this->input->post('genderid'),
            'gender' => $this->input->post('gender')
        ];

        if ($this->form_validation->run()) {
            $this->load->model('WorkInfo_model', 'work_model');

            if ($this->work_model->update_gender($data)) {
                $this->session->set_flashdata('success', 'Gender updated successfully.');
                redirect('admin/gender');
            } else {
                $this->session->set_flashdata('danger', 'Gender update failed.');
                redirect('admin/gender/' . $data['gender_id']);
            }
        } else {
            redirect('admin/gender/' . $data['gender_id']);
        }
    }

    public function delgen($id)
    {
        $this->load->model('WorkInfo_model', 'work_model');
        if ($this->work_model->delete_gender($id)) {
            $this->session->set_flashdata('success', 'Gender deleted successfully.');
            redirect('admin/gender');
        } else {
            $this->session->set_flashdata('danger', 'Deleting gender failed.');
            redirect('admin/gender');
        }
    }
    #endregion genders

    #region districts
    public function district($id = NULL)
    {
        $this->load->model('WorkInfo_model', 'work_model');

        $data['title'] = 'District - DepEd Online Appointment System';
        $data['districts'] = $this->work_model->get_districts();
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        if ($id != NULL) {
            $data['district'] = $this->work_model->get_district($id);
        }

        $this->templates('district/index', $data);
    }

    public function adddistrict()
    {
        $this->form_validation->set_rules('district', 'district', 'required');

        $data = [
            'district' => $this->input->post('district')
        ];

        if ($this->form_validation->run()) {
            $this->load->model('WorkInfo_model', 'work_model');

            if ($this->work_model->add_district($data)) {
                $this->session->set_flashdata('success', 'District added successfully.');
                redirect('admin/district');
            } else {
                $this->session->set_flashdata('danger', 'Adding district failed.');
                redirect('admin/district');
            }
        } else {
            redirect('admin/district');
        }
    }

    public function updistrict()
    {
        $this->form_validation->set_rules('districtid', 'ID', 'required');
        $this->form_validation->set_rules('district', 'district', 'required');

        $data = [
            'district_id' => $this->input->post('districtid'),
            'district' => $this->input->post('district')
        ];

        if ($this->form_validation->run()) {
            $this->load->model('WorkInfo_model', 'work_model');

            if ($this->work_model->update_district($data)) {
                $this->session->set_flashdata('success', 'District updated successfully.');
                redirect('admin/district');
            } else {
                $this->session->set_flashdata('danger', 'District update failed.');
                redirect('admin/district/' . $data['district_id']);
            }
        } else {
            redirect('admin/district/' . $data['district_id']);
        }
    }

    public function deldis($id)
    {
        $this->load->model('WorkInfo_model', 'work_model');
        if ($this->work_model->delete_district($id)) {
            $this->session->set_flashdata('success', 'District deleted successfully.');
            redirect('admin/district');
        } else {
            $this->session->set_flashdata('danger', 'Deleting district failed.');
            redirect('admin/district');
        }
    }
    #endregion districts

    #region schools
    public function school($id = NULL)
    {
        $this->load->model('WorkInfo_model', 'work_model');

        $data['title'] = 'Schools - DepEd Online Appointment System';
        $data['schools'] = $this->work_model->get_schools();
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        if ($id != NULL) {
            $data['school'] = $this->work_model->get_school($id);
        }

        $this->templates('school/index', $data);
    }

    public function addschool()
    {
        $this->form_validation->set_rules('school-id', 'School ID', 'required');
        $this->form_validation->set_rules('school-name', 'School Name', 'required');

        $data = [
            'school_id' => $this->input->post('school-id'),
            'school_name' => $this->input->post('school-name')
        ];

        if ($this->form_validation->run()) {
            $this->load->model('WorkInfo_model', 'work_model');

            if ($this->work_model->add_school($data)) {
                $this->session->set_flashdata('success', 'School added successfully.');
                redirect('admin/school');
            } else {
                $this->session->set_flashdata('danger', 'Adding school failed.');
                redirect('admin/school');
            }
        } else {
            redirect('admin/school');
        }
    }

    public function upschool()
    {
        $this->form_validation->set_rules('schoolid', 'ID', 'required');
        $this->form_validation->set_rules('school-id', 'School ID', 'required');
        $this->form_validation->set_rules('school-name', 'School Name', 'required');

        $data = [
            'school_in_id' => $this->input->post('schoolid'),
            'school_id' => $this->input->post('school-id'),
            'school_name' => $this->input->post('school-name')
        ];

        if ($this->form_validation->run()) {
            $this->load->model('WorkInfo_model', 'work_model');

            if ($this->work_model->update_school($data)) {
                $this->session->set_flashdata('success', 'School updated successfully.');
                redirect('admin/school');
            } else {
                $this->session->set_flashdata('danger', 'Updating school failed.');
                redirect('admin/school/' . $data['school_id']);
            }
        } else {
            redirect('admin/school/' . $data['school_id']);
        }
    }

    public function delschool($id)
    {
        $this->load->model('WorkInfo_model', 'work_model');
        if ($this->work_model->delete_school($id)) {
            $this->session->set_flashdata('success', 'School deleted successfully.');
            redirect('admin/school');
        } else {
            $this->session->set_flashdata('danger', 'Deleting school failed.');
            redirect('admin/school');
        }
    }
    #endregion schools

    #region positions
    public function position($id = NULL)
    {
        $this->load->model('WorkInfo_model', 'work_model');

        $data['title'] = 'Position - DepEd Online Appointment System';
        $data['positions'] = $this->work_model->get_positions();
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        if ($id != NULL) {
            $data['position'] = $this->work_model->get_position($id);
        }

        $this->templates('position/index', $data);
    }

    public function addpos()
    {
        $this->form_validation->set_rules('position', 'position', 'required');

        $data = [
            'position' => $this->input->post('position')
        ];

        if ($this->form_validation->run()) {
            $this->load->model('WorkInfo_model', 'work_model');

            if ($this->work_model->add_position($data)) {
                $this->session->set_flashdata('success', 'Position added successfully.');
                redirect('admin/position');
            } else {
                $this->session->set_flashdata('danger', 'Adding position failed.');
                redirect('admin/position');
            }
        } else {
            redirect('admin/position');
        }
    }

    public function uppos()
    {
        $this->form_validation->set_rules('posid', 'ID', 'required');
        $this->form_validation->set_rules('position', 'position', 'required');

        $data = [
            'position_id' => $this->input->post('posid'),
            'position' => $this->input->post('position')
        ];

        if ($this->form_validation->run()) {
            $this->load->model('WorkInfo_model', 'work_model');

            if ($this->work_model->update_position($data)) {
                $this->session->set_flashdata('success', 'Position updated successfully.');
                redirect('admin/position');
            } else {
                $this->session->set_flashdata('danger', 'Updating position failed.');
                redirect('admin/position/' . $data['position_id']);
            }
        } else {
            redirect('admin/position/' . $data['position_id']);
        }
    }

    public function delpos($id)
    {
        $this->load->model('WorkInfo_model', 'work_model');
        if ($this->work_model->delete_position($id)) {
            $this->session->set_flashdata('success', 'Position deleted successfully.');
            redirect('admin/position');
        } else {
            $this->session->set_flashdata('danger', 'Deleting position failed.');
            redirect('admin/position');
        }
    }
    #endregion positions

    #region divisions
    public function division($id = NULL)
    {
        $this->load->model('WorkInfo_model', 'work_model');

        $data['title'] = 'Division - DepEd Online Appointment System';
        $data['divisions'] = $this->work_model->get_divisions();
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        if ($id != NULL) {
            $data['division'] = $this->work_model->get_division($id);
        }

        $this->templates('division/index', $data);
    }

    public function adddiv()
    {
        $this->form_validation->set_rules('division', 'division', 'required');

        $data = [
            'functional_division' => $this->input->post('division')
        ];

        if ($this->form_validation->run()) {
            $this->load->model('WorkInfo_model', 'work_model');

            if ($this->work_model->add_division($data)) {
                $this->session->set_flashdata('success', 'Functional division added successfully.');
                redirect('admin/division');
            } else {
                $this->session->set_flashdata('danger', 'Adding functional division failed.');
                redirect('admin/division');
            }
        } else {
            redirect('admin/division');
        }
    }

    public function updiv()
    {
        $this->form_validation->set_rules('divid', 'ID', 'required');
        $this->form_validation->set_rules('division', 'division', 'required');

        $data = [
            'func_div_id' => $this->input->post('divid'),
            'functional_division' => $this->input->post('division')
        ];

        if ($this->form_validation->run()) {
            $this->load->model('WorkInfo_model', 'work_model');

            if ($this->work_model->update_division($data)) {
                $this->session->set_flashdata('success', 'Functional division updated successfully.');
                redirect('admin/division');
            } else {
                $this->session->set_flashdata('danger', 'Updating functional division failed.');
                redirect('admin/division/' . $data['division_id']);
            }
        } else {
            redirect('admin/division/' . $data['division_id']);
        }
    }

    public function deldiv($id)
    {
        $this->load->model('WorkInfo_model', 'work_model');
        if ($this->work_model->delete_division($id)) {
            $this->session->set_flashdata('success', 'Functional division deleted successfully.');
            redirect('admin/division');
        } else {
            $this->session->set_flashdata('danger', 'Deleting functional division failed.');
            redirect('admin/division');
        }
    }
    #endregion divisions

    #region usovs
    public function usov($id = NULL)
    {
        $this->load->model('WorkInfo_model', 'work_model');

        $data['title'] = 'Unit, Section, Office to Visit - DepEd Online Appointment System';
        $data['usovs'] = $this->work_model->get_usovs();
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        if ($id != NULL) {
            $data['usov'] = $this->work_model->get_usov($id);
        }

        $this->templates('usov/index', $data);
    }
    // public function usov()
    // {
    //     $data['title'] = 'Unit, Section, Office to Visit - DepEd Online Appointment System';
    //     $perPage = 10;
    //     $config['base_url'] = base_url() . 'admin/usov';
    //     $page = 0;
    //     $data['csrf'] = array(
    //         'name' => $this->security->get_csrf_token_name(),
    //         'hash' => $this->security->get_csrf_hash()
    //     );
    //     if ($this->input->get('page')) {
    //         $page = $this->input->get('page');
    //     }

    //     $start_index = 0;
    //     if ($page != 0) {
    //         $start_index = $perPage * ($page - 1);
    //     }

    //     $total_rows = 0;

    //     $this->load->model('WorkInfo_model', 'work_model');
    //     $this->load->model('Pagination_model', 'pagination_model');
    //     if ($this->input->get('search') != null) {
    //         $search = $this->input->get('search');
    //         $data['usovs'] = $this->pagination_model->get_usovs($perPage, $start_index, $search, $is_count = 0);
    //         $total_rows = $this->work_model->count_usovs($search);
    //     } else {
    //         $data['usovs'] = $this->pagination_model->get_usovs($perPage, $start_index, null, $is_count = 0);
    //         $total_rows = $this->work_model->count_usovs(null);
    //     }

    //     $config['total_rows'] = $total_rows;

    //     $config['per_page'] = $perPage;
    //     $config['enable_query_strings'] = true;
    //     $config['use_page_numbers'] = true;
    //     $config['page_query_string'] = true;
    //     $config['query_string_segment'] = 'page';
    //     $config['reuse_query_string'] = true;
    //     $config['full_tag_open'] = '<ul  class="pagination">';
    //     $config['full_tag_close'] = '</ul' >
    //         $config['first_link'] = 'First';
    //     $config['last_link'] = 'Last';
    //     $config['first_tag_open'] =  '<li  class="page-item"><spann class="page-link">';
    //     $config['first_tag_close'] = '</span></li>';
    //     $config['prev_link'] = '&laquo';
    //     $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';

    //     $config['prev_tag_close'] = '</span></li>';
    //     $config['next_link'] = '&raquo';
    //     $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['next_tag_close'] = '</span></li>';
    //     $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['last_tag_close'] = '</span></li>';
    //     $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
    //     $config['cur_tag_close'] = '</a></li>';
    //     $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
    //     $config['num_tag_close'] = '</span></li>';

    //     $this->pagination->initialize($config);
    //     // $this->data['page'] = $page;
    //     // $this->data['links'] = $this->pagination->create_links();
    //     $data['offset'] = $start_index;
    //     $data['allrecords'] = $total_rows;
    //     $data['number_page'] = $page;
    //     $this->templates('usov/index', $data);
    // }

    public function addusov()
    {
        $this->form_validation->set_rules('usov', 'usov', 'required');

        $data = [
            'usov' => $this->input->post('usov')
        ];

        if ($this->form_validation->run()) {
            $this->load->model('WorkInfo_model', 'work_model');

            if ($this->work_model->add_usov($data)) {
                $this->session->set_flashdata('success', 'Unit, Section, Office to Visit added successfully.');
                redirect('admin/usov');
            } else {
                $this->session->set_flashdata('danger', 'Adding Unit, Section, Office to Visit failed.');
                redirect('admin/usov');
            }
        } else {
            redirect('admin/usov');
        }
    }

    public function upusov()
    {
        $this->form_validation->set_rules('usovid', 'ID', 'required');
        $this->form_validation->set_rules('usov', 'usov', 'required');

        $data = [
            'usov_id' => $this->input->post('usovid'),
            'usov' => $this->input->post('usov')
        ];

        if ($this->form_validation->run()) {
            $this->load->model('WorkInfo_model', 'work_model');

            if ($this->work_model->update_usov($data)) {
                $this->session->set_flashdata('success', 'Unit, Section, Office to Visit updated successfully.');
                redirect('admin/usov');
            } else {
                $this->session->set_flashdata('danger', 'Updating Unit, Section, Office to Visit failed.');
                redirect('admin/usov/' . $data['usov_id']);
            }
        } else {
            redirect('admin/usov/' . $data['usov_id']);
        }
    }

    public function delusov($id)
    {
        $this->load->model('WorkInfo_model', 'work_model');
        if ($this->work_model->delete_usov($id)) {
            $this->session->set_flashdata('success', 'Unit, Section, Office to Visit deleted successfully.');
            redirect('admin/usov');
        } else {
            $this->session->set_flashdata('danger', 'Deleting Unit, Section, Office to Visit failed.');
            redirect('admin/usov');
        }
    }
    #endregion usovs

    public function settings()
    {
        $this->load->model('Admin_model', 'admin_model');
        $data['title'] = 'Settings - DepEd Online Appointment System';
        // $data['admin'] = $this->admin_model->get_admin($this->session->userdata('user_id'));
        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->templates('settings', $data);
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
                redirect('admin/settings');
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
                redirect('admin/settings');
            }
        } else {
            $this->session->set_flashdata('danger', 'Please check the information you provided');
            redirect('admin/settings');
        }
    }
}
