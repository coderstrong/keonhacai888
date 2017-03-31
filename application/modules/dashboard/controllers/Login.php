<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends BackendController {
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
	*/
	public function __construct()
    {
        parent::__construct();
        // Ideally you would autoload the parser
    }
	
    //login
	public function index()
	{
		
		if(!isPost())
		{
			$data['isshow'] = 'hidden';
			$data['redirect'] =  $this->input->get('redirect');
			$this->twig->set($data);
		}else {
			
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			//This method will have the credentials validation
			$this->form_validation->set_rules('username', 'username', 'trim|required|min_length[3]|max_length[30]|xss_clean');
			$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]|max_length[255]|xss_clean');
			if($this->form_validation->run() == TRUE)
			{
				$username = $this->input->post('username');
				$password = $this->input->post('password');

				$result = $this->user->login($username, $password);

				if($result)
				{

					redirect($this->input->post('redirect'), 'refresh');
				}
				else
				{
					$this->twig->set('dberror', 'Invalid username or password' ,TRUE);
				}
			} 
		}
		$this->twig->display('_layouts/login');
		// Catch the user's answer
		//$captcha_answer = $this->input->post('g-recaptcha-response');

		// Verify user's answer
		//$response = $this->recaptcha->verifyResponse($captcha_answer);

		// Processing ...
		//if ($response['success']) {
		    // Your success code here
		//} else {
		    // Something goes wrong
		    //var_dump($response);
		//}
	}


	// change password
	public function changePassword()
	{
		if(!isPost())
		{
			$data['isshow'] = 'hidden';
			$this->twig->set($data);
		}else {

			//This method will have the credentials validation
			$this->form_validation->set_rules('opassword', 'Old Password', 'trim|required|min_length[3]|max_length[30]|xss_clean');
			$this->form_validation->set_rules('npassword', 'New Password', 'trim|required|matches[rpassword]|min_length[6]|max_length[30]|xss_clean');
			$this->form_validation->set_rules('rpassword', 'Confirm Password', 'trim|required|min_length[6]|max_length[30]|xss_clean');
			if($this->form_validation->run() == TRUE)
			{
				$opassword = $this->input->post('opassword');
				$npassword = $this->input->post('npassword');
				$rpassword = $this->input->post('rpassword');

				$sess = $this->session->userdata('is_logged_backend');

				if($sess!=null)
				{
					$result = $this->UserSystem->updateAdmin($opassword, $npassword, $sess['id']);

					if($result)
					{
						$this->session->unset_userdata('is_logged_backend');
						session_destroy();
						redirect('dashboard', 'refresh');
					}
					else
					{
						$this->twig->set('dberror', 'Invalid password' ,TRUE);
					}
				}else{
					$this->twig->set('dberror', 'Invalid Session' ,TRUE);
				}
				
				//Go to private area
			} 
		}
		$this->twig->display('_layouts/changepassword');
	}

	//register
	public function register()
	{
		if(!isPost())
		{
			$data['isshow'] = 'hidden';
			$this->twig->set($data);
		}else {

			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[30]|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[c_password]|min_length[6]|max_length[30]|xss_clean');
			$this->form_validation->set_rules('c_password', 'Confirm Password', 'trim|required|min_length[6]|max_length[30]|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('accept', 'Accept terms of use', 'required');

			if($this->form_validation->run() == TRUE)
			{
				$username = $this->input->post('username');
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				
				$result = $this->UserSystem->createSystemUser($username, $email, $password);

				if($result > 0)
				{
					$sess_array = array(
						'id' => $result,
						'username' => $username
					);
					$this->session->set_userdata('is_logged_backend', $sess_array);

					redirect('dashboard', 'refresh');
				}
				elseif ($result == -1) {
					$this->twig->set('dberror', 'Username is not ready.' ,TRUE);
				}elseif ($result == -2) {
					$this->twig->set('dberror', 'Email existed.' ,TRUE);
				}else {
					$this->twig->set('dberror', 'Invalid db error, please contact admin.' ,TRUE);
				}
			}
		}
		$this->twig->display('_layouts/register');
	}


	//forgot password
	public function forgotPassword()
	{
		$this->twig->display('_layouts/forgotpassword');
	}

	//logout
	public function logout()
	{
		$this->session->unset_userdata('is_logged_backend');
		session_destroy();
		redirect('', 'refresh');
	}
}
