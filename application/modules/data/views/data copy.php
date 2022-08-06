<style>
    img {
        width: 80px;
        border-radius: 3px;
    }
</style>
<?php
$districts = Modules::run("auth/getDistricts");

$facilities = Modules::run("auth/getFacilities");
?>
<section class="col-lg-12 connectedSortable">
    <div class="row">
        <div class="col-lg-12">

            <div class="card-tools">

                <form class="form-horizontal" action="<?php echo base_url() ?>data/collection" method="post">
                    <div class="row">


                        <?php //print_r($this->session->userdata()); 
                        ?>
                        <div class="form-group col-md-4">
                            <label for="aw_description">
                                Districts </label>
                            <select name="district" class="form-control select2 sdistrict" style="width:100%;" onChange="getFacs($(this).val());">
                                <option value="" disabled selected>DISTRICT</option>
                                <option value="ALL">ALL</option>
                                <?php foreach ($districts as $district) :
                                ?>
                                    <option value="<?php echo $district->district; ?>" <?php if ($this->input->post('district') == $district->district) echo "selected"; ?>><?php echo $district->district; ?></option>
                                <?php endforeach; ?>
                            </select>


                        </div>
                        <div class="form-group col-md-4">
                            <label for="aw_description">
                                Facilities </label>
                            <select name="facility" class="sfacility form-control">
                                <option value="" disabled>All</option>

                            </select>
                        </div>


                    </div>
            </div>

            <div class="row">
                <?php if ($this->input->post('district')) : ?>
                    <a href="<?php echo base_url() ?>data/pdf_data/1" class="btn bt-sm bg-gray-dark color-pale" style="width:100px;"><i class="fa fa-file" aria-hidden="true"></i>PDF</a>
                    &nbsp;&nbsp;
                    <a href="<?php echo base_url() ?>data/csv_data/1" class="btn bt-sm bg-gray-dark color-pale" style="width:100px;"><i class="fa fa-file-excel" aria-hidden="true"></i>CSV</a>
                    &nbsp;&nbsp;
                <?php endif; ?>
                <button type="submit" class="btn bt-sm bg-gray-dark color-pale" style="width:100px; left-right:4px;"><i class="fa fa-tasks" aria-hidden="true"></i>APPLY</button>
                &nbsp;&nbsp;
            </div>
            &nbsp;&nbsp;
        </div>


        </form>


        &nbsp;&nbsp;<p class="pagination"><?php echo $links; ?>

            <b> &nbsp;&nbsp;<?php $t = ($total_rows);
                            if ($t < 0) {
                                echo $t;
                            } else {
                                echo $t;
                            }
                            ' Records'; ?></b>

        <div class="table" style="overflow-x:auto;">


            <table id="example" class="" style="width:100%">
                <thead>
                    <tr>
                        <th label="Image">No</th>
                        <th label="Image">Image</th>
                        <th label="Surname">Surname</th>
                        <th label="Firstname">Firstname </th>
                        <th label="Othername">Othername </th>
                        <th>Record Ref ID</th>
                        <th label="District">District</th>
                        <th label="Worker Type">Worker Type</th>
                        <th label="Date of Birth">Date of Birth </th>
                        <th label="Place of Birth">Place of Birth</th>
                        <th label="Gender">Gender </th>
                        <th label="Position">Position </th>
                        <th label="Facility">Facility </th>
                        <th label="ID Photo">ID Photo </th>
                        <th label="ID Type">ID Type </th>
                        <th label="ID Number">ID Number </th>
                        <th label="ID Expiry"> </th>
                        <th label="National ID Number">National ID Number</th>
                        <th label="National ID Card Number">National ID Card Number</th>
                        <th label="Consent to use Data">Consent to use Data</th>
                        <th label="Signature">Signature</th>
                        <th label="Mobile Number">Mobile Number </th>
                        <th label="Other Contact">Other Contact </th>
                        <th label="Mobile Money Registration Status">Mobile Money Registration Status </th>
                        <th label="Is Number registered by Health Worker">Is Number registered by Health Worker </th>
                        <th label="If previous is No, Registered Name ">If previous is No, Registered Name </th>
                        <th label="Allow Mobile Money">Allow Mobile Money </th>
                        <th label="KYC verification">KYC verification </th>
                        <th label="Sync Date ">Sync Date </th>
                        <th> Clean State </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;

                    foreach ($files as $dt) :
                        $staff = json_decode($dt->data);
                    ?>
                        <tr>
                            <td label="Firstname"><?php echo $i++; ?></td>
                            <td label="Image">
                                <div class=" image"><?php if (!empty(@$staff->person_photo)) { ?><img src="data:image/jpg;base64,<?php echo @$staff->person_photo; ?> " alt="Img" /><?php } ?>
                                </div>
                            </td>
                            <td label="Surname">
                                <?php echo $staff->surname; ?>
                            </td>
                            <td label="Firstname"><?php echo $staff->firstname ?></td>
                            <td label="Othername"><?php echo $staff->othername ?></td>
                            <td label="Record Reference"><?php echo $staff->reference; ?></td>
                            <td label="District"> <?php echo @$staff->district; ?></td>
                            <td label="Health Worker Type">
                                <?php if ($staff->hw_type == 'chw') {
                                    echo "Community Health worker";
                                } else {
                                    echo "Ministry Health worker";
                                }  ?>
                            </td>
                            <td label="Date of Birth"><?php echo @$staff->birth_date ?></td>
                            <td label="Place of Birth"><?php echo @$staff->birth_place ?></td>
                            <td label="Gender"><?php echo $staff->gender ?></td>
                            <td label="Position"><?php echo $staff->job ?></td>
                            <td label="Facility"><?php echo @$staff->facility ?></td>
                            <td label="ID Photo"><?php if (!empty(@$staff->id_photo)) { ?> <img src="data:image/png;base64,<?php echo @$staff->id_photo; ?> " alt="Img" /><?php } ?>
                            </td>
                            <td label="ID Type"><?php echo $staff->id_type ?></td>
                            <td label="ID Number"><?php echo @$staff->ID_Number ?></td>
                            <td label="ID Expiry"><?php echo @$staff->id_expiry ?></td>
                            <td label="National ID"><?php echo @$staff->national_id;
                                                    ?></td>
                            <td label="National ID Card No."><?php echo @$staff->national_id_card_number ?></td>
                            <td label="Data Share Consent"><?php echo $staff->consent ?></td>
                            <td label="Signature"><?php if (!empty(@$staff->consent_image) && (strlen(@$staff->consent_image) > 100)) { ?> <img src="data:image/png;base64,<?php echo @$staff->consent_image; ?> " alt="Img" /><?php } else { ?>
                                <?php echo $staff->consent_image;
                                                                                                                                                                                                                            } ?> </td>
                            <td label="Primary Phone Number"><?php echo $staff->primary_mobile_number ?></td>
                            <td label="Alternative Phone Number"><?php echo $staff->other_contact ?></td>
                            <td label="Mobile Money Registration Status"><?php echo $staff->is_mm_registered ?></td>
                            <td label="Is Number registered by Health Worker"><?php echo $staff->is_registered_by_hw ?></td>
                            <td label="If previous is No, Registered Name"><?php echo $staff->registered_mm_name ?></td>

                            <td label="Allow Mobile Money"><?php echo $staff->diff_names_consent ?></td>
                            <td label="KYC Verification"><?php echo $staff->kyc_verification ?></td>

                            <td label="Sync Date"><?php echo $staff->sync_date ?></td>
                            <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#<?php echo $staff->reference; ?>">
                                    Clean
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="<?php echo $staff->reference; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Data Comment</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo base_url() ?>data/save_status" method="post" class="status_update">
                                                    <input type="hidden" value="<?php echo $staff->reference; ?>" name="reference">
                                                    <textarea name="status" class="form-control"><?php echo $dt->status; ?></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                            </td>

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
        $('.tb').DataTable({
            dom: 'Bfrtip',
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": false,

            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pageLength',


            ]
        });
    });
</script>
<script>
    // $(document).ready(function() {


    //             //Submit new user data

    //             $(".status_update").submit(function(e) {

    //                 e.preventDefault();

    //                 $('.status').html('<img style="max-height:50px" src="<?php //echo base_url(); 
                                                                            ?>assets/img/loading.gif">');
    //                 var formData = $(this).serialize();
    //                 // console.log(formData);
    //                 var url = "<?php //echo base_url(); 
                                    ?>data/save_status";
    //                 $.ajax({
    //                     url: url,
    //                     method: 'post',
    //                     data: formData,
    //                     success: function(result) {
    //                         console.log(result);
    //                         setTimeout(function() {
    //                             $('.status').html(result);
    //                             $.notify(result, 'info');
    //                             $('.status').html('');
    //                             $('.clear').click();
    //                         }, 1000);


    //                     }
    //                 }); //ajax

    //             }}));
    //form submit
</script>