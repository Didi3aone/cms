<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag_manager extends CI_Controller
{
    private $_dm;
    private $_currentAdmin;
    private $_table         = "tbl_tag";
    private $_table_aliases = "tt";
    private $_pk_field      = "tag_id";

	public function __construct()
	{
		parent::__construct();
        $this->load->model('Dynamic_model');
        $this->_dm = new Dynamic_model;
	}

	function index()
	{	
        $header  = array(
            "title"      => "Tag",
            "breadcrumb" => "<li> List Tag </li>",
        );

        $footer = array(
            "script" => array(
                "asset/js/plugins/datatables/jquery.dataTables.min.js",
                "asset/js/plugins/datatables/dataTables.tableTools.min.js",
                "asset/js/plugins/datatables/dataTables.bootstrap.min.js",
                "asset/js/plugins/datatable-responsive/datatables.responsive.min.js"
            ),
            "view_js_nav" => "tag/list_js_nav"
        );
       
        $this->load->view(HEADER_MANAGER, $header);
        $this->load->view('tag/index');
        $this->load->view(FOOTER_MANAGER, $footer);
	}

    /**
    * ajax get data
    */
    public function list_all_data()
    {
       //must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "GET") {
            exit('No direct script access allowed');
        }

        $sort_col   = sanitize_str_input($this->input->get("order")['0']['column'], "numeric");
        $sort_dir   = sanitize_str_input($this->input->get("order")['0']['dir']);
        $limit      = sanitize_str_input($this->input->get("length"), "numeric");
        $start      = sanitize_str_input($this->input->get("start"), "numeric");
        $search     = sanitize_str_input($this->input->get("search")['value']);
        $filter     = $this->input->get("filter");

        $select = array("tt.tag_id","tt.name","IF(tt.status,'Aktif', 'Nonaktif') as status");

        $conditions = array();

        $column_sort = $select[$sort_col];

        //initialize.
        $data_filters   = array();
        $conditions     = array();
        $status         = STATUS_ACTIVE;

        if (count ($filter) > 0) {
            foreach ($filter as $key => $value) {
                $value = ($value);
                switch ($key) {
                    case 'id':
                        if ($value != "") {
                            $data_filters['lower(group_id)'] = $value;
                        }
                        break;
                    case 'last_login':
                        if ($value != "") {
                            $date = parse_date_range($value);
                            $conditions["cast(last_login_time as date) <="] = $date['end'];
                            $conditions["cast(last_login_time as date) >="] = $date['start'];

                        }
                        break;
                    default:
                        break;
                }
            }
        }

        //get data
        $datas = $this->_dm->set_model(
            $this->_table, 
            $this->_table_aliases, 
            $this->_pk_field
        )->get_all_data(array(
                'select'           => $select,
                'conditions'       => $conditions,
                'order_by'         => array(),
                'limit'            => $limit,
                'start'            => $start,
                'filter'           => $data_filters,
                "count_all_first"  => true,
                "status"           => -1,
                "debug"            => false
        ));

        //get total rows
        $total_rows = $datas['total'];

        $output = array(
            "data"              => $datas['datas'],
            "draw"              => intval($this->input->get("draw")),
            "recordsTotal"      => $total_rows,
            "recordsFiltered"   => $total_rows,
        );

        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($output);
        exit;
    }

    // public function edit_process()
    // {
    //     $name = $this->input->post('');
    // }
    
    /**
     * function delete tag 
     */
    public function delete()
    {
        //MUst AJAX AND GET mungkin lu hacker ya cuk
        if(!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $message['is_error'] = true;

        $id = $this->input->post('id');

        if(!empty($id)) {
            $conditions = array("tag_id" => $id);
            $delete = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk_field)->delete(array("tag_id" => $id));

            $message['is_error'] = false;
            $message['notif_title'] = "tag has been deleted";
            $message['redirect_to'] = "";
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }
}

/* End of file tag.php */
/* Location: ./application/controllers/admin/tag.php */
