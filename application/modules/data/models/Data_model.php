<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_model extends CI_Model
{



	public function getData2($limits, $starts, $dfilter, $ffilter, $fworker_type, $print)
	{
		if ($print == 1) {
			$limit = "";
		} else {

			$limit = "LIMIT $starts,$limits";
		}
		$query = $this->db->query("SELECT data FROM `records_json`  $dfilter $ffilter, $fworker_type ORDER BY sync_date DESC $limit");
		return $query->result();
	}
	public function cleangetData2($limits, $starts, $dfilter, $ffilter, $fworker_type, $print)
	{
		if ($print == 1) {
			$limit = "";
		} else {

			$limit = "LIMIT $starts,$limits";
		}
		$query = $this->db->query("SELECT * FROM `records_json_report` where status='Clean' $dfilter $ffilter $fworker_type ORDER BY sync_date DESC $limit");
		return $query->result();
	}
	public function getColums()
	{
		$query = $this->db->query("SELECT sync_date,data FROM `records_json`");
		return $query->result();
	}
	public function getColumsup()
	{
		$query = $this->db->query("SELECT Distinct facility FROM `records_json_report` WHERE district is NULL");
		return $query->result();
	}
	public function getData()
	{

		$query = $this->db->query("SELECT  sync_date, data FROM `records_json` ORDER BY STR_TO_DATE(sync_date,'%d-%m-%Y') DESC");
		return $query->result();
	}
	public function kycData($filters)
	{
		if (empty($filters)) {
			$filters = "";
		}
		$query = $this->db->query("SELECT r.*,u.name as enroller,u.email as enroller_email FROM `report` r LEFT JOIN user u on u.user_id=r.user_id WHERE kyc_verification='yes'");
		return $query->result();
	}
	public function headers()
	{
		return $this->db->get('fields')->result();
	}

	public function mtn_data($limits, $starts, $dfilter, $ffilter, $fworker_type, $print)
	{
		if ($print == 1) {
			$limit = "";
		} else {

			$limit = "LIMIT $starts,$limits";
		}
		$query = $this->db->query("SELECT * FROM `mtn_clients` WHERE status='clean' $dfilter $ffilter $fworker_type ORDER BY surname ASC $limit");
		return $query->result();
	}
	public function airtel_data($limits, $starts, $dfilter, $ffilter, $fworker_type, $print)
	{
		if ($print == 1) {
			$limit = "";
		} else {

			$limit = "LIMIT $starts,$limits";
		}
		$query = $this->db->query("SELECT * FROM `airtel_clients` WHERE status='clean' $dfilter $ffilter $fworker_type ORDER BY surname ASC $limit");
		return $query->result();
	}
}
