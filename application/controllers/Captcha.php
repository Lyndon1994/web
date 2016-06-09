<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 生成验证码
 * Created by PhpStorm.
 * User: linyi
 * Date: 16-6-6
 * Time: 下午1:34
 */
class Captcha extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('validateCode_model');
    }
    public function index(){
        $this->validateCode_model->doimg();
        unset($_SESSION['code']);
        $this->session->set_userdata('code', strtolower($this->validateCode_model->getCode()));
    }

}