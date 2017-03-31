<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageStatic extends FrontendController {
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
        $this->load->model('PageContent');
        // Ideally you would autoload the parser
    }
	public function LoadContent($PageCode = FALSE)
	{
		//get content
		$_data = $this->PageContent->getPageByCode($PageCode);

		$data['staticpage'] = $_data;
		$this->twig->title($_data['title']);
		$this->twig->meta('keywords',$_data['meta_keywords']);
		$this->twig->meta('description',$_data['meta_description']);

		$this->twig->set($data);
		
        $this->twig->display('pagestatic');
	}
}
