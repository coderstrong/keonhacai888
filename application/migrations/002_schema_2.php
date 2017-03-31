<?php if ( ! defined('BASEPATH')) exit('No direct access allowed');

/**
 * 	Install the initial tables for project:
 *	addresses, banners, categories, countries, coupons, coupons_history,
 *  currencies, customers, customers_activity, customer_groups, extensions,
 *  languages, layouts, layout_routes, locations, location_tables,
 *  mail_templates, mail_templates_data, menus, menus_specials,
 */
class Migration_Schema_2 extends CI_Migration {

	public function up() {
		$this->load->database();

		$this->_tournament();
		$this->_club();
		$this->_fixtures();
		$this->_news_category();
		$this->_news();
		$this->_videos();
		$this->_tips();
		$this->_settings();
		$this->_channels();
		$this->_slider();
		$this->_slider_images();
		//
		$this->insertInitialData();
	}

	public function down() {
		
		$this->dbforge->drop_table('tournament');
		$this->dbforge->drop_table('club');
		$this->dbforge->drop_table('fixtures');
		$this->dbforge->drop_table('news_category');
		$this->dbforge->drop_table('news');
		$this->dbforge->drop_table('videos');
		$this->dbforge->drop_table('tips');
		$this->dbforge->drop_table('settings');
		$this->dbforge->drop_table('channels');
		$this->dbforge->drop_table('slider');
		$this->dbforge->drop_table('slider_images');
	}


	public function _tournament() {
		$fields = array(
			'tournament_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'tournament_name VARCHAR(100) NOT NULL',
			'tournament_slug VARCHAR(100) NOT NULL',
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('tournament');
	}

	public function _club() {
		$fields = array(
			'club_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'club_name VARCHAR(100) NOT NULL',
			'club_slug VARCHAR(100) NOT NULL',
			'image VARCHAR(500) NOT NULL'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('club');
	}

	public function _fixtures() {
		$fields = array(
			'fixtures_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'referent_id VARCHAR(40) NULL',
			'club_home INT(11) NOT NULL',
			'club_away INT(11) NOT NULL',
			'tournament_id INT(11) NOT NULL',
			'fixtures_type INT(11) NOT NULL',
			'fixtures_slug VARCHAR(1000) NOT NULL',
			'time INT(11) NOT NULL',
			'server_0 VARCHAR(1000) DEFAULT NULL',
			'server_1 VARCHAR(1000) DEFAULT NULL',
			'server_2 VARCHAR(1000) DEFAULT NULL',
			'server_3 VARCHAR(1000) DEFAULT NULL',
			'server_4 VARCHAR(1000) DEFAULT NULL',
			'server_5 VARCHAR(1000) DEFAULT NULL',
			'server_6 VARCHAR(1000) DEFAULT NULL',
			'server_7 VARCHAR(1000) DEFAULT NULL',
			'server_8 VARCHAR(1000) DEFAULT NULL',
		  	'auto_sopcast VARCHAR(1000) DEFAULT NULL',
		  	'auto_nowgoal VARCHAR(1000) DEFAULT NULL',
		  	'auto_idsimulator VARCHAR(50) DEFAULT NULL',
			'status TINYINT(1) NOT NULL DEFAULT 1',
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('fixtures');
	}

	public function _news_category() {
		$fields = array(
			'news_category_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'news_category_name VARCHAR(100) NOT NULL',
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('news_category');
	}

	public function _news() {
		$fields = array(
			'news_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'referent_id VARCHAR(40) NULL',
			'news_category_id INT(11) NOT NULL',
			'title VARCHAR(1000) NOT NULL',
			'slug VARCHAR(1000) NOT NULL',
			'image VARCHAR(1000) NOT NULL',
			'description VARCHAR(5000) NOT NULL',
			'content TEXT NOT NULL',
			'date_added INT(11) NOT NULL',
			'date_updated INT(11) NOT NULL',
			'status TINYINT(1) NOT NULL DEFAULT 1',
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('news');
	}

	public function _videos() {
		$fields = array(
			'video_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'referent_id VARCHAR(40) NULL',
			'title VARCHAR(1000) NOT NULL',
			'slug VARCHAR(1000) NOT NULL',
			'image VARCHAR(1000) NOT NULL',
			'content TEXT NOT NULL',
			'date_added INT(11) NOT NULL',
			'date_updated INT(11) NOT NULL',
			'status TINYINT(1) NOT NULL DEFAULT 1',
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('videos');
	}

	public function _tips() {
		$fields = array(
			'tip_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'title VARCHAR(1000) NOT NULL',
			'time INT(11) NOT NULL',
			'experts_predict VARCHAR(200) NOT NULL', // dự đoán chuyên gia
			'score VARCHAR(100) NULL',
			'result_status VARCHAR(100)', // thắng, thua, hòa, chưa diễn ra
			'date_added INT(11) NOT NULL',
			'date_updated INT(11) NOT NULL',
			'status TINYINT(1) NOT NULL DEFAULT 1',
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('tips');
	}

	public function _settings() {
		$fields = array(
			'setting_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'type VARCHAR(50) NULL',
			'item VARCHAR(50) NOT NULL',
			'value TEXT NOT NULL',
			'serialized TINYINT(1) NOT NULL DEFAULT 0'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('settings');
	}

	public function _channels() {
		$fields = array(
			'id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'title VARCHAR(200) NULL',
			'slug VARCHAR(200) NULL',
			'image VARCHAR(500) NULL',
			'content TEXT NOT NULL',
			'status TINYINT(1) NOT NULL DEFAULT 1'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('channels');
	}

	public function _slider() {
		$fields = array(
			'slider_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'postion_id VARCHAR(200) NOT NULL DEFAULT MAIN_SLIDER',
			'name VARCHAR(500) NULL',
			'status TINYINT(1) NOT NULL DEFAULT 1'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('slider');
	}

	public function _slider_images() {
		$fields = array(
			'id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY',
			'slider_id INT(11) NOT NULL',
			'image VARCHAR(500) NOT NULL',
			'click_url VARCHAR(500) NULL',
			'sort INT(11) DEFAULT 0',
			'status TINYINT(1) NOT NULL DEFAULT 1'
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('slider_images');
	}

	protected function insertInitialData() {
		include(APPPATH . '/migrations/initial_schema.php');

		if ( ! empty($insert_menu_data)) {
			$this->db->query($insert_menu_data);
		}

		if ( ! empty($insert_news_category_data)) {
			$this->db->query($insert_news_category_data);
		}
	}

}

/* End of file 001_schema.php */
/* Location: ./setup/migrations/001_schema.php */