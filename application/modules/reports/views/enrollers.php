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

            <th>Enroller Key </th>
            <th>Enroller </th>
            <th>Enroller Email </th>
        
            </tr>
        </thead>
        <tbody>
        <?php 
             $i=1;
   
             foreach($staffs as $staff): 
       
             
             ?>
           

            <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $staff->username ?></td>
            <td><?php echo $staff->name ?></td>
            <td><?php echo $staff->email ?></td>
            
           
            
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