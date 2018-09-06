<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {

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

	public function index()
	{
		##-- Get all kategori --##
        $data['kategori'] = $this->_dm->set_model("tbl_kategori","kt","kategori_id")->get_all_data(array(
            "conditions" => array("status" => STATUS_ACTIVE,"kategori_id !=" => KHUTBAH_JUMAT)
        ))['datas'];
        // pr($data['kategori']);
        ## -- End get all kategori --##

		$data['video'] = $this->_dm->set_model("tbl_artikel_video","tav","artikel_video_id")->get_all_data()['datas'];
		$this->load->view(LAYOUT_WEB_HEADER, $data);	
        $this->load->view('article_video/front/video-list', $data);
        $this->load->view(LAYOUT_WEB_FOOTER);
	}

	public function live_streaming ()
	{
		##-- Get all kategori --##
        $data['kategori'] = $this->_dm->set_model("tbl_kategori","kt","kategori_id")->get_all_data(array(
            "conditions" => array("status" => STATUS_ACTIVE, "kategori_id !=" => KHUTBAH_JUMAT)
        ))['datas'];
        // pr($data['kategori']);
        ## -- End get all kategori --##

		$this->load->view(LAYOUT_WEB_HEADER, $data);	
        $this->load->view('article_video/front/live-stream');
        $this->load->view(LAYOUT_WEB_FOOTER);
	}
}

/* End of file Video.php */
/* Location: ./application/modules/article_video/controllers/Video.php */