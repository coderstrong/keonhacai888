<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Channels extends CI_Model
{
	function getChannels($limit=20, $offset=0)
	{
		$this->db->order_by('id','desc');
		$query = $this->db->get('channels', $limit, $offset);

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
