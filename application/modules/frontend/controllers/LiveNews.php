<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LiveNews extends FrontendController {
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
    private static $limit = 25;
    private static $cate_tintuc = 1;
    private static $cate_nhandinh = 3;

    public function __construct()
    {
    	parent::__construct();
        $this->load->library('pagination');
        // Ideally you would autoload the parser
    }

    public function index()
    {
    	$this->load->model(['News']);
    	$data['news'] = $this->News->getNews(self::$limit, 0, 1);
    	$this->twig->set($data);
    	$this->twig->display('listnews');
    }

    public function tintuc($obj=NULL, $slug = NULL)
    {
        $this->load->model(['News']);
        $page = 1;
        if ($obj!=NULL && $slug!=NULL) {
            $data['idactive'] = $obj;
        }
        else if($obj!=NULL && $slug==NULL) {
            $page = $obj;
        }

        $config = $this->News->paginationNews(self::$limit, self::$cate_tintuc);
        //$config['display_pages'] = TRUE;
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $offset =  self::$limit * ($page-1);
        $data['news'] = $this->News->getNews(self::$limit, $offset, self::$cate_tintuc);

        $this->twig->set($data);
        $this->twig->display('listnews');
    }

    public function nhandinh($obj=NULL, $slug = NULL)
    {
        $this->load->model(['News']);
        $page = 1;
        if ($obj!=NULL && $slug!=NULL) {
            $data['idactive'] = $obj;
        }
        else if($obj!=NULL && $slug==NULL) {
            $page = $obj;
        }

        $config = $this->News->paginationNews(self::$limit, self::$cate_nhandinh);
        //$config['display_pages'] = TRUE;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $offset =  self::$limit * ($page-1);
        $data['news'] = $this->News->getNews(self::$limit, $offset, self::$cate_nhandinh);

        $this->twig->set($data);
        $this->twig->display('listnews');
    }

    public function livedetail($fixture_id, $slug)
    {
    	$this->load->model('News');
    	$match = $this->News->getNews($fixture_id);

    	$data['serverid'] = -1;
    	if($match!==FALSE)
    	{
    		$this->twig->title()->prepend($slug);

    		$data['servers'] = array(
    			0 => trim($match['server_0']) ,
    			1 => trim($match['server_1']) ,
    			2 => trim($match['server_2']) ,
    			3 => trim($match['server_3']) ,
    			4 => trim($match['server_4']) ,
    			5 => trim($match['server_5']) ,
    			6 => trim($match['server_6']) ,
    			7 => trim($match['server_7']) ,
    			8 => trim($match['server_8'])
    			);
    		for ($i=0; $i < sizeof($data['servers']); $i++) {

    			if($data['servers'][$i] !='' && $data['servers'][$i] !=NULL)
    			{
    				$data['serverid'] = $i;
    				break;
    			}

    		}
    		$data['livefixture'] = $match;
    	}
    	$this->twig->set($data);
    	$this->twig->display('detailTranDau');
    }

    public function livedetailbyserver($fixture_id, $serverid, $slug)
    {
    	$this->load->model('Fixture');
    	$match = $this->Fixture->GetLiveFixture($fixture_id);
    	$data['serverid'] = $serverid;
    	if($match!==FALSE)
    	{
    		$this->twig->title()->prepend($slug);

    		$data['servers'] = array(
    			0 => trim($match['server_0']) ,
    			1 => trim($match['server_1']) ,
    			2 => trim($match['server_2']) ,
    			3 => trim($match['server_3']) ,
    			4 => trim($match['server_4']) ,
    			5 => trim($match['server_5']) ,
    			6 => trim($match['server_6']) ,
    			7 => trim($match['server_7']) ,
    			8 => trim($match['server_8'])
    			);
    		$data['livefixture'] = $match;
    	}
    	$this->twig->set($data);
    	$this->twig->display('detailTranDau');
    }

}
