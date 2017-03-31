<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Model {

	/**
	 * lay tat ca cac tran dau
	 * @param array integer $fixtures_type loại: 1 main ; 2, 3 bong phu, 4 bong , 5 bong
	 * @param integer $limit         so tran can lay
	 * @param integer $offset        vi tri lay
	 */
	function GetSeting($item_setting = NULL ,$type = NULL)
	{
		$this->db->from('settings s');
		if($type != NULL)
			$this->db->where('type',$type);
		if($item_setting != NULL)
			$this->db->where('item',$item_setting);
		$this->db->select('s.item, s.value, s.serialized');
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

	function Insert($type, $item, $value, $serialized=0)
	{
		$query = 0;
		$_id =$this->IsExist($item);
		$arr_data = array
		(
			'type' => $type,
			'item' => $item,
			'value' => $value,
			'serialized' => $serialized,
			);

		if($_id===FALSE)
		{
			//insert
			$query = $this->db->insert('settings', $arr_data);
			if($query > 0)
			{
				$_id = $this->db->insert_id();
			}
		}
		else
		{
			//update
			$this->db->where('setting_id', $_id);
			$query = $this->db->update('settings', $arr_data);
		}
		return $_id;
	}

	function IsExist($item)
	{
		$this->db->select('setting_id');
		$this->db->from('settings');
		$this->db->where('item' , $item);
		$this->db->limit(1);
		$query = $this->db->get();

		if($query -> num_rows() > 0)
		{
			return $query->unbuffered_row()->setting_id;
		}
		else
		{
			return FALSE;
		}
	}
}

/* End of file Fixture.php */
/* Location: ./application/models/Fixture.php */