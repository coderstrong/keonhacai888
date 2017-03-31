<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class verify extends MX_Controller {
	/**
	 * verify OnePay for this controller.
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
	private $access_key = 'd3ujd1o2na6cus3x8y3l';
    private $secret = 'kh1w5egcpl1o0sll5bl6szoy854iy4bw';
    private $coin = 3000;

	public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelCustomer');
        // Ideally you would autoload the parser
    }

    public function index()
	{
		$arResponse['message'] = 'Wellcome';
		echo json_encode($arResponse);
	}

	public function receive_mo()
	{
		$arResponse['type'] = 'text';

		$arParams['amount'] = FALSE;
		$arParams['access_key'] = $this->input->get('access_key');
		$arParams['command'] = $this->input->get('command');
		$arParams['mo_message'] = $this->input->get('mo_message');
		$arParams['msisdn'] = $this->input->get('msisdn');
		$arParams['request_id'] = $this->input->get('request_id');
		$arParams['request_time'] = $this->input->get('request_time');
		$arParams['short_code'] = $this->input->get('short_code');
		$arParams['signature'] = $this->input->get('signature');


		// kiem tra signature neu can
		if (strpos($arParams['mo_message'], ' ') !== false) 
		{
			$array_mess = explode(' ',$arParams['mo_message']); //0 command , 1 userid

			if (!$this->ModelCustomer->existTransaction($arParams['mo_message'], $arParams['request_id'])) 
			{
				$data = "access_key=" . $arParams['access_key'] . "&command=" . $arParams['command'] . "&mo_message=" . $arParams['mo_message'] . "&msisdn=" . $arParams['msisdn'] . "&request_id=" . $arParams['request_id'] . "&request_time=" . $arParams['request_time'] . "&short_code=" . $arParams['short_code'];

				$signature = hash_hmac("sha256", $data, $this->secret); // create signature to check

				if(strtolower($array_mess[0]) == $arParams['command'])
				{
					switch ($arParams['short_code']) {
						case '8098':
							$arParams['amount'] = 1000;
							break;
						// case '8198':
						// 	$arParams['amount'] = 1500;
						// 	break;
						// case '8298':
						// 	$arParams['amount'] = 2000;
						// 	break;
						case '8398':
							$arParams['amount'] = 3000;
							break;
						// case '8498':
						// 	$arParams['amount'] = 4000;
						// 	break;
						// case '8598':
						// 	$arParams['amount'] = 5000;
						// 	break;
						// case '8698':
						// 	$arParams['amount'] = 10000;
						// 	break;
						// case '8798':
						// 	$arParams['amount'] = 15000;
						// 	break;
						default:
							$arParams['amount'] = FALSE;
							break;
					}
					if($arParams['amount'] != FALSE)
					{
						$deposit = $this->ModelCustomer->Deposit($array_mess[1], $arParams['amount']);
						$sigverify = $arParams['signature'] == $signature;
						if ($deposit['status'] && $sigverify && $this->access_key==$arParams['access_key']) {
							//if sms content and amount and ... are ok. return success case
							$this->ModelCustomer->LogTransaction($array_mess[1], $arParams['amount'], $arParams['msisdn'], 1, $arParams['short_code'], $arParams['request_id'], $arParams['signature'], 0);
							$arResponse['status'] = 1;
							$arResponse['sms'] = 'Giao dich thanh cong. Cam on quy khach da su dung dich vu cua chung toi.';
						}
						else {
							//if not. return fail case
							$this->ModelCustomer->LogTransaction($array_mess[1], $arParams['amount'], $arParams['msisdn'], 1, $arParams['short_code'], $arParams['request_id'], $arParams['signature'], 1);
							$arResponse['status'] = 0;
							$arResponse['sms'] = 'Giao dich khong thanh cong. Lien he de biet them chi tiet.';

							log_message('error','[deposit] - sigverify'.$sigverify.', sdt'. $arParams['msisdn'].', mo_message'. $arParams['mo_message'].', request_id'. $arParams['request_id']);
						}
					}
					else
					{
						$arResponse['status'] = 0;
						$arResponse['sms'] = 'Lien he voi chung toi de biet them chi tiet';
					}
				}
				else
				{
					$arResponse['status'] = 0;
					$arResponse['sms'] = 'Lien he voi chung toi de biet them chi tiet';
				}
			}
			else
			{
				$arResponse['status'] = 0;
				$arResponse['sms'] = 'Loi qua nhieu request, Lien he voi chung toi de biet them chi tiet';
			}
		}
		else
		{
			$arResponse['status'] = 0;
			$arResponse['sms'] = 'Cu phap tin nhan khong dung. Cu phap mau la: fb6 userid';
		}
		// return json for 1pay system
		echo json_encode($arResponse);
	}

	public function recive_status()
	{
		// $arParams['access_key'] = $this->input->get('access_key');
		// $arParams['amount'] =$this->input->get('amount');
		// $arParams['command_code'] =$this->input->get('command_code');
		// $arParams['mo_message'] =$this->input->get('mo_message');
		// $arParams['msisdn'] =$this->input->get('msisdn');
		// $arParams['signature'] =$this->input->get('signature');

		// $arParams['request_id'] = $this->input->get('request_id');
		// $arParams['request_time'] = $this->input->get('request_time'); 
		// $arParams['error_code'] = $this->input->get('error_code');
		// $arParams['error_message'] = $this->input->get('error_message');

		// $data = "access_key=" . $arParams['access_key'] . "&amount=" . $arParams['amount'] . "&command_code=" . $arParams['command_code'];

		// $signature = hash_hmac("sha256", $data, $this->secret); // create signature to check
		// $arResponse['type'] = 'text';
		// // kiem tra signature neu can
		
		// log_message('error','[deposit step 2 log status] - access_key'.$arParams['access_key'].' ,amount'. $arParams['amount'] . ' ,command_code: '.$arParams['command_code']) . ', 1pay error_code:' . $arParams['error_code'] . ', 1pay error message' .$arParams['error_message'];

		// $sigverify = $arParams['signature'] == $signature;
		// if ($sigverify) {
		// 	//if sms content and amount and ... are ok. return success case
		// 	$deposit = $this->ModelCustomer->Deposit($arParams['msisdn'], $arParams['amount']);

		// 	if(!$deposit['status'])
		// 	{
		// 		log_message('error','[deposit step 2] - sigverify'.$sigverify.', msisdn'. $arParams['msisdn'] . ', db error: '.$deposit['message']) . ', 1pay error_code:' . $arParams['error_code'] . ', 1pay error message' .$arParams['error_message'];
		// 		$arResponse['status'] = 0;
		// 		$arResponse['sms'] = 'Giao dich khong thanh cong. Lien he de biet them chi tiet.';
		// 	}else {
		// 		$arResponse['status'] = 1;
		// 		$arResponse['sms'] = 'Giao dich thanh cong. Cam on quy khach da su dung dich vu cua chung toi.';
		// 	}

		// 	$this->ModelCustomer->LogTransaction($arParams['msisdn'].'|'.$arParams['request_id'], $arParams['amount'], 0, $arParams['request_id'], $arParams['signature'], 0);
			
		// }
		// else {
		// 	//if not. return fail case
		// 	$this->ModelCustomer->LogTransaction($arParams['msisdn'].'|'.$arParams['request_id'], $arParams['amount'], 1, $arParams['request_id'], $arParams['signature'], 1);
		// 	$arResponse['status'] = 0;
		// 	$arResponse['sms'] = 'Giao dich khong thanh cong. Lien he de biet them chi tiet.';
		// 	log_message('error','[deposit step 2] - sigverify'. $sigverify.', msisdn'. $arParams['msisdn'] .',1pay error_code:' . $arParams['error_code'] . ', 1pay error message' .$arParams['error_message']);
		// }
		// // return json for 1pay system
		// echo json_encode($arResponse);
	}
}
