<?php

class Appointment_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function check_date($date)
    {
        return $this->db->get_where('appointment_details', ['date_of_visit' => $date])->result_array();
    }

    private function _get_schedules($date, $time_slot_id)
    {
        return $this->db->select('time_slot_id')->where(['date_of_visit' => $date, 'time_slot_id' => $time_slot_id])->get('appointment_details')->row_array();
    }

    public function set_appointment($data)
    {
        $this->db->where('user_id', $data['work_info']['user_id']);
        $this->db->update('user', $data['user_info']);
        return $this->db->insert('appointment_details', $data['work_info']);
    }

    public function cancel_appointment($data)
    {
        $this->db->where('appointment_id', $data['appointment_id']);
        return $this->db->update('appointment_details', $data);
    }

    public function get_id_of_appointment($data)
    {
        $records = [];
        foreach ($data as $row) {
            $this->db->select('ad.appointment_id, ad.date_of_visit, ts.time_slot, concat(u.last_name, ", ", u.first_name, " ", u.middle_name) as full_name, ad.purpose, ad.status, g.gender, vs.vulnerable_sector, us.usov, p.position, d.district, sn.school_name, sn.school_id, l.level, fd.functional_division');
            $this->db->from('appointment_details as ad');
            $this->db->join('user as u', 'u.user_id = ad.user_id');
            $this->db->join('time_slot as ts', 'ts.time_slot_id = ad.time_slot_id');
            $this->db->join('vulnerable_sector as vs', 'vs.vul_sec_id = u.vul_sec_id');
            $this->db->join('gender as g', 'g.gender_id = u.gender_id');
            $this->db->join('usov as us', 'us.usov_id = ad.usov_id');
            $this->db->join('position as p', 'p.position_id = ad.position_id');
            $this->db->join('district as d', 'd.district_id = ad.district_id');
            $this->db->join('school_id_name as sn', 'sn.school_in_id = ad.school_in_id');
            $this->db->join('level as l', 'l.level_id = ad.level_id');
            $this->db->join('functional_division as fd', 'fd.func_div_id = ad.func_div_id');

            array_push($records, $this->db->where(['ad.date_of_visit' => change_date_format($row['date_of_visit'], 'Y-m-d'), 'ts.time_slot' => change_date_format($row['time_slot'], 'h:i A')])->get()->row());
        }
        return $records;
    }

    public function export_spreadsheet($data)
    {
        $records = [];
        foreach ($data as $row) {
            $this->db->select('ad.appointment_id, u.first_name, u.middle_name, u.last_name, u.contact_no, g.gender, u.email, vs.vulnerable_sector, p.position, sn.school_id, sn.school_name, l.level, d.district, fd.functional_division, us.usov, ad.purpose, ad.date_of_visit, ts.time_slot, ad.status');
            $this->db->from('appointment_details as ad');
            $this->db->join('user as u', 'u.user_id = ad.user_id');
            $this->db->join('time_slot as ts', 'ts.time_slot_id = ad.time_slot_id');
            $this->db->join('vulnerable_sector as vs', 'vs.vul_sec_id = u.vul_sec_id');
            $this->db->join('gender as g', 'g.gender_id = u.gender_id');
            $this->db->join('usov as us', 'us.usov_id = ad.usov_id');
            $this->db->join('position as p', 'p.position_id = ad.position_id');
            $this->db->join('district as d', 'd.district_id = ad.district_id');
            $this->db->join('school_id_name as sn', 'sn.school_in_id = ad.school_in_id');
            $this->db->join('level as l', 'l.level_id = ad.level_id');
            $this->db->join('functional_division as fd', 'fd.func_div_id = ad.func_div_id');

            array_push($records, $this->db->where(['ad.date_of_visit' => change_date_format($row['date_of_visit'], 'Y-m-d'), 'ts.time_slot' => change_date_format($row['time_slot'], 'h:i A')])->get()->row());
        }
        return $records;
    }

    public function appointments($csrf_name, $csrf_hash, $postdata = null)
    {
        // dd($postdata);
        $response = array();

        # Read value
        $draw = $postdata['draw'];
        $start = $postdata['start'];
        $rowperpage = $postdata['length']; // Rows display per page
        $columnIndex = $postdata['order'][0]['column']; // Column index
        $columnName = $postdata['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postdata['order'][0]['dir']; // asc or desc
        $searchValue = $postdata['search']['value']; // Search value

        # Search 
        $searchQuery = "";

        if ($searchValue != '') {
            if (isset($_POST["start_date"], $_POST["end_date"]) && $_POST["start_date"] != '' && $_POST["end_date"] != '') {
                $searchQuery .= "(concat(u.first_name, ' ', u.last_name) like '%" . $searchValue . "%' or ad.purpose like '%" . $searchValue . "%' or ad.status like '%" . $searchValue . "%' or ts.time_slot like '%" . $searchValue . "%'";
                $searchQuery .= ' AND ad.date_of_visit BETWEEN "' . change_date_format($postdata['start_date'], 'Y-m-d') . '" AND "' . change_date_format($postdata['end_date'], 'Y-m-d') . '")';
            } else {
                $searchQuery .= "(concat(u.first_name, ' ', u.last_name) like '%" . $searchValue . "%' or ad.purpose like '%" . $searchValue . "%' or ad.status like '%" . $searchValue . "%' or ts.time_slot like '%" . $searchValue . "%'";
                $searchQuery .= ' ad.date_of_visit = "' . date('Y-m-d') . '")';
            }
        } else {
            if (isset($_POST["start_date"], $_POST["end_date"]) && $_POST["start_date"] != '' && $_POST["end_date"] != '') {
                $searchQuery .= ' ad.date_of_visit BETWEEN "' . change_date_format($postdata['start_date'], 'Y-m-d') . '" AND "' . change_date_format($postdata['end_date'], 'Y-m-d') . '"';
            } else {
                $searchQuery .= ' ad.date_of_visit = "' . date('Y-m-d') . '"';
            }
        }



        # Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('appointment_details as ad');
        $this->db->join('user as u', 'u.user_id = ad.user_id');
        $this->db->join('time_slot as ts', 'ts.time_slot_id = ad.time_slot_id');
        $records = $this->db->get()->result();
        $totalRecords = $records[0]->allcount;

        # Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from('appointment_details as ad');
        $this->db->join('user as u', 'u.user_id = ad.user_id');
        $this->db->join('time_slot as ts', 'ts.time_slot_id = ad.time_slot_id');
        if ($searchQuery != '')
            $this->db->where($searchQuery);
        $records = $this->db->get()->result();
        $totalRecordwithFilter = $records[0]->allcount;

        # Fetch records
        $this->db->select('concat(u.first_name, " ", u.last_name) as full_name, ad.purpose, ad.date_of_visit, ts.time_slot, ad.status');
        $this->db->from('appointment_details as ad');
        $this->db->join('user as u', 'u.user_id = ad.user_id');
        $this->db->join('time_slot as ts', 'ts.time_slot_id = ad.time_slot_id');
        if ($searchQuery != '')
            $this->db->where($searchQuery);

        // dd(["dd" => $searchQuery]);
        if ($columnName == 'no')
            $columnName = 'full_name';
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        $no = 1;
        foreach ($records as $record) {

            $data[] = array(
                'no' => $no,
                "full_name" => $record->full_name,
                "date_of_visit" => change_date_format($record->date_of_visit),
                "time_slot" => change_date_format($record->time_slot, 'h:i A'),
                "purpose" => $record->purpose,
                "status" => $this->check_status($record->status)
            );
            $no++;
        }

        # Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        $response[$csrf_name] = $csrf_hash;

        return $response;
    }

    private function check_status($status)
    {
        if ($status == 'booked') {
            return '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> ' . ucfirst($status) . '</span>';
        } else {
            return '<span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i> ' . ucfirst($status) . '</span>';
        }
    }

    public function get_appointments($user_id)
    {
        $query = $this->db->query('select * from appointment_details as ad inner join user as u on u.user_id = ad.user_id inner join time_slot as ts on ts.time_slot_id = ad.time_slot_id where ad.user_id = ' . $user_id);
        return $query->result_array();
    }

    public function get_appointment($app_id)
    {
        $query = $this->db->query('select * from appointment_details as ad inner join user as u on u.user_id = ad.user_id inner join time_slot as ts on ts.time_slot_id = ad.time_slot_id where ad.appointment_id = ' . $app_id);
        return $query->row_array();
    }

    public function get_appointment_by_date($date)
    {
        // $this->db->select('*');
        // $this->db->from('blogs');
        // $this->db->join('comments', 'comments.id = blogs.id');
        // $query = $this->db->get();
        // $this->db->select('*');
        // $this->db->from('appointment_details');
        // $this->db->join('time_slot', 'time_slot.time_slot_id = appointment_details.time_slot_id');
        // $query = $this->db->get_where('appointment_details', ['appointment_details.date_of_visit' => $date]);
        $query = $this->db->query('select * from appointment_details as ad inner join time_slot as ts on ts.time_slot_id = ad.time_slot_id where ad.date_of_visit = ' . $date);
        return $query->result_array();
    }

    public function check_if_booked($date)
    {
        return $this->db->get_where('appointment_details', ['date_of_visit' => $date])->row();
    }

    public function get_timeslots()
    {
        return $this->db->get('time_slot')->result_array();
    }

    public function get_timeslot($id)
    {
        return $this->db->get_where('time_slot', ['time_slot_id' => $id])->row();
    }

    public function add_timeslot($data)
    {
        return $this->db->insert('time_slot', $data);
    }

    public function update_timeslot($data)
    {
        $this->db->where('time_slot_id', $data['time_slot_id']);
        return $this->db->update('time_slot', $data);
    }

    public function delete_timeslot($id)
    {
        return $this->db->delete('time_slot', ['time_slot_id' => $id]);
    }
}
