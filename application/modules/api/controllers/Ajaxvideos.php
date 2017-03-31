<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajaxvideos extends FrontendController {
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
	 
	public function __construct()
    {
        parent::__construct();

        // Ideally you would autoload the parser
    }
	*/
    private static $limit = 20;

	public function __construct()
    {
        parent::__construct();
        
        // Ideally you would autoload the parser
    }

	public function index()
	{
		if (!$this->input->is_ajax_request()) {
		   redirect('/', 'refresh');
		}
        $this->load->model(['Video']);
        $data['pid']=$this->input->get('pid');
        $data['videos'] = $this->Video->getVideos(self::$limit);
		$this->twig->set($data);
		$this->twig->display('_ajax/videos');
	}

}
