<?php if ( ! defined('BASEPATH')) exit('No direct access allowed');

/**
 * Install the initial data structure for tables:
 *	countries, currencies, customer_groups, extensions,
 *  languages, layout_modules, layout_routes, layouts,
 *  mail_templates, mail_templates_data, pages, permalinks,
 *  permissions, security_questions, settings, staff_groups,
 *  statuses, uri_routes
 */

$insert_menu_data = "REPLACE INTO `".$this->db->dbprefix."menu` (`menu_type`, `menu_code`, `menu_name`, `meta_title`, `meta_description`, `css_icon`, `sort`) 
  VALUES 
  ('main', '', 'TRANG CHỦ', 'Trực tiếp bóng đá - Soi kèo nhà cái - Tips bóng đá chính xác và thông tin thể thao trong ngày', 'Lịch trực tiếp : Giải đấu lớn – Live Full HD Lịch trực tiếp : Giải đấu nhỏ – Videostream HD Lịch trực tiếp – Videostream HD Tin Thể Thao Nhận định trận đấu Videos Bóng Đá – Xem lại các trận đấu Kết quả thi đấu Tips – Dự Đoán', 'fa fa-home icon-red-2', 0) ,

  ('main', 'truc-tiep-bd', 'Trực Tiếp Bóng Đá', 'Trực tiếp bóng đá - Trực tiếp bóng đá', 'Lịch trực tiếp – Giải đấu lớn Lịch trực tiếp – Giải đấu nhỏ Lịch trực tiếp – Videostream HD', 'fa fa-futbol-o', 1) ,

  ('main', 'tips', 'Tips - Dự Đoán', 'Tips - Trực tiếp bóng đá', 'Tips – Dự đoán', 'fa fa-key icon-red', 2) ,

  ('main', 'tin-tuc', 'Tin Thể Thao', 'Tin tức - Trực tiếp bóng đá', 'Tin tức - Trực tiếp bóng đá', 'fa fa-newspaper-o icon-yellow', 3) ,

  ('main', 'nhan-dinh', 'Nhận Định Trận Đấu', 'Nhận định trận đấu - Trực tiếp bóng đá', 'Nhận định trận đấu - Trực tiếp bóng đá', 'fa fa-key icon-red', 4) ,

  ('main', 'live-score', 'Live Score', 'Live score - Trực tiếp bóng đá', 'Live score - Trực tiếp bóng đá', 'fa fa-television', 5) ,

  ('main', 'chat-bong-da', 'Chat Bóng Đá', 'Chát bóng đá - Trực tiếp bóng đá', 'Chát bóng đá - Trực tiếp bóng đá', 'fa fa-commenting-o icon-blue', 6) ,

  ('main', 'keno-bong-ao', 'Chat Keno - Bóng Ảo','Keno bóng ảo - Trực tiếp bóng đá','Keno bóng ảo - Trực tiếp bóng đá','fa fa-comments', 7) , 

  ('main', 'bang-xep-hang', 'Bảng xếp hạng', 'Bảng xếp hạng - Trực tiếp bóng đá', 'Bảng xếp hạng - Trực tiếp bóng đá', 'fa fa-star icon-yellow', 8) , 

  ('main', 'ket-qua-xo-so', 'Kết quả xổ số', 'Kết quả xổ số - Trực tiếp bóng đá', 'Kết quả xổ số - Trực tiếp bóng đá', 'fa fa-dashboard', 9)
  ;";


$insert_layouts_data = "
REPLACE INTO `".$this->db->dbprefix."layouts` (`layout_id`, `name`) VALUES
(1, 'Home');
";

$insert_news_category_data = "
REPLACE INTO `".$this->db->dbprefix."news_category` (`news_category_id`, `news_category_name`) VALUES
(1, 'Tin Thể Thao'),
(3, 'Nhận định Trận Đấu')
;";


$insert_pages_data = "
REPLACE INTO `".$this->db->dbprefix."pages` (`page_id`, `language_id`, `name`, `title`, `heading`, `content`, `meta_description`, `meta_keywords`, `layout_id`, `navigation`, `date_added`, `date_updated`, `status`)
VALUES
(11, 11, 'About Us', 'About Us', 'About Us', '<h3 style=\"text-align: center;\"><span style=\"color: #993300;\">Aim</span></h3>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In venenatis massa ac magna sagittis, sit amet gravida metus gravida. Aenean dictum pellentesque erat, vitae adipiscing libero semper sit amet. Vestibulum nec nunc lorem. Duis vitae libero a libero hendrerit tincidunt in eu tellus. Aliquam consequat ultrices felis ut dictum. Nulla euismod felis a sem mattis ornare. Aliquam ut diam sit amet dolor iaculis molestie ac id nisl. Maecenas hendrerit convallis mi feugiat gravida. Quisque tincidunt, leo a posuere imperdiet, metus leo vestibulum orci, vel volutpat justo ligula id quam. Cras placerat tincidunt lorem eu interdum.</p>\r\n<h3 style=\"text-align: center;\"><span style=\"color: #993300;\">Mission</span></h3>\r\n<p>Ut eu pretium urna. In sed consectetur neque. In ornare odio erat, id ornare arcu euismod a. Ut dapibus sit amet erat commodo vestibulum. Praesent vitae lacus faucibus, rhoncus tortor et, bibendum justo. Etiam pharetra congue orci, eget aliquam orci. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eleifend justo eros, sit amet fermentum tellus ullamcorper quis. Cras cursus mi at imperdiet faucibus. Proin iaculis, felis vitae luctus venenatis, ante tortor porta nisi, et ornare magna metus sit amet enim. Phasellus et turpis nec metus aliquet adipiscing. Etiam at augue nec odio lacinia tincidunt. Suspendisse commodo commodo ipsum ac sollicitudin. Nunc nec consequat lacus. Donec gravida rhoncus justo sed elementum.</p>\r\n<h3 style=\"text-align: center;\"><span style=\"color: #a52a2a;\">Vision</span></h3>\r\n<p>Praesent erat massa, consequat a nulla et, eleifend facilisis risus. Nullam libero mi, bibendum id eleifend vitae, imperdiet a nulla. Fusce congue porta ultricies. Vivamus felis lectus, egestas at pretium vitae, posuere a nibh. Mauris lobortis urna nec rhoncus consectetur. Fusce sed placerat sem. Nulla venenatis elit risus, non auctor arcu lobortis eleifend. Ut aliquet vitae velit a faucibus. Suspendisse quis risus sit amet arcu varius malesuada. Vestibulum vitae massa consequat, euismod lorem a, euismod lacus. Duis sagittis dolor risus, ac vehicula mauris lacinia quis. Nulla facilisi. Duis tristique ipsum nec egestas auctor. Nullam in felis vel ligula dictum tincidunt nec a neque. Praesent in egestas elit.</p>', '', '', 17, 'a:2:{i:0;s:8:\"side_bar\";i:1;s:6:\"footer\";}', '2014-04-19 16:57:21', '2015-05-07 12:39:52', 1);";


$insert_permissions_data = "
REPLACE INTO `".$this->db->dbprefix."permissions` (`permission_id`, `name`, `description`, `action`, `status`)
VALUES
(11, 'Admin.Banners', 'Ability to access, manage, add and delete banners', 'a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}', 1);
";


$insert_settings_data = "
REPLACE INTO `".$this->db->dbprefix."settings` (`setting_id`, `sort`, `item`, `value`, `serialized`) VALUES
(7870, 'prefs', 'mail_template_id', '11', 0),
(8500, 'ratings', 'ratings', 'a:1:{s:7:\"ratings\";a:5:{i:1;s:3:\"Bad\";i:2;s:5:\"Worse\";i:3;s:4:\"Good\";i:4;s:7:\"Average\";i:5;s:9:\"Excellent\";}}', 1),
(9225, 'config', 'site_desc', '', 0),
(9241, 'config', 'search_radius', '20', 0),
(9249, 'config', 'ready_time', '45', 0),
(10836, 'prefs', 'default_location_id', '', 0),
(10839, 'config', 'site_logo', 'data/no_photo.png', 0),
(10840, 'config', 'country_id', '222', 0),
(10841, 'config', 'timezone', 'Europe/London', 0),
(10842, 'config', 'currency_id', '226', 0),
(10843, 'config', 'language_id', '11', 0),
(10844, 'config', 'customer_group_id', '11', 0),
(10845, 'config', 'page_limit', '20', 0),
(10846, 'config', 'meta_description', '', 0),
(10847, 'config', 'meta_keywords', '', 0),
(10848, 'config', 'menus_page_limit', '20', 0),
(10849, 'config', 'show_menu_images', '1', 0),
(10850, 'config', 'menu_images_h', '80', 0),
(10851, 'config', 'menu_images_w', '95', 0),
(10852, 'config', 'special_category_id', '0', 0),
(10853, 'config', 'registration_terms', '1', 0),
(10854, 'config', 'checkout_terms', '0', 0),
(10855, 'config', 'stock_warning', '0', 0),
(10856, 'config', 'stock_qty_warning', '0', 0),
(10857, 'config', 'registration_email', '1', 0),
(10858, 'config', 'customer_order_email', '1', 0),
(10859, 'config', 'customer_reserve_email', '1', 0),
(10860, 'config', 'main_address', 'a:6:{s:9:\"address_1\";s:0:\"\";s:9:\"address_2\";s:0:\"\";s:4:\"city\";s:0:\"\";s:8:\"postcode\";s:0:\"\";s:11:\"location_id\";s:0:\"\";s:10:\"country_id\";s:1:\"1\";}', 1),
(10861, 'config', 'maps_api_key', '', 0),
(10863, 'config', 'distance_unit', 'mi', 0),
(10864, 'config', 'future_orders', '0', 0),
(10865, 'config', 'location_order', '1', 0),
(10866, 'config', 'location_order_email', '0', 0),
(10867, 'config', 'location_reserve_email', '0', 0),
(10868, 'config', 'approve_reviews', '1', 0),
(10869, 'config', 'new_order_status', '11', 0),
(10870, 'config', 'completed_order_status', '15', 0),
(10878, 'config', 'canceled_order_status', '19', 0),
(10871, 'config', 'guest_order', '1', 0),
(10872, 'config', 'delivery_time', '45', 0),
(10873, 'config', 'collection_time', '15', 0),
(10874, 'config', 'reservation_mode', '1', 0),
(10875, 'config',	'new_reservation_status',	'18',	0),
(10876, 'config',	'confirmed_reservation_status',	'16',	0),
(10879, 'config',	'canceled_reservation_status',	'17',	0),
(10880, 'config', 'reservation_time_interval', '45', 0),
(10881, 'config', 'reservation_stay_time', '60', 0),
(10882, 'config', 'image_manager', 'a:11:{s:8:\"max_size\";s:3:\"300\";s:11:\"thumb_width\";s:3:\"320\";s:12:\"thumb_height\";s:3:\"220\";s:7:\"uploads\";s:1:\"1\";s:10:\"new_folder\";s:1:\"1\";s:4:\"copy\";s:1:\"1\";s:4:\"move\";s:1:\"1\";s:6:\"rename\";s:1:\"1\";s:6:\"delete\";s:1:\"1\";s:15:\"transliteration\";s:1:\"0\";s:13:\"remember_days\";s:1:\"7\";}', 1),
(10883, 'config', 'protocol', 'mail', 0),
(10884, 'config', 'mailtype', 'html', 0),
(10885, 'config', 'smtp_host', '', 0),
(10886, 'config', 'smtp_port', '', 0),
(10887, 'config', 'smtp_user', '', 0),
(10888, 'config', 'smtp_pass', '', 0),
(10889, 'config', 'log_threshold', '1', 0),
(10891, 'config', 'customer_online_time_out', '120', 0),
(10892, 'config', 'customer_online_archive_time_out', '0', 0),
(10894, 'config', 'index_file_url', '0', 0),
(10895, 'config', 'permalink', '1', 0),
(10896, 'config', 'maintenance_mode', '0', 0),
(10897, 'config', 'maintenance_message', 'Site is under maintenance. Please check back later.', 0),
(10898, 'config', 'cache_mode', '0', 0),
(10899, 'config', 'cache_time', '0', 0);
";

$insert_staff_groups_data = "
REPLACE INTO `".$this->db->dbprefix."staff_groups` (`staff_group_id`, `staff_group_name`, `location_access`, `permission`) VALUES
(11, 'Administrator', 0, 'a:44:{i:11;a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}i:12;a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}i:13;a:3:{i:0;s:6:\"manage\";i:1;s:3:\"add\";i:2;s:6:\"delete\";}i:14;a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}i:15;a:3:{i:0;s:6:\"manage\";i:1;s:3:\"add\";i:2;s:6:\"delete\";}i:16;a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}i:17;a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}i:18;a:1:{i:0;s:6:\"access\";}i:19;a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}i:20;a:2:{i:0;s:6:\"access\";i:1;s:6:\"delete\";}i:21;a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}i:22;a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}i:25;a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}i:26;a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}i:27;a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}i:28;a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}i:29;a:2:{i:0;s:3:\"add\";i:1;s:6:\"delete\";}i:30;a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}i:32;a:3:{i:0;s:6:\"access\";i:1;s:3:\"add\";i:2;s:6:\"delete\";}i:33;a:3:{i:0;s:6:\"manage\";i:1;s:3:\"add\";i:2;s:6:\"delete\";}i:34;a:2:{i:0;s:3:\"add\";i:1;s:6:\"delete\";}i:35;a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}i:36;a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}i:37;a:2:{i:0;s:3:\"add\";i:1;s:6:\"delete\";}i:39;a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}i:40;a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}i:41;a:2:{i:0;s:6:\"access\";i:1;s:6:\"manage\";}i:42;a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}i:43;a:4:{i:0;s:6:\"access\";i:1;s:6:\"manage\";i:2;s:3:\"add\";i:3;s:6:\"delete\";}i:23;a:3:{i:0;s:6:\"manage\";i:1;s:3:\"add\";i:2;s:6:\"delete\";}i:24;a:3:{i:0;s:6:\"manage\";i:1;s:3:\"add\";i:2;s:6:\"delete\";}i:31;a:3:{i:0;s:6:\"manage\";i:1;s:3:\"add\";i:2;s:6:\"delete\";}i:38;a:1:{i:0;s:6:\"manage\";}i:44;a:2:{i:0;s:6:\"access\";i:1;s:6:\"manage\";}i:45;a:1:{i:0;s:6:\"manage\";}i:46;a:1:{i:0;s:6:\"manage\";}i:47;a:1:{i:0;s:6:\"manage\";}i:48;a:1:{i:0;s:6:\"manage\";}i:49;a:1:{i:0;s:6:\"manage\";}i:50;a:1:{i:0;s:6:\"manage\";}i:51;a:1:{i:0;s:6:\"manage\";}i:52;a:1:{i:0;s:6:\"manage\";}i:53;a:1:{i:0;s:6:\"manage\";}i:54;a:1:{i:0;s:6:\"manage\";}}');
";