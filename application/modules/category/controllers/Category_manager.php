<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_manager extends CI_Controller
{

    private $_dm;
    private $_currentAdmin;
    private $_table = "tbl_kategori";
    private $_table_alias = "tk";
    private $_pk_field    = "kategori_id";
    private $_view        = 'category/';

	public function __construct()
	{
       parent::__construct();
        
        if ($this->session->has_userdata(ADMIN_SESSION)) {
            $this->_currentAdmin = $this->session->sess_login_admin;

            //refresh session.
            $this->session->set_userdata(ADMIN_SESSION, $this->_currentAdmin);
        } else {
            //force logout.
            redirect("/manager/login");
        }
        
        $this->_footer = array(
            "script"    => array(),
            "css"       => array(),
        );
        
        //load model
        $this->load->model('Dynamic_model');

        $this->_dm = new Dynamic_model();
	}
    /*
    * list data
    */
    public function index()
    {
        $header = array(
            "title"       => "Category",
            "breadcrumb"  => "<li><a href='/artikel/admin/dashboard'>Home</a></li><li> List Kategori </li>",
            "active_page" => "category",
        );

        $footer = array(
            "script" => array(
                "asset/js/plugins/datatables/jquery.dataTables.min.js",
                "asset/js/plugins/datatables/dataTables.tableTools.min.js",
                "asset/js/plugins/datatables/dataTables.bootstrap.min.js",
                "asset/js/plugins/datatable-responsive/datatables.responsive.min.js",
            ),
            "view_js_nav"   => $this->_view."list_js_nav"
        );
       
        $this->load->view(HEADER_MANAGER, $header);
        $this->load->view($this->_view.'index');
        $this->load->view(FOOTER_MANAGER, $footer);
    } 

    public function create()
    {
        $header = array(
            "title"       => "Data Artikel",
            "title_page"  => "Create Category",
            "breadcrumb"  => "<li><a href='/artikel/admin/dashboard'>Home</a></li><li> List Kategori </li>",
            "active_page" => "category",
            "css" => array(
                    "asset/css/select2.min.css",
            ),
        );

        $footer = array(
            "script" => array(
                "asset/js/pages/kategori/create.js",
                "asset/js/plugins/select2/select2.full.min.js",
            ),
        );

        $data['category'] = $this->_dm->set_model("tbl_kategori", "tk", "kategori_id")->get_all_data(array("conditions" => array("parent_id" => "0")
        ))['datas'];
        // pr($data['category']);exit;
       
        $this->load->view(HEADER_MANAGER, $header);
        $this->load->view('category/create', $data);
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

        $sort_col = sanitize_str_input($this->input->get("order")['0']['column'], "numeric");
        $sort_dir = sanitize_str_input($this->input->get("order")['0']['dir']);
        $limit = sanitize_str_input($this->input->get("length"), "numeric");
        $start = sanitize_str_input($this->input->get("start"), "numeric");
        $search = sanitize_str_input($this->input->get("search")['value']);
        $filter = $this->input->get("filter");

        $select = array(
            $this->_table_alias.".kategori_id", 
            $this->_table_alias.".name", 
            $this->_table_alias.".created_date"
        );
        $conditions = array(
            $this->_table_alias.'.status' => STATUS_ACTIVE
        );

        $column_sort = $select[$sort_col];

        //initialize.
        $data_filters = array();
        $conditions = array();
        $status = STATUS_ACTIVE;

        if (count ($filter) > 0) {
            foreach ($filter as $key => $value) {
                $value = ($value);
                switch ($key) {
                    case 'id':
                        if ($value != "") {
                            $data_filters['lower(group_id)'] = $value;
                        }
                        break;
                    case 'admin_type':
                        if ($value != "") {
                            $data_filters['lower(admin_type)'] = $value;
                        }
                        break;

                    case 'last_login':
                        if ($value != "") {
                            $date = parse_date_range($value);
                            $conditions["cast(last_login_time as date) <="] = $date['end'];
                            $conditions["cast(last_login_time as date) >="] = $date['start'];

                        }
                        break;
                    // case 'create_date':
                    //     if ($value != "") {
                    //         $date = parse_date_range($value);
                    //         $conditions["cast(created_date as date) <="] = $date['end'];
                    //         $conditions["cast(created_date as date) >="] = $date['start'];

                    //     }
                    //     break;

                    default:
                        break;
                }
            }
        }

        //get data
        $datas = $this->_dm->set_model($this->_table, $this->_table_alias, $this->_pk_field)->get_all_data(array(
            'select'            => $select,
            'order_by'          => array($column_sort => $sort_dir),
            'limit'             => $limit,
            'start'             => $start,
            'conditions'        => $conditions,
            'filter'            => $data_filters,
            "count_all_first"   => true,
            "debug"             => false
        ));

        //get total rows
        $total_rows = $datas['total'];

        $output = array(
            "data" => $datas['datas'],
            "draw" => intval($this->input->get("draw")),
            "recordsTotal" => $total_rows,
            "recordsFiltered" => $total_rows,
        );

        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($output);
        exit;
    }

    /**
     * ajax form
     */
    public function procces_form()
    {
        //must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $this->load->model('Category_model');
        //initial error
        $message['is_error'] = true;

        $id = $this->input->post('id');
        $name = $this->input->post('nama_kategori');
        $desc = $this->input->post('desc');
        $parent = $this->input->post('parent');

        //check parent ID
        $parent = strtolower($parent);

        if($parent == "root") {
            $parent_id = "0";
        } else {
            $parent_id = $this->Category_model->get_category_id($parent_id);
        }
        
        $this->load->library('form_validation');

        if($id) {
            //check name is exist
            $params['conditions'] = array("kategori_id" => $id, "nama_kategori" => $name);
            $result = $this->_dm->set_model("tbl_kategori", "tk", "kategori_id")->get_all_data($params);

            if(!$result) {
                $this->form_validation->set_rules("name", "Category Name", "is_unique[tbl_kategori.nama_kategori]", array("is_unique" => "This category is already exists!"));
            }
        }  
        else {
            //create
            $this->form_validation->set_rules("name", "Category Name" , "is_unique[tbl_kategori.nama_kategori]", array("is_unique" => "This category already exists !"));
        }    

        if($this->form_validation->run() == false) {
            //validations failed
            $message['error_msg'] = validation_errors();
        } else {
            //validation usccess
            $this->db->trans_begin();

            //prepare insert data
            $arrayToDB = array(
                "nama_kategori" => $name,
                "parent_id"     => $parent_id
            );
            
            //insert or update
            if($id == "") {
                $result = $this->_dm->set_model("tbl_kategori", "tk", "kategori_id")->insert($arrayToDB);

                if ($this->db->trans_status() === FALSE || !$result) {
                    // Update failed, rollback
                    $this->db->trans_rollback();

                    $message['error_msg'] = 'Failed! Please try again.';
                }
                else {
                    // Update success
                    $this->db->trans_commit();
                    $message['is_error']        = false;
                    $message['notif_title']     = "Success!";
                    $message['notif_message']   = "New category has been added.";
                    $message['redirect_to']     = "/artikel/manager/category";
                }
            } 
            else {
                //conditions for update
                $conditions = array("kategori_id" => $id);

                $result = $this->_dm->set_model("tbl_kategori", "tk", "kategori_id")->update($arrayToDB, $conditions);

                if ($this->db->trans_status() === FALSE || !$result) {
                    // Update failed, rollback
                    $this->db->trans_rollback();

                    $message['error_msg'] = 'Failed! Please try again.';
                }
                else {
                    // Update success
                    $this->db->trans_commit();
                    $message['is_error']        = false;
                    $message['notif_title']     = "Success!";
                    $message['notif_message']   = "Category has been updated.";
                    $message['redirect_to']     = "/artikel/manager/category";
                }
            }
        }
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    public function delete()
    {
        //must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $id = $this->input->post('id');
        // $is_active = $this->input->post('active');

        if(!empty($id)) {
            
            $data = array(
                "find_by_pk" => array($id),
                "count_all_first" => true,
                "status"          => STATUS_ACTIVE,
                "row_array"       => true,
            );
            $datas = $this->_dm->set_model("tbl_kategori","tk","kategori_id")->get_all_data($data); 
        
        if(empty($datas)) {
                show_404();
            } else {
                $this->db->trans_begin();

                $conditions = array('kategori_id' => $id);

                $result  = $this->_dm->set_model("tbl_kategori","tk","kategori_id")->delete($conditions);

                //end transaction.
                if ($this->db->trans_status() === false) {
                    //failed.
                    $this->db->trans_rollback();
                    //failed.
                    $message['error_msg'] = 'database operation failed';
                } else {
                    //success.
                    $this->db->trans_commit();

                    $message['is_error'] = false;
                    $message['error_msg'] = '';
                    //smallbox.
                    $message['notif_title']     = "Done!";
                    $message['notif_message']   = "Category has been deleted.";
                    $message['redirect_to']     = "";
                }
            }
        } else {
            //id is not passed.
            $message['error_msg'] = 'Invalid ID.';
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
    }

    
    public function list_select()
    {
    	//must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "GET") {
            exit('No direct script access allowed');
        }

        $select_q    = $this->input->get('q');
        $select_page = ($this->input->get('page')) ? $this->input->get('page') : 1;
        $limit = 10;
        $start = ($limit * ($select_page - 1));

        $filters = array();
        if($select_q != "") {
            $filters['nama_kategori'] = $select_q;

        }

        $conditions = array();
        $from = "tbl_kategori";
        //get data.
        $params = $this->_category_model->get_all_data(array(
            "select" => array("kategori_id", "nama_kategori"),
            "from"   => $from,
            "conditions" => $conditions,
            "filter_or" => $filters,
            "count_all_first" => true,
            "limit" => $limit,
            "start" => $start,
            "status" => STATUS_ACTIVE
        ));
        // pr($params);exit;

        //prepare returns.
        $message["page"] = $select_page;
        $message["total_data"] = $params['total'];
        $message["paging_size"] = $limit;
        $message["datas"] = $params['datas'];

        echo json_encode($message);
        exit;
    }
}

/* End of file category.php */
/* Location: ./application/controllers/admin/category.php */
