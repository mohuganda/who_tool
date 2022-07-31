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

	public function collection()

	{
		@$print = $_GET['print'];
		if ($this->input->post('district') != 'ALL') {
			$district = $this->input->post('district');
			$_SESSION['dfilter'] = "WHERE district like '$district%'";
		}
		if (isset($_SESSION['dfilter'])) {
			$dfilter = $_SESSION['dfilter'];
		} else {
			$dfilter = "";
		}



		if (($this->input->post('facility') != 'ALL')) {
			$facility = $this->input->post('facility');
			$_SESSION['ffilter'] = " and facility like '$facility%'";
		}
		if (isset($_SESSION['ffilter'])) {
			$ffilter = $_SESSION['ffilter'];
		} else {
			$ffilter = "";
		}




		$this->load->library('pagination');
		$data['uptitle']      = 'Activity Report';
		$data['title']      = 'Activity Report';
		$data['module'] 	= "data";
		$data['view']   	= "data";
		$config = array();
		$config['base_url'] = base_url('data/collection');
		$data['total_rows'] = $config['total_rows'] = $this->count_rows($dfilter, $ffilter);
		$config['per_page'] = 10; //records per page
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
		$data['files'] = $this->data_model->getData2($config['per_page'], $page, $dfilter, $ffilter, $print);
		//print_r($config['total_rows']);
		echo Modules::run('templates/main', $data);
	}

	public function clean_collection()

	{
		@$print = $_GET['print'];
		if ($this->input->post('district') != 'ALL') {
			$district = $this->input->post('district');
			$_SESSION['dfilter'] = "WHERE district like '$district%'";
		}
		if (isset($_SESSION['dfilter'])) {
			$dfilter = $_SESSION['dfilter'];
		} else {
			$dfilter = "";
		}



		if (($this->input->post('facility') != 'ALL')) {
			$facility = $this->input->post('facility');
			$_SESSION['ffilter'] = " and facility like '$facility%'";
		}
		if (isset($_SESSION['ffilter'])) {
			$ffilter = $_SESSION['ffilter'];
		} else {
			$ffilter = "";
		}




		$this->load->library('pagination');
		$data['uptitle']      = 'Activity Report';
		$data['title']      = 'Activity Report';
		$data['module'] 	= "data";
		$data['view']   	= "data";
		$config = array();
		$config['base_url'] = base_url('data/collection');
		$data['total_rows'] = $config['total_rows'] = $this->count_rows($dfilter, $ffilter);
		$config['per_page'] = 10; //records per page
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
		$data['files'] = $this->data_model->cleangetData2($config['per_page'], $page, $dfilter, $ffilter, $print);
		//print_r($config['total_rows']);
		echo Modules::run('templates/main', $data);
	}
	public function count_rows($dfilter, $ffilter)
	{

		$query = $this->db->query("SELECT reference from records_json $dfilter $ffilter");
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

	public function data2()
	{

		return $data;
	}
	public function collections()
	{
		$datas = $this->data_model->getData();
		echo json_encode($datas);
	}
	public function cache_report()
	{

		ini_set('max_execution_time', 0);
		//$this->load->library('pagination');
		$count = $this->count_rows($dfilter = '', $ffilter = '');
		//contains = [ [],[] [] ]
		$per_page = 1000;
		$page = 0;
		for ($page = 0; $page < round(($count / $per_page), 0); $page++) :
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
		$dis = $this->db->query("SELECT distinct district from ihrisdata");
		foreach ($dis as $d) :

			$up = $this->db->query("UPDATE records_json SET=(SELECT JSON_EXTRACT(data,'.$district') WHERE JSON_EXTRACT(data,'.$district')='$d->district'");
			if ($up) {
				echo 'Successful';
			} else {
				echo 'Failed';
			}
		endforeach;
	}
	public function enrollers_per()
	{
		$data['module'] = 'data';
		$data['uptitle'] = 'Records per Enroller';
		$data['title'] = 'Records per Enroller';
		$data['view'] = 'aggregate_enrollers';
		echo Modules::run('templates/main', $data);
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

		$dfilter = $_SESSION['dfilter'];
		$ffilter = $_SESSION['ffilter'];
		$datefilter = $_SESSION['datefilter'];
		if ((!empty($dfilter)) && ($print = 1)) {
			$records = $this->data_model->getData2($config['per_page'] = FALSE, $page = FALSE, $dfilter, $ffilter, $print);
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

		$csv_file = "Field_Data" . date('Y-m-d') . '_' . $records[0]->district . ".csv";

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
					@$dt->facility,
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
		if ((!empty($dfilter)) && ($print = 1)) {
			$data['files'] = $this->data_model->getData2($config['per_page'] = FALSE, $page = FALSE, $dfilter, $ffilter, $print);
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
}
