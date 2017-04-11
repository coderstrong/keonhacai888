<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LiveTips extends FrontendController {
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

    private static $limit = 50;

    public function __construct()
    {
    	parent::__construct();
    	$this->load->library('pagination');
    	$this->load->model(['Tips']);
        // Ideally you would autoload the parser
    }

    public function index()
    {
    	$data['tips'] = $this->Tips->getTip(self::$limit, 0);
    	$this->twig->set($data);
    	$this->twig->display('tips');
    }

    public function tips($obj=NULL)
    {
        $page = 1;
        if($obj!=NULL) {
            $page = $obj;
        }

        $config = $this->Tips->paginationTips(self::$limit);
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $offset =  self::$limit * ($page-1);
        $data['tips'] = $this->Tips->getTip(self::$limit, $offset);

        $this->twig->set($data);
        $this->twig->display('tips');
    }
}
