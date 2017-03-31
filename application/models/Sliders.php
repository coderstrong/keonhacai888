<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Sliders extends CI_Model
{
	function getSlider($postion = 'MAIN_SLIDER', $limit=20, $offset=0)
	{
		$this->db->order_by('sort','desc');
		$this->db->from('slider s');
		$this->db->where('s.postion_id', $postion); //2h10
		$this->db->join('slider_images si', 'si.slider_id = s.slider_id', 'left');
		$this->db->select('si.*');
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
