<?php

class WorkInfo_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    #region sectors
    public function get_vul_sectors()
    {
        $result = $this->db->get('vulnerable_sector');
        return $result->result_array();
    }

    public function get_vul_sector($id)
    {
        return $this->db->get_where('vulnerable_sector', ['vul_sec_id' => $id])->row();
    }

    public function add_sector($data)
    {
        return $this->db->insert('vulnerable_sector', $data);
    }

    public function update_sector($data)
    {
        $this->db->where('vul_sec_id', $data['vul_sec_id']);
        return $this->db->update('vulnerable_sector', $data);
    }

    public function delete_sector($id)
    {
        return $this->db->delete('vulnerable_sector', ['vul_sec_id' => $id]);
    }
    #endregion sectors

    #region genders
    public function get_genders()
    {
        $result = $this->db->get('gender');
        return $result->result_array();
    }

    public function get_gender($id)
    {
        return $this->db->get_where('gender', ['gender_id' => $id])->row();
    }

    public function add_gender($data)
    {
        return $this->db->insert('gender', $data);
    }

    public function update_gender($data)
    {
        $this->db->where('gender_id', $data['gender_id']);
        return $this->db->update('gender', $data);
    }

    public function delete_gender($id)
    {
        return $this->db->delete('gender', ['gender_id' => $id]);
    }
    #endregion genders

    #region levels
    public function get_levels()
    {
        $result = $this->db->get('level');
        return $result->result_array();
    }

    public function get_level($id)
    {
        return $this->db->get_where('level', ['level_id' => $id])->row();
    }

    public function add_level($data)
    {
        return $this->db->insert('level', $data);
    }

    public function update_level($data)
    {
        $this->db->where('level_id', $data['level_id']);
        return $this->db->update('level', $data);
    }

    public function delete_level($id)
    {
        return $this->db->delete('level', ['level_id' => $id]);
    }
    #endregion level

    #region districts
    public function get_districts()
    {
        $result = $this->db->get('district');
        return $result->result_array();
    }

    public function get_district($id)
    {
        return $this->db->get_where('district', ['district_id' => $id])->row();
    }

    public function add_district($data)
    {
        return $this->db->insert('district', $data);
    }

    public function update_district($data)
    {
        $this->db->where('district_id', $data['district_id']);
        return $this->db->update('district', $data);
    }

    public function delete_district($id)
    {
        return $this->db->delete('district', ['district_id' => $id]);
    }
    #endregion districts

    #region schools
    public function get_schools()
    {
        $result = $this->db->get('school_id_name');
        return $result->result_array();
    }

    public function get_school($id)
    {
        return $this->db->get_where('school_id_name', ['school_in_id' => $id])->row();
    }

    public function add_school($data)
    {
        return $this->db->insert('school_id_name', $data);
    }

    public function update_school($data)
    {
        $this->db->where('school_in_id', $data['school_in_id']);
        return $this->db->update('school_id_name', $data);
    }

    public function delete_school($id)
    {
        return $this->db->delete('school_id_name', ['school_in_id' => $id]);
    }
    #endregion schools

    #region positions
    public function get_positions()
    {
        $result = $this->db->get('position');
        return $result->result_array();
    }

    public function get_position($id)
    {
        return $this->db->get_where('position', ['position_id' => $id])->row();
    }

    public function add_position($data)
    {
        return $this->db->insert('position', $data);
    }

    public function update_position($data)
    {
        $this->db->where('position_id', $data['position_id']);
        return $this->db->update('position', $data);
    }

    public function delete_position($id)
    {
        return $this->db->delete('position', ['position_id' => $id]);
    }
    #endregion positions

    #region functional divisions
    public function get_divisions()
    {
        $result = $this->db->get('functional_division');
        return $result->result_array();
    }

    public function get_division($id)
    {
        return $this->db->get_where('functional_division', ['func_div_id' => $id])->row();
    }

    public function add_division($data)
    {
        return $this->db->insert('functional_division', $data);
    }

    public function update_division($data)
    {
        $this->db->where('func_div_id', $data['func_div_id']);
        return $this->db->update('functional_division', $data);
    }

    public function delete_division($id)
    {
        return $this->db->delete('functional_division', ['func_div_id' => $id]);
    }
    #endregion functional divisions

    #region usovs
    public function count_usovs($search)
    {
        if (!empty($search)) {
            $this->db->like('usov', $search);
        }

        $this->db->select('*');
        $this->db->from('usov');
        $this->db->order_by('usov_id', 'ASC');
        $rs = $this->db->get();
        return $rs->num_rows();
    }

    public function get_usovs_with_search($limit, $offset, $search = '')
    {
        if (!empty($search)) {
            $this->db->like('usov', $search);
        }

        $this->db->select('*');
        $this->db->from('usov');
        $this->db->order_by('usov_id', 'ASC');
        $this->db->limit($limit, $offset);
        $rs = $this->db->get();
        return $rs->result_array();
    }

    public function get_usovs()
    {
        $result = $this->db->get('usov');
        return $result->result_array();
    }

    public function get_usov($id)
    {
        return $this->db->get_where('usov', ['usov_id' => $id])->row();
    }

    public function add_usov($data)
    {
        return $this->db->insert('usov', $data);
    }

    public function update_usov($data)
    {
        $this->db->where('usov_id', $data['usov_id']);
        return $this->db->update('usov', $data);
    }

    public function delete_usov($id)
    {
        return $this->db->delete('usov', ['usov_id' => $id]);
    }
    #endregion usovs
}
