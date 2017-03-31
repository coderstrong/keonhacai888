<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class News extends CI_Model
{

	function paginationNews($limit, $news_category_id)
	{
		$q = 'tin-tuc';
		switch ($news_category_id) {
			case 1:
				$q = 'tin-tuc';
				break;
			case 3:
				$q = 'nhan-dinh';
				break;
		}

		$ci = get_instance(); // CI_Loader instance
		$this->db->select('news_id');
		$this->db->where('news_category_id', $news_category_id);
		$this->db->from('news');

		$query = $query = $this->db->get();
		$config['base_url'] = $ci->config->item('base_url').'/'.$q.'/page/';
		$config['total_rows'] = $query->num_rows();
		$config['per_page'] = $limit;
		$config['use_page_numbers'] = TRUE;
		$config['num_tag_open'] = '';
		$config['num_tag_close'] = '';
		$config['cur_tag_open'] = '<a class="active" href="javascript:void(0);" title="pagination">';
		$config['cur_tag_close'] = '</a>';
		$config['first_url'] =  $ci->config->item('base_url').'/'.$q.'/page/1'; 
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
	 * Get tin tuc
	 * @param  integer $limit            [description]
	 * @param  integer $offset           [description]
	 * @param  integer $news_category_id default null ; 1 tin tuc ; 3 nhan dinh
	 */
	function getNews($limit=20, $offset=0, $news_category_id = NULL)
	{
		if($news_category_id != NULL)
			$this->db->where('news_category_id', $news_category_id);
		$this->db->from('news');
		$this->db->limit($limit, $offset);
		$this->db->order_by('news_id', 'desc');
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

	function isExist($referent_id)
	{
		$query = $this->db->get_where('news', array('referent_id' => $referent_id), 1, 0);

		if($query -> num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function insertNews($referent_id, $news_category_id, $title, $slug, $image, $description, $content)
	{
		$data = array(
			'referent_id' => $referent_id,
			'news_category_id' => $news_category_id,
			'title' => trim($title),
			'slug' => trim($slug),
			'image' => trim($image),
			'description' => trim($description),
			'content' => trim($content),
			'date_added' => getTimeGMT0(),
			'date_updated' => getTimeGMT0()
		);

		$query = $this->db->insert('news', $data);

		if($query > 0)
		{
			return $referent_id;
		}
		else
		{
			return 'FALSE';
		}
	}

}
