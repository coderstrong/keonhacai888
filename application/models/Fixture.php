<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fixture extends CI_Model {

	/**
	 * lay tat ca cac tran dau
	 * @param array integer $fixtures_type loại: 1 main ; 2, 3 bong phu, 4 bong , 5 bong
	 * @param integer $limit         so tran can lay
	 * @param integer $offset        vi tri lay
	 */
	function GetList($limit = 20, $offset = 0, $fixtures_type = NULL)
	{
		$this->db->from('fixtures f');
		$this->db->join('tournament t', 'f.tournament_id = t.tournament_id', 'left');
		$this->db->join('club c1', 'f.club_home = c1.club_id', 'left');
		$this->db->join('club c2', 'f.club_away = c2.club_id', 'left');
		$this->db->where('time >', getTimeGMT0() - 7800); //2h10
		$this->db->where('time <', strtotime("+2 day")); //two days
		if($fixtures_type != NULL)
			$this->db->where_in('fixtures_type',$fixtures_type);
		$this->db->order_by('time', 'asc');
		$this->db->limit($limit, $offset);
		$this->db->select('f.*, c1.club_name club_home, c1.image home_image, c2.club_name club_away, c2.image away_image, t.tournament_name');
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return FALSE;
		}
	}

	///$fixtures_type is array type,
	///$limit is limit in a type
	function GetListTypeByLimit($fixtures_type ,$limit = 20, $offset = 0)
	{
		$subqueries = [];
		foreach ($fixtures_type as $type) {
			$this->db->from('fixtures f');
			$this->db->join('tournament t', 'f.tournament_id = t.tournament_id', 'left');
			$this->db->join('club c1', 'f.club_home = c1.club_id', 'left');
			$this->db->join('club c2', 'f.club_away = c2.club_id', 'left');
			$this->db->where('time >', getTimeGMT0() - 7800); //2h10
			//$this->db->where('time <', strtotime("+2 day")); //two days
			$this->db->where_in('fixtures_type', $type);
			$this->db->order_by('time', 'asc');

			$this->db->limit($limit, $offset);
			$this->db->select('f.fixtures_id, f.fixtures_type, f.fixtures_slug, f.time, c1.club_name club_home, c1.image home_image, c2.club_name club_away, c2.image away_image, t.tournament_name');
			$subqueries[] = '(' . $this->db->get_compiled_select() . ')';
		}

		$sql = implode(' UNION ', $subqueries);
		
		// echo $sql; die();
		// or if necessary:
        //$sql = implode(' UNION DISTINCT ', $subqueries);
        
        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return FALSE;
		}
	}

	function GetLiveFixture($fixtures_id)
	{
		$this->db->from('fixtures f');
		// $this->db->join('tournament t', 'f.tournament_id = t.tournament_id', 'left');
		// $this->db->join('club c1', 'f.club_home = c1.club_id', 'left');
		// $this->db->join('club c2', 'f.club_away = c2.club_id', 'left');
		
		$this->db->where('fixtures_id', $fixtures_id); //2h10
		$this->db->where('time >', getTimeGMT0() - 7800); //2h10
		$this->db->where('time <', strtotime("+2 day")); //two days

		// $this->db->select('f.*, c1.club_name club_home, c1.image home_image, c2.club_name club_away, c2.image away_image, t.tournament_name');
		$this->db->select('f.*');
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return FALSE;
		}
	}

	function Insert($referent_id, $club_home, $club_away, $tournament_id, $fixtures_type, $fixtures_slug, $time, $server_0, $server_1, 
		$server_2, $server_3, $server_4, $server_5, $server_6, $server_7, $server_8, $auto_sopcast, $auto_nowgoal, $auto_idsimulator)
	{
		$query = 0;
		$_id =$this->IsExist($referent_id, $fixtures_type);

		$arr_data = array
			(
				'referent_id' => $referent_id,
				'club_home' => $club_home,
				'club_away' => $club_away,
				'tournament_id' => $tournament_id,
				'fixtures_type' => $fixtures_type, //$fixtures_type không truyền sẽ lấy hết truyền [ 1: bóng chính, 2,3 bóng phụ, 4 bóng rổ, 5 tenis ]
				'fixtures_slug' => $fixtures_slug,
				'time' => $time,
				'server_0' => $server_0,
				'server_1' => $server_1,
				'server_2' => $server_2,
				'server_3' => $server_3,
				'server_4' => $server_4,
				'server_5' => $server_5,
				'server_6' => $server_6,
				'server_7' => $server_7,
				'server_8' => $server_8,
				'auto_sopcast' => $auto_sopcast,
				'auto_nowgoal' => $auto_nowgoal,
				'auto_idsimulator' => $auto_idsimulator
			);

		if($_id===FALSE)
		{
			//insert
			$query = $this->db->insert('fixtures', $arr_data);
		}
		else
		{
			//update
			$this->db->where('fixtures_id', $_id);
			$query = $this->db->update('fixtures', $arr_data);
		}

		if($query > 0)
		{
			$_id = $this->db->insert_id();
			return $referent_id;
		}
		else
		{
			return FALSE;
		}
	}

	function IsExist($referent_id, $fixtures_type)
	{
		$this->db->select('fixtures_id');
		$this->db->from('fixtures');
		$this->db->where('referent_id' , $referent_id);
		$this->db->where('fixtures_type' , $fixtures_type);
		$this->db->limit(1);
		$query = $this->db->get();

		if($query -> num_rows() > 0)
		{
			return $query->unbuffered_row()->fixtures_id;
		}
		else
		{
			return FALSE;
		}
	}


	//TOURNAMENT 
	function getAllTour()
	{
		// $this->db->cache_on();
		$this->db->select('tournament_id, tournament_name');
		$this->db->from('tournament');
		
		$query = $this->db->get();

		if($query -> num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return FALSE;
		}
	}

	function getTour()
	{
		$this->db->select('t.tournament_id, tournament_name');
		$this->db->from('fixture as f');
		$this->db->join('tournament as t', 't.tournament_id = f.tournament_id');
		$this->db->where('f.time >', getTimeGMT0() - 7800 ); //2h10
		$this->db->group_by('tournament_name'); 
		$this->db->order_by('tournament_name','asc');
		
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return FALSE;
		}
	}

	function isExistTour($tournament_slug)
	{

		$this->db->select('tournament_id');
		$this->db->where('tournament_slug' , $tournament_slug);
		$this->db->from('tournament');
		$this->db->limit(1);
		$query = $this->db->get();

		if($query -> num_rows() > 0)
		{
			return $query->unbuffered_row()->tournament_id;
		}
		else
		{
			return FALSE;
		}
	}

	function insertTour($tournament)
	{
		$query = 0;
		$tournament_slug = slugify(trim($tournament));
		$_id = $this->isExistTour($tournament_slug);
		if ($_id===FALSE) {
			$data = array(
				'tournament_slug' => $tournament_slug,
				'tournament_name' => $tournament,
			);

			$query = $this->db->insert('tournament', $data);
		}

		if($query > 0)
		{
			return $this->db->insert_id();
		}
		else
		{
			return $_id;
		}
	}


	//TEAM
	function getClub()
	{
		$this->db->select('club_id, club_name');
		$this->db->from('club');
		$this->db->order_by('club_name','asc');
		
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return FALSE;
		}
	}

	function isExistClub($club_slug)
	{
		$this->db->select('club_id');
		$this->db->from('club');
		$this->db->where('club_slug', $club_slug);
		$this->db->limit(1);
		$query = $this->db->get();

		if($query -> num_rows() > 0)
		{
			return $query->unbuffered_row()->club_id;
		}
		else
		{
			return FALSE;
		}
	}

	function insertClub($club_name, $image)
	{
		$query = 0;
		$club_slug = slugify(trim($club_name));
		$_id = $this->isExistClub($club_slug);
		if($_id===FALSE)
		{
			$data = array(
				'club_slug' => $club_slug,
				'club_name' => $club_name
			);
			if(isset($image))
			{
				$data['image'] = $image;
			}

			$query = $this->db->insert('club', $data);
		}

		if($query > 0)
		{
			return $this->db->insert_id();;
		}
		else
		{
			return $_id;
		}
	}

}

/* End of file Fixture.php */
/* Location: ./application/models/Fixture.php */