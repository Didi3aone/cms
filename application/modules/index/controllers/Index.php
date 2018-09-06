<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

    private $_article_model;
    private $_dm;
    private $_avm;
    private $_table = "tbl_kategori";
    private $_table_aliases = "tk";
    private $_pk_field = "kategori_id";
    private $_id_kondisi;

    private $_date_prev;
    
    var $_limit_1 = 1;
    var $_limit_5 = 5;
    
    var $_is_true = TRUE;
    var $_is_false = FALSE;
    var $_is_null  = NULL;

    public function __construct()
    {
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
        ## -- Get artikel kiri Akhlaq -- ##
        //prepare get data
        $artikel_kiri_akhlaq = $this->_article_model->get_all_data(array(
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
                'tbl_user u' => array('u.user_id'     => 'at.artikel_created_by')
            ),
            'left_joined'       => array(
                'tbl_artikel_detail ad' => array('ad.artikel_id' => 'at.artikel_id'),
            'tbl_tag t'         => array('t.tag_id'      => 'ad.tag_id')),
            'conditions'        => array(
                'at.artikel_status'      => STATUS_PUBLISH,
                'at.artikel_category_id' => ARTIKEL_AKHLAQ_AS_SUNNAH
            ),
            'order_by'          => array(
                'at.artikel_id' => 'desc'
            ), 
            'limit'             => $this->_limit_1,
            'debug'             => $this->_is_false,
            'row_array'         => $this->_is_true
        ))['datas'];
        ## -- end artikel kiri akhlaq-- ##

        ## -- Get artikel kanan akhlaq-- ##
        if($artikel_kiri_akhlaq != "" && $artikel_kiri_akhlaq > 1) {
            $this->_id_kondisi =  'at.artikel_id NOT IN("'.$artikel_kiri_akhlaq['artikel_id'].'")';
        }

        $artikel_kanan_akhlaq = $this->_article_model->get_all_data(array(
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
                'tbl_user u'   => array('u.user_id'     => 'at.artikel_created_by')
            ),
            'left_joined'       => array(
                'tbl_artikel_detail ad' => array('ad.artikel_id' => 'at.artikel_id'),
                'tbl_tag t'             => array('t.tag_id'      => 'ad.tag_id'),
            ), 
            'conditions'        => array(
                'at.artikel_status' => STATUS_PUBLISH,
                $this->_id_kondisi  => $this->_is_null,
                'at.artikel_category_id' => ARTIKEL_AKHLAQ_AS_SUNNAH
            ),
            'order_by'          => array('at.artikel_id' => 'desc'), 
            'limit'             => $this->_limit_5,
            'debug'             => $this->_is_false
        ))['datas'];
        ## -- end artikel akhlaq -- ##
        // pr( $artikel_kanan_akhlaq);

        ## -- Get artikel atas amalan -- ##
        //prepare get data
        $artikel_atas_amalan = $this->_article_model->get_all_data(array(
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
            'conditions'        => array(
                'at.artikel_status' => STATUS_PUBLISH,
                'at.artikel_category_id' => ARTIKEL_AMALAN_AS_SUNNAH
            ),
            'order_by'          => array('at.artikel_id' => 'desc'), 
            'limit'             => $this->_limit_1,
            'debug'             => $this->_is_false,
            'row_array'         => $this->_is_true
        ))['datas'];
        ## -- end artikel atas amalan-- ##

        ## -- Get artikel bawah amalan-- ##
        if($artikel_atas_amalan != "" && $artikel_atas_amalan > 1) {
            $id_kondisi =  'at.artikel_id NOT IN("'.$artikel_atas_amalan['artikel_id'].'")';
        }
        $artikel_bawah_amalan = $this->_article_model->get_all_data(array(
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
                'tbl_user u'    => array('u.user_id'     => 'at.artikel_created_by')
            ),
            'left_joined'       => array(
                'tbl_artikel_detail ad' => array('ad.artikel_id' => 'at.artikel_id'),
                'tbl_tag t'             => array('t.tag_id'      => 'ad.tag_id'),
            ), 
            'conditions'        => array(
                'at.artikel_status' => STATUS_PUBLISH,
                $id_kondisi => $this->_is_null,
                'at.artikel_category_id' => ARTIKEL_AMALAN_AS_SUNNAH 
            ),
            'order_by'          => array('at.artikel_id' => 'desc'), 
            'debug'             => $this->_is_false
        ))['datas'];
        # -- end artikel amalan -- #

        ## -- Get artikel atas jalan kebenaran -- ##
        $artikel_atas_jalan_sunnah = $this->_article_model->get_all_data(array(
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
            'joined'            =>  array(
                'tbl_user u'    => array('u.user_id'     => 'at.artikel_created_by'),
            ),
            'left_joined'       => array(
                'tbl_artikel_detail ad' => array('ad.artikel_id' => 'at.artikel_id'),
                'tbl_tag t'             => array('t.tag_id'      => 'ad.tag_id'),
            ), 
            'conditions'        => array(
                'at.artikel_status'      => STATUS_PUBLISH,
                'at.artikel_category_id' => ARTIKEL_JALAN_KEBENARAN_AS_SUNNAH
            ),
            'order_by'          => array('at.artikel_id' => 'desc'), 
            'limit'             => $this->_limit_5,
            'debug'             => $this->_is_false,
            'row_array'         => $this->_is_true
        ))['datas'];
        ## -- end artikel jalan kebenaran-- ##

        ## -- Get artikel bawah jalan kebenaran-- ##
        if($artikel_atas_jalan_sunnah != "" && $artikel_atas_jalan_sunnah > 1) {
            $id_kondisi =  'at.artikel_id NOT IN("'.$artikel_atas_jalan_sunnah['artikel_id'].'")';
        }
     
        $artikel_bawah_jalan_sunnah = $this->_article_model->get_all_data(array(
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
                'tbl_user u'            => array('u.user_id'     => 'at.artikel_created_by'),
            ),
            'left_joined'       =>  array(
                'tbl_artikel_detail ad' => array('ad.artikel_id' => 'at.artikel_id'),
                'tbl_tag t'             => array('t.tag_id'      => 'ad.tag_id'),
            ), 
            'conditions'        => array(
                'at.artikel_status' => STATUS_PUBLISH,
                $id_kondisi => $this->_is_null,
                'at.artikel_category_id' => ARTIKEL_JALAN_KEBENARAN_AS_SUNNAH
            ),
            'order_by'          => array('at.artikel_id' => 'desc'), 
            'debug'             => $this->_is_false
        ))['datas'];
        # -- end artikel bawah -- #

        ## -- Get artikel kiri -- ##
        //conditions
        $conditions = array(
            'at.artikel_status' => STATUS_PUBLISH,
            'at.artikel_category_id' => ARTIKEL_KELUARGA_AS_SUNNAH
        );
        //prepare get data
        $keluarga_sunnah_1 = $this->_article_model->get_all_data(array(
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
                'tbl_user u'            => array('u.user_id'     => 'at.artikel_created_by'),
            ),
            'left_joined'       => array(
                'tbl_artikel_detail ad' => array('ad.artikel_id' => 'at.artikel_id'),
                'tbl_tag t'             => array('t.tag_id'      => 'ad.tag_id'),
            ), 
            'conditions'        => $conditions,
            'order_by'          => array('at.artikel_id' => 'desc'), 
            'limit'             => $this->_limit_1,
            'debug'             => $this->_is_false,
            'row_array'         => $this->_is_true
        ))['datas'];
        ## -- end artikel kiri keluarga-- ##

        ## -- Get artikel kanan keluarga-- ##
        if($keluarga_sunnah_1 != "" && $keluarga_sunnah_1 > 1) {
            $this->_id_kondisi =  'at.artikel_id NOT IN("'.$keluarga_sunnah_1['artikel_id'].'")';
        }
        $keluarga_sunnah_2 = $this->_article_model->get_all_data(array(
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
                'tbl_user u'            => array('u.user_id'     => 'at.artikel_created_by'),
            ),
            'left_joined'       => array(
                'tbl_artikel_detail ad' => array('ad.artikel_id' => 'at.artikel_id'),
                'tbl_tag t'             => array('t.tag_id'      => 'ad.tag_id'),
            ), 
            'conditions'        => array(
                'at.artikel_status' => STATUS_PUBLISH,
                $this->_id_kondisi => $this->_is_null,
                'at.artikel_category_id' => ARTIKEL_KELUARGA_AS_SUNNAH
            ),
            'order_by'          => array('at.artikel_id' => 'desc'), 
            'debug'             => false
        ))['datas'];
        # -- end artikel kanan manhaj -- #

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

        ## -- Slider --##
        $slider = $this->_dm->set_model(
            "tbl_background_slider", "tbs", "slider_id")
        ->get_all_data(array("conditions" => array("status" => STATUS_ACTIVE)))['datas'];
        ## -- End slider -- ##

        ##-- Get all kategori --##
        $kategori = $this->_dm->set_model(
            "tbl_kategori","kt","kategori_id")->
        get_all_data(array(
            "conditions" => array("status" => STATUS_ACTIVE, "kategori_id !=" => KHUTBAH_JUMAT)
        ))['datas'];
        // pr($data['kategori']);
        ## -- End get all kategori --##

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

        ##-- Get all kategori --##
        $kategori = $this->_dm->set_model("tbl_kategori","kt","kategori_id")->get_all_data(array(
            "conditions" => array("status" => STATUS_ACTIVE)
        ))['datas'];
        ## -- End get all kategori --##

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
        ## prepare init all data ##
        $data = array(
            "artikel_kiri_akhlaq"       => $artikel_kiri_akhlaq,
            "artikel_kanan_akhlaq"      => $artikel_kanan_akhlaq, 
            "artikel_atas_amalan"       => $artikel_atas_amalan,
            "artikel_bawah_amalan"      => $artikel_bawah_amalan, 
            "artikel_atas_jalan"        => $artikel_atas_jalan_sunnah, 
            "artikel_bawah_jalan"       => $artikel_bawah_jalan_sunnah,
            "artikel_atas_keluarga"     => $keluarga_sunnah_1,
            "artikel_bawah_keluarga"    => $keluarga_sunnah_2,
            "slider"                    => $slider,
            "lat_post"                  => $latest_post,
            "kategori"                  => $kategori,
            "pop_post"                  => $popular_post,
            "tag"                       => $tag,
            "description"               => "MIAS.OR.ID"
        );
        ## ------- ## end init ## ------- ##

        // $data['view_layout'] = 'index/front/artikel_harian';

        $this->load->view(LAYOUT_WEB_HEADER, $data);
        $this->load->view('index/front/index', $data);
        $this->load->view(LAYOUT_WEB_FOOTER);
    }

    public function read($id = null, $slug = null)
    {
        $this->add_count($slug);
        $data['title']    = 'Read';
        $data['article']  = $this->Article_model->get_single_post(array('slug' => $slug,'id' => $id));
        // var_dump($data['article']);
        $this->load->view('web/header');
        $this->load->view('web/article', $data);
        $this->load->view('web/footer');
    }

    public function artikel_by_kategori($kategori_id = "") 
    {
        $header = array();

        $footer = array();

        // $header['slider'] =$this->_dm->set_model("tbl_background_slider","tbs","slider_id")->get_all_data(array(
        //     "conditions" => array("status" => STATUS_ACTIVE),
        //     "limit"      => 3,
        // ))['datas'];
               
        $data['artikel_by_kategori'] = $this->Article_model->artikel_by_category( $kategori_id );

        $this->load->view(LAYOUT_WEB_HEADER,$header);
        $this->load->view('index/front/artikel_by_kategori',$data);
        $this->load->view(LAYOUT_WEB_FOOTER,$footer);
    }
}

/* End of file News.php */
/* Location: ./application/controllers/News.php */