<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model(array(
			'data_model'
		));
		$this->watermark = FCPATH . "assets/images/moh.png";
	}
	function render_district($facility)
	{
		$fac = urldecode($facility);
		$district = $this->db->query("SELECT distinct district from ihrisdata WHERE facility like '$fac%'")->row()->district;
		return $district;
	}
	public function kyc_status()
	{
		$kyc = $this->db->query("SELECT distinct kyc_status from validated_numbers")->result();
		return $kyc;
	}
	//This updates data to the new format 
	function normalise_data()
	{
		ini_set('max_execution_time', 0);


		$datas = $this->data_model->getColumsup();

		foreach ($datas as $dt) :
			$staff = json_decode($dt->data);
			// @$staff->sync_date=$dt->sync_date;
			//print_r($staff->reference);
			@$facility = str_replace("'", "\'", $staff->facility);
			@$district = $staff->district;
			if (empty($district) && (!empty($facility))) {
				$db_district = $this->db->query("SELECT DISTINCT district,district_id,facility_id from ihrisdata WHERE facility like '$facility%'")->row();
				$district = $db_district->district;
			}
			@$user_id = $staff->user_id;
			@$hw_type = $staff->hw_type;
			$reference = $dt->reference;
			if (empty($hw_type)) {
				$hw_type = 'chw';
			}
			@$ihris_pid = $staff->ihris_pid;

			$this->db->query("UPDATE records_json SET facility='$facility', district='$district', hw_type='$hw_type',user_id='$user_id',ihris_pid='$ihris_pid' WHERE reference='$reference'");
		endforeach;
	}

	//This updates data to the new format 
	function flatten_data()
	{
		ini_set('max_execution_time', 0);


		$datas = $this->data_model->getColumsup();
		$i = 0;
		foreach ($datas as $staff) :

			// @$staff->sync_date=$dt->sync_date;
			//print_r($staff->reference);
			@$facility = $staff->facility;

			if (!empty($facility)) {
				$db_district = $this->db->query("SELECT DISTINCT district,district_id,facility_id from ihrisdata WHERE facility like '$facility%'")->row();
				$district = $db_district->district;
			}

			if (!empty($district)) {
				$update = $this->db->query("UPDATE records_json_report SET  district='$district' WHERE facility='$facility'");

				if ($update) {
					echo "\033[32m" . $staff->facility . " updated" . $i++ . "\n";
				} else {
					echo "\033[37m" . $staff->facility . "Not Found In IHRIS" . $i++ . "\n";
				}
			}

		endforeach;
	}


	public function collection()

	{
		$dfilter = $_SESSION['dfilter'] = "";
		$ffilter = $_SESSION['ffilter'] = "";
		$fworker_type = $_SESSION['worker_type'] = "";
		@$print = $_GET['print'];
		if (!empty($this->input->post('district'))) {
			$district = $this->input->post('district');
			$dfilter = $_SESSION['dfilter'] = "WHERE district like '$district%'";
		} else {
			$dfilter = "";
		}



		if (!empty($this->input->post('facility'))) {
			$facility = $this->input->post('facility');
			$_SESSION['ffilter'] = " and facility like '$facility%'";
		} else {
			$ffilter = "";
		}

		if (!empty($this->input->post('worker_type'))) {
			$worker_type = $this->input->post('worker_type');
			$fworker_type = $_SESSION['worker_type'] = "and hw_type like '$worker_type%'";
		} else {
			$fworker_type = "";
		}



		$this->load->library('pagination');
		$data['uptitle']      = 'Data Report';
		$data['title']      = 'Data Report';
		$data['module'] 	= "data";
		$data['view']   	= "data";
		$config = array();
		$config['base_url'] = base_url('data/collection');
		$data['total_rows'] = $config['total_rows'] = $this->count_rows($dfilter, $ffilter, $fworker_type);
		$config['per_page'] = 50; //records per page
		$config['uri_segment'] = 3; //segment in url  
		//pagination links styling
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['attributes'] = ['class' => 'page-link'];
		$config['first_link'] = true;
		$config['last_link'] = true;
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['use_page_numbers'] = false;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; //default starting point for limits 
		$data['links'] = $this->pagination->create_links();
		$data['files'] = $this->data_model->getData2($config['per_page'], $page, $dfilter, $ffilter, $fworker_type, $print);
		//print_r($config['total_rows']);
		echo Modules::run('templates/main', $data);
	}

	public function processed()

	{
		$dfilter = $_SESSION['dfilter'] = "";
		$ffilter = $_SESSION['ffilter'] = "";
		$fworker_type = $_SESSION['worker_type'] = "";
		@$print = $_GET['print'];
		if (!empty($this->input->post('district'))) {
			$district = $this->input->post('district');
			$dfilter = $_SESSION['dfilter'] = "WHERE district='$district'";
		} else {
			$dfilter = "";
		}



		if (!empty($this->input->post('facility'))) {
			$facility = $this->input->post('facility');
			$_SESSION['ffilter'] = " and facility like '$facility%'";
		} else {
			$ffilter = "";
		}

		if (!empty($this->input->post('worker_type'))) {
			$worker_type = $this->input->post('worker_type');
			$fworker_type = $_SESSION['worker_type'] = "and hw_type='$worker_type'";
		} else {
			$fworker_type = "";
		}



		$this->load->library('pagination');
		$data['uptitle']      = 'Clean Data Report';
		$data['title']      = 'Clean Data Report';
		$data['module'] 	= "data";
		$data['view']   	= "clean_data";
		$config = array();
		$config['base_url'] = base_url('data/processed');
		$data['total_rows'] = $config['total_rows'] = $this->processed_count_rows($dfilter, $ffilter, $fworker_type, 'records_json_report');
		$config['per_page'] = 50; //records per page
		$config['uri_segment'] = 3; //segment in url  
		//pagination links styling
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['attributes'] = ['class' => 'page-link'];
		$config['first_link'] = true;
		$config['last_link'] = true;
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['use_page_numbers'] = false;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; //default starting point for limits 
		$data['links'] = $this->pagination->create_links();
		$data['files'] = $this->data_model->cleangetData2($config['per_page'], $page, $dfilter, $ffilter, $fworker_type, $print);
		//print_r($config['total_rows']);
		echo Modules::run('templates/main', $data);
	}


	//kyc verified

	public function kyc_csv($print)
	{
		ini_set('max_execution_time', 0);
		$dfilter = $_SESSION['dfilter'];
		$ffilter = $_SESSION['ffilter'];
		$fworker_type = $_SESSION['worker_type'];
		$datefilter = $_SESSION['datefilter'];
		$jobfilter = $_SESSION['job'];
		$kycfilter = $_SESSION['kycfilter'];
		$fsearch = $_SESSION['fsearch'];
		$csv = $_SESSION['district'] . "-KYC_VERIFIED" . date('Y-m-d') . '_' . ".csv";

		if ($print = 1) {
			$records = $this->data_model->kyc_verified_data($config['per_page'] = '', $page = 0, $dfilter, $ffilter, $fworker_type, $jobfilter, $fsearch, $print);
		}
		//print_r($records);
		$f = fopen('php://memory', 'w');
		$delimiter = ",";
		$fields = array(

			'NO',
			'Reference',
			'Worker Type',
			'National ID',
			'Name  ',
			'MNO Registered Name ',
			'JOb ',
			'KYC Status ',
			'Mobile Number',
			'Facility',
			'District'

		);
		fputcsv($f, $fields, $delimiter);
		$i = 1;
		foreach ($records as $staff) {
			if ($staff->hw_type == 'chw') {
				$wtype = "Community Health worker";
			} else {
				$wtype = "Ministry Health worker";
			}
			$data = array(
				$i++,
				@$staff->reference,
				ucwords($wtype),
				ucwords($staff->national_id),
				ucwords($staff->customer_name),
				ucwords($staff->mno_registered_name),
				ucwords($staff->job),
				ucwords($staff->kyc_status),
				ucwords(@$staff->mobile_number),
				ucwords($staff->facility),
				ucwords($staff->district)

			);

			fputcsv($f, $data, $delimiter);
		}
		// Move back to beginning of file 
		fseek($f, 0);

		// Set headers to download file rather than displayed 
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="' . $csv . '";');
		header("Pragma: no-cache");
		header("Expires: 0");

		//output all remaining data on a file pointer 
		fpassthru($f);

		exit;
	}

	public function kyc_failed_csv($print = FALSE)
	{
		ini_set('max_execution_time', 0);
		$dfilter = $_SESSION['dfilter'];
		$ffilter = $_SESSION['ffilter'];
		$fworker_type = $_SESSION['worker_type'];
		$datefilter = $_SESSION['datefilter'];
		$jobfilter = $_SESSION['job'];
		$kycfilter = $_SESSION['kycfilter'];
		$fsearch = $_SESSION['fsearch'];
		$csv = $_SESSION['district'] . "-KYC_FAILED_VERIFIED" . date('Y-m-d') . '_' . ".csv";

		if ($print = 1) {
			$records = $this->data_model->kyc_failed_data($config['per_page'] = '', $page = 0, $dfilter, $ffilter, $fworker_type, $jobfilter, $fsearch, $print);
		}
		//print_r($records);
		$f = fopen('php://memory', 'w');
		$delimiter = ",";
		$fields = array(

			'NO',
			'Reference',
			'Worker Type',
			'National ID',
			'Name  ',
			'MNO Registered Name ',
			'JOb ',
			'KYC Status ',
			'Mobile Number',
			'Facility',
			'District'

		);
		fputcsv($f, $fields, $delimiter);
		$i = 1;
		foreach ($records as $staff) {
			if ($staff->hw_type == 'chw') {
				$wtype = "Community Health worker";
			} else {
				$wtype = "Ministry Health worker";
			}
			$data = array(
				$i++,
				@$staff->reference,
				ucwords($wtype),
				ucwords($staff->national_id),
				ucwords($staff->customer_name),
				ucwords($staff->mno_registered_name),
				ucwords($staff->job),
				ucwords($staff->kyc_status),
				ucwords(@$staff->mobile_number),
				ucwords($staff->facility),
				ucwords($staff->district)

			);

			fputcsv($f, $data, $delimiter);
		}
		// Move back to beginning of file 
		fseek($f, 0);

		// Set headers to download file rather than displayed 
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="' . $csv . '";');
		header("Pragma: no-cache");
		header("Expires: 0");

		//output all remaining data on a file pointer 
		fpassthru($f);

		exit;
	}
	public function kyc_verified()
	{
		$dfilter = $_SESSION['dfilter'] = "";
		$ffilter = $_SESSION['ffilter'] = "";
		$fworker_type = $_SESSION['worker_type'] = "";
		@$print = $_GET['print'];
		if (!empty($this->input->get('district'))) {
			$district = urldecode($this->input->get('district'));
			$dfilter = $_SESSION['dfilter'] = "WHERE district ='$district'";
		} else {
			$dfilter = "";
		}



		if (!empty($this->input->get('facility'))) {
			$facility = urldecode($this->input->get('facility'));
			$ffilter = $_SESSION['ffilter'] = " and facility = '$facility'";
		} else {
			$ffilter = "";
		}

		if (!empty($this->input->get('worker_type'))) {
			$worker_type = $this->input->get('worker_type');
			$fworker_type = $_SESSION['worker_type'] = "and hw_type = '$worker_type'";
		} else {
			$fworker_type = "";
		}

		if (!empty($this->input->get('job'))) {
			$job = urldecode($this->input->get('job'));
			$fjob = $_SESSION['job'] = "and job = '$job'";
		} else {
			$fjob = "";
		}

		if (!empty($this->input->get('search'))) {
			$search = urldecode($this->input->get('search'));
			$fsearch = $_SESSION['fsearch'] = "and surname  like'$search%' or firstname  like'$search%'";
		} else {
			$fsearch = "";
		}

		$this->load->library('pagination');
		$data['uptitle']      = 'KYC Verified Data Report';
		$data['title']      = 'KYC Verified Data Report';
		$data['module'] 	= "data";
		$data['view']   	= "kyc_verified_data";
		$data['jobs'] = $this->data_model->get_jobs();
		$config = array();
		$config['base_url'] = base_url('data/kyc_verified');
		$data['total_rows'] = $config['total_rows'] = $this->kyc_count_rows($dfilter, $ffilter, $fworker_type, $fjob, $fsearch);
		$config['per_page'] = 50; //records per page
		$config['uri_segment'] = 3; //segment in url  
		//pagination links styling
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['attributes'] = ['class' => 'page-link'];
		$config['first_link'] = true;
		$config['last_link'] = true;
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['use_page_numbers'] = false;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; //default starting point for limits 
		$data['links'] = $this->pagination->create_links();
		$data['files'] = $this->data_model->kyc_verified_data($config['per_page'], $page, $dfilter, $ffilter, $fworker_type, $fjob, $fsearch, $print);
		//print_r($config['total_rows']);

		//print_r($data);	
		echo Modules::run('templates/main', $data);
	}

	public function kyc_failed()

	{

		$dfilter = $_SESSION['dfilter'] = "";
		$ffilter = $_SESSION['ffilter'] = "";
		$fworker_type = $_SESSION['worker_type'] = "";
		@$print = $_GET['print'];
		if (!empty($this->input->get('district'))) {
			$district = urldecode($this->input->get('district'));
			$dfilter = $_SESSION['dfilter'] = "WHERE district ='$district'";
		} else {
			$dfilter = "";
		}



		if (!empty($this->input->get('facility'))) {
			$facility = urldecode($this->input->get('facility'));
			$ffilter = $_SESSION['ffilter'] = " and facility = '$facility'";
		} else {
			$ffilter = "";
		}

		if (!empty($this->input->get('worker_type'))) {
			$worker_type = $this->input->get('worker_type');
			$fworker_type = $_SESSION['worker_type'] = "and hw_type = '$worker_type'";
		} else {
			$fworker_type = "";
		}

		if (!empty($this->input->get('job'))) {
			$job = urldecode($this->input->get('job'));
			$fjob = $_SESSION['job'] = "and job = '$job'";
		} else {
			$fjob = "";
		}
		if (!empty($this->input->get('search'))) {
			$search = urldecode($this->input->get('search'));
			$fsearch = $_SESSION['fsearch'] = "and surname  like'$search%' or firstname  like'$search%'";
		} else {
			$fsearch = "";
		}





		$this->load->library('pagination');
		$data['uptitle']      = 'KYC Failed Data Report';
		$data['title']      = 'KYC Failed Data Report';
		$data['module'] 	= "data";
		$data['view']   	= "kyc_failed_data";
		$data['jobs'] = $this->data_model->get_jobs();
		$config = array();
		$config['base_url'] = base_url('data/kyc_failed');
		$data['total_rows'] = $config['total_rows'] = $this->kyc_failed_count_rows($dfilter, $ffilter, $fworker_type, $fjob, $fsearch);
		$config['per_page'] = 50; //records per page
		$config['uri_segment'] = 3; //segment in url  
		//pagination links styling
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['attributes'] = ['class' => 'page-link'];
		$config['first_link'] = true;
		$config['last_link'] = true;
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['use_page_numbers'] = false;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; //default starting point for limits 
		$data['links'] = $this->pagination->create_links();
		$data['files'] = $this->data_model->kyc_failed_data($config['per_page'], $page, $dfilter, $ffilter, $fworker_type, $fjob, $fsearch, $print);
		//print_r($config['total_rows']);

		//print_r($data);	
		echo Modules::run('templates/main', $data);
	}
	public function count_rows($dfilter, $ffilter, $fworker_type)
	{

		$query = $this->db->query("SELECT reference from records_json $dfilter $ffilter $fworker_type");
		return $query->num_rows();
	}
	public function kyc_count_rows($dfilter, $ffilter,  $fworker_type, $fjob, $fsearch)

	{
		if (empty($dfilter)) {
			$kycstatus = "WHERE kyc_status IS NOT NULL";
		} else {
			$kycstatus = "and kyc_status IS NOT NULL";
		}

		$query = $this->db->query("SELECT v.*,r.birth_date,r.district,r.facility,r.hw_type,r.job,r.national_id FROM validated_numbers v JOIN records_json_report r ON v.reference=r.reference and kyc_status in ('MATCH','CLOSE MATCH','POSSIBLE MATCH','VERIFIED MATCH') $dfilter $kycstatus $ffilter $fworker_type $fjob $fsearch");
		return $query->num_rows();
	}
	public function kyc_failed_count_rows($dfilter, $ffilter,  $fworker_type, $fjob, $fsearch)

	{
		if (empty($dfilter)) {
			$kycstatus = "WHERE kyc_status IS NOT NULL";
		} else {
			$kycstatus = "and kyc_status IS NOT NULL";
		}

		$query = $this->db->query("SELECT v.*,r.birth_date,r.district,r.facility,r.hw_type,r.job,r.national_id FROM validated_numbers v JOIN records_json_report r ON v.reference=r.reference and kyc_status not in ('MATCH','CLOSE MATCH','POSSIBLE MATCH','VERIFIED MATCH') $dfilter $kycstatus $ffilter $fworker_type $fjob $fsearch");
		return $query->num_rows();
	}
	function generate_users()
	{
		$districts =  $this->db->query('SELECT distinct district,district_id from ihrisdata')->result();
		$i = 0;
		foreach ($districts as $dist) :

			$data = array(
				'user_id' => NULL,
				'email' => 'noemail@gmail.com',
				'contact' => 0,
				'username' => 'data_' . $dist->district,
				'password' => 'ac3b167e495e0d64b0380a2a99b95711',
				'name' => 'data_' . $dist->district,
				'role' => 17,
				'status' => 1,
				'created_at' => date('Y-m-d h:m:i'),
				'ihris_pid' => NULL,
				'facility_id' => NULL,
				'facility' => NULL,
				'department_id' => NULL,
				'department' => NULL,
				'district_id' => $dist->district_id,
				'district' => $dist->district,
				'auth_id' => NULL,
				'changed' => date('Y-m-d'),
				'isChanged' => 1
			);
			$insert = $this->db->insert('user', $data);
			if ($insert) {
				echo "\033[32m" . $dist->district . " Account Created" . $i++ . "\n";
			} else {
				echo "\033[37m" . $dist->district . "Not Created" . $i++ . "\n";
			}

		endforeach;
	}
	public function processed_count_rows($dfilter, $ffilter, $fworker_type, $table)
	{
		if (empty($dfilter)) {
			$fstatus = "WHERE status='clean'";
		} else {
			$fstatus = "and status='clean'";
		}

		$query = $this->db->query("SELECT reference from $table   $dfilter $fstatus $fworker_type ");
		return $query->num_rows();
	}

	public function kyc()
	{
		$data['uptitle']      = 'KYC Verified Data';
		$data['title']      = 'KYC Verified Data ';
		$data['module'] 	= "data";
		$data['view']   	= "kyc";
		$data['headers']   	= $this->data_model->headers();
		$filters = $this->input->post();
		$data['staffs']   	= $this->data_model->kycData($filters);
		echo Modules::run('templates/main', $data);
	}


	public function collections()
	{
		$datas = $this->data_model->getData();
		echo json_encode($datas);
	}
	public function cache_report()
	{

		ini_set('max_execution_time', 0);
		$count = $this->count_rows($dfilter = '', $ffilter = '', $fworker_type = '');
		//contains = [ [],[] [] ]
		$per_page = 500;
		$pages = ceil($count / $per_page);
		for ($page = 0; $page < $pages; $page++) :
			$offset = ($page > 1) ? ($per_page * ($page - 1)) : 0;
			$datas = $this->data_model->getData2($per_page, $offset, $dfilter, $ffilter, 0);
			//print_r(count($datas));
			foreach ($datas as $dt) :
				$staff = json_decode($dt->data);
				@$staff->sync_date = $dt->sync_date;
				//print_r($staff);
				$this->db->replace('records_json_report', $staff);
			endforeach;

		endfor;
	}
	function create_report()
	{

		$this->load->dbforge();
		//$query=$this->db->dbforge->drop_table('linear_json_report');

		$data = $this->db->query("SELECT form_field, data_type as type, db_constraint as 'constraint', db_unique as 'unique' from fields")->result();
		$fields = array();
		foreach ($data as $row) {
			if ($row->type == 'signature') {
				$type = str_replace("signature", "longtext", "$row->type");
			} else if ($row->type == 'blob') {
				$type = str_replace("blob", "longtext", "$row->type");
			} else if ($row->type == 'charmap') {
				$type = str_replace("charmap", "varchar", "$row->type");
			} else if ($row->type == 'char') {
				$type = str_replace("char", "varchar", "$row->type");
			} else {
				$type = str_replace("map", "", "$row->type");
			}

			$properties = array(
				'type' => $type,
				'constraint' => "$row->constraint",
				'unique' => "$row->unique",
				'null' => true,
			);

			$fields[$row->form_field] = $properties;
		}
		//print_r($fields);
		$fields['sync_date'] = array(
			'type'       => 'DATETIME',
			'null' => true,
		);
		$fields['app_version'] = array(
			'type'       => 'varchar',
			'constraint' => "10",
			'null' => true,
		);
		$fields['district'] = array(
			'type'       => 'varchar',
			'constraint' => "30",
			'null' => true,
		);
		$this->dbforge->add_field($fields);
		// define primary key

		$this->dbforge->add_key('reference', TRUE);
		$this->dbforge->add_key('user_id', FALSE);
		$this->dbforge->add_key('facility', FALSE);
		$this->dbforge->add_key('position', FALSE);
		$this->dbforge->add_key('district', FALSE);
		$this->dbforge->add_key('ihris_pid', FALSE);
		$this->dbforge->add_key('national_id', FALSE);
		$this->dbforge->add_key('app_version', FALSE);
		$this->dbforge->add_key('sync_date', FALSE);


		// create table
		$this->dbforge->create_table('records_json_report', TRUE);
	}
	public function fill_districts()
	{
		// $dis = $this->db->query("SELECT distinct district from ihrisdata");
		// foreach ($dis as $d) :

		// 	$up = $this->db->query("UPDATE records_json SET=(SELECT JSON_EXTRACT(data,'.$district') WHERE JSON_EXTRACT(data,'.$district')='$d->district'");
		// 	if ($up) {
		// 		echo 'Successful';
		// 	} else {
		// 		echo 'Failed';
		// 	}
		// endforeach;
	}
	public function enrollers_per()
	{
		$data['module'] = 'data';
		$data['uptitle'] = 'Records per Enroller';
		$data['title'] = 'Records per Enroller';
		$data['view'] = 'aggregate_enrollers';
		echo Modules::run('templates/main', $data);
	}

	public function update_kyc()
	{

		$reference = $this->input->post('reference');
		$kyc_status = $this->input->post('kyc_status');
		$district = $this->input->post('district');
		$registername = $this->input->post('registered_name');
		$mobile_number = $this->input->post('mobile_number');
		$mobile_operator = $this->input->post('operator');
		$job = $this->input->post('job');
		$customer_name = $this->input->post('customer_name');

		$insert = array(
			"kyc_status" => "$kyc_status",
			"mobile_number" => "$mobile_number",
			"mno_registered_name" => "$registername",
			"customer_name" => "$customer_name"
		);
		$insert2 = array(
			"district" => "$district",
			"primary_mobile_number" => "$mobile_number",
			"registered_mm_name" => "$registername",
			"diff_names_consent" => "Yes",
			"primary_mobile_operator" => "$mobile_operator",
			"job" => "$job"
		);

		$this->db->where("reference", "$reference");
		$query = $this->db->update("validated_numbers", $insert);

		$query2 = $this->update_district($insert2, $reference);

		if ($query && $query2) {

			echo "KYC UPDATED";
		} else {
			echo "KYC FAILED";
		}
	}

	public function update_district($insert2, $reference)
	{
		$this->db->where("reference", "$reference");
		$query = $this->db->update("records_json_report", $insert2);
		if ($query) {

			return "UPDATED";
		} else {
			return "FAILED";
		}
	}
	public function phase2_enrollers_per()
	{
		$data['module'] = 'data';
		$data['uptitle'] = 'Phase2 Records per Enroller';
		$data['title'] = 'Phase2 Records per Enroller';
		$data['view'] = 'phase2_aggregate_enrollers';
		echo Modules::run('templates/main', $data);
	}
	public function district_per()
	{
		$data['module'] = 'data';
		$data['uptitle'] = 'Records per District';
		$data['title'] = 'Records per District';
		$data['view'] = 'aggregate_district';
		echo Modules::run('templates/main', $data);
	}
	public function csv_data($print)
	{
		ini_set('max_execution_time', 0);
		$dfilter = $_SESSION['dfilter'];
		$ffilter = $_SESSION['ffilter'];
		$datefilter = $_SESSION['datefilter'];
		$worker_type = $_SESSION['worker_type'];
		$csv_file = "Field_Data" . date('Y-m-d') . '_' . ".csv";

		if ((!empty($dfilter)) && ($print = 1)) {
			$records = $this->data_model->getData2($config['per_page'] = FALSE, $page = FALSE, $dfilter, $ffilter, $worker_type, $print);
		}
		//print_r($records);kyc
		$f = fopen('php://memory', 'w');
		$delimiter = ",";
		$fields = array(
			'No',
			'Worker Type',
			'Surname',
			'Firstname ',
			'Othername ',
			'Date of Birth ',
			'Place ',
			'Gender ',
			'position ',
			'facility ',
			'ID Type ',
			'ID Number ',
			'ID Expiry ',
			'National ID Number',
			'National ID Card Number',
			'Allow Consent',
			'Mobile Number ',
			'Other Contact ',
			'Mobile Money Registration Status ',
			'Is registered by Health Worker ',
			'If No, Registered Name ',
			'Allow Mobile Money ',
			'KYC verification '
		);
		fputcsv($f, $fields, $delimiter);
		if (!empty($records)) {
			$i = 1;
			foreach ($records as $dt) {
				$staff = json_decode($dt->data);
				$linedata = array(
					$i++,
					@$staff->hw_type == 'chw' ? "Community Health worker" : "Ministry Health worker",
					$staff->surname,
					$staff->firstname,
					$staff->othername,
					@$staff->birth_date,
					@$staff->birth_place,
					$staff->gender,
					$staff->job,
					@$staff->facility,
					$staff->id_type,
					@$staff->ID_Number,
					@$staff->id_expiry,
					@$staff->national_id,
					@$staff->national_id_card_number,
					$staff->consent,
					$staff->primary_mobile_number,
					$staff->other_contact,
					$staff->is_mm_registered,
					$staff->is_registered_by_hw,
					$staff->registered_mm_name,
					$staff->diff_names_consent,
					$staff->kyc_verification
				);

				fputcsv($f, $linedata, $delimiter);
			}
			// Move back to beginning of file 
			fseek($f, 0);

			// Set headers to download file rather than displayed 
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment; filename="' . $csv_file . '";');
			header("Pragma: no-cache");
			header("Expires: 0");

			//output all remaining data on a file pointer 
			fpassthru($f);
		}
		exit;
	}
	public function clean_csv_data($print)
	{
		ini_set('max_execution_time', 0);
		$dfilter = $_SESSION['dfilter'];
		$ffilter = $_SESSION['ffilter'];
		$datefilter = $_SESSION['datefilter'];
		$worker_type = $_SESSION['worker_type'];
		$csv_file = "Field_Data" . date('Y-m-d') . '_' . ".csv";

		if ((!empty($dfilter)) && ($print = 1)) {
			$records = $this->data_model->getData2($config['per_page'] = FALSE, $page = FALSE, $dfilter, $ffilter, $worker_type, $print);
		}
		//print_r($records);
		$f = fopen('php://memory', 'w');
		$delimiter = ",";
		$fields = array(
			'No',
			'Worker Type',
			'Surname',
			'Firstname ',
			'Othername ',
			'Date of Birth ',
			'Place ',
			'Gender ',
			'position ',
			'facility ',
			'ID Type ',
			'ID Number ',
			'ID Expiry ',
			'National ID Number',
			'National ID Card Number',
			'Allow Consent',
			'Mobile Number ',
			'Other Contact ',
			'Mobile Money Registration Status ',
			'Is registered by Health Worker ',
			'If No, Registered Name ',
			'Allow Mobile Money ',
			'KYC verification '
		);
		fputcsv($f, $fields, $delimiter);
		if (!empty($records)) {
			$i = 1;
			foreach ($records as $dt) {
				$staff = json_decode($dt->data);
				$linedata = array(
					$i++,
					@$staff->hw_type == 'chw' ? "Community Health worker" : "Ministry Health worker",
					$staff->surname,
					$staff->firstname,
					$staff->othername,
					@$staff->birth_date,
					@$staff->birth_place,
					$staff->gender,
					$staff->job,
					@$staff->facility,
					$staff->id_type,
					@$staff->ID_Number,
					@$staff->id_expiry,
					@$staff->national_id,
					@$staff->national_id_card_number,
					$staff->consent,
					$staff->primary_mobile_number,
					$staff->other_contact,
					$staff->is_mm_registered,
					$staff->is_registered_by_hw,
					$staff->registered_mm_name,
					$staff->diff_names_consent,
					$staff->kyc_verification
				);

				fputcsv($f, $linedata, $delimiter);
			}
			// Move back to beginning of file 
			fseek($f, 0);

			// Set headers to download file rather than displayed 
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment; filename="' . $csv_file . '";');
			header("Pragma: no-cache");
			header("Expires: 0");

			//output all remaining data on a file pointer 
			fpassthru($f);
		}
		exit;
	}


	public function pdf_data($print)
	{
		$dfilter = $_SESSION['dfilter'];
		$ffilter = $_SESSION['ffilter'];
		$datefilter = $_SESSION['datefilter'];
		$fworker_type = $_SESSION['worker_type'];
		if ((!empty($dfilter)) && ($print = 1)) {
			$data['files'] = $this->data_model->getData2($config['per_page'] = FALSE, $page = FALSE, $dfilter, $ffilter, $fworker_type, $print);
		}
		$this->load->library('ML_pdf');
		$filename = "Field_Data" . date('Y-m-d') . '_' . $data['files'][0]->district . ".pdf";
		ini_set('max_execution_time', 0);
		$html = $this->load->view('pdfdata', $data, TRUE);
		$PDFContent = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
		$this->ml_pdf->pdf->SetCompression(true);
		$this->ml_pdf->pdf->SetWatermarkImage($this->watermark);
		$this->ml_pdf->pdf->showWatermarkImage = true;
		date_default_timezone_set("Africa/Kampala");
		$this->ml_pdf->pdf->SetHTMLFooter("Printed/ Accessed on: <b>" . date('d F,Y h:i A') . "</b><br style='font-size: 9px !imporntant;'>" . " Source: iHRIS - iHRIS Mobile Tool " . base_url());
		ini_set('max_execution_time', 0);
		$this->ml_pdf->pdf->WriteHTML($PDFContent); //ml_pdf because we loaded the library ml_pdf for landscape format not ml_pdf
		//download it D save F.
		$this->ml_pdf->pdf->Output($filename, 'I');
	}

	public function cache_report_data()
	{
		$references = $this->db->query("SELECT reference from new_refs")->result();
		//print_r($reference);
		$i = 1;
		foreach ($references as $reference) :
			$datas = $this->db->query("SELECT reference,data FROM 'records_json' WHERE reference='$reference->reference'")->row();

			$staff = json_decode($datas->data);

			//print_r($staff);
			$inserted = $this->db->replace('records_json_report', $staff);
			// $this->db->query("UPDATE records_json SET primary_mobile_number=(SELECT  JSON_UNQUOTE(JSON_EXTRACT(data,'$.primary_mobile_number')) FROM records_json WHERE JSON_UNQUOTE(JSON_EXTRACT(data,'$.reference'))='$reference->reference')WHERE reference ='$reference->reference'");
			if ($inserted) {
				echo "\033[32m" . $reference->reference . " Inserted Record" . $i++ . "\n";
			} else {
				echo "\033[37m" . $reference->reference . "Failed" . $i++ . "\n";
			}
		endforeach;
	}

	public function airtel_data()
	{
		@$print = $_GET['print'];
		$dfilter = $_SESSION['dfilter'] = "";
		$ffilter = $_SESSION['ffilter'] = "";
		$fworker_type = $_SESSION['worker_type'] = "";
		if (!empty($this->input->post('district'))) {
			$district = $this->input->post('district');
			$dfilter = $_SESSION['dfilter'] = "WHERE district like '$district%'";
		} else {
			$dfilter = "";
		}



		if (!empty($this->input->post('facility'))) {
			$facility = $this->input->post('facility');
			$_SESSION['ffilter'] = " and facility like '$facility%'";
		} else {
			$ffilter = "";
		}

		if (!empty($this->input->post('worker_type'))) {
			$worker_type = $this->input->post('worker_type');
			$fworker_type = $_SESSION['worker_type'] = "and hw_type like '$worker_type%'";
		} else {
			$fworker_type = "";
		}
		$this->load->library('pagination');
		$data['uptitle']      = 'Airtel Data';
		$data['title']      = 'Airtel Data';
		$data['module'] 	= "data";
		$data['view']   	= "telcom_data";
		$config = array();
		$config['base_url'] = base_url('data/airtel_data');
		$data['total_rows'] = $config['total_rows'] = $this->processed_count_rows($dfilter, $ffilter, $fworker_type, 'airtel_clients');
		$config['per_page'] = 50; //records per page
		$config['uri_segment'] = 3; //segment in url  
		//pagination links styling
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['attributes'] = ['class' => 'page-link'];
		$config['first_link'] = true;
		$config['last_link'] = true;
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['use_page_numbers'] = false;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; //default starting point for limits 
		$data['links'] = $this->pagination->create_links();
		$data['form'] = 'airtel_data';
		$data['files'] = $this->data_model->airtel_data($config['per_page'], $page, $dfilter, $ffilter, $fworker_type, $print);
		//print_r($config['total_rows']);
		echo Modules::run('templates/main', $data);
	}
	public function mtn_data()
	{
		@$print = $_GET['print'];
		$dfilter = $_SESSION['dfilter'] = "";
		$ffilter = $_SESSION['ffilter'] = "";
		$fworker_type = $_SESSION['worker_type'] = "";
		if (!empty($this->input->post('district'))) {
			$district = $this->input->post('district');
			$dfilter = $_SESSION['dfilter'] = "WHERE district like '$district%'";
		} else {
			$dfilter = "";
		}



		if (!empty($this->input->post('facility'))) {
			$facility = $this->input->post('facility');
			$_SESSION['ffilter'] = " and facility like '$facility%'";
		} else {
			$ffilter = "";
		}

		if (!empty($this->input->post('worker_type'))) {
			$worker_type = $this->input->post('worker_type');
			$fworker_type = $_SESSION['worker_type'] = "and hw_type like '$worker_type%'";
		} else {
			$fworker_type = "";
		}



		$this->load->library('pagination');
		$data['uptitle']      = 'MTN Data';
		$data['title']      = 'MTN Data';
		$data['module'] 	= "data";
		$data['view']   	= "telcom_data";
		$config = array();
		$config['base_url'] = base_url('data/airtel_data');
		$data['total_rows'] = $config['total_rows'] = $this->processed_count_rows($dfilter, $ffilter, $fworker_type, 'mtn_clients');
		$config['per_page'] = 50; //records per page
		$config['uri_segment'] = 3; //segment in url  
		//pagination links styling
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['attributes'] = ['class' => 'page-link'];
		$config['first_link'] = true;
		$config['last_link'] = true;
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['use_page_numbers'] = false;
		$this->pagination->initialize($config);
		$data['form'] = 'mtn_data';
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; //default starting point for limits 
		$data['links'] = $this->pagination->create_links();
		$data['files'] = $this->data_model->mtn_data($config['per_page'], $page, $dfilter, $ffilter, $fworker_type, $print);
		//print_r($config['total_rows']);
		echo Modules::run('templates/main', $data);
	}

	public function uncategorised_data()
	{
		@$print = $_GET['print'];
		$dfilter = $_SESSION['dfilter'] = "";
		$ffilter = $_SESSION['ffilter'] = "";
		$fworker_type = $_SESSION['worker_type'] = "";
		if (!empty($this->input->post('district'))) {
			$district = $this->input->post('district');
			$dfilter = $_SESSION['dfilter'] = "WHERE district like '$district%'";
		} else {
			$dfilter = "";
		}



		if (!empty($this->input->post('facility'))) {
			$facility = $this->input->post('facility');
			$_SESSION['ffilter'] = " and facility like '$facility%'";
		} else {
			$ffilter = "";
		}

		if (!empty($this->input->post('worker_type'))) {
			$worker_type = $this->input->post('worker_type');
			$fworker_type = $_SESSION['worker_type'] = "and hw_type like '$worker_type%'";
		} else {
			$fworker_type = "";
		}



		$this->load->library('pagination');
		$data['uptitle']      = 'Uncategorised Data';
		$data['title']      = 'Uncategorised Data';
		$data['module'] 	= "data";
		$data['view']   	= "telcom_data";
		$config = array();
		$config['base_url'] = base_url('data/uncategorised_data');
		$data['total_rows'] = $config['total_rows'] = $this->processed_count_rows($dfilter, $ffilter, $fworker_type, 'uncategorised_clients');
		$config['per_page'] = 50; //records per page
		$config['uri_segment'] = 3; //segment in url  
		//pagination links styling
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['attributes'] = ['class' => 'page-link'];
		$config['first_link'] = true;
		$config['last_link'] = true;
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['use_page_numbers'] = false;
		$this->pagination->initialize($config);
		$data['form'] = 'uncategorised_data';
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; //default starting point for limits 
		$data['links'] = $this->pagination->create_links();
		$data['files'] = $this->data_model->uncategorised_data($config['per_page'], $page, $dfilter, $ffilter, $fworker_type, $print);
		//print_r($config['total_rows']);
		echo Modules::run('templates/main', $data);
	}
	public function mno_data($print, $form)
	{
		ini_set('max_execution_time', 0);
		$dfilter = $_SESSION['dfilter'];
		$ffilter = $_SESSION['ffilter'];
		$fworker_type = $_SESSION['worker_type'];
		$datefilter = $_SESSION['datefilter'];
		$csv = $form . "_MNO_Data" . date('Y-m-d') . '_' . ".csv";

		if ($print = 1) {
			$records = $this->data_model->$form($config['per_page'] = FALSE, $page = FALSE, $dfilter, $ffilter, $fworker_type, $print);
		}
		//print_r($records);
		$f = fopen('php://memory', 'w');
		$delimiter = ",";
		$fields = array(

			'NO',
			'Reference',
			'Surname',
			'Firstname ',
			'Othername ',
			'Primary Mobile Number ',
			'Registered Name ',
			'National ID',
			'Job',
			'Facility',
			'District'

		);
		fputcsv($f, $fields, $delimiter);
		$i = 0;
		foreach ($records as $staff) {
			$data = array(
				$i++,
				@$staff->reference,
				ucwords($staff->surname),
				ucwords($staff->firstname),
				ucwords($staff->othername),
				$staff->primary_mobile_number,
				ucwords($staff->registered_mm_name),
				ucwords(@$staff->national_id),
				ucwords($staff->job),
				ucwords($staff->facility),
				ucwords($staff->district)

			);

			fputcsv($f, $data, $delimiter);
		}
		// Move back to beginning of file 
		fseek($f, 0);

		// Set headers to download file rather than displayed 
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="' . $csv . '";');
		header("Pragma: no-cache");
		header("Expires: 0");

		//output all remaining data on a file pointer 
		fpassthru($f);

		exit;
	}
	public function utl_data()
	{
		@$print = $_GET['print'];
		$dfilter = $_SESSION['dfilter'] = "";
		$ffilter = $_SESSION['ffilter'] = "";
		$fworker_type = $_SESSION['worker_type'] = "";
		if (!empty($this->input->post('district'))) {
			$district = $this->input->post('district');
			$dfilter = $_SESSION['dfilter'] = "WHERE district like '$district%'";
		} else {
			$dfilter = "";
		}



		if (!empty($this->input->post('facility'))) {
			$facility = $this->input->post('facility');
			$_SESSION['ffilter'] = " and facility like '$facility%'";
		} else {
			$ffilter = "";
		}

		if (!empty($this->input->post('worker_type'))) {
			$worker_type = $this->input->post('worker_type');
			$fworker_type = $_SESSION['worker_type'] = "and hw_type like '$worker_type%'";
		} else {
			$fworker_type = "";
		}



		$this->load->library('pagination');
		$data['uptitle']      = 'UTL Data';
		$data['title']      = 'UTL Data';
		$data['module'] 	= "data";
		$data['view']   	= "telcom_data";
		$config = array();
		$config['base_url'] = base_url('data/airtel_data');
		$data['total_rows'] = $config['total_rows'] = $this->processed_count_rows($dfilter, $ffilter, $fworker_type, 'utl_clients');
		$config['per_page'] = 50; //records per page
		$config['uri_segment'] = 3; //segment in url  
		//pagination links styling
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['attributes'] = ['class' => 'page-link'];
		$config['first_link'] = true;
		$config['last_link'] = true;
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['use_page_numbers'] = false;
		$this->pagination->initialize($config);
		$data['form'] = 'utl_data';
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; //default starting point for limits 
		$data['links'] = $this->pagination->create_links();
		$data['files'] = $this->data_model->utl_data($config['per_page'], $page, $dfilter, $ffilter, $fworker_type, $print);
		//print_r($config['total_rows']);
		echo Modules::run('templates/main', $data);
	}
	public function assign_operator()
	{

		$refs = $this->db->query("SELECT reference from records_json_report WHERE primary_mobile_operator='UTL'");
		$i = 0;
		foreach ($refs as $ref) :

			$query = $this->db->query("UPDATE records_json_report SET primary_mobile_operator='MTN' WHERE reference='$ref->reference' AND primary_mobile_number LIKE '077%' OR primary_mobile_number LIKE '078%' OR primary_mobile_number LIKE '076%'");
			if ($query) {
				echo "\033[32m" . $ref->reference . " Inserted Record" . $i++ . "\n";
			} else {
				echo "\033[37m" . $ref->reference . "Failed" . $i++ . "\n";
			}
		endforeach;
	}
	public function data_remap()
	{
		$data['jobs'] = $this->data_model->get_jobs();
		$data['uptitle']      = 'Remap Job';
		$data['title']      = 'Remap';
		$data['module'] 	= "data";
		$data['view']   	= "job_remap";
		if (!empty($this->input->post('value'))) :
			$data['message'] = $this->data_model->remap_data($this->input->post());

		endif;
		//print_r($this->input->post());
		echo Modules::run('templates/main', $data);
	}
}
