<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manager extends BackendController {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper(['url','io']);
		$this->load->library('grocery_CRUD');
	}

	public function menus()
	{
		try
		{
			$arr_fa_css = array(
				'fa fa-home icon-red-2' => 'red home', 'fa fa-futbol-o' => 'ball',
				'fa fa-key icon-red' => 'red key' , 'fa fa-newspaper-o icon-yellow' => 'yellow newspaper',
				'fa fa-television' => 'television', 'fa fa-commenting-o icon-blue' => 'blue commenting',
				'fa fa-comments' => 'comment', 'fa fa-star icon-yellow' => 'yellow start', 
				'fa fa-dashboard' => 'dashboard',
				'fa fa-lightbulb-o' => 'tips',
				'fa fa-television' => 'tivi',
				);

			$crud = new grocery_CRUD();
			$crud->set_table('menu');
			$crud->set_subject('Quản lý menu');
			$crud->set_primary_key('menu_id','menu');
			$crud->required_fields('menu_id', 'menu_type_id');
			$crud->set_relation('parent_id','menu','menu_code');

			$crud->add_fields('parent_id','menu_type','menu_code','menu_name','meta_title','meta_description','css_icon','sort','status');
			$crud->edit_fields('parent_id','menu_type','menu_code','menu_name','meta_title','meta_description','css_icon','sort','status');
			$crud->field_type('menu_type','enum', array('main','footer'), 'main');
			$crud->field_type('css_icon','dropdown', $arr_fa_css);
			
			$crud->columns('parent_id','menu_type','menu_code','menu_name','sort');
			$crud->display_as('parent_id','Parent');
			$crud->display_as('menu_type','Loại');
			$crud->unset_jquery();
			$output = $crud->render();
			$array = json_decode(json_encode($output), true);
			
			$this->twig->set($array);
			$this->twig->display('managercrud');
		}
		catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function banner()
	{
		try
		{
			$arr_fa_css = array(
				'fa fa-home icon-red-2' => 'red home', 'fa fa-futbol-o' => 'ball',
				'fa fa-key icon-red' => 'red key' , 'fa fa-newspaper-o icon-yellow' => 'yellow newspaper',
				'fa fa-television' => 'television', 'fa fa-commenting-o icon-blue' => 'blue commenting',
				'fa fa-comments' => 'comment', 'fa fa-star icon-yellow' => 'yellow start', 
				'fa fa-dashboard' => 'dashboard',
				);

			$crud = new grocery_CRUD();
			$crud->set_table('menu');
			$crud->set_subject('Quản lý menu');
			$crud->set_primary_key('menu_id','menu');
			$crud->required_fields('menu_id', 'menu_type_id');
			$crud->set_relation('parent_id','menu','menu_code');

			$crud->add_fields('parent_id','menu_type','menu_code','menu_name','meta_title','meta_description','css_icon','sort','status');
			$crud->edit_fields('parent_id','menu_type','menu_code','menu_name','meta_title','meta_description','css_icon','sort','status');
			$crud->field_type('menu_type','enum', array('main','footer'));
			$crud->field_type('css_icon','dropdown', $arr_fa_css);
			
			$crud->columns('parent_id','menu_type','menu_code','menu_name','sort');
			$crud->display_as('parent_id','Parent');
			$crud->display_as('menu_type','Loại');
			$crud->unset_jquery();
			$output = $crud->render();
			$array = json_decode(json_encode($output), true);
			
			$this->twig->set($array);
			$this->twig->display('managercrud');

		}
		catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}


	public function tips()
	{
		try
		{
			$arr_result_status = array(
				'win'=>'Thắng',
				'lose'=>'Thua',
				'draw'=>'Hòa',
				'none'=>'Chưa diễn ra'
				);

			$crud = new grocery_CRUD();
			$crud->set_table('tips');
			$crud->set_subject('Quản lý tips - dự đoán');
			$crud->set_primary_key('tip_id','tips');

			$crud->add_fields('title','time','experts_predict','score','result_status','status');
			$crud->edit_fields('title','time','experts_predict','score','result_status','status');
			$crud->field_type('result_status','dropdown', $arr_result_status, 'none');
			$crud->field_type('time','datetime');

			$crud->callback_edit_field('time',array($this,'edit_time_field_callback'));
			$crud->callback_insert(array($this,'covert_time_and_insert_callback'));
			$crud->callback_update(array($this,'covert_time_and_update_callback'));

			$crud->columns('title','experts_predict','score','result_status');
			$crud->display_as('experts_predict','Dự đoán chuyên gia');
			$crud->display_as('score','Tỉ số');
			$crud->display_as('result_status','Kết quả');

			$crud->unset_jquery();
			$output = $crud->render();
			$array = json_decode(json_encode($output), true);
			
			$this->twig->set($array);
			$this->twig->display('managercrud');

		}
		catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}


	public function pagestatic()
	{
		try{
			$crud = new grocery_CRUD();
			
			$crud->set_table('pages');
			$crud->set_subject('Trang Tĩnh');
			$crud->set_primary_key('page_id','Page');
			$crud->required_fields('page_id');
			$crud->columns('page_id','title', 'meta_keywords', 'meta_description','status');

			$crud->add_fields('page_id', 'title', 'content', 'status');
			$crud->edit_fields('page_id', 'title' , 'content', 'status');

			$crud->display_as('page_id','Menu Code');

			$crud->set_relation('page_id','menu','menu_code');

			$output = $crud->render();
			$array = json_decode(json_encode($output), true);

			$this->twig->set($array);
			$this->twig->display('managercrud');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function videos()
	{
		try{
			$crud = new grocery_CRUD();
			
			$crud->set_table('videos');
			$crud->set_subject('Video');
			$crud->set_primary_key('video_id','videos');
			$crud->required_fields('video_id');
			$crud->columns('title', 'image', 'content','status');

			$crud->set_field_upload('image', GenerateUploadFolder('thumbvideos'));
			$crud->add_fields('title', 'image', 'content', 'status');
			$crud->edit_fields('title',  'image', 'content', 'status');
			$crud->callback_after_insert(array($this, 'covert_video_slug_after_callback'));
			$crud->callback_after_update(array($this, 'covert_video_slug_after_callback'));
			$crud->display_as('image','thumb');
			$output = $crud->render();
			$array = json_decode(json_encode($output), true);

			$this->twig->set($array);
			$this->twig->display('managercrud');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function channels()
	{
		try{
			$crud = new grocery_CRUD();
			
			$crud->set_table('channels');
			$crud->set_subject('Kênh');
			$crud->set_primary_key('id','channels');
			$crud->required_fields('id');
			$crud->columns('title', 'image', 'content','status');

			$crud->set_field_upload('image', GenerateUploadFolder('thumbchanels'));
			$crud->add_fields('title', 'image', 'content', 'status');
			$crud->edit_fields('title',  'image', 'content', 'status');
			$crud->callback_after_insert(array($this, 'covert_channel_slug_after_callback'));
			$crud->callback_after_update(array($this, 'covert_channel_slug_after_callback'));
			$crud->display_as('image','thumb');
			$output = $crud->render();
			$array = json_decode(json_encode($output), true);

			$this->twig->set($array);
			$this->twig->display('managercrud');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function position()
	{
		try{
			$crud = new grocery_CRUD();
			
			$crud->set_table('position');
			$crud->set_subject('Vị trí hiển thị');
			$crud->set_primary_key('position_id','position');
			$crud->required_fields('position_id');
			$crud->columns('position_id', 'name','status');

			$output = $crud->render();
			$array = json_decode(json_encode($output), true);

			$this->twig->set($array);
			$this->twig->display('managercrud');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function banners()
	{
		try{
			$crud = new grocery_CRUD();
			
			$crud->set_table('banners');
			$crud->set_subject('Quảng cáo');
			$crud->set_primary_key('banner_id','banners');
			$crud->required_fields('banner_id');
			$crud->required_fields('position_id');
			$crud->set_relation('position_id','position','name');
			$crud->columns('position_id', 'name','click_url','sort','status');
			$crud->add_fields('position_id', 'name','click_url', 'content', 'sort','status');
			$crud->edit_fields('position_id',  'name', 'click_url','content','sort', 'status');

			$output = $crud->render();
			$array = json_decode(json_encode($output), true);

			$this->twig->set($array);
			$this->twig->display('managercrud');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function slider()
	{
		try{
			$crud = new grocery_CRUD();
			
			$crud->set_table('slider_images');
			$crud->set_subject('Main Slider');
			$crud->set_primary_key('id','slider_images');
			$crud->required_fields('id');
			$crud->set_field_upload('image', GenerateUploadFolder('thumbchanels'));
			$crud->columns('image', 'click_url','sort','status');
			$crud->add_fields('image', 'click_url','sort','status');
			$crud->edit_fields('image', 'click_url','sort','status');
			
			$output = $crud->render();
			$array = json_decode(json_encode($output), true);

			$this->twig->set($array);
			$this->twig->display('managercrud');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}



	public function settings()
	{
		try{
			$crud = new grocery_CRUD();
			
			$arr_setting_type = array(
				'win'=>'Thắng',
				'lose'=>'Thua',
				'draw'=>'Hòa',
				'none'=>'Chưa diễn ra'
				);

			$crud->set_table('settings');
			$crud->set_subject('Cấu hình site');
			$crud->set_primary_key('setting_id','slider_images');
			$crud->required_fields('setting_id');
			$crud->columns('type', 'item','serialized');
			$crud->add_fields('type', 'item','value','serialized');
			$crud->edit_fields('type', 'item','value','serialized');
			
			$crud->field_type('type','dropdown', $arr_setting_type, 'none');

			$output = $crud->render();
			$array = json_decode(json_encode($output), true);

			$this->twig->set($array);
			$this->twig->display('managercrud');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function dealer()
	{
		try{
			$crud = new grocery_CRUD();
			
			$crud->set_table('dealer');
			$crud->set_subject('Top nhà cái');
			$crud->set_primary_key('id','dealer');
			$crud->required_fields('id');
			$crud->set_field_upload('image', GenerateUploadFolder('thumbchanels'));
			$crud->set_field_upload('point', GenerateUploadFolder('thumbchanels'));
			$crud->columns('name', 'image','sort','status');
			
			$output = $crud->render();
			$array = json_decode(json_encode($output), true);

			$this->twig->set($array);
			$this->twig->display('managercrud');

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function managersystemuser()
	{
		try{
			//$sess = $this->session->userdata('user_info');
			$crud = new grocery_CRUD();
			$crud->set_table('users');
			$crud->set_subject('User Manager');
			$crud->set_primary_key('user_id','user_id');
			$crud->required_fields('user_id');
			$crud->fields('staff_id','username', 'password', 'verify_password');
			$crud->columns('username','password');
			$crud->change_field_type('password', 'password');
			$crud->change_field_type('verify_password', 'password');
			$crud->set_rules('password', 'Verify Password', 'trim|required');
			$crud->set_rules('verify_password', 'Verify Password', 'trim|required|matches[password]');
			$crud->field_type('staff_id', 'hidden');
			$crud->unset_add();
			$crud->unset_delete();
			$crud->callback_field('password',array($this,'password_empty_callback'));
			$crud->callback_update(array($this,'encrypt_password_and_update_callback'));

			$output = $crud->render();
			$array = json_decode(json_encode($output), true);

			$this->twig->set($array);
			$this->twig->display('managercrud');


		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	function encrypt_password_and_update_callback($post_array) {

		$this->load->model('Staffs_model');

		$rootinfo = array(
			'username' => $post_array['username'],
			'password' => $post_array['password'],
			'staff_status' => '1'
			);

		$staff_id = $this->Staffs_model->saveStaff($post_array['staff_id'], $rootinfo);
		
		return $staff_id;
	}

	function password_empty_callback($value = '', $primary_key = null) {

		$html = '<div class="form-line"><input id="field-password" class="form-control" name="password" type="password" value="" maxlength="40"></div>';
		return $html;
	}

	function edit_time_field_callback($value, $primary_key)
	{
		$input = '<link rel="stylesheet" href="'. base_url() .'grocery_crud/plugins/datepicker/bootstrap-datetimepicker.min.css">';
		$input .= '<script type="text/javascript" src="'. base_url() .'grocery_crud/plugins/datepicker/moment.min.js"></script>';
		$input .= '<script type="text/javascript" src="'. base_url() .'grocery_crud/plugins/datepicker/bootstrap-datetimepicker.min.js"></script>';
		$input .= '<script type="text/javascript" src="'. base_url() .'grocery_crud/plugins/datepicker/bootstrap-datetimepicker.config.js"></script>';
		$input .= '<div class="form-line">';
		$input .= "<input id='field-time' name='time' type='text' value='".Time_GMT0toDate_GMT7($value)."' maxlength='19' class='form-control datetimepicker'/>";
		$input .= '</div>';
		return $input;
	}

	function covert_time_and_insert_callback($post_array) {

		$post_array['time'] = GMT7toGMT0($post_array['time']);

		return $this->db->insert('tips',$post_array);
	}

	function covert_video_slug_after_callback($post_array, $primary_key) {
		$dataupdate  = array(
			'slug' => slugify($post_array['title']),
			'date_added' => getTimeGMT0(),
			'date_updated' => getTimeGMT0(),
		 );
		return $this->db->update('videos',$dataupdate,array('video_id' => $primary_key));
	}

	function covert_channel_slug_after_callback($post_array, $primary_key) {
		$dataupdate  = array(
			'slug' => slugify($post_array['title'])
		 );
		return $this->db->update('channels',$dataupdate,array('id' => $primary_key));
	}

	function covert_time_and_update_callback($post_array, $primary_key) {

		$post_array['time'] = GMT7toGMT0($post_array['time']);

		return $this->db->update('tips',$post_array,array('tip_id' => $primary_key));
	} 
}