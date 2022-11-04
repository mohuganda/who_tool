<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_mdl extends CI_Model
{


    public function __Construct()
    {

        parent::__Construct();
        $this->department = $this->session->userdata['department_id'];

        // Set orderable column fields
        $this->column_order = array(null, 'id', 'district', 'chw', 'mhw', 'total');
        // Set searchable column fields
        $this->column_search = array('first_name', 'last_name', 'email', 'gender', 'country', 'created', 'status');
        // Set default order
        $this->order = array('first_name' => 'asc');
    }
    public function getData()
    {
        $data['total_records'] = $this->db->query("select count(id) as total_records from records_json_report")->row()->total_records;
        ///total verified
        $data['total_verified'] = $this->db->query("SELECT r.reference FROM validated_numbers v JOIN records_json_report r ON v.reference=r.reference and kyc_status in ('MATCH','CLOSE MATCH','POSSIBLE MATCH','VERIFIED MATCH')")->num_rows();
        //total  chws
        $data['chwdata_verified'] = $this->db->query("SELECT r.reference FROM validated_numbers v JOIN records_json_report r ON v.reference=r.reference and kyc_status in ('MATCH','CLOSE MATCH','POSSIBLE MATCH','VERIFIED MATCH') and r.job='VHT'")->num_rows();
        //not verified
        $data['chwdata_not_verified'] = $this->db->query("SELECT r.reference FROM validated_numbers v JOIN records_json_report r ON v.reference=r.reference and kyc_status not in ('MATCH','CLOSE MATCH','POSSIBLE MATCH','VERIFIED MATCH') and r.job='VHT'")->num_rows();

        $data['mhwdata_verified'] = $this->db->query("SELECT r.reference FROM validated_numbers v JOIN records_json_report r ON v.reference=r.reference and kyc_status in ('MATCH','CLOSE MATCH','POSSIBLE MATCH','VERIFIED MATCH') and r.hw_type='mhw'")->num_rows();

        $data['mhwdata_not_verified'] = $this->db->query("SELECT r.reference FROM validated_numbers v JOIN records_json_report r ON v.reference=r.reference and kyc_status not in ('MATCH','CLOSE MATCH','POSSIBLE MATCH','VERIFIED MATCH') and r.hw_type='mhw'")->num_rows();
        //other records
        $data['others_verified'] = $this->db->query("SELECT r.reference FROM validated_numbers v JOIN records_json_report r ON v.reference=r.reference and kyc_status in ('MATCH','CLOSE MATCH','POSSIBLE MATCH','VERIFIED MATCH') and r.hw_type!='mhw' and r.job!='VHT'")->num_rows();

        $data['others_not_verified'] = $this->db->query("SELECT r.reference FROM validated_numbers v JOIN records_json_report r ON v.reference=r.reference and kyc_status not in ('MATCH','CLOSE MATCH','POSSIBLE MATCH','VERIFIED MATCH') and r.hw_type!='mhw' and r.job!='VHT'")->num_rows();

        $data['covered_districts'] = $this->db->query("SELECT distinct district from records_json_report WHERE district!=''")->num_rows();

        $data['covered_facilities'] = $this->db->query("SELECT distinct facility from records_json_report WHERE facility!=''")->num_rows();

        // $data['updated_records'] = $this->db->query("SELECT distinct ihris_pid from records_json_report ")->num_rows();


        // $data['mhwdata']= $this->db->query("SELECT reference as ministry_workers from records_json WHERE JSON_EXTRACT(data,'$.hw_type')='mhw'")->num_rows();

        return $data;
    }

    public function mno_graph()
    {
        $data['mtn_verified'] = $this->db->query("SELECT r.reference FROM validated_numbers v JOIN records_json_report r ON v.reference=r.reference and kyc_status  in ('MATCH','CLOSE MATCH','POSSIBLE MATCH','VERIFIED MATCH') and  r.primary_mobile_operator='MTN'")->num_rows();
        $data['airtel_verified'] = $this->db->query("SELECT r.reference FROM validated_numbers v JOIN records_json_report r ON v.reference=r.reference and kyc_status  in ('MATCH','CLOSE MATCH','POSSIBLE MATCH','VERIFIED MATCH') and  r.primary_mobile_operator='Airtel'")->num_rows();
        $data['others_verified'] = $this->db->query("SELECT r.reference FROM validated_numbers v JOIN records_json_report r ON v.reference=r.reference and kyc_status  in ('MATCH','CLOSE MATCH','POSSIBLE MATCH','VERIFIED MATCH') and  r.primary_mobile_operator NOT IN ('Airtel','MTN')")->num_rows();
        return  $data;
    }

    //
    public function district_count()
    {

        $counts = array();
        $district = $this->db->query("SELECT distinct district from ihrisdata order by district ASC")->result();
        $id = 1;
        foreach ($district as $dist) :
            $data['mhw'] = $this->count_ministry($dist->district);
            $data['chw'] = $this->count_community($dist->district);
            $data['district'] = $dist->district;
            $data['total'] = $data['chw'] + $data['mhw'];
            $data['id'] = $id++;
            array_push($counts, $data);



        endforeach;

        return $counts;
    }
    public function count_ministry($district)
    {
        return  $this->db->query("SELECT reference from records_json_report WHERE district='$district' AND hw_type='mhw'")->num_rows();
    }
    public function count_community($district)
    {
        return  $this->db->query("SELECT reference from records_json_report WHERE district='$district' AND hw_type='chw'")->num_rows();
    }

    public function enrollers_count()
    {

        $counts = array();
        $user = $this->db->query("SELECT distinct user_id,name,contact,username,district from user WHERE user_id!=1 order by username ASC")->result();
        $id = 1;
        $date = $this->input->post('udate');
        foreach ($user as $u) :
            $data['total'] = $this->user_records($date = FALSE, $u->user_id);
            $data['name'] = $u->name;
            $data['code'] = $u->username;
            $data['contact'] = $u->contact;
            $data['district'] = $u->district;
            $data['id'] = $id++;
            array_push($counts, $data);

        endforeach;

        return $counts;
    }


    public function phase2_enrollers_count()
    {

        $counts = array();
        $user = $this->db->query("SELECT distinct user_id,name,contact,username,district from user WHERE user_id!=1 order by username ASC")->result();
        $id = 1;
        $date = $this->input->post('udate');
        foreach ($user as $u) :
            $data['total'] = $this->phase2_user_records($date = FALSE, $u->user_id);
            $data['name'] = $u->name;
            $data['code'] = $u->username;
            $data['contact'] = $u->contact;
            $data['district'] = $u->district;
            $data['id'] = $id++;
            array_push($counts, $data);

        endforeach;

        return $counts;
    }
    public function user_records($date = FALSE, $user_id)
    {
        if (!empty($date)) {
            $dfilter = "AND sync_date like '$date%'";
        } else {
            $dfilter = "";
        }
        return $this->db->query("SELECT reference from records_json_report WHERE user_id=$user_id $dfilter")->num_rows();
    }
    public function phase2_user_records($date = FALSE, $user_id)
    {
        if (!empty($date)) {
            $dfilter = "AND sync_date like '$date%'";
        } else {
            $dfilter = "";
        }
        return $this->db->query("SELECT reference from records_json_report WHERE user_id=$user_id and DATE_FORMAT(sync_date, '%Y-%m-%d')>'2022-03-31'")->num_rows();
    }
}
