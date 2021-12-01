 <!-- Main content -->
 <style>
.info-box-main {
    box-shadow: 0 0 1px rgba(86, 76, 76, 0.13),0 1px 3px rgba(110, 68, 68, 0.2);
    border-radius: .25rem;
    background: linear-gradient( 135deg, rgb(56 54 54) 0%, rgb(11 155 206 / 78%) 100%);
    text-align: center;
    display: -ms-flexbox;
    display: flex;
    margin-bottom: 1rem;
    min-height: 90px;
    padding: .5rem;
    border-radius: 6px;
    position: relative;
    color: #FFF;
}
</style>
 <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
       
        <?php
         $permissions=$this->session->userdata('permissions');
        //  print_r($permissions);
        if(in_array('33', $permissions)){ 
          $display="active";
           }
           else{
          $display="none";
           }
          
          ?>
       
       
      <div class="row">
            <!-- /.info-box -->
      <div class="col-md-3">
        <div class="info-box mb-3 bg-cyan ">
              <span class="info-box-icon"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">iHRIS Manage</span>
                <span class="info-box-number" id="ihrisdata"></span>
              </div>
              <!-- /.info-box-content-->
        </div>
            <!-- /.info-box -->
      </div>
            
            <!-- /.info-box -->
      <div class="col-md-3">
        <div class="info-box mb-3 bg-green">
              <span class="info-box-icon"><i class="far fa-building"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">CHW Registry</span>
                <span class="info-box-number" id="chwdata" ></span>
        </div>
              <!-- /.info-box-content -->
        </div>
            <!-- /.info-box -->
        </div>
            
            <!-- /.info-box -->
      <div class="col-md-3">
         <div class="info-box mb-3 bg-danger">
              <span class="info-box-icon"><i class="fas fa-school"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Daily Updates</span>
                <span class="info-box-number" id="updates"></span>
             </div>
              <!-- /.info-box-content -->
        </div>
        </div>
            
            <!-- /.info-box -->
      <div class="col-md-3">
        <div class="info-box mb-3 bg-yellow">
              <span class="info-box-icon"><i class="fas fa-tasks" ></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Data Clerks</span>
                <span class="info-box-number" id="jobs"></span>
              </div>
              <!-- /.info-box-content-->
        </div>
        </div>
        </div>
    
      <div class="row">
       <section class="col-lg-4 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
              
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <!-- <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                    </li> -->
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
             
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
         
          
          </section>
          <section class="col-lg-8 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
              
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <!-- <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                    </li> -->
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                
             
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
         
          
          </section>
          </div>

        

          


    
            <!-- Info Boxes Style 2 -->
      




    
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<script src="<?php echo base_url()?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script type="text/javascript">
  Highcharts.setOptions({
    colors: ['#28a745',   '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
    });
//get dashboard Data
$(document).ready(function(){
        knobgauge(0);
        $.ajax({
            type:'GET',
            url:'<?php echo base_url('dashboard/dashboardData')?>',
            dataType: "json",
            data:'',
            success:function(data){
                
                    // $('#workers').text(data.workers);
                  
                   // console.log(data);
               
                
            }
            
        });
       
       
   
});
 
</script>



         