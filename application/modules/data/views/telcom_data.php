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

                <form class="form-horizontal" action="<?php echo base_url() ?>data/<?php echo $form ?>" method="post">
                    <div class="row">


                        <?php //print_r($this->session->userdata()); 
                        ?>
                        <div class="form-group col-md-4">
                            <label for="aw_description">
                                Districts </label>
                            <select name="district" class="form-control select2 sdistrict" style="width:100%;" onChange="getFacs($(this).val());">
                                <option value="" disabled selected>DISTRICT</option>
                                <option value="">ALL</option>
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


                <a href="<?php echo base_url() ?>data/mono_data/1/<?php echo $form ?>" class="btn bt-sm bg-gray-dark color-pale" style="width:100px;"><i class="fa fa-file-excel" aria-hidden="true"></i>CSV</a>
                &nbsp;&nbsp;

                <button type="submit" class="btn bt-sm bg-gray-dark color-pale" style="width:100px; "><i class="fa fa-tasks" aria-hidden="true"></i>APPLY</button>
                &nbsp;&nbsp;
            </div>
            &nbsp;&nbsp;

        </div>


        </form>


        &nbsp;&nbsp;<p class="pagination"><?php echo $links; ?>

            <b> &nbsp;&nbsp;<?php echo $total_rows . ' Records'; ?></b>

        <div class="table" style="overflow-x:auto;">


            <table id="example" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Record Ref ID</th>
                        <th label="Surname">Surname</th>
                        <th label="Firstname">Firstname </th>
                        <th label="Othername">Othername </th>
                        <th label="Mobile Number">Primary Mobile Number </th>
                        <th label="Registered Name if Not Owner"> Registered Name </th>
                        <th label="National ID">National ID</th>
                        <th label="Job">Job</th>
                        <th label="Facility ">Facility </th>
                        <th label="Ditrict">District</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;

                    foreach ($files as $staff) :


                    ?>

                        <td label="Record Reference"><?php echo $i++ ?></td>
                        <td label="Record Reference"><?php echo $staff->reference ?></td>
                        <td label="Surname"> <?php echo ucwords($staff->surname); ?> </td>
                        <td label="Firstname"><?php echo ucwords($staff->firstname) ?></td>
                        <td label="Othername"><?php echo ucwords($staff->othername) ?></td>
                        <td label="Primary Phone Number"><?php echo $staff->primary_mobile_number ?></td>
                        <td label="Consented Registered Names"><?php echo ucwords($staff->registered_mm_name) ?></td>
                        <td label="National ID"><?php echo ucwords(@$staff->national_id) ?></td>
                        <td label="Position"><?php echo ucwords($staff->job) ?></td>
                        <td label="Facility"><?php echo ucwords(@$staff->facility) ?></td>
                        <td label="District"> <?php echo @$staff->district; ?></td>



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