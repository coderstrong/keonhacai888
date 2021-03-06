<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UICommon extends CommonController {
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
        $this->load->model('Menu','',TRUE);
    }
	public function generateHeader()
	{
		$this->twig->display('_commons/header');
	}

	public function buildFooter()
	{
		$this->twig->display('_commons/footer');
	}

	public function buildMenu()
	{
		$data['_menus'] = $this->Menu->getMenu(1);
		
		$this->twig->set($data);
		$this->twig->display('_commons/menu');
	}

	public function buildSidebar()
	{
		$data['_menus'] = $this->Menu->getMenu(2);
		$this->twig->set($data);
		$this->twig->display('_commons\sidebar-nav');
	}

	public function buildBreadcrumb()
	{
		$this->twig->display('_commons/breadcrumb');
	}
	
}