<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Tips extends CI_Model
{

	function paginationTips($limit)
	{
		$ci = get_instance(); // CI_Loader instance
		$this->db->select('tip_id');
		$this->db->from('tips');

		$query = $query = $this->db->get();
		$config['base_url'] = $ci->config->item('base_url').'/tips/page/';
		$config['total_rows'] = $query->num_rows();
		$config['per_page'] = $limit;
		$config['use_page_numbers'] = TRUE;
		$config['num_tag_open'] = '';
		$config['num_tag_close'] = '';
		$config['cur_tag_open'] = '<a class="active" href="javascript:void(0);" title="pagination">';
		$config['cur_tag_close'] = '</a>';
		$config['first_url'] =  $ci->config->item('base_url').'/tips/page/1'; 
		$config['first_link'] = '&laquo;';
		$config['first_tag_open'] = '';
		$config['first_tag_close'] = '';
		$config['last_link'] = '&raquo;';
		$config['last_tag_open'] = '';
		$config['last_tag_close'] = '';
		$config['next_link'] = FALSE;
		$config['prev_link'] = FALSE;

		return $config;
	}

	/**
	 * Get tips
	 * @param  integer $limit            [description]
	 * @param  integer $offset           [description]
	 */
	function getTip($limit=50, $offset=0)
	{
		$this->db->order_by('time','desc');
		$this->db->from('tips');
		// $this->db->where('time >', strtotime("-2 day")); //2h10
		// $this->db->where('time <', strtotime("+2 day")); //two days
		$this->db->limit($limit, $offset);
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
