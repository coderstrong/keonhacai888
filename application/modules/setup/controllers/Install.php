<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class install extends CommonController {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 
	public function __construct()
    {
        parent::__construct();

        // Ideally you would autoload the parser
    }
	*/
    private static $limit = 13;

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
        $this->load->model('Staffs_model');
        //$this->load->model('Locations_model'); // load the locations model
        $this->load->model('Staff_groups_model');
        $this->load->library('migration');
        // Ideally you would autoload the parser
    }

	public function index()
	{

        if(is_cli())
        {
            if ($this->migration->current() === FALSE)
            {
                show_error($this->migration->error_string());
            }

            $rootinfo = array(
                'staff_name' => 'Joh Tran',
                'staff_email' => 'thao31b@gmail.com',
                'staff_group_id' => '1',
                'staff_location_id' => '0',
                'staff_status' => '1',
                'username' => 'joh',
                'password' => '1q2w3e4r'
            );

            $staff_id = $this->Staffs_model->saveStaff($this->input->get('id'), $rootinfo);

            $rootgroupinfo = array(
                'staff_name' => 'Joh Tran',
                'staff_email' => 'thao31b@gmail.com',
                'staff_group_id' => '1',
                'staff_location_id' => '0',
                'staff_status' => '1',
                'username' => 'joh',
                'password' => '1q2w3e4r'

            );

            $staff_id = $this->Staff_groups_model->saveStaffGroup($this->input->get('id'), $rootgroupinfo);

            

            echo $staff_id;
        }
        else
        {
            echo "hello word!!!";
        }
	}
}
