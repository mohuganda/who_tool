   
       <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
              <h6>Data Aggregation By District</h6>
                <div class="card-tools">
                 
                  <ul class="nav nav-pills ml-auto">
      

                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
          
           <table  class="table table-striped table-bordered nowrap mytable" style="width:100%" >
             <thead>
            <tr>
            <th>#</th>
            
                <th>District</th>
                <th>Community HW</th>
                <th>MoH Workers</th>
                <th>Total</th>
          </tr>
          </thead>
          <tbody>
            <?php 
            $districts = Modules::run('dashboard/data_district'); 
           // print_r($districts);
            foreach($districts as $district): ?>
              <tr>
                  <td><?php echo $district['id'] ?></td>
                  <td><?php echo $district['district'] ?></td>
                  <td><?php echo $district['chw'] ?></td>
                  <td><?php echo $district['mhw'] ?></td>
                  <td><?php echo $district['total'] ?></td>
                 
                  
                </tr>
             <?php  endforeach; ?>
          </tbody>
          </table>
          </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
       
          
          </section>
