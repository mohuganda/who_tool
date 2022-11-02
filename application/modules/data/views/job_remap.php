<section class="col-lg-12 connectedSortable">
    <div class="row">
        <div class="col-lg-12">

            <div class="card-tools">
                <p> <?php echo $message; ?></p>

                <form class="form-horizontal" action="<?php echo base_url() ?>data/data_remap" method="post">
                    <div class="row">


                        <?php //print_r($this->session->userdata());
                        ?>
                        <div class="form-group col-md-4">
                            <label for="aw_description">
                                Job </label>
                            <select name="job" class="form-control" style="width:100%;">
                                <?php

                                foreach ($jobs as $job) : ?>

                                    <option value="<?php echo $job->job ?>"><?php echo $job->job; ?></option>
                                <?php
                                endforeach;
                                ?>

                            </select>


                        </div>
                        <div class="form-group col-md-4">
                            <label for="aw_description">
                                Remap Value </label>
                            <input type="text" name="value" class="form-control">
                            </select>
                        </div>



                    </div>
            </div>

            <div class="row">

                <button type="submit" class="btn bt-sm bg-gray-dark color-pale" style="width:100px; "><i class="fa fa-tasks" aria-hidden="true"></i>Remap</button>
                &nbsp;&nbsp;
            </div>
            &nbsp;&nbsp;

        </div>


        </form>
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