<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ManagerLinks extends BackendController {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->model('UserSystem','',TRUE);
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
	}

	public function categorylink()
	{
		try{
			$crud = new grocery_CRUD();
			
			$crud->set_table('LinkCategory');
			$crud->set_subject('Quản lý loại liên kết');
			$crud->set_primary_key('LinkCategoryId','LinkCategory');
			$crud->required_fields('LinkCategoryId');
			$crud->columns('Icon','Name');
			$crud->set_field_upload('Icon','uploads/images');

			$output = $crud->render();
			$array = json_decode(json_encode($output), true);
			//var_dump($array);

			$this->twig->set($array);
			$this->twig->display('managercrud');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function Tournamentmanagement()
	{
		try{
			$crud = new grocery_CRUD();
			
			$crud->set_table('Tournament');
			$crud->set_subject('Quản lý lịch');
			$crud->set_primary_key('TournamentId','LinkCategory');
			$crud->required_fields('TournamentId');
			$crud->columns('TournamentId','Tournament_name');

			$output = $crud->render();
			$array = json_decode(json_encode($output), true);
			//var_dump($array);

			$this->twig->set($array);
			$this->twig->display('managercrud');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function Teammanagement()
	{
		try{
			$crud = new grocery_CRUD();
			
			$crud->set_table('Team');
			$crud->set_subject('Quản lý đội');
			$crud->set_primary_key('TeamId','Team');
			$crud->required_fields('TeamId');
			$crud->columns('TeamName','Image');
			$crud->set_field_upload('Image','uploads/images');

			$output = $crud->render();
			$array = json_decode(json_encode($output), true);
			//var_dump($array);

			$this->twig->set($array);
			$this->twig->display('managercrud');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function livematchs()
	{
		try{
			$this->load->model('LiveMatch');
			$data['result'] = $this->LiveMatch->getLiveMatch(1000, 0, '');
			$this->twig->set($data);
			$this->twig->display('livematchlist');
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function addlinks($LiveMatchId)
	{
		try{
			$this->load->model('LiveMatch');
			$data['result'] = $this->LiveMatch->getLiveMatch(1000, 0, '');
			$this->twig->set($data);
			$this->twig->display('linksform');
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function addlivematch()
	{
		try{
			$this->load->model('LiveMatch');
			if(isPost())
			{
				$TeamHomeId = $this->input->post('TeamHomeId');
				$TeamAwayId = $this->input->post('TeamAwayId');
				$StartDate = $this->input->post('StartDate');
				$TournamentId = $this->input->post('TournamentId');
				$LiveMatchTypeId = 1;//$this->input->post('LiveMatchTypeId');
				$server_0 = $this->input->post('server_0');
				$server_1 = $this->input->post('server_1');
				$server_2 = $this->input->post('server_2');
				$server_3 = $this->input->post('server_3');
				$server_4 = $this->input->post('server_4');
				$server_5 = $this->input->post('server_5');
				$server_6 = $this->input->post('server_6');
				$server_7 = $this->input->post('server_7');
				$server_8 = $this->input->post('server_8');

				$auto_sopcast = $this->input->post('auto_sopcast');
				$auto_nowgoal = $this->input->post('auto_nowgoal');
				$auto_idsimulator = $this->input->post('auto_idsimulator');
				$type = $this->input->post('type') == 'on';
				$Slug = $this->LiveMatch->getTeamSlug($TeamHomeId,$TeamAwayId);
				$LiveMatchId = $this->LiveMatch->insertManualLiveMatch($Slug, $TeamHomeId, $TeamAwayId, $StartDate, $TournamentId, $LiveMatchTypeId, $server_0,$server_1,$server_2,$server_3,$server_4,$server_5,$server_6,$server_7,$server_8,$auto_sopcast,$auto_nowgoal,$auto_idsimulator,$type);

				if($LiveMatchId!='FALSE')
				{
					if($LiveMatchId>0)
						redirect('/backend/ManagerLinks/editlivematch/'.$LiveMatchId, 'refresh');
				}
				else
				{
					$this->twig->set('dberror', 'Insert failt' ,TRUE);
				}
				
			}

			$data['categorylinks'] = $this->LiveMatch->getCategoryLinks();
			$data['tournaments'] = $this->LiveMatch->getAllTournaments();
			$data['teams'] = $this->LiveMatch->getTeam();
			$this->twig->set($data);
			$this->twig->display('livematchform');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function createSlug($TeamHomeId, $TeamAwayId)
	{
		
	}


	public function editlivematch($LiveMatchId)
	{
		try{
			$this->load->model('LiveMatch');
			if(isPost())
			{
				$TeamHomeId = $this->input->post('TeamHomeId');
				$TeamAwayId = $this->input->post('TeamAwayId');
				$StartDate = $this->input->post('StartDate');
				$TournamentId = $this->input->post('TournamentId');
				$LiveMatchTypeId = 1;//$this->input->post('LiveMatchTypeId');
				$server_0 = $this->input->post('server_0');
				$server_1 = $this->input->post('server_1');
				$server_2 = $this->input->post('server_2');
				$server_3 = $this->input->post('server_3');
				$server_4 = $this->input->post('server_4');
				$server_5 = $this->input->post('server_5');
				$server_6 = $this->input->post('server_6');
				$server_7 = $this->input->post('server_7');
				$server_8 = $this->input->post('server_8');
				
				$auto_sopcast = $this->input->post('auto_sopcast');
				$auto_nowgoal = $this->input->post('auto_nowgoal');
				$auto_idsimulator = $this->input->post('auto_idsimulator');
				$type = $this->input->post('type') == 'on';
				$Slug = $this->LiveMatch->getTeamSlug($TeamHomeId,$TeamAwayId);
				$query = $this->LiveMatch->insertManualLiveMatch($Slug, $TeamHomeId, $TeamAwayId, $StartDate, $TournamentId, $LiveMatchTypeId, $server_0,$server_1,$server_2,$server_3,$server_4,$server_5,$server_6,$server_7,$server_8,$auto_sopcast,$auto_nowgoal,$auto_idsimulator,$type,$LiveMatchId);
				if($query=='FALSE')
				{
					$this->twig->set('dberror', 'Invalid username or password' ,TRUE);
				}
			}

			$data['result'] = $this->LiveMatch->getRawLiveMatchById($LiveMatchId);
			$data['links'] = $this->LiveMatch->getLinksMatchById($LiveMatchId);
			$data['categorylinks'] = $this->LiveMatch->getCategoryLinks();
			$data['tournaments'] = $this->LiveMatch->getAllTournaments();
			$data['teams'] = $this->LiveMatch->getTeam();
			$this->twig->set($data);
			$this->twig->display('livematchform');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function ajaxaddlinks()
	{
		try{
			$this->load->model('LiveMatch');
			if(isPost())
			{
				$LiveMatchId = $this->input->post('livematchid');
				$linkid = $this->input->post('linkid');
				$cate_value = $this->input->post('cate_value');
				$link_value = $this->input->post('link_value');
				$rate_value = $this->input->post('rate_value');
				$speed_value = $this->input->post('speed_value');
				
				echo $query = $this->LiveMatch->insertLinksLiveMatch($linkid, $LiveMatchId,$cate_value, $link_value, $speed_value, $rate_value);
				die;
			}
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function ajaxremovelinks()
	{
		try{
			$this->load->model('LiveMatch');
			if(isPost())
			{
				$linkid = $this->input->post('linkid');
				
				echo $query = $this->LiveMatch->deleteLink($linkid);
				die;
			}
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function ajaxhiddematch()
	{
		try{
			$this->load->model('LiveMatch');
			if(isPost())
			{
				$linkid = $this->input->post('linkid');
				
				echo $query = $this->LiveMatch->updateStatus($linkid, 0);
				die;
			}
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function ajaxshowmatch()
	{
		try{
			$this->load->model('LiveMatch');
			if(isPost())
			{
				$linkid = $this->input->post('linkid');
				
				echo $query = $this->LiveMatch->updateStatus($linkid, 1);
				die;
			}
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function links($LiveMatchId='')
	{
		try{
			$this->load->model('LiveMatch');
			$match = $this->LiveMatch->getLiveMatchById($LiveMatchId);
			if( $match!=null )
			{
				$crud = new grocery_CRUD();
			
				$crud->set_table('Links');
				$crud->set_subject(' Links for: '. $match->TeamHome_name .' vs '.$match->TeamAway_name);
				$crud->set_primary_key('LinkId','Links');
				$crud->where('Links.LiveMatchId', $LiveMatchId);
				$crud->columns('Link','Status');
				$crud->set_relation('LinkCategoryId','LinkCategory','Name');
				$crud->display_as('LinkCategoryId','Type');
				$crud->add_fields('LiveMatchId','LinkCategoryId','Link','Speed','Rate','Status');
				$crud->edit_fields('LinkCategoryId','Link','Speed','Rate','Status');
 
				$crud->set_field_upload('Icon','uploads/images');
				$crud->field_type('LiveMatchId', 'hidden', $LiveMatchId);

				$output = $crud->render();
				$array = json_decode(json_encode($output), true);
				$this->twig->set($array);
			}
			
			$this->twig->display('managercrud');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	
}