<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MX_Controller
{


	public  function __construct()
	{
		parent::__construct();

		$this->dashmodule = "dashboard";
		$this->load->model("dashboard_mdl", 'dash_mdl');
	}

	public function index()
	{
		$data['module'] = $this->dashmodule;
		$data['title'] = "Main Dashboard";
		$data['uptitle'] = "Main Dashboard";
		$data['view'] = "home";
		//$data['dashboard']=$this->dashboardData();

		echo Modules::run('templates/main', $data);
	}
	public function dashboardData()
	{

		$data = $this->dash_mdl->getData();
		echo json_encode($data);
	}
	public function mnodashboardData()
	{

		$data = $this->dash_mdl->mno_graph();
		echo json_encode($data);
	}

	public function not_verified()
	{

		$data = $this->dash_mdl->not_verified();
		echo json_encode($data);
	}

	public function data_district()
	{

		$data = $this->dash_mdl->district_count();
		return $data;
	}
	public function data_enrollers()
	{

		$data = $this->dash_mdl->enrollers_count();
		echo json_encode($data);
	}

	public function phase2_data_enrollers()
	{

		$data = $this->dash_mdl->phase2_enrollers_count();
		//return 0;
		echo json_encode($data);
	}

	public function jsondata_district()
	{

		$data = $this->dash_mdl->district_count();
		echo json_encode($data);
	}
	public function get_enrollments()
	{
		$people = array();
		$data = $this->db->query("SELECT district, count(reference) as datas from records_json_report WHERE district IS NOT NULL  group by district")->result();
		foreach ($data as $d) {
			$fdata = array($d->district, intval($d->datas));
			array_push($people, $fdata);
		}


		echo json_encode($people);
	}
	public function data_status()
	{
		$fdata = array();
		$total = $this->db->query("SELECT distinct reference from records_json")->num_rows();
		$Cleaned = $this->db->query("SELECT distinct reference from records_json_report")->num_rows();
		$verified = $this->db->query("SELECT reference FROM validated_numbers WHERE kyc_status in ('MATCH','CLOSE MATCH','POSSIBLE MATCH','VERIFIED MATCH')")->num_rows();

		$fdata = array(
			array(
				"Total Collection" => intval($total)
			),
			array(
				"Total Clean Data" => intval($Cleaned)
			), array(
				"Total KYC Verified Data" => intval($verified)
			)

		);

		echo json_encode([$fdata]);
	}
}
