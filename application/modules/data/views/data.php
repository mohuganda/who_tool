<style>
    img{
        width:80px;
        border-radius:3px;
    }
</style>
<?php
$districts=Modules::run("auth/getDistricts");  

$facilities=Modules::run("auth/getFacilities"); 
?>
<section class="col-lg-12 connectedSortable">
                <div class="row">
                    <div class="col-lg-12">
                    <p class="pagination"><?php echo $links;?>
                    <div class="card-tools">
                
                  <form class="form-horizontal" action="<?php echo base_url() ?>employees/viewTimeLogs" method="post">
                
                  <div class="row">
                    <div class="form-group col-md-3">
                    <label>Date From:</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                        </div>
                        <input type="text"  name="sync_date" class="form-control datepicker" value="<?php echo date("Y-m-d"); ?>" autocomplete="off">
                    </div>
                    <!-- /.input group -->
                    </div>
                    
                            
                  <div class="form-group col-md-3">
                       <label for="aw_description">
                        Districts </label>
                    <select onChange="getFacs($(this).val());" name="district"  class="form-control select2 sdistrict" style="width:100%;">
                    <option value="" disabled selected>DISTRICT</option>
                    <?php  foreach($districts as $district): 
                                  ?>
                    <option value="<?php echo $district->district; ?>"><?php echo $district->district; ?></option>
                                <?php endforeach; ?>
                    </select>

                        
                    </div>
                    <div class="form-group col-md-3">
                       <label for="aw_description">
                        Facilities </label>
                    <select onChange="getFacs($(this).val());" name="facility"  class="form-control select2" style="width:100%;">
                    <option value="" disabled selected>FACILITY</option>
                    <?php  foreach($facilities as $facility): 
                                  ?>
                    <option value="<?php echo $facility->facility; ?>"><?php echo $facility->facility; ?></option>
                                <?php endforeach; ?>
                    </select>
                    </div>
                        
                  
                        
    
                <div class="form-group col-md-2">
            
                <button type="submit" class="btn bt-sm bg-gray-dark color-pale"  style="width:100px;"><i class="fa fa-tasks" aria-hidden="true"></i>Apply</button>
               
              </div>
       
            
              </form>

               
                        
              </div>
<div class="table"  style="overflow-x:auto;">


    <table id="example" class="table tb table-striped table-bordered nowrap table-responsive" style="width:100%">
        <thead>
            <tr>
            <th>#</th>
            <th>Enroller ID</th>
            <th>District</th>
            <th>Worker Type</th>
            <th>Image</th>
            <th>Surname</th>
            <th>Firstname </th>
            <th>Othername </th>
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
            <th>Signature</th>
            <th>Mobile Number </th>
            <th>Other Contact </th>
            <th>Mobile Money Registration Status </th>
            <th>Is registered by Health Worker </th>
            <th>If No, Registered Name </th>
            <th>Allow Mobile Money </th>
            <th>KYC verification </th>
            <th>Sync Date </th>
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
            <td><?php echo $dt->reference ?></td>
            <td> <?php echo @$staff->user_id; ?></td>
            <td> <?php if(!empty($staff->district)) {echo @$staff->district;}else{ echo Modules::run('data/render_district',$staff->facility);} ?></td>
            <td><?php  if ($staff->hw_type=='chw') { echo "Community Health worker"; } else { echo "Ministry Health worker"; }  ?></td>
            <td><div class="image"><?php if(!empty(@$staff->person_photo)){?><img src="data:image/png;base64,<?php  echo @$staff->person_photo; ?> " alt="Img" /><?php } ?>
             </div> </td>
            <td>

            <?php echo $staff->surname; ?>
            </td>
            <td><?php echo $staff->firstname ?></td>
            <td><?php echo $staff->othername ?></td>
            <td><?php echo @$staff->birth_date ?></td>
            <td><?php echo @$staff->birth_place ?></td>
            <td><?php echo $staff->gender ?></td>
            <td><?php echo $staff->job ?></td>
            <td><?php echo $staff->facility ?></td>
            <td><?php if(!empty(@$staff->id_photo)){ ?> <img src="data:image/png;base64,<?php echo @$staff->id_photo; ?> " alt="Img"  /><?php }?>
            </td>
            <td><?php echo $staff->id_type ?></td>
            <td><?php echo $staff->id_number ?></td>
            <td><?php echo $staff->id_expiry ?></td>
            <td><?php echo $staff->national_id ?></td>
            <td><?php echo $staff->national_id_card_number ?></td>
            <td><?php echo $staff->consent ?></td>
            <td><?php if(!empty(@$staff->consent_image)&&(strlen(@$staff->consent_image)>100)){ ?> <img src="data:image/png;base64,<?php echo @$staff->consent_image; ?> " alt="Img"  /><?php }else{?>
            <?php echo $staff->consent_image; } ?> </td>
            <td><?php echo $staff->primary_mobile_number ?></td>
            <td><?php echo $staff->other_contact ?></td>
            <td><?php echo $staff->is_mm_registered ?></td>
            <td><?php echo $staff->is_registered_by_hw ?></td>
            <td><?php echo $staff->registered_mm_name ?></td>
            
            <td><?php echo $staff->diff_names_consent ?></td>
            <td><?php echo $staff->kyc_verification ?></td>
            
            <td><?php echo $dt->sync_date ?></td>
           
            
            </tr>
            <?php endforeach; ?>
        </tbody>
</table>
             </div>

        <!-- /.box -->
    </div>
</div>
</section>          
<script>
 $(document).ready(function() {
    $('.tb').DataTable( {
        dom: 'Bfrtip',
        "lengthChange": true,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": false,
        lengthMenu: [
            [ 25, 50, 100,150, -1 ],
            [ '25', '50', '100','150','200', 'Show all' ]
        ],
      
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pageLength',
            
            
        ]
    } );
});
</script>                 