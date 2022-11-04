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

       <section class="col-lg-9 connectedSortable">
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
               <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                 <div id="enrollment" height="300" style="height: 300px;"></div>
               </div>
               <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                 <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
               </div>
             </div>
           </div><!-- /.card-body -->
         </div>
         <!-- /.card -->


       </section>


       <!-- Left col -->
       <section class="col-lg-6 connectedSortable">
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
               <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                 <div id="record_breakdown" height="300" style="height: 300px;"></div>
               </div>
               <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                 <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
               </div>
             </div>
           </div><!-- /.card-body -->
         </div>
         <!-- /.card -->


       </section>
       <!-- right col -->

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
               <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                 <div id="enrollment_by_mno" height="300" style="height: 300px;"></div>
               </div>
               <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                 <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
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
               <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                 <div id="gender_chart" height="300" style="height: 300px;"></div>
               </div>
               <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                 <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
               </div>
             </div>
           </div><!-- /.card-body -->
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
 <script type="text/javascript">
   Highcharts.setOptions({
     colors: ['#A1D066', '#FF9655', '#28a745', '#FF9655', '#FFF263', '#6AF9C4']
   });

   function renderGraph(data) {

     Highcharts.chart('record_breakdown', {


       chart: {
         plotBackgroundColor: null,
         plotBorderWidth: null,
         plotShadow: false,
         type: 'pie'
       },
       title: {
         text: 'Health Worker Breakdown By Category'
       },
       tooltip: {
         pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
       },
       accessibility: {
         point: {
           valueSuffix: '%'
         }
       },
       plotOptions: {
         pie: {
           allowPointSelect: true,
           cursor: 'pointer',
           dataLabels: {
             enabled: true,
             format: '<b>{point.name}</b>: {point.percentage:.1f} %'
           }
         }
       },

       series: [{
         name: 'Health Worker Types',
         colorByPoint: true,
         filter: {
           property: 'percentage',
           operator: '>',
           value: 4
         },

         data: [{
             name: 'Verified VHT',
             y: data.chwdata_verified,
             sliced: true,
             selected: true
           },
           {
             name: 'Verified Facility Based HWs',
             y: data.mhwdata_verified
           },
           {
             name: 'Other Categories(LCs etc.)',
             y: data.others_verified
           }
         ]
       }],
       credits: {
         enabled: false
       }

     });
     //console.log(data.mhwdata);
   }

   //get dashboard Data
   $(document).ready(function() {
     //  renderGraph(data);


     $.ajax({
       type: 'GET',
       url: '<?php echo base_url('dashboard/dashboardData') ?>',
       dataType: "json",
       data: '',
       success: function(data) {

         $('#total_records').text(data.total_records);
         $('#total_verified').text(data.total_verified);
         $('#chwdata_verified').text(data.chwdata_verified);
         $('#mhwdata_verified').text(data.mhwdata_verified);
         $('#others_verified_data').text(data.others_verified_data);

         renderGraph(data);



       }

     });

   });

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

         axios.get('<?php echo base_url() ?>dashboard/jsondata_district')
           .then(function(response) {
             app.districts = response.data;
             //console.log(response.data);
             setTimeout(() => {
               $('#vuetable2').DataTable(

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
   });

   ///data by MNOS
   function enrollment_column_graph(gdata) {

     Highcharts.chart('enrollment', {
       chart: {
         type: 'column'
       },
       title: {
         text: 'Enrollment by District'
       },
       subtitle: {
         text: 'Source: <a href="<?php echo base_url() ?>" target="_blank">Digital Finance Data Bank</a>'
       },
       xAxis: {
         type: 'category',
         labels: {
           rotation: -45,
           style: {
             fontSize: '13px',
             fontFamily: 'Verdana, sans-serif'
           }
         }
       },
       yAxis: {
         min: 0,
         title: {
           text: 'Population (millions)'
         }
       },
       legend: {
         enabled: false
       },
       tooltip: {
         pointFormat: 'Population in 2021: <b>{point.y:.1f} millions</b>'
       },
       credits: {
         enabled: false
       },
       series: [{
         name: 'Population',
         data: gdata,
         dataLabels: {
           enabled: true,
           rotation: -90,
           color: '#FFFFFF',
           align: 'right',
           format: '{point.y:.1f}', // one decimal
           y: 10, // 10 pixels down from the top
           style: {
             fontSize: '13px',
             fontFamily: 'Verdana, sans-serif'
           }
         }
       }]
     });
   }

   ///data by MNOS
   function mnodataGraph(data) {

     Highcharts.chart('enrollment_by_mno', {


       chart: {
         plotBackgroundColor: null,
         plotBorderWidth: null,
         plotShadow: false,
         type: 'pie'
       },
       title: {
         text: 'Verified Data by Network Operators'
       },
       tooltip: {
         pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
       },
       accessibility: {
         point: {
           valueSuffix: '%'
         }
       },
       plotOptions: {
         pie: {
           allowPointSelect: true,
           cursor: 'pointer',
           dataLabels: {
             enabled: true,
             format: '<b>{point.name}</b>: {point.percentage:.1f} %'
           }
         }
       },

       series: [{
         name: 'Operators',
         colorByPoint: true,

         data: [{
             name: 'MTN',
             y: data.mtn_verified,
             sliced: true,
             selected: true
           }, {
             name: 'Airtel',
             y: data.airtel_verified
           },
           {
             name: 'Others',
             y: data.others_verified
           }
         ]
       }],
       credits: {
         enabled: false
       }

     });
   }
   //console.log(data.mhwdata);

   //get dashboard Data
   $(document).ready(function() {
     //  renderGraph(data);

     $('#loader').html('<img src="../../images/ajax-loader.gif" />       Please wait...');
     $.ajax({
       type: 'GET',
       url: '<?php echo base_url('dashboard/mnodashboardData') ?>',
       dataType: "json",
       data: '',
       success: function(data) {
         $('#mtn_verified').text(data.mtn_verified);
         $('#airtel_verified').text(data.airtel_verified);
         $('#others_verified').text(data.others_verified);
         //console.log(data);
         mnodataGraph(data);
       }

     });
   });

   $(document).ready(function() {



     $.ajax({
       type: 'GET',
       url: '<?php echo base_url('dashboard/not_verified') ?>',
       dataType: "json",
       data: '',
       success: function(data) {
         $('#chwdata_not_verified').text(data.chwdata_not_verified);
         $('#mhwdata_not_verified').text(data.mhwdata_not_verified);
         $('#others_not_verified').text(data.others_not_verified);
         $('#covered_districts').text(data.covered_districts);
         $('#covered_facilities').text(data.covered_facilities);




       }

     });

   });

   $(document).ready(function() {



     $.ajax({
       type: 'GET',
       url: '<?php echo base_url('dashboard/get_enrollments') ?>',
       dataType: "json",
       data: '',
       success: function(data) {
         enrollment_column_graph(data);
       }

     });

   });
 </script>