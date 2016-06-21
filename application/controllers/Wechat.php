<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wechat extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();
    	$this->load->model('wechat_model');
    }

    public function auth()
    {
    	define("TOKEN", "lyndon");
		define("AppID", "wxcb792fd1ca4248fd");
		//define("EncodingAESKey", "r2QkCH7g0p4Un2EQXpYQcmehYKVl83zi3YzEzC21IFT");


		if (!isset($_GET['echostr'])) {
	  		$this->wechat_model->responseMsg();
		}else{
		    $this->wechat_model->valid();
		}
    }
}