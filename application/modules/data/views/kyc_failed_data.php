<style>
    img {
        width: 80px;
        border-radius: 3px;
    }
</style>
<?php
$districts = Modules::run("auth/getDistricts");

$facilities = Modules::run("auth/getFacilities");
$kyc_status = Modules::run("data/kyc_status");

?>
<section class="col-lg-12 connectedSortable">
    <div class="row">
        <div class="col-lg-12">

            <div class="card-tools">

                <form class="form-horizontal" action="<?php echo base_url() ?>data/kyc_failed_csv" method="get">
                    <div class="row">


                        <?php //print_r($this->session->userdata());
                        ?>
                        <div class="form-group col-md-4">
                            <label for="aw_description">
                                Districts </label>
                            <select name="district" class="form-control select2 sdistrict" style="width:100%;" onChange="getFacs($(this).val());">
                                <option value="" disabled selected>DISTRICT</option>
                                <option value="">ALL</option>
                                <?php
                                if ($_SESSION['role'] != "District Administrator") {
                                    foreach ($districts as $district) :
                                ?>
                                        <option value="<?php echo $district->district; ?>" <?php if (urldecode($this->input->get('district')) == $district->district) echo "selected"; ?>><?php echo $district->district; ?></option>
                                    <?php endforeach;
                                } else { ?>
                                    <option value="<?php echo $_SESSION['district']; ?>" <?php if (urldecode($this->input->get('district')) == $_SESSION['district']) echo "selected"; ?>><?php echo $_SESSION['district']; ?></option>
                                <?php }

                                ?>
                            </select>


                        </div>
                        <div class="form-group col-md-4">
                            <label for="aw_description">
                                Facilities </label>
                            <select name="facility" class="sfacility form-control select2">
                                <option value="" disabled>All</option>

                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="aw_description">
                                Worker Category </label>
                            <select name="worker_type" class="form-control select2">
                                <option value="">All</option>
                                <option value="mhw">Main Stream</option>
                                <option value="chw">VHT</option>

                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="aw_description">
                                Job </label>
                            <select name="job" class="form-control select2 sdistrict" style="width:100%;">
                                <option value="">All</option>

                                <?php foreach ($jobs as $job) :
                                ?>
                                    <option value="<?php echo $job->job; ?>" <?php if (urldecode($this->input->get('job')) == $job->job) echo "selected"; ?>><?php echo $job->job; ?></option>
                                <?php endforeach; ?>
                            </select>




                        </div>


                        <div class="form-group col-md-4">
                            <label for="aw_description">
                                Search </label>
                            <input type="text" class="form-control" name="search" placeholder="Search Name">

                        </div>


                    </div>
            </div>

            <div class="row">
                <a href="<?php echo base_url() ?>data/kyc_csv/1/<?php echo $form ?>" class="btn bt-sm bg-gray-dark color-pale" style="width:100px;"><i class="fa fa-file-excel" aria-hidden="true"></i>CSV</a>
                &nbsp;&nbsp;
                <button type="submit" class="btn bt-sm bg-gray-dark color-pale" style="width:100px; "><i class="fa fa-tasks" aria-hidden="true"></i>APPLY</button>
                &nbsp;&nbsp;
            </div>
            &nbsp;&nbsp;

        </div>


        </form>
        <?php //print_r($jobs); 
        ?>

        &nbsp;&nbsp;<p class="pagination"><?php echo $links; ?>

            <b> &nbsp;&nbsp;<?php echo $total_rows . ' Records'; ?></b>

        <div class="table" style="overflow-x:auto;">
            <table id=" example" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Record Ref ID</th>
                        <th>Worker Category</th>
                        <th>National ID</th>
                        <th label="Customer Name">Customer Name</th>
                        <th label="Network Provider Registered Name">Network Provider Registered Name </th>
                        <th label="Position">Position </th>
                        <th label="Kyc Status">KYC Status </th>
                        <th label="Mobile Number">Primary Mobile Number </th>
                        <th label="Facility ">Facility </th>
                        <th label="Ditrict">District</th>
                        <th label="Action">Update KYC</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;

                    foreach ($files as $staff) :


                    ?>

                        <td label="No"><?php echo $i++ ?></td>
                        <td label="Record Reference"><?php echo $staff->reference ?></td>
                        <td label="Worker Category"><?php if ($staff->hw_type == 'chw') {
                                                        echo "Community Health worker";
                                                    } else {
                                                        echo "Ministry Health worker";
                                                    }  ?></td>
                        <td label="National ID"> <?php echo ucwords($staff->national_id); ?> </td>
                        <td label="Name"> <?php echo ucwords($staff->customer_name); ?> </td>
                        <td label="MNO Name"> <?php echo ucwords($staff->mno_registered_name); ?> </td>
                        <td label="Primary Phone Number"><?php echo $staff->job ?></td>
                        <td label="Primary Phone Number"><?php echo $staff->kyc_status ?></td>
                        <td label="Primary Phone Number"><?php echo $staff->mobile_number ?></td>
                        <td label="Primary Phone Number"><?php echo $staff->facility ?></td>
                        <td label="Primary Phone Number"><?php echo $staff->district ?></td>
                        <td><button type="button" class="btn bt-sm bg-gray-dark color-pale" data-toggle="modal" data-target="#<?php echo $staff->reference ?>">
                                Update
                            </button></td>

                        <!-- The Modal -->
                        <form class="kyc_form" method="post" action="">
                            <div class="modal" id="<?php echo $staff->reference ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Update KYC FOR: <?php echo ucwords($staff->customer_name); ?></h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <span class="kyc_loader"></span>
                                        </div>

                                        <!-- Modal body -->
                                        <div class=" modal-body">

                                            <div class="form-group col-md-12">
                                                <label for="aw_description">
                                                    KYC STATUS </label>
                                                <select class="form-control" name="kyc_status">
                                                    <?php $kycs = array('MATCH', 'CLOSE MATCH', 'POSSIBLE MATCH', 'VERIFIED MATCH', 'DOES NOT MATCH');
                                                    foreach ($kycs as $kyc) : ?>
                                                        <option value="<?php echo $kyc; ?>" <?php if ($kyc == $staff->kyc_status) {
                                                                                                echo "selected";
                                                                                            } ?>><?php echo $kyc; ?></option>
                                                    <?php endforeach; ?>
                                                </select>

                                                <div class="form-group col-md-12">
                                                    <label for="aw_description">
                                                        DISTRICT </label>
                                                    <select name="district" class="form-control select2 sdistrict" style="width:100%;">
                                                        <option value="" disabled selected>DISTRICT</option>
                                                        <option value="">ALL</option>
                                                        <?php
                                                        if ($_SESSION['role'] != "District Administrator") {
                                                            foreach ($districts as $district) :
                                                        ?>
                                                                <option value="<?php echo $district->district; ?>" <?php if (urldecode($this->input->get('district')) == $district->district) echo "selected"; ?>><?php echo $district->district; ?></option>
                                                            <?php endforeach;
                                                        } else { ?>
                                                            <option value="<?php echo $_SESSION['district']; ?>" <?php if (urldecode($this->input->get('district')) == $_SESSION['district']) echo "selected"; ?>><?php echo $_SESSION['district']; ?></option>
                                                        <?php }

                                                        ?>
                                                    </select>


                                                </div>




                                            </div>

                                            <!-- Modal footer -->
                                            <div class=" modal-footer">
                                                <button type="Submit" class="btn bt-sm bg-gray-dark color-pale">Update</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                        </form>
                        <!-- The Modal -->

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




        $(".kyc_form").submit(function(e) {

            e.preventDefault();

            var formData = $(this).serialize();
            console.log(formData);
            var url = "<?php echo base_url(); ?>data/update_kyc";
            $.ajax({
                    url: url,
                    method: 'post',
                    data: formData,
                    success: function(result) {


                        setTimeout(function() {
                            $('.status').html(result);
                            $.notify(result, 'info');
                            $('.status').html('');
                            $('.clear').click();
                        }, 1000);


                    }



                }

            ); //ajax

        }); //form submit
        console.log(formData);
    });
</script>