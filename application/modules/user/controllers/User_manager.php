<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_manager extends CI_Controller {

    private $_user_model;
    private $_currentAdmin;

    private $_title       = "User";
    private $_title_page  = "User";
    private $_breadcrumb  = "<li><a href='/artikel/admin/dashboard'>Home</a></li>";
    private $_active_page = "User";
    private $_view        = 'user/';

	function __construct() {
		parent::__construct();
        //save current user if he is already logged in.
        if ($this->session->has_userdata(ADMIN_SESSION)) {
            $this->_currentAdmin = $this->session->sess_login_admin;

            //refresh session.
            $this->session->set_userdata(ADMIN_SESSION, $this->_currentAdmin);
        } else {
            //force logout.
            redirect("/manager/login");
        }

		$this->load->helper(array('url','form','file'));
		$this->load->model('User_model');

        $this->_user_model = new User_model;
	}
   
    function index()
    {
        $header = array(
            "title"      => $this->_title,   
            "title_page" => $this->_title_page,
            "breadcrumb" => $this->_breadcrumb ."<li>User</li>",
            "active-page"=> $this->_active_page ."-list",
                "css" => array(
                    "asset/js/plugins/lightbox/css/lightbox.css"
            )
        );

        $footer = array(
            "script" => array(
                "asset/js/plugins/datatables/jquery.dataTables.min.js",
                "asset/js/plugins/datatables/dataTables.tableTools.min.js",
                "asset/js/plugins/datatables/dataTables.bootstrap.min.js",
                "asset/js/plugins/datatable-responsive/datatables.responsive.min.js",
                "asset/js/plugins/lightbox/js/lightbox.js",
            ),
            "view_js_nav" => $this->_view ."list_js"
        );
       
        $this->load->view(HEADER_MANAGER, $header);
        $this->load->view($this->_view . 'index');
        $this->load->view(FOOTER_MANAGER, $footer);	
    }

     /**
     * create new article
     */
    public function create()
    {
        $this->_header = array(
            "title"         => $this->_title,
            "title_page"    => $this->_title_page."-create",
            "breadcrumb"    => $this->_breadcrumb. "<li> Buat Artikel </li>",
            "active-page"   => $this->_active_page ."-create",
                "css" => array(
                    "asset/css/select2.min.css",
                ),
        );

        $this->_footer = array(
            "script" => array(
                "asset/js/pages/user/create.js",
                "asset/js/plugins/cropper/cropper.min.js",
                "asset/js/crop-master.js",
                "asset/js/plugins/select2/select2.full.min.js",
            ),

            "css"   => array(
                "asset/js/plugins/cropper/crop.css",
                "asset/js/plugins/cropper/cropper.css"
            ),
        );

        //load views
        $this->load->view(HEADER_MANAGER, $this->_header);
        $this->load->view($this->_view .'create');
        $this->load->view(FOOTER_MANAGER,$this->_footer);
    }

    /**
     * Edit an admin
     */
    public function edit ($admin_id = null) {
        $this->_breadcrumb .= '<li><a href="/manager/admin">Admin</a></li>';

        //load the model.
        $this->load->model('User_model');
        $data['item'] = null;

        //validate ID and check for data.
        if ( $admin_id === null || !is_numeric($admin_id) ) {
            show_404();

        }

        $params = array("row_array" => true,"conditions" => array("user_id" => $admin_id), "status" => -1);
        //get the data.
        $data['item'] = $this->User_model->get_all_data($params)['datas'];

        //if no data found with that ID, throw error.
        if (empty($data['item'])) {
            show_404();
        }

        //prepare header title.
        $header = array(
            "title"         => $this->_title,
            "title_page"    => $this->_title_page . '<span>> Edit Admin</span>',
            "active_page"   => $this->_active_page,
            "breadcrumb"    => $this->_breadcrumb . '<li>Edit Admin</li>',
            // "back"          => $this->_back,
        );

        $footer = array(
            "view_js_nav" => $this->_view . "create_js_nav",
        );

        //load the view.
        $this->load->view(HEADER_MANAGER, $header);
        $this->load->view($this->_view . 'create', $data);
        $this->load->view(FOOTER_MANAGER, $footer);
    }

    /**
     * view an admin
     */
    public function detail ($admin_id = null) {
        $this->_breadcrumb .= '<li><a href="/manager/admin">Admin</a></li>';

        //load the model.
        $this->load->model('User_model');
        $data['item'] = null;

        //validate ID and check for data.
        if ( $admin_id === null || !is_numeric($admin_id) ) {
            show_404();

        }

        $params = array(
            "select" => "us.*, tur.role_name",
            "row_array" => true,
            "conditions" => array("user_id" => $admin_id),
            "joined" => array("tbl_user_role tur" => array("tur.role_id" => "us.role_Id"))
        );
        //get the data.
        $data['item'] = $this->User_model->get_all_data($params)['datas'];

        //if no data found with that ID, throw error.
        if (empty($data['item'])) {
            show_404();
        }

        //prepare header title.
        $header = array(
            "title"         => $this->_title,
            "title_page"    => $this->_title_page . '<span>> View Admin</span>',
            "active_page"   => $this->_active_page,
            "breadcrumb"    => $this->_breadcrumb . '<li>View Admin</li>',
            // "back"          => $this->_back,
        );

        $footer = array();

        //load the view.
        $this->load->view(HEADER_MANAGER, $header);
        $this->load->view($this->_view . 'view', $data);
        $this->load->view(FOOTER_MANAGER, $footer);
    }
    
    /**
     * Change Password
     */
    public function change_password () {
        //prepare header title.
        $this->_header = array(
            "title"         => 'Change Password',
            "title_page"    => '<i class="fa-fw fa fa-user"></i> Change Password',
            "active_page"   => '',
            "breadcrumb"    =>  $this->_breadcrumb . '<li>Change Password</li>',
        );

        $this->_footer = array(
            "script" => array("asset/js/pages/user/change-password.js"),
        );

        //load the view.
        $this->load->view(HEADER_MANAGER, $this->_header);
        $this->load->view($this->_view .'change-pass');
        $this->load->view(FOOTER_MANAGER, $this->_footer);
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

        $select = array("user_id","username as user_name","tur.role_name", "IF(status = 1, 'AKTIF', 'NONAKTIF') as state", "last_login_time as user_last_login");

        $joined = array("tbl_user_role tur" => array("tur.role_id" => "us.role_Id"));
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
        $datas = $this->_user_model->get_all_data(array(
            'select'           => $select,
            'joined'           => $joined,
            'conditions'       => $conditions,
            'order_by'         => array($column_sort => $sort_dir),
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

    /**
     * set validation for admin  create and edit
     */
    private function _set_rule_validation($id) {
        
        //preparing to set delimiters
        $this->form_validation->set_error_delimiters();

        //validates
        $this->form_validation->set_rules('username','Username',"trim|required|callback_check_username[$id]");
        $this->form_validation->set_rules('email','Email',"trim|required|callback_check_email[$id]");

        //when insert only, check password and username
        if(!$id) {
            $this->form_validation->set_rules('password','Password',"trim|required|min_length[6]|max_length[20]");
            $this->form_validation->set_rules('conf_password','Password Confirmation','trim|required|min_length[6]|max_length[20]|matches[password]');
        } else {
            $this->form_validation->set_rules('new_password','New Password','trim|required|min_length[6]|max_length[20]');
            if($this->input->post('new_password') != "") $this->form_validation->set_rules('conf_new_password','Confirmation New Password','trim|required|min_length[6]|max_length[20]');
        }
    }
    
    /**
     * 
     * set rule validation edit profile
     */
    private function _set_rule_validation_profile($id) {
      
        $this->form_validation->set_error_delimiters('','');

        //validates
        $this->form_validation->set_rules("name",'Name','trim|required|min_length[6]|max_length[100]');

        //special validations for when editing
        $this->form_validation->set_rules('username','Username',"trim|required|callback_check_username[$id]");
        $this->form_validation->set_rules('email','Email',"trim|required|callback_check_email[$id]");
    }

    /**
     * set rule validation for change password
     */
    private function _set_rule_validation_pass () {
        $this->form_validation->set_error_delimiters('', '');

        $this->form_validation->set_rules("password", "Old Password", "required|min_length[5]|max_length[12]");
        $this->form_validation->set_rules("new_password", "New Password", "required|min_length[5]|max_length[12]|matches[confirm_password]");
        $this->form_validation->set_rules("confirm_password", "Confirm Password", "required|min_length[5]|max_length[12]");
    }

    /**
     * this is a custom form validation rule to check that username is must unique
     */
    public function check_username($str, $id) {

        //flag
        $isValid = true;
        $params = array("row_array" => true);

        if($id == "") {
            //from create 
            $params['conditions'] = array("lower(username)" => strtolower($str));
        } else {
            $params['conditions'] = array("lower(username)" => strtolower($str), "user_id !=" => $id);
        }

        $datas = $this->User_model->get_all_data($params)['datas'];

        if($datas) {
            $isValid = false;
            $this->form_validation->set_message('check_username','{field} is already taken.');
        }

        return $isValid;
    } 

    /**
     * This is a custom form validation rule to check that email is must unique.
     */
    public function check_email($str, $id) {

        //flag.
        $isValid = true;
        $params = array("row_array" => true);

        if ($id == "") {
            //from create
            $params['conditions'] = array("lower(email)" => strtolower($str));
        } else {
            $params['conditions'] = array("lower(email)" => strtolower($str), "user_id !=" => $id);
        }

        $datas = $this->User_model->get_all_data($params)['datas'];
        if ($datas) {
            $isValid = false;
            $this->form_validation->set_message('check_email', '{field} is already taken.');
        }

        return $isValid;
    }

    // /**
    //  * check old password sane as inputed old password
    //  */
    // public function password_check($old_pass) {

    //     $pass = $this->session->userdata('password');

    //     //check password
    //     if(password_verify($old_pass, $pass)) {
    //         return TRUE;
    //     } else {
    //         $this->form_validation->set_message('password_check','{filed} does not match');
    //     }
    // }

    /**
     * ajax form 
     */
    public function process_form()
    {
        // Must AJAX and POST
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        //load form validation
        $this->load->library('form_validation');
        
        $message['is_error'] = true;
        $message['redirect_to'] = '';

        $id             = $this->input->post('id');
        $name           = $this->input->post('name');
        $username       = $this->input->post('username');
        $email          = $this->input->post('email');
        $password       = sha1($this->input->post('password'));
        $new_password   = sha1($this->input->post('new_password'));
        $role_id        = $this->input->post('role_id');
        $date           = date('Y-m-d H:i:s');
        $create_by      = $this->session->userdata('user_id');
        // pr($this->input->post());exit;
        
        //set validation
        $this->_set_rule_validation($id);

        if($this->form_validation->run($this) == FALSE)
        {
            $message['error_msg'] = validation_errors();
        } 
        else {
             //begin transaction
            $this->db->trans_begin();
            
            //prepare save to DB
            $save = array(
               'name'           => $name,
               'username'       => $username,
               'password'       => $password, 
               'email'          => $email,
               'created_date'   => $date,
               'user_create_by' => $create_by,
               'role_id'        => $role_id,
            );

            //insert or update
            if($id == "") {
                
                if(!empty($_FILES['name']['photo'])) {
                    $save['photo'] = $this->do_upload();
                }

                //insert to DB
                $result = $this->_user_model->insert($save);

                //end transaction
                if($this->db->trans_status() == false ) {
                    //balikin jangan di insert
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                    //success
                    $message['is_error']    = false;
                    $message['notif_title'] = 'Good!';
                    $message['notif_message'] = 'User has been added';
                    $message['redirect_to'] = site_url('admin/user');
                }

            } else {
                //update
                $condition = array('user_id' => $id);
                $upload_result = $this->upload(false);
                
                if($upload_result != null) 
                    $save['artikel_photo'] = $save['artikel_photo'] = "/".$upload_result['result'][1]['uploaded_path'];

                $result = $this->_article_model->update($save, $condition);

                //end transaction.
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $message['error_msg'] = 'Insert failed! Please try again.';
                } else {
                    $this->db->trans_commit();
                    //growler.
                    $message['is_error']    = false;
                    $message['notif_title'] = "Excellent!";
                    $message['notif_message'] = "User has been updated.";

                    //on update, redirect.
                    $message['redirect_to'] = site_url('admin/user');
                }
            }
        }
        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /**
     * process form user level
     */
    public function process_form_level() {
        if(!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }
        $this->load->model('User_level_model');
        $this->load->library('form_validation');

        //initial
        // $message['is_error'] = true;

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $desc = $this->input->post('desc');
        // pr($this->input->post());exit;

        $this->form_validation->set_rules('name', 'Level Name','trim|required');
        if($this->form_validation->run() == false) {

            $message['error_msg'] = validation_errors();
        } else {

            $check_name = $this->User_level_model->name_exist($name);

            $save = array(
                'role_name' => $name,
                'description' => $desc
            );

            if(!$check_name) {
                $result = $this->User_level_model->insert($save);

                $message['is_error'] = false;
                $message['notif_title'] = 'success';
            } else {

                $condition = array('role_id' => $id);
                $result = $this->User_level_model->update($save, $condition);

                $message['is_error'] = false;
                $message['notif_title'] = 'success';
            }
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /**
     * change profile
     */
    public function change_profile()
    {
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $this->load->library('form_validation');

        //load the model
        $this->load->model('User_model');

        //initial.
        $message['is_error'] = true;
        $message['redirect_to'] = "";
        $message['error_msg'] = "";

        $id = $this->session->userdata('user_id');
        $name = $this->input->post('name');
        $username = $this->input->post('username');
        $email    = $this->input->post('email');

        $this->_set_rule_validation_profile($id);
        if($this->form_validation->run($this) == false) {

            //validation failed
            $message['error_msg'] = validation_errors();
        } else {
            //begin transactions
            $this->db->trans_begin();

            //validation success prepare save
            $save = array(
                'name' => $name,
                'username' => $username,
                'email'    => $email,
            );

            if(!empty($id)) {
                $condition = array('user_id' => $id);
                $insert = $this->User_model->update($save, $condition);
            }

            if($this->db->trans_status() == false) {
                $this->db->trans_rollback();
                $message['error_msg'] = 'Database operation failed';
            } else {
                $this->db->trans_commit();

                $message['notif_title'] = 'Good!';
                $message['notif_message'] = 'Change profile has been success';

                $message['redirect_to']   = site_url('admin/user');

                //reset session 
                $params = array("row_array" => true, "conditions" => array("user_id" => $id));
                $data_user = $this->User_model->get_all_data($params);
                $this->session->set_userdata($data_user['user_id']);
            }
        }
        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /**
     * Change Password Process form
     */
    public function change_password_process(){
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        //load form validation lib.
        $this->load->library('form_validation');

        //initial.
        $message['is_error'] = true;
        $message['redirect_to'] = "";
        $message['error_msg'] = "";

        $id = $this->session->userdata('user_id');
        $password= sha1($this->input->post('confirm_password'));
        // pr($id);exit;
        $pass = $this->session->userdata("password");
        // pr($pass);exit;
        // 
        $this->_set_rule_validation_pass();

        if ($this->form_validation->run($this) == FALSE) {
            //validation failed.
            $message['error_msg'] = validation_errors();
        } else {
            //begin transaction.
            $this->db->trans_begin();

            //validation success, prepare array to DB.
            $arrayToDB = array('password'   => $password);

            if (!empty($id)) {

                $condition = array("user_id" => $id);
                $insert = $this->_user_model->update($arrayToDB,$condition);
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $message['error_msg'] = 'database operation failed.';

            } else {
                $this->db->trans_commit();

                //set is error to false
                $message['is_error'] = false;

                //success.
                //growler.
                $message['notif_title'] = "Good!";
                $message['notif_message'] = "Password has been updated.";

                //on insert, not redirected.
                $message['redirect_to'] = site_url('admin/user');


                //re-set the session
                $params = array("row_array" => true,"conditions" => array("user_id" => $id));
                $data_user = $this->User_model->get_all_data($params)['datas'];
                $this->session->set_userdata("password", $data_user['password']);
                $this->session->set_userdata("username", $data_user['username']);
                $this->session->set_userdata("name", $data_user['name']);
                $this->session->set_userdata("photo", $data_user['photo']);
            }
        }

        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;

    }

    /**
     * delete user
     */
    public function delete() {
         //must ajax and must post.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $this->load->model('User_model');
        //initial.
        $message['is_error'] = true;
        $message['redirect_to'] = "";
        $message['error_msg'] = "";

        $id = $this->input->post('id');

        if(!empty($id) && is_numeric($id)) {

            //check if admin id is the current login ?
            if($this->session->userdata('user_id') == $id) {

                $message['error_msg'] = 'cannot delete the user account you are currently logged in with.';
                //encoding
                $this->output->set_content_type('application/json');
                echo json_encode($message);
                exit;
            }

            $total = $this->User_model->get_all_data(array(
                "count_all_first" => true,
            ))['total'];

            //check if this is only the last in admin 
            if($total == 1) {
                $message['error_msg'] = 'Cannot delete the last user account. At least one admin account is needed to acces the management site.';
                //encoding and returning.
                $this->output->set_content_type('application/json');
                echo json_encode($message);
                exit;

            }

            //get data admin
            $data = $this->User_model->get_all_data(array(
                'find_by_pk' => array($id),
                'row_array'  => true,
            ))['datas'];

            if(empty($data)) {
                $message['error_msg'] = 'Invalid ID.';
            } else {
                //begin transaction
                $this->db->trans_begin();

                //delete the data 
                $condition = array('user_id' => $id);
                $delete = $this->User_model->delete($condition);

                //end transaction.
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();

                    //failed.
                    $message['error_msg'] = 'database operation failed';
                } else {
                    $this->db->trans_commit();
                    //success.
                    $message['is_error'] = false;
                    $message['error_msg'] = '';

                    //growler.
                    $message['notif_title'] = "Done!";
                    $message['notif_message'] = "User has been delete.";
                    $message['redirect_to'] = "";
                }
            }
        } else {
            $message['error_msg'] = 'Invalid ID.';
        }
        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    public function list_select_role()
    {
        //must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "GET") {
            exit('No direct script access allowed');
        }

        $this->load->model('User_level_model');

        $select_q = $this->input->get('q');
        $select_page = ($this->input->get('page')) ? $this->input->get('page') : 1;

        $limit = 10;
        $start = ($limit * ($select_page - 1));

        $filters = array();

        if($select_q != "") {
            $filters['role_name'] = $select_q;
        }

        $conditions = array();

        $params = $this->User_level_model->select_ajax($limit, $start, $conditions);

        // pr($params);exit;

        $message['page']        = $select_page;
        $message['get']         = $params;
        $message['paging_size'] = $limit;

        $this->output->set_content_type('application/json');
        echo json_encode($message);
    }

    public function do_upload()
    {
        $this->load->library('upload');
        $config['upload_path'] = FCPATH . 'upload/user';
       
        if(!is_dir($config['upload_path'])){
          mkdir($config['upload_path'], 0777, TRUE);
        }

        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']  = '1024';
        
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('photo')) {
        	echo $config['upload_path'];
            $this->session->set_flashdata('success', $this->upload->display_errors(''));
            redirect(uri_string());

            $data = $this->upload->data();
            return $data['file_name'];
        }
    }
}