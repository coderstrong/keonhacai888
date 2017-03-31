<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Tips extends CI_Model
{
	/**
	 * Get tips
	 * @param  integer $limit            [description]
	 * @param  integer $offset           [description]
	 */
	function getTip($limit=100, $offset=0)
	{
		$this->db->order_by('time','desc');
		$this->db->from('tips');
		// $this->db->where('time >', strtotime("-2 day")); //2h10
		// $this->db->where('time <', strtotime("+2 day")); //two days
		//$this->db->limit($limit, $offset);
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

}
