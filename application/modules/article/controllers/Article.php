<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

    private $_date_prev;
    var $_limit_1 = 1;
    var $_limit_5 = 5;
    
    var $_is_true = TRUE;
    var $_is_false = FALSE;
    var $_is_null  = NULL;

    private $_view_folder = 'article/front/';

	public function __construct() {
		parent::__construct();
		//load model
        $this->load->model(array(
            'article/Article_model',
            'article_video/Article_video_model', 
            'Dynamic_model'
        ));
        //new class for model
        $this->_article_model  = new Article_model();
        $this->_avm            = new Article_video_model();
        $this->_dm             = new Dynamic_model();
	}

	public function read( $id = null)
	{
        // echo $url_id;

        ##-- Get all kategori --##
        $kategori = $this->_dm->set_model("tbl_kategori","kt","kategori_id")->get_all_data(array(
            "conditions" => array("status" => STATUS_ACTIVE, "kategori_id !=" => KHUTBAH_JUMAT)
        ))['datas'];
        // pr($data['kategori']);
        ## -- End get all kategori --##

        ## -- popular post -- ##
        $date_prev = date('Y-m-d', strtotime('-7 days'));
        $popular_post = $this->_article_model->get_all_data(array(
           "select"         => "tk.name as kategori , at.*",
           "joined"         => array("tbl_kategori tk" => array("tk.kategori_id" => "at.artikel_category_id")),
           "conditions"     => array("at.artikel_created_date >=" => $date_prev),
           "limit"          => 5
        ))['datas'];
        ## -- end get popular post -- ##

        ## -- Get artikel kiri -- ##
        $select = 'at.*, t.name, u.username as create_by, tk.name as kategori';
        //left joined
        $left_joined = array(
            'tbl_artikel_detail ad' => array('ad.artikel_id' => 'at.artikel_id'),
            'tbl_tag t'             => array('t.tag_id'      => 'ad.tag_id'),
        );
        //joined
        $joined = array(
            'tbl_user u'            => array('u.user_id'     => 'at.artikel_created_by'),
            'tbl_kategori tk'		=> array('tk.kategori_id' => 'at.artikel_category_id')
        );
        //conditions
        $conditions = array(
            'at.artikel_status' => STATUS_PUBLISH,
            'at.artikel_id'		=> $id
        );
        //prepare get data
        $artikel_single = $this->_article_model->get_all_data(array(
            'select'            => $select,
            'joined'            => $joined,
            'left_joined'       => $left_joined, 
            'conditions'        => $conditions,
            'order_by'          => array('at.artikel_id' => 'desc'), 
            'limit'             => 1,
            'debug'             => false,
            'row_array'         => true
        ))['datas'];
        ## -- end artikel kiri harian-- ##
        // pr($data['artikel_single']);exit;

        $other_article = $this->_dm->set_model("tbl_artikel", "ta", "artikel_id")->get_all_data(array(
            "conditions" => array(
                "artikel_id != " 	=> $artikel_single['artikel_id'],
	            "artikel_status" 	=> STATUS_PUBLISH
            ),
            "limit" => 4,
            "order_by" => array("rand()" => "")
        ))['datas'];

        $tag = $this->_dm->set_model("tbl_tag", "tt", "tag_id")->get_all_data(array(
            "select" => "tt.tag_id as id,tt.name as tag , ta.artikel_pretty_url, ta.artikel_judul, ta.artikel_id",
            "joined" => array(
                "tbl_artikel_detail tad" => array("tad.tag_id" => "tt.tag_id"),
                "tbl_artikel ta"         => array("ta.artikel_id" => "tad.artikel_id")
            ),
            "order_by"  => array("tt.tag_id" => "desc"),
            "debug"     => $this->_is_false
            // "conditions" => array("ta.artikel_status" => STATUS_PUBLISH)
        ))['datas'];

        $data = array(
            "kategori" => $kategori,
            "pop_post" => $popular_post,
            "artikel_single" => $artikel_single,
            "other_article"  => $other_article,
            "tag"            => $tag,
            "breadcrumb"    => "Article"
        );

		$this->load->view(LAYOUT_WEB_HEADER, $data);	
        $this->load->view('index/front/article-single-page', $data);
        $this->load->view(LAYOUT_WEB_FOOTER);
	}

    public function kategori( $name = null )
    {

        $this->load->library('pagination');
        ##-- Get all kategori --##
        $kategori = $this->_dm->set_model("tbl_kategori","kt","kategori_id")->get_all_data(array(
            "conditions" => array("status" => STATUS_ACTIVE, "kategori_id !=" => KHUTBAH_JUMAT)
        ))['datas'];
        // pr($data['kategori']);
        ## -- End get all kategori --##

        $fix_name = str_replace("_", " ", $name);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        // pr($data['page']);exit;
        $data['artikel_by_category'] = $this->_dm->set_model("tbl_artikel", "ta","artikel_id")->get_all_data(
            array(
                "select" => "ta.*, tk.kategori_id as id_kategori, tu.username",
                "joined" => array(
                    "tbl_kategori tk" => array("tk.kategori_id" => "ta.artikel_category_id"),
                    "tbl_user tu"     => array("tu.user_id"     => "ta.artikel_created_by"),
                    "tbl_artikel_type tak" => array("tak.type_id" => "ta.artikel_type_id")
                ),
                "left_joined"         => array(
                    "tbl_artikel_detail tad" => array("tad.artikel_id" => "ta.artikel_id"),
                    "tbl_tag tt"             => array("tt.tag_id"      => "tad.tag_id")
                ),
                "conditions"        => array(
                    "tk.name" => $fix_name,
                    "ta.artikel_type_id" => KAJIAN,
                    "ta.artikel_status"  => STATUS_PUBLISH
                ),
                "limit"             => "10",
                "start"             => $data['page'],
                "debug"             => $this->_is_false,
                "count_all_first"   => $this->_is_true
            )
        );

        $config['base_url'] = site_url('article/kategori'); //site url
        $config['total_rows'] = $data['artikel_by_category']['total']; //total row
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        # -- end  -- #

        ## -- popular post -- ##
        $date_prev = date('Y-m-d', strtotime('-7 days'));
        $datas = $this->_article_model->get_all_data(array(
           "select"         => "tk.name as kategori , at.*",
           "joined"         => array("tbl_kategori tk" => array("tk.kategori_id" => "at.artikel_category_id")),
           "conditions"     => array("at.artikel_created_date >=" => $date_prev)
        ))['datas'];
        ## -- end get popular post -- ##

        ## -- Get artikel latest -- ##
        //conditions
        //yang di tampilkan adalah yang sudah di publish
        $conditions = array(
            'at.artikel_status' => STATUS_PUBLISH,
        );

        $latest_post = $this->_article_model->get_all_data(array(
            'select'            => 
                'at.artikel_id,
                at.artikel_judul,
                at.artikel_pretty_url,
                at.artikel_photo,
                at.artikel_photo_real,
                at.artikel_isi,
                at.artikel_category_id,
                at.artikel_status,
                at.artikel_created_date,
                at.artikel_created_by,
                t.name, 
                u.username as create_by',
            'joined'            => array(
                'tbl_user u'   => array('u.user_id'     => 'at.artikel_created_by'),
            ),
            'left_joined'       => array(
                'tbl_artikel_detail ad' => array('ad.artikel_id' => 'at.artikel_id'),
                'tbl_tag t'             => array('t.tag_id'      => 'ad.tag_id'),
            ), 
            'conditions'        => $conditions,
            'order_by'          => array('at.artikel_id' => 'desc'), 
            'limit'             => $this->_limit_5,
            'debug'             => $this->_is_false
        ))['datas'];
        // pr($latest_post);exit;   
        ## -- End get artikel latest -- ##
        $datas = array(
            'popular_post' => $datas,
            'kategori'     => $kategori,
            'lat_post'     => $latest_post
        );
                 
        //     //get one kategori
        if( !empty($data['artikel_by_category']) )
        {
            // $id_kategori = ($data['artikel_by_category']['datas'][0]['id_kategori']) ? $data['artikel_by_category']['datas'][0]['id_kategori'] : "";

            $data['other_article'] = $this->_dm->set_model("tbl_artikel", "ta", "artikel_id")->get_all_data(array(
                "select"     => "ta.*, tk.kategori_id as ketegori",   
                "joined"     => array(
                    "tbl_kategori tk" => array("tk.kategori_id" => "ta.artikel_category_id")
                ),
                "conditions" => array(
                    "artikel_status"    => STATUS_PUBLISH,
                    "tk.name !=" => $fix_name
                ),
                "limit" => 6,
                "order_by" => array("rand()" => ""),
                "debug"    => $this->_is_false
            ))['datas'];
        }


        ## -- Get artikel latest -- ##
        //conditions
        //yang di tampilkan adalah yang sudah di publish
        $conditions = array(
            'at.artikel_status' => STATUS_PUBLISH,
        );

        $data['lat_post'] = $this->_article_model->get_all_data(array(
            'select'            => 
                'MAX(at.artikel_id), 
                at.artikel_id,
                at.artikel_judul,
                at.artikel_pretty_url,
                at.artikel_photo,
                at.artikel_photo_real,
                at.artikel_isi,
                at.artikel_category_id,
                at.artikel_status,
                at.artikel_created_date,
                at.artikel_created_by,
                t.name, 
                u.username as create_by',
            'joined'            => array(
                'tbl_user u'   => array('u.user_id'     => 'at.artikel_created_by'),
            ),
            'left_joined'       => array(
                'tbl_artikel_detail ad' => array('ad.artikel_id' => 'at.artikel_id'),
                'tbl_tag t'             => array('t.tag_id'      => 'ad.tag_id'),
            ), 
            'conditions'        => $conditions,
            'order_by'          => array('at.artikel_id' => 'desc'), 
            'limit'             => $this->_limit_5
        ))['datas'];
        // pr($data['lat_post']);exit;   
        ## -- End get artikel latest -- ##

        ## -- popular post -- ##
        $date_prev = date('Y-m-d', strtotime('-7 days'));
        $data['pop_post'] = $this->_article_model->get_all_data(array(
           "select"         => "tk.name as kategori , at.*",
           "joined"         => array("tbl_kategori tk" => array("tk.kategori_id" => "at.artikel_category_id")),
           "conditions"     => array("at.artikel_created_date >=" => $date_prev),
           "limit"          => 5
        ))['datas'];
        ## -- end get popular post -- ##

        ## -- tag -- ## 
        $data['tag'] = $this->_dm->set_model("tbl_tag", "tt", "tag_id")->get_all_data(array(
            "select" => "tt.tag_id as id,tt.name as tag , ta.artikel_pretty_url, ta.artikel_judul, ta.artikel_id",
            "joined" => array(
                "tbl_artikel_detail tad" => array("tad.tag_id" => "tt.tag_id"),
                "tbl_artikel ta"         => array("ta.artikel_id" => "tad.artikel_id")
            ),
            "order_by"  => array("tt.tag_id" => "desc"),
            "debug"     => $this->_is_false
            // "conditions" => array("ta.artikel_status" => STATUS_PUBLISH)
        ))['datas'];
    
        $view = ($data['artikel_by_category']['total'] == 0) ? 'index/front/404' : "article/front/kategori";

        $this->load->view(LAYOUT_WEB_HEADER, $datas);
        $this->load->view($view, $data);
        $this->load->view(LAYOUT_WEB_FOOTER);
    }

     public function loadmore () {
        //check if ajax request
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $page = $this->input->post("page");
        $limit = $this->input->post("limit");

        if (empty($page)) $page = 1;
        $start = ($limit * ($page - 1));

        $article = $this->_dm->set_model("tbl_artikel", "ta", "artikel_id")->get_all_data(array(
            "order_by" => array("artikel_created_date" => "desc"),
            "limit" => $limit,
            "start" => $start,
            "conditions" => array(
                "artikel_status" => STATUS_PUBLISH,
                // "artikel_category_id" => $id
            ),
            "count_all_first" => true,
        ));

        $models = array();
        // foreach ($article['datas'] as $model) {
        //     $model['content_formated'] = ($model['short_content']) ? trimstr(strip_tags($model['short_content']), 150, 'WORDS', '...') : trimstr(strip_tags($model['full_content']), 200, 'WORDS', '...');
        //     unset($model['full_content']);
        //     array_push ($models,$model);
        // }

        $this->output->set_content_type('application/json');
        echo json_encode(array(
            "result"        => "OK",
            "datas"         => $article['datas'],
            "total_page"    => ceil($article['total']/$limit),
        ));
        exit;
    }

    public function khutbah_jumat()
    {
        $this->load->library("pagination");
         ##-- Get all kategori --##
        $kategori = $this->_dm->set_model("tbl_kategori","kt","kategori_id")->get_all_data(array(
            "conditions" => array("status" => STATUS_ACTIVE, "kategori_id !=" => KHUTBAH_JUMAT)
        ))['datas'];
        ## -- End get all kategori --##

        ## -- get khutbah -- ##
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $khutbah = $this->_dm->set_model("tbl_artikel", "ta","artikel_id")->get_all_data(
            array(
                "select" => "ta.*, tk.kategori_id as id_kategori, tu.username",
                "joined" => array(
                    "tbl_kategori tk" => array("tk.kategori_id" => "ta.artikel_category_id"),
                    "tbl_user tu"     => array("tu.user_id"     => "ta.artikel_created_by"),
                    "tbl_artikel_type tak" => array("tak.type_id" => "ta.artikel_type_id")
                ),
                "left_joined"         => array(
                    "tbl_artikel_detail tad" => array("tad.artikel_id" => "ta.artikel_id"),
                    "tbl_tag tt"             => array("tt.tag_id"      => "tad.tag_id")
                ),
                "conditions"        => array(
                    "ta.artikel_category_id" => KHUTBAH_JUMAT,
                    "ta.artikel_type_id"     => KAJIAN,
                    "ta.artikel_status"      => STATUS_PUBLISH
                ),
                "limit"             => "10",
                "start"             => $page,
                "debug"             => $this->_is_false,
                "count_all_first"   => $this->_is_true
            )
        );

        $config['base_url'] = site_url('article/khutbah'); //site url
        $config['total_rows'] = $khutbah['total']; //total row
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        ## -- end khutbah -- ##
        // pr($khutbah);
        ## -- Get artikel latest -- ##
        $conditions = array(
            'at.artikel_status' => STATUS_PUBLISH,
        );

        $latest_post = $this->_article_model->get_all_data(array(
            'select'            => 
                'MAX(at.artikel_id), 
                at.artikel_id,
                at.artikel_judul,
                at.artikel_pretty_url,
                at.artikel_photo,
                at.artikel_isi,
                at.artikel_category_id,
                at.artikel_status,
                at.artikel_created_date,
                at.artikel_created_by,
                t.name, 
                u.username as create_by',
            'joined'            => array(
                'tbl_user u'   => array('u.user_id'     => 'at.artikel_created_by'),
            ),
            'left_joined'       => array(
                'tbl_artikel_detail ad' => array('ad.artikel_id' => 'at.artikel_id'),
                'tbl_tag t'             => array('t.tag_id'      => 'ad.tag_id'),
            ), 
            'conditions'        => $conditions,
            'order_by'          => array('at.artikel_id' => 'desc'), 
            'limit'             => $this->_limit_5
        ))['datas'];
        ## -- End get artikel latest -- ##

        $other = $this->_dm->set_model("tbl_artikel", "ta", "artikel_id")->get_all_data(array(
            "select"     => "ta.*, tk.kategori_id as ketegori",   
            "joined"     => array(
                "tbl_kategori tk" => array("tk.kategori_id" => "ta.artikel_category_id")
            ),
            "conditions" => array(
                "artikel_status"    => STATUS_PUBLISH,
                "tk.kategori_id !=" => KHUTBAH_JUMAT  
                // "tk.name !=" => $fix_name
            ),
            "limit" => 6,
            "order_by" => array("rand()" => ""),
            "debug"    => $this->_is_false
        ))['datas'];

        //prepare send paramater
        $data = array(
            "khutbah"       => $khutbah,
            "lat_post"      => $latest_post,
            "kategori"      => $kategori,
            "other_article" => $other,
            "page"          => $page,
            "pagination"    => $this->pagination->create_links()
            // "alert_error"   => "Artikel kategori ".$khutbah['datas']['kategori']
        );

        $view = ($khutbah['total'] == 0) ? 'index/front/404' : $this->_view_folder.'khutbah-jumat';

        $this->load->view(LAYOUT_WEB_HEADER, $data);    
        $this->load->view($view, $data);
        $this->load->view(LAYOUT_WEB_FOOTER);
    }

    // function _error_404()
    // {
    //     $kategori = $this->_dm->set_model("tbl_kategori","kt","kategori_id")->get_all_data(array(
    //         "conditions" => array("status" => STATUS_ACTIVE)
    //     ))['datas'];

    //     ## -- Get artikel popular post -- ##
    //     $date_prev = date('Y-m-d', strtotime('-7 days'));
    //     $data['popular_post'] = $this->_article_model->get_all_data(array(
    //        "select"         => "tk.name as kategori , at.*",
    //        "joined"         => array("tbl_kategori tk" => array("tk.kategori_id" => "at.artikel_category_id")),
    //        "conditions"     => array("at.artikel_created_date >=" => $date_prev)
    //     ))['datas'];
    //     // pr($data['popular_post']);exit;
    //     ## -- end get popular post -- ##
    //     ## -- Get artikel latest -- ##
    //     $select = 'at.*, t.name, u.username as create_by';
    //     //left joined
    //     $left_joined = array(
    //         'tbl_artikel_detail ad' => array('ad.artikel_id' => 'at.artikel_id'),
    //         'tbl_tag t'             => array('t.tag_id'      => 'ad.tag_id'),
    //     );
    //     //joined
    //     $joined = array(
    //         'tbl_user u'            => array('u.user_id'     => 'at.artikel_created_by'),
    //     );
    //     //conditions
    //     //yang di tampilkan adalah yang sudah di publish
    //     $conditions = array(
    //         'at.artikel_status' => STATUS_PUBLISH,
    //     );
    //     $data['latest_post'] = $this->_article_model->get_all_data(array(
    //         'select'            => $select,
    //         'joined'            => $joined,
    //         'left_joined'       => $left_joined, 
    //         'conditions'        => $conditions,
    //         'order_by'          => array('at.artikel_id' => 'desc'), 
    //         // 'limit'             => 3
    //     ))['datas'];

    //     $params = array(
    //         "select" => "*",
    //         "conditions" => array("status" => STATUS_ACTIVE)
    //     );
    //     $data['slider'] = $this->_dm->set_model("tbl_background_slider", "tbs", "slider_id")->get_all_data($params)['datas'];
    //     $header = array("kategori" => $kategori);

    //     $data['view_layout'] = "index/front/404";

    //     $this->load->view(LAYOUT_WEB_HEADER, $header);
    //     $this->load->view('index/front/index', $data);
    //     $this->load->view(LAYOUT_WEB_FOOTER);
    // }
}

/* End of file Article.php */
/* Location: ./application/modules/article/controllers/Article.php */