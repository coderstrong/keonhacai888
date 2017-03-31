<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends FrontendController {
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
    private static $limit = 13;

	public function __construct()
    {
        parent::__construct();
        
        // Ideally you would autoload the parser
    }

	public function index($date='')
	{
        $this->load->model(['Fixture','News','Tips','Video','Channels']);
        $data['fixtures'] = $this->Fixture->GetListTypeByLimit( ['1',['2','3'],['4','5']] , 10, 0);
        $data['news'] = $this->News->getNews(14, 0, 1);
        $data['nhandinh'] = $this->News->getNews(14, 0, 3);
        $data['tips'] = $this->Tips->getTip(30);

        $data['channels'] = $this->Channels->getChannels(30);
        $data['videos'] = $this->Video->getVideos(20);
        $data['countv'] = sizeof($data['videos']) - 1;
		$this->twig->set($data);
		$this->twig->display('index');
	}

	public function loadfilterajax($date='')
	{
		$tournamentid = $this->input->post('tournamentid');
		$data['livematchs'] = $this->LiveMatch->getLiveMatch(1000, 0, '', $date, $tournamentid);

		$this->twig->set($data);
        $this->twig->display('_ajax/listfixture');
	}

	//authenticated
	public function authenticated()
	{
		if($this->facebook->is_authenticated())
        {
			$user = $this->facebook->request('get', '/me');
			if (!isset($user['error']))
			{
				$this->load->model('ModelCustomer');
				$email = '';
				if(isset($user['email']))
					$email = $user['email'];
			    $Customer = $this->ModelCustomer->loginCustomer($user['id'], $user['name'], $email);
			}
		}
		redirect('/', 'refresh');
	}

	//logout
	public function logout()
	{
		if($this->facebook->is_authenticated())
        {
			$this->session->unset_userdata('is_logged_frontend');
			//session_destroy();
			$this->facebook->destroy_session();
		}
		redirect('/', 'refresh');
	}
}
