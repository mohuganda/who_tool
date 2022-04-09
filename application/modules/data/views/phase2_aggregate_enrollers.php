<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
              <h6>Active Enrollers Daily Entries</h6>
                <div class="card-tools">
            
                  <form class="form-horizontal" method="post" action="<?php echo base_url()?>dashboard/data_enrollers">
                  <div class="form-group">
                         <label>Date:</label>
                   
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                        </div>
                      
                        <input type="text"  name="udate" class="form-control datepicker" value="<?php echo date("Y-m-d"); ?>" autocomplete="off">
                        </div>
                  
                   
                    </div>
                      <!-- /.input group -->
                      <button type="submit" class="btn btn-default">Search</button>
                      </form>
                 
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
            <div class="app"> 
                         
           <table id="enrollers" class="table table-striped table-bordered nowrap " style="width:100%">
             <thead>
            <tr>
            <th>#</th>
            
                <th>Code</th>
                <th>Enroller</th>
                <th>Contact</th>
                <th>District</th>
                <th>Total</th>
               
          </tr>
          </thead>
          <tbody>
          <tr v-for='collection in collections' >
                  <td>{{collection.id}}</td>
                  <td>{{collection.code}}</td>
                  <td>{{collection.name}}</td>
                  <td>{{collection.contact}}</td>
                  <td>{{collection.district}}</td>
                  <td>{{collection.total}}</td>
                 
                  
             </tr>
          </tbody>
          </table>

          
             
            </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
         
          
          </section>
<script>
//get data for enrollers
  var app = new Vue({
  el: '.app',
  data: {
    collections: "",
   

  },
  mounted: function () {
    
    this.records()
    
  },
  methods: {
    records: function(){

      axios.get('<?php echo base_url() ?>dashboard/phase2_data_enrollers')
      .then(function (response) {
          app.collections = response.data;
        // console.log(response.data);
        setTimeout(() => {
          $('#enrollers').DataTable(

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
            [ 25, 50, 100,150, -1 ],
            [ '25', '50', '100','150','200', 'Show all' ]
        ],
      
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pageLength',
            
            
        ]
    } 

          );
        }, 3000);
       
      })
      .catch(function (error) {
         console.log(error);
      });
    },
    
    }
  }
)
</script>
        