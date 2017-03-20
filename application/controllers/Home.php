<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
    {
    	parent::__construct();
    	$this->load->helper('url');
    	// $this->load->model('home_model');
    	$this->load->library('file');
    }

	public function index()
	{
		$data['file'] = $this->file->file_list('C:\MJF\web\upload\data');
		$this->load->view('home_view', $data);
	}

	public function exec()
	{
		$file = $this->input->post('file');
		if( is_file($file) ){
			//$f = pathinfo($file);
			rename($file, 'C:\MJF\web\doc\convert\\'.basename($file));
		}
		echo json_encode($file);
	}
}
