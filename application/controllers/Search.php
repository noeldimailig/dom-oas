<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Search extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pagination_model');
        $this->load->library("pagination");
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
        $this->load->model('my_model');
        //$this->data['users'] = $this->my_model->getusers();

        $this->load->library('pagination');

        $perPage = 10;
        $config['base_url'] = base_url();
        $page = 0;

        if ($this->input->get('page')) {
            $page = $this->input->get('page');
        }

        $start_index = 0;
        if ($page != 0) {
            $start_index = $perPage * ($page - 1);
        }

        $total_rows = 0;

        if ($this->input->get('search_text') != null) {
            $search_text = $this->input->get('search_text');
            $this->data['users'] = $this->my_model->getSearchUsers($perPage, $start_index, $search_text, $is_count = 0);
            $total_rows = $this->my_model->getSearchUsers(null, null, $search_text, $is_count = 1);
        } else {
            $this->data['users'] = $this->my_model->getSearchUsers($perPage, $start_index, null, $is_count = 0);
            $total_rows = $this->my_model->getSearchUsers(null, null, null, $is_count = 1);
        }

        $config['total_rows'] = $total_rows;

        $config['per_page'] = $perPage;
        $config['enable_query_strings'] = true;
        $config['use_page_numbers'] = true;
        $config['page_query_string'] = true;
        $config['query_string_segment'] = 'page';
        $config['reuse_query_string'] = true;
        $config['full_tag_open'] = '<ul  class="pagination">';
        $config['full_tag_close'] = '</ul' >
            $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] =  '<li  class="page-item"><spann class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';

        $config['prev_tag_close'] = '</span></li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';

        $this->pagination->initialize($config);
        $this->data['page'] = $page;
        $this->data['links'] = $this->pagination->create_links();
        $this->load->view('welcome_message', $this->data);
    }

    public function search_usov($type = NULL)
    {

        $data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $search = "";
        if ($this->input->post('search') != "") {
            $search = trim($this->input->post('search'));
        } else {
            $this->load->model('WorkInfo_model', 'work_model');
            $data['usovs'] = $this->work_model->get_usovs();
        }
        // dd($search);

        $data['title'] = 'Search Results' . ' for ' . $search . '';
        $data['search'] = $search;
        $allrecords = $this->Pagination_model->allrecord('usov');
        $baseurl =  base_url() . $this->router->class . '/' . $this->router->method . "/" . $search;
        // dd($baseurl);
        $paging = array();
        $paging['base_url'] = $baseurl;
        $paging['total_rows'] = $allrecords;
        $paging['per_page'] = 10;
        $paging['uri_segment'] = 2;
        $paging['num_links'] = 5;

        $paging['full_tag_open'] = '<ul class="pagination">';
        $paging['full_tag_close'] = '</ul>';
        $paging['first_link'] = '<li class="page-item"><a class="page-link" href="#">First</a></li>';
        $paging['last_link'] = '<li class="page-item"><a class="page-link" href="#">Last</a></li>';
        $paging['first_tag_open'] = '<li class="page-item">';
        $paging['first_tag_close'] = '</li>';
        $paging['prev_link'] = '<li class="page-item"><a class="page-link" href="#">&laquo;</a></li>';
        $paging['prev_tag_close'] = '</li>';
        $paging['next_link'] = '<li class="page-item"><a class="page-link" href="#">&raquo;</a></li>';
        $paging['next_tag_close'] = '</li>';
        $paging['last_tag_open'] = '<li class="page-item">';
        $paging['last_tag_close'] = '</li>';
        $paging['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $paging['cur_tag_close'] = '</a></li>';
        $paging['num_tag_open'] = '<li class="page-item">';
        $paging['num_tag_close'] = '</li>';

        $this->pagination->initialize($paging);

        $data['limit'] = (int)$paging['per_page'];
        $data['number_page'] = (int)$paging['per_page'];
        $data['offset'] = ((int)$this->uri->segment(2)) ? (int)$this->uri->segment(2) : 0;
        $data['links'] = $this->pagination->create_links();

        $data['usovs'] = $this->Pagination_model->get_usov_data_list($data['limit'], $data['offset'], $search);

        $this->templates('usov/index', $data);
    }
}
