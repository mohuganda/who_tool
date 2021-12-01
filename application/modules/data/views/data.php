<section class="col-lg-12 connectedSortable">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title"> <?php echo $title; ?>   </h3>
                            </div>
                            <div class="card-body">
       
    <table id="example" class="table table-striped table-bordered nowrap mytable" style="width:100%">
        <thead>
            <tr>
            <th>#</th>
            
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
            <th>Consent to save and share Information </th>
            <th>Mobile Number </th>
            <th>Other Contact </th>
            <th>Mobile Money Registration Status </th>
            <th>Is registered by Health Worker </th>
            <th>If No, Registered Name </th>
            <th>Allow Mobile Money </th>
            <th>KYC verification </th>
            <th>Location </th>
            <th>Record Date </th>
            </tr>
        </thead>
        <tbody>
        <?php 
             $i=1;
             $datas = Modules::run('data/data2');
             foreach($datas as $dt): 
             $staff=json_decode($dt->data); 
             $this->db->replace('report',$staff);
             ?>
           

            <tr>
            <td><?php echo $i++; ?></td>
          
            <td><?php  if ($staff->hw_type=='chw') { echo "Community Health worker"; } else { echo "Ministry Health worker"; }  ?></td>
            <td><img src="data:image/png;base64,<?php if(!empty($staff->person_photo)) echo $staff->person_photo; ?> " alt="Img" />
            </td>
            <td>

              <?php echo $staff->surname; ?>
            </td>
            <td><?php echo $staff->firstname ?></td>
            <td><?php echo $staff->othername ?></td>
            <td><?php echo $staff->birth_date ?></td>
            <td><?php echo $staff->birth_place ?></td>
            <td><?php echo $staff->gender ?></td>
            <td><?php echo $staff->position ?></td>
            <td><?php echo $staff->facility ?></td>
            <td><img src="data:image/png;base64,<?php if(!empty($staff->id_photo))echo $staff->id_photo; ?> " alt="Img" />
            </td>
            <td><?php echo $staff->id_type ?></td>
            <td><?php echo $staff->id_number ?></td>
            <td><?php echo $staff->id_expiry ?></td>
            <td><?php echo $staff->consent ?></td>
            <td><?php echo $staff->primary_mobile_number ?></td>
            <td><?php echo $staff->other_contact ?></td>
            <td><?php echo $staff->is_mm_registered ?></td>
            <td><?php echo $staff->is_registered_by_hw ?></td>
            <td><?php echo $staff->registered_mm_name ?></td>
            <td><?php echo $staff->diff_names_consent ?></td>
            <td><?php echo $staff->kyc_verification ?></td>
            <td><?php echo $staff->location ?></td>
            <td><?php echo $staff->record_date ?></td>
           
            
            </tr>
            <?php endforeach; ?>
        </tbody>
</table>
</div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
</section>                           