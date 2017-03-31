<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Video extends CI_Model
{
	function getVideos($limit=20, $offset=0)
	{
		$this->db->order_by('video_id','desc');
		$query = $this->db->get('videos', $limit, $offset);

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
