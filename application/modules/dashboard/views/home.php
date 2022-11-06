 <!-- Main content -->
 <style>
   .info-box-main {
     box-shadow: 0 0 1px rgba(86, 76, 76, 0.13), 0 1px 3px rgba(110, 68, 68, 0.2);
     border-radius: .25rem;
     background: linear-gradient(135deg, rgb(56 54 54) 0%, rgb(11 155 206 / 78%) 100%);
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

 <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
 <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

 <!-- Main content -->
 <section class="content" ng-controller="DashboardCtrl" style="background-image: url('assets/MOH.png');">
   <div class="container-fluid">
     <!-- Main row -->
     <div class="row">


       <div class="col-md-3">
         <!-- Info Boxes Style 2 -->
         <div class="info-box mb-3 bg-dark">
           <span class="info-box-icon" style="color:#FFF !important;"><i class="fas fa-mobile-alt"></i></span>

           <div class="info-box-content" style="color:#FFF !important;">
             <span class="info-box-text">Total Records Via Mobile</span>
             <span class="info-box-number">
               <div id="total_records"></div>

             </span>
           </div>
           <!-- /.info-box-content-->
         </div>
         <!-- /.info-box -->
         <div class=" info-box mb-3 bg-info">
           <span class="info-box-icon"><i class="fa-solid fa-phone"></i></span>

           <div class="info-box-content">
             <span class="info-box-text">Total Verified Records</span>
             <span class="info-box-number">

               <div id="total_verified"></div>
             </span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
         <div class="info-box mb-3 bg-success">
           <span class="info-box-icon"><i class="fas fa-users"></i></span>

           <div class="info-box-content">
             <span class="info-box-text">Community Health Workers</span>
             <span class="info-box-number">
               <div id="chwdata_verified"></div>
             </span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
         <!-- /.info-box -->
         <div class="info-box mb-3 bg-gray">
           <span class="info-box-icon"><i class="fas fa-users"></i></span>

           <div class="info-box-content">
             <span class="info-box-text">Facility Based Health Workers</span>
             <span class="info-box-number">

               <div id="mhwdata_verified"></div>

             </span>
           </div>
           <!-- /.info-box-content -->
         </div>
         <!-- /.info-box -->
         <div class="info-box mb-3 bg-orange">
           <span class="info-box-icon" style="color:#FFF !important;"><i class="fas fa-users"></i></span>

           <div class="info-box-content">
             <span class="info-box-text" style="color:#FFF !important;">Other Categories</span>
             <span class="info-box-number" style="color:#FFF !important;">
               <div id="others_verified_data"></div>
             </span>
           </div -->
           <!-- /.info-box-content-->
         </div>
         <!-- /.info-box -->


         <!-- /.footer -->
       </div>



       <!-- Left col -->
       <section class="col-lg-9 connectedSortable" style="height:500px;">
         <!-- Custom tabs (Charts with tabs)-->
         <div class="card">
           <div class="card-header">
             <h3 class="card-title">
               <!-- iHRIS National Health Worker Force Gender Distribution -->
             </h3>
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
             <div class="tab-content p-0">
               <!-- Morris chart - Sales -->
               <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 450px;">
                 <div id="record_breakdown" style="height: 400px;"></div>
               </div>

             </div>
           </div><!-- /.card-body -->
         </div>
         <!-- /.card -->


       </section>
       <!-- right col -->

       <section class="col-lg-12 connectedSortable">
         <!-- Custom tabs (Charts with tabs)-->
         <div class="card">
           <div class="card-header">
             <h3 class="card-title">
             </h3>
             <div class="card-tools">
               <ul class="nav nav-pills ml-auto">
               </ul>
             </div>
           </div><!-- /.card-header -->
           <div class="card-body">
             <div class="tab-content p-0">
               <!-- Morris chart - Sales -->
               <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 450px; align-items:center; justify-content:center;">
                 <span id="enrolloader"></span>
                 <div id="enrollment" height="300" style="height: 450px;"></div>
               </div>

             </div>
           </div><!-- /.card-body -->
         </div>
         <!-- /.card -->


       </section>



       <section class="col-lg-6 connectedSortable">
         <!-- Custom tabs (Charts with tabs)-->
         <div class="card">
           <div class="card-header">
             <h3 class="card-title">
             </h3>
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
             <div class="tab-content p-0">
               <!-- Morris chart - Sales -->
               <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 450px;">
                 <div id="enrollment_by_mno" style="height: 450px;"></div>
               </div>

             </div>
           </div><!-- /.card-body -->
         </div>
         <!-- /.card -->
       </section>


       <section class="col-lg-6 connectedSortable">
         <!-- Custom tabs (Charts with tabs)-->
         <div class="card">
           <div class="card-header">
             <h3 class="card-title">
             </h3>
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
             <div class="tab-content p-0">
               <!-- Morris chart - Sales -->
               <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 450px;">
                 <div id="data_status" style="height: 450px;"></div>
               </div>

             </div>
           </div><!-- /.card-body -->
         </div>
         <!-- /.card -->
       </section>


       <section class="col-lg-12 connectedSortable">
         <!-- Custom tabs (Charts with tabs)-->
         <div class="card">
           <div class="card-header">
             <h3 class="card-title">
             </h3>
             <div class="card-tools">
               <ul class="nav nav-pills ml-auto">

               </ul>
             </div>
           </div><!-- /.card-header -->
           <div class="card-body">

             <div id="app">
               <table id="vuedata_table" class="table table-striped table-bordered nowrap" style="width:100%">
                 <thead>
                   <tr>
                     <th>#</th>
                     <th>District</th>
                     <th>Community HW</th>

                   </tr>
                 </thead>
                 <tbody>

                   <tr v-for='district in districts'>
                     <td>{{1++}}</td>
                     <td>{{district.district}}</td>
                     <td>{{district.datas}}</td>


                   </tr>

                 </tbody>
               </table>
             </div>


           </div>
           <!-- /.card -->


       </section>
     </div>
     <!-- /.row (main row) -->
   </div><!-- /.container-fluid -->
 </section>
 <!-- /.content -->


 <script src="<?php echo base_url() ?>assets/plugins/moment/moment.min.js"></script>
 <script src="<?php echo base_url() ?>assets/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
 <?php include('chartsjs.php'); ?>
 <script>
   //get data for districts
   var app = new Vue({
     el: '#app',
     data: {
       districts: "",

     },
     mounted: function() {

       this.dists()

     },
     methods: {
       dists: function() {

         axios.get('<?php echo base_url() ?>dashboard/kyc_verified_table')
           .then(function(response) {
             app.districts = response.data;
             console.log(response.data);
             setTimeout(() => {
               $('#vuedata_table').DataTable(

                 {
                   dom: 'Bfrtip',
                   "paging": true,
                   "lengthChange": true,
                   "searching": true,
                   "ordering": true,
                   "info": true,
                   "autoWidth": false,
                   "responsive": true,
                   lengthMenu: [
                     [25, 50, 100, 150, -1],
                     ['25', '50', '100', '150', '200', 'Show all']
                   ],

                   buttons: [
                     'copyHtml5',
                     'excelHtml5',
                     'csvHtml5',
                     'pageLength',


                   ]
                 }

               );
             }, 4000);

           })
           .catch(function(error) {
             console.log(error);
           });
       },


     }
   })
 </script>