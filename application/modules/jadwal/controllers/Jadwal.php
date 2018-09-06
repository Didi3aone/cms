<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

	private $_date_prev, 
    $_view_folder = "jadwal/front/";

    var $_limit_1 = 1;
    var $_limit_5 = 5;
    
    var $_is_true = TRUE;
    var $_is_false = FALSE;
    var $_is_null  = NULL;

	public function __construct() {
		parent::__construct();
		//load model
        $this->load->model(array(
            'article/Article_model',
            'article_video/Article_video_model',
            'Dynamic_model'
        ));
        $this->_id_kondisi = NULL;
        $this->_date_prev  = date('Y-m-d', strtotime('-7 days'));
        //new class for model
        $this->_article_model  = new Article_model();
        $this->_avm            = new Article_video_model();
        $this->_dm             = new Dynamic_model();
	}

    public function index()
    {
         ##-- Get all kategori --##
        $kategori = $this->_dm->set_model("tbl_kategori","kt","kategori_id")->get_all_data(array(
            "conditions" => array("status" => STATUS_ACTIVE, "kategori_id !=" => KHUTBAH_JUMAT)
        ))['datas'];
        ## -- End get all kategori --##

        ## -- get jadwal akhwat -- ##
        $jadwal = $this->_dm->set_model("tbl_jadwal","tj","jadwal_id")->get_all_data(
            array(
                "select" => "tj.*, tjk.kategori_name, tjk.jadwal_kategori_id",
                "joined" => array(
                    "tbl_jadwal_kategori tjk" => array(
                    "tjk.jadwal_kategori_id" => "tj.jadwal_kategori_id" 
                )),
                "conditions" => array("tjk.jadwal_kategori_id" => JADWAL_KATEGORI_KAJIAN_UMUM),
                "debug"     => $this->_is_false,
                "count_all_first" => $this->_is_true
            )
        );
        ## -- end jadwal -- ##

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
                // "tk.name !=" => $fix_name
            ),
            "limit" => 6,
            "order_by" => array("rand()" => ""),
            "debug"    => $this->_is_false
        ))['datas'];

        //prepare send paramater
        $data = array(
            "jadwal"        => $jadwal,
            "lat_post"      => $latest_post,
            "kategori"      => $kategori,
            "other_article" => $other
        );

        $view = ($jadwal['total'] == 0) ? 'index/front/404' : $this->_view_folder.'jadwal-kajian';

        $this->load->view(LAYOUT_WEB_HEADER, $data);    
        $this->load->view($view, $data);
        $this->load->view(LAYOUT_WEB_FOOTER);
    }

	public function akhwat()
	{
         ##-- Get all kategori --##
        $kategori = $this->_dm->set_model("tbl_kategori","kt","kategori_id")->get_all_data(array(
            "conditions" => array("status" => STATUS_ACTIVE, "kategori_id !=" => KHUTBAH_JUMAT)
        ))['datas'];
        ## -- End get all kategori --##

        ## -- get jadwal akhwat -- ##
		$jadwal = $this->_dm->set_model("tbl_jadwal","tj","jadwal_id")->get_all_data(
			array(
				"select" => "tj.*, tjk.kategori_name, tjk.jadwal_kategori_id",
				"joined" => array(
					"tbl_jadwal_kategori tjk" => array(
					"tjk.jadwal_kategori_id" => "tj.jadwal_kategori_id" 
				)),
				"conditions" => array("tjk.jadwal_kategori_id" => JADWAL_KATEGORI_KAJIAN_AKHWAT),
				"debug"		=> $this->_is_false,
                "count_all_first" => $this->_is_true
			)
		);
        ## -- end jadwal -- ##

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

        ## -- Get artikel popular post -- ##
        
        $popular_post = $this->_article_model->get_all_data(array(
           "select"         => 
               "tk.name as kategori,
                MAX(at.artikel_id), 
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
                tk.name", 
           "joined"         => array("tbl_kategori tk" => array("tk.kategori_id" => "at.artikel_category_id")),
           "conditions"     => array("at.artikel_created_date >=" => $this->_date_prev),
           "limit"          => 5
        ))['datas'];
        // pr($data['popular_post']);exit;
        ## -- end get popular post -- ##

        $other = $this->_dm->set_model("tbl_artikel", "ta", "artikel_id")->get_all_data(array(
            "select"     => "ta.*, tk.kategori_id as ketegori",   
            "joined"     => array(
                "tbl_kategori tk" => array("tk.kategori_id" => "ta.artikel_category_id")
            ),
            "conditions" => array(
                "artikel_status"    => STATUS_PUBLISH,
                // "tk.name !=" => $fix_name
            ),
            "limit" => 6,
            "order_by" => array("rand()" => ""),
            "debug"    => $this->_is_false
        ))['datas'];

        //prepare send paramater
		$data = array(
			"jadwal"        => $jadwal,
			"lat_post"		=> $latest_post,
            "kategori"      => $kategori,
            "other_article" => $other,
            "pop_post"      => $popular_post
		);
        // pr($jadwal);

        $view = ($jadwal['total'] == 0) ? 'index/front/404' : $this->_view_folder.'jadwal-kajian';

		$this->load->view(LAYOUT_WEB_HEADER, $data);	
        $this->load->view($view, $data);
        $this->load->view(LAYOUT_WEB_FOOTER);
	}

    public function ikhwan()
    {
        ##-- Get all kategori --##
        $kategori = $this->_dm->set_model("tbl_kategori","kt","kategori_id")->get_all_data(array(
            "conditions" => array("status" => STATUS_ACTIVE, "kategori_id !=" => KHUTBAH_JUMAT)
        ))['datas'];
        ## -- End get all kategori --##

        ## -- get jadwal ikhwan -- ##
        $jadwal = $this->_dm->set_model("tbl_jadwal","tj","jadwal_id")->get_all_data(
            array(
                "select" => "tj.*, tjk.kategori_name, tjk.jadwal_kategori_id",
                "joined" => array(
                    "tbl_jadwal_kategori tjk" => array(
                    "tjk.jadwal_kategori_id" => "tj.jadwal_kategori_id" 
                )),
                "conditions" => array("tjk.jadwal_kategori_id" => JADWAL_KATEGORI_KAJIAN_IKHWAN),
                "debug"     => $this->_is_false,
                // "count_all_first" => $this->_is_true
            )
        );
        ## -- end jadwal -- ##

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

        ## -- other article -- ##
        $other = $this->_dm->set_model("tbl_artikel", "ta", "artikel_id")->get_all_data(array(
            "select"     => "ta.*, tk.kategori_id as ketegori",   
            "joined"     => array(
                "tbl_kategori tk" => array("tk.kategori_id" => "ta.artikel_category_id")
            ),
            "conditions" => array(
                "artikel_status"    => STATUS_PUBLISH,
                // "tk.name !=" => $fix_name
            ),
            "limit" => 6,
            "order_by" => array("rand()" => ""),
            "debug"    => $this->_is_false
        ))['datas'];
        ## -- end -- ##

        //prepare send paramater
        $data = array(
            "jadwal"        => $jadwal,
            "lat_post"      => $latest_post,
            "kategori"      => $kategori,
            "other_article" => $other
        );

        $view = ($jadwal['total'] == 0) ? 'index/front/404' : $this->_view_folder.'jadwal-kajian';

        $this->load->view(LAYOUT_WEB_HEADER, $data);    
        $this->load->view($view, $data);
        $this->load->view(LAYOUT_WEB_FOOTER);
    }

    public function detail($id = null)
    {
        ##-- Get all kategori --##
        $kategori = $this->_dm->set_model("tbl_kategori","kt","kategori_id")->get_all_data(array(
            "conditions" => array("status" => STATUS_ACTIVE, "kategori_id !=" => KHUTBAH_JUMAT)
        ))['datas'];
        ## -- End get all kategori --##

        ##-- Get all kategori --##
        $kategori = $this->_dm->set_model("tbl_kategori","kt","kategori_id")->get_all_data(array(
            "conditions" => array("status" => STATUS_ACTIVE)
        ))['datas'];
        ## -- End get all kategori --##

        ## -- get jadwal ikhwan -- ##
        $jadwal = $this->_dm->set_model("tbl_jadwal","tj","jadwal_id")->get_all_data(
            array(
                "select" => "tj.*, tjk.kategori_name, tu.username,tjk.jadwal_kategori_id",
                "joined" => array(
                    "tbl_jadwal_kategori tjk" => array("tjk.jadwal_kategori_id" => "tj.jadwal_kategori_id"),
                    "tbl_user tu" => array("tu.user_id" => "tj.jadwal_created_by")
                ),
                "conditions" => array("tjk.jadwal_kategori_id" => $id),
                "debug"     => $this->_is_false,
                "row_array" => $this->_is_true
            )
        )['datas'];
        ## -- end jadwal -- ##

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

        ## -- popular post -- ##
        $date_prev = date('Y-m-d', strtotime('-7 days'));
        $popular_post = $this->_article_model->get_all_data(array(
           "select"         => "tk.name as kategori , at.*",
           "joined"         => array("tbl_kategori tk" => array("tk.kategori_id" => "at.artikel_category_id")),
           "conditions"     => array("at.artikel_created_date >=" => $date_prev),
           "limit"          => 5
        ))['datas'];
        ## -- end get popular post -- ##

        ## -- other article -- ##
        $other = $this->_dm->set_model("tbl_artikel", "ta", "artikel_id")->get_all_data(array(
            "select"     => "ta.*, tk.kategori_id as ketegori",   
            "joined"     => array(
                "tbl_kategori tk" => array("tk.kategori_id" => "ta.artikel_category_id")
            ),
            "conditions" => array(
                "artikel_status"    => STATUS_PUBLISH,
                // "tk.name !=" => $fix_name
            ),
            "limit" => 6,
            "order_by" => array("rand()" => ""),
            "debug"    => $this->_is_false
        ))['datas'];
        ## -- end -- ##

        ## -- tag -- ## 
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
        ## -- tag -- ##

        $data = array(
            "jadwal"        => $jadwal,
            "lat_post"      => $latest_post,
            "pop_post"      => $popular_post,
            "other_article" => $other,
            "kategori"      => $kategori,
            "tag"           => $tag,
            "breadcrumb"    => "Jadwal"
        );

        $this->load->view(LAYOUT_WEB_HEADER, $data);    
        $this->load->view($this->_view_folder.'detail', $data);
        $this->load->view(LAYOUT_WEB_FOOTER);
    }

}

/* End of file Jadwal.php */
/* Location: ./application/modules/jadwal/controllers/Jadwal.php */