<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Dealer extends CI_Model
{
	function getList($limit=50, $offset=0)
	{
		$this->db->order_by('sort','asc');
		$this->db->where('status', 1);
		$query = $this->db->get('dealer', $limit, $offset);

		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return FALSE;
		}
	}

}
