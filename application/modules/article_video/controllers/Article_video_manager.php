<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class article_video_manager extends CI_Controller {

    private $_avm;
    private $_currentAdmin;

    private $_title = "Artikel-video";
    private $_title_page = 'Artikel Video ';
    private $_breadcrumb = "<li><a href='/artikel-video/admin/dashboard'>Home</a></li>";
    private $_active_page = "artikel-video";
    private $_view        = "article_video/";

    private $error;
    private $success;

    protected $_currentUser;

    function __construct() {
        parent::__construct();

        if ($this->session->has_userdata(ADMIN_SESSION)) {
            $this->_currentAdmin = $this->session->sess_login_admin;

            //refresh session.
            $this->session->set_userdata(ADMIN_SESSION, $this->_currentAdmin);
        } else {
            //force logout.
            redirect("/manager/login");
        }

        //load model
        $this->load->model("Article_video_model");
        //new class for model
        $this->_avm = new Article_video_model();
    }

    /*
    * list data
    */
    public function index()
    {
        $header = array(
            "title"      => $this->_title,
            "title_page" => $this->_title_page,
            "breadcrumb" => $this->_breadcrumb ."<li>Artikel Video</li>",
            "active_page"=> $this->_active_page,
        );

        // pr($this->_header);exit;

        $footer = array(
            "script" => array(
                "asset/js/plugins/datatables/jquery.dataTables.min.js",
                "asset/js/plugins/datatables/dataTables.tableTools.min.js",
                "asset/js/plugins/datatables/dataTables.bootstrap.min.js",
                "asset/js/plugins/datatable-responsive/datatables.responsive.min.js"
            ),
            "view_js_nav"   => $this->_view."list_js_nav"
        );

       $this->load->view(HEADER_MANAGER, $header);
       $this->load->view('article_video/index');
       $this->load->view(FOOTER_MANAGER, $footer);
    }

    /**
     * create new article
     */
    public function create()
    {

        $header = array(
            "title"         => $this->_title ."-create",
            "title_page"    => $this->_title_page."-create",
            "breadcrumb"    => $this->_breadcrumb. "<li> Buat Artikel </li>",
            "active_page"   => $this->_active_page ."-create",
        );
        // pr($header);exit;

        $footer = array(
            "view_js_nav"   => $this->_view."create_js_nav",
            "script" => array(
                "asset/js/plugins/tinymce/tinymce.min.js",
            ),
        );

        //load views
        $this->load->view(HEADER_MANAGER, $header);
        $this->load->view($this->_view.'create');
        $this->load->view(FOOTER_MANAGER, $footer);
    }

    /**
     * create new article
     */
    public function edit($id = null)
    {
        if(empty($id) && !is_numeric($id) && $id == '') {
            show_404();
        }

        $data['artikel'] = $this->_avm->get_all_data(array(
            "conditions"              => array("artikel_video_id" => $id),
            "row_array"               => true,
        ))['datas'];

        $header = array(
            "title"         => $this->_title ."Edit",
            "title_page"    => $this->_title_page. "- Edit",
            "breadcrumb"    => $this->_breadcrumb ."<li> Edit Artikel</li>",
            "active-page"   => $this->_active_page ."edit",
        );

        $footer = array(
            "script" => array(
                "asset/js/plugins/tinymce/tinymce.min.js",
                // "asset/js/plugins/markdown/markdown.min.js",
                // "asset/js/plugins/markdown/to-markdown.min.js",
                // "asset/js/plugins/markdown/bootstrap-markdown.min.js",
            ),
            "view_js_nav"   => $this->_view."create_js_nav"
        );

        //load views
        $this->load->view(HEADER_MANAGER, $header);
        $this->load->view($this->_view.'create',$data);
        $this->load->view(FOOTER_MANAGER, $footer);
    }

    /**
     * create new article
     */
    public function detail($id = null)
    {
        if(empty($id) && !is_numeric($id) && $id == '') {
            show_404();
        }

        $data['artikel'] = $this->_avm->get_all_data(array(
            "conditions"              => array("artikel_video_id" => $id),
            "row_array"               => true,
        ))['datas'];

        $header = array(
            "title"         => $this->_title ."Edit",
            "title_page"    => $this->_title_page. "- Edit",
            "breadcrumb"    => $this->_breadcrumb ."<li> Edit Artikel</li>",
            "active-page"   => $this->_active_page ."edit",
        );

        $footer = array(
            "script" => array(
                "asset/js/plugins/tinymce/tinymce.min.js"
            ),
        );

        //load views
        $this->load->view(HEADER_MANAGER, $header);
        $this->load->view($this->_view.'view',$data);
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

        $select = array("artikel_video_id", "title", "url_video","copyright");

        $conditions = array(
            "av.status IN(1,2) " => NULL 
        );

        $column_sort = $select[$sort_col];

        //initialize.
        $data_filters = array();
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
                    default:
                        break;
                }
            }
        }

        //get data
        $datas = $this->_avm->get_all_data(
            array(
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
    public function process_form()
    {
        // Must AJAX and POST
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }
        //load library form validation
        $this->load->library("form_validation");

        //initital
        $message['is_error'] = true;
        $message['redirect_to'] = '';
        // pr($this->input->post());exit;
        $id          = $this->input->post('id');
        $judul       = $this->input->post('judul');
        $url         = $this->input->post('url');
        $content     = $this->input->post("content");
        $sumber      = $this->input->post('sumber');
        $prettty_url = $this->input->post('pretty_url');
        $now         = NOW;
        $writter     = $this->_currentAdmin['user_id'];
        $video       = $this->input->post('video_name');

        //conversion to embed video youtube
        $url_video   = str_replace("/watch?v=","/embed/",$url);
        // $image_url   = preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url_video, $match);
        // $image_url = $match[1];
        // $image_url = "http://img.youtube.com/vi/".$image_url."/0.jpg";

        //set validation
        $this->form_validation->set_rules("judul", "Judul", "trim|required");
        $this->form_validation->set_rules("url", "URL", "trim|required");
        // $this->form_validation->set_rules("content", "Content", "trim|required");
        $this->form_validation->set_rules("pretty_url", "URL SEO", "trim|required");
 
        if($this->form_validation->run() == FALSE)
        {
            $message['error_msg'] = validation_errors();
        }
        else {
            //begin transaction
            $this->db->trans_begin();
            //validation success
            //prepare save to DB
            $arrayToDb = array(
                "title"       => $judul,
                "pretty_url"  => $prettty_url,
                "url_video"   => $url_video,
                "content"      => $content,
                "copyright"   => $sumber,
                "created_date" => $now,
                "created_by"  => $writter
            );

            //insert or update
            if($id) {

                //update
                $condition = array('artikel_video_id' => $id);     
                //then  insert updated date
                $arrayToDb['updated_date'] = NOW;
                $arrayToDb['status']       = STATUS_EDITED;

                $result = $this->_avm->update($arrayToDb, $condition);

                //end transaction.
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    $message['error_msg'] = 'Insert failed! Please try again.';
                } else {
                    $this->db->trans_commit();
                    //growler.
                    $message['is_error']        = false;
                    $message['notif_title']     = "Excellent!";
                    $message['notif_message']   = "Article video has been updated.";

                    //on update, redirect.
                    $message['redirect_to']     = site_url('manager/article_video');
                }
            } else {
                //insert new tag to DB
                //insert to DB
                $image_youtube = str_replace("https://www.youtube.com/embed/", "", $url_video);

                //i will use the image_thumb_file for image thumbnail from youtube
                $image_url = "http://img.youtube.com/vi/".$image_youtube."/0.jpg";
                $arrayToDb['url_image'] = $image_url;
                // pr($this->input->post());exit;

                $result = $this->_avm->insert($arrayToDb);

                //end transaction
                if($this->db->trans_status() == false ) {
                    //balikin jangan di insert
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                    //success
                    $message['is_error']        = false;
                    $message['notif_title']     = 'Good!';
                    $message['notif_message']   = 'Article video has been added';
                    $message['redirect_to']     = site_url('manager/article_video');
                }
            }
        }
        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }


    /**
     * delete
     */
    public function delete()
    {
        // Must AJAX and POST
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $id          = $this->input->post('id');
        $delete_by   = $this->_currentAdmin["user_id"];
  
        if(empty($id) && !is_numeric($id)) {
            show_404();
        }
        else {

            $this->db->trans_begin();

            $arrayToDb = array(
                "status"     => STATUS_DELETED,
                "deleted_by" => $delete_by
            );

            $condition = array("artikel_video_id" => $id);

            $result = $this->_avm->update($arrayToDb, $condition);

             //end transaction.
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $message['error_msg'] = 'Insert failed! Please try again.';
            } else {
                $this->db->trans_commit();
                //growler.
                $message['notif_title'] = "Excellent!";
                $message['notif_message'] = "Article video has been deleted.";

                //on update, redirect.
                $message['redirect_to'] = site_url('admin/article_video');
            }
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /**
     * [publish_artikel description]
     * @return [array json]
     */
    public function publish_artikel()
    {
        // Must AJAX and POST
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        $id  = $this->input->post('id');
        $by  = $this->session->userdata("user_id");
        //cheked id
        if(empty($id)) {
        	show_404();
        }
        else {

        	$this->db->trans_begin();

        	$data = $this->_avm->get_all_data(array(
        		"count_all_first" => true,
        	))['datas'];

        	$arrayToDb = array(
        		"status"          => 1,
                "publish_date"    => NOW,
                "publish_by"      => $by
        	);

            $conditions = array("artikel_video_id" => $id);

        	$result = $this->_avm->update($arrayToDb, $conditions);

        	 //end transaction.
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $message['error_msg'] = 'Database operation failed.';
            } else {
                $this->db->trans_commit();
                //growler.
                $message['notif_title'] = "Excellent!";
                $message['notif_message'] = "Article video has been published.";

                //on update, redirect.
                $message['redirect_to'] = site_url('manager/article-video');
            }
        }

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    public function uploads( $name = null) {

        $message['is_error'] = true;
        $message['redirect_to'] = '';

        $config['upload_path'] = './assets/images/upload';
        $config['allowed_types'] = 'mp4';
        $config['max_size']  = '1000';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
 
        $this->load->library('upload', $config);
 
        if ( ! $this->upload->do_upload($name)){
            $message['is_error'] = true;
            $message['error_msg'] = $this->upload->display_errors();
        }
        else{
            $dataupload = $this->upload->data();
            $message['is_error'] = false;
            $message['error_msg'] = $dataupload['file_name']." berhasil diupload";
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
    }
}
