<style>
    table.dataTable {
  border: 3px solid #000000;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}
table.dataTable td, table.dataTable th {
  border: 1px solid #000000;
  padding: 5px 4px;
}
table.dataTable tbody td {
  font-size: 13px;
}
table.dataTable thead {
  background: #CFCFCF;
  background: -moz-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
  background: -webkit-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
  background: linear-gradient(to bottom, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
  border-bottom: 3px solid #000000;
}
table.dataTable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #000000;
  text-align: left;
}
table.dataTable tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #000000;
  border-top: 3px solid #000000;
}
table.dataTable tfoot td {
  font-size: 14px;
}
img{
        width:80px;
        border-radius:3px;
    }
</style>
<section class="col-lg-12 connectedSortable">
    <div class="row">
        <h3>HEALTH WORKERS LIST FOR -    <?php echo str_replace('%','',str_replace('WHERE district like ','',$_SESSION['dfilter'])); ?> DISTRICT</h3>
    
    <table id="example" class="dataTable table-striped table-bordered nowrap table-responsive" style="width:100%">
        <thead>
            <tr>
            <th>#</th>
            <th>Worker Type</th>
            <th>Image</th>
            <th>Surname</th>
            <th>Firstname </th>
            <!-- <th>Othername </th> -->
            <th>Date of Birth </th>
            <th>Place </th>
            <th>Gender </th>
            <th>position </th>
            <th>facility </th>
             <th>ID Photo </th>
            <th>ID Type </th>
            <th>ID Number </th>
            <th>ID Expiry </th>
            <th>National ID Number</th>
            <th>National ID Card Number</th>
            <th>Allow Consent</th>
            <!-- <th>Signature</th> -->
            <th>Mobile Number </th>
            <th>Other Contact </th>
            <th>Mobile Money Registration Status </th>
            <th>Is registered by Health Worker </th>
            <th>If No, Registered Name </th>
            <th>Allow Mobile Money </th>
            <th>KYC verification </th>
          
            </tr>
        </thead>
        <tbody>
        <?php 
             $i=1;
            
             foreach($files as $dt): 
             $staff=json_decode($dt->data); 
             //print_r();
             ?>
            <tr>
            <td> <?php echo @$i++; ?></td>
            <td><?php  if ($staff->hw_type=='chw') { echo "Community Health worker"; } else { echo "Ministry Health worker"; }  ?></td>
           <?php $photo="<img src=\"data:image/jpg;base64, ".@$staff->person_photo."\"/>"; ?>
             <td><div class="image"><?php if(!empty(@$staff->person_photo)){ echo $photo; }?>
             </div> </td>
            <td>
             
            <?php echo $staff->surname; ?>
            </td>
            <td><?php echo $staff->firstname ?></td>
            <!-- <td><?php //echo $staff->othername ?></td> -->
            <td><?php echo @$staff->birth_date ?></td>
            <td><?php echo @$staff->birth_place ?></td>
            <td><?php echo $staff->gender ?></td>
            <td><?php echo $staff->job ?></td>
            <td><?php echo @$dt->facility ?></td>
            <td><?php if(!empty(@$staff->id_photo)){ ?> <img src="data:image/jpg;base64,<?php echo @$staff->id_photo; ?> " /><?php }?>
            </td>
            <td><?php echo $staff->id_type ?></td>
            <td><?php echo @$staff->ID_Number ?></td>
            <td><?php echo @$staff->id_expiry ?></td>
            <td><?php echo @$staff->national_id ?></td>
            <td><?php echo @$staff->national_id_card_number ?></td>
            <td><?php echo $staff->consent ?></td>
            <!-- <td><?php //if(!empty(@$staff->consent_image)&&(strlen(@$staff->consent_image)>100)){ ?> <img src="data:image/png;base64,<?php// echo @$staff->consent_image; ?> " alt="Img"  /><?php //}else{?>
            <?php //echo $staff->consent_image; } ?> </td> -->
            <td><?php echo $staff->primary_mobile_number ?></td>
            <td><?php echo $staff->other_contact ?></td>
            <td><?php echo $staff->is_mm_registered ?></td>
            <td><?php echo $staff->is_registered_by_hw ?></td>
            <td><?php echo $staff->registered_mm_name ?></td>
            
            <td><?php echo $staff->diff_names_consent ?></td>
            <td><?php echo $staff->kyc_verification ?></td>
            
      
           
            
            </tr>
            <?php endforeach; ?>
        </tbody>
</table>
</div>

    
</section>          
                