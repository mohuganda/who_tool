<!-- Main content -->

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<style>
    img{
        width:80px;
        border-radius:3px;
    }
</style>
<div id="app">
<section class="content">
     <div class="container-fluid">
       <!-- Main row -->

       <div class="row">
         
         <section class="col-lg-12 ">
  

         <table id="" class="table table-striped table-bordered nowrap mytable" style="width:100%">
        <thead>
            <tr>
            <th>Enroller ID</th>
            <th>District</th>
            <th>Worker Type</th>
            <th>Image</th>
            <th>Surname</th>
            <th>Firstname </th>
            <th>Othername </th>
            <th>Date of Birth </th>
            <th>Place </th>
            <th>Gender </th>
            <th>position </th>
            <th>facility </th>
            <th>ID Photo </th>
            <th>ID Type </th>
            <th>ID Number </th>
            <th>ID Expiry </th>
            <th>National ID Number</th>
            <th>National ID Card Number</th>
            <th>Consent to save and share Information </th>
            <th>Mobile Number </th>
            <th>Other Contact </th>
            <th>Mobile Money Registration Status </th>
            <th>Is registered by Health Worker </th>
            <th>If No, Registered Name </th>
            <th>Allow Mobile Money </th>
            <th>KYC verification </th>
            <th>Record Date </th>
            </tr>
        </thead>
        <tbody>
   
           

            <tr v-for='collection in collections'>
            <td>{{JSON.parse(collection.data).user_id}}</td>
            <td>{{JSON.parse(collection.data).district}}</td>
            <td><span v-if="JSON.parse(collection.data).hw_type == 'chw'"> Community Health Worker </span> <span v-else> Ministry Health Worker</span></td>
            <td><span v-if="JSON.parse(collection.data).person_photo" ><img v-bind:src="'data:image/png;base64,'+ JSON.parse(collection.data).person_photo"></span></td>

            <td>{{JSON.parse(collection.data).surname}}</td>
            <td>{{JSON.parse(collection.data).firstname}}</td>
            <td>{{JSON.parse(collection.data).othername}}</td>
            <td>{{JSON.parse(collection.data).birth_date}}</td>
            <td>{{JSON.parse(collection.data).birth_place}}</td>
            <td>{{JSON.parse(collection.data).gender}}</td>
            <td>{{JSON.parse(collection.data).job}}</td>
            <td>{{JSON.parse(collection.data).facility}}</td>
            <td><span v-if="JSON.parse(collection.data).id_photo"><img v-bind:src="'data:image/png;base64,'+ JSON.parse(collection.data).id_photo"></span></td>
            <td>{{JSON.parse(collection.data).id_type}}</td>
            <td>{{JSON.parse(collection.data).id_number}}</td>
            <td>{{JSON.parse(collection.data).id_expiry}}</td>
            <td>{{JSON.parse(collection.data).national_id}}</td>
            <td>{{JSON.parse(collection.data).national_id_card_number}}</td>
            <td>{{JSON.parse(collection.data).consent}}</td>
            <td>{{JSON.parse(collection.data).primary_mobile_number}}</td>
            <td>{{JSON.parse(collection.data).other_contact}}</td>
            <td>{{JSON.parse(collection.data).is_mm_registered}}</td>
            <td>{{JSON.parse(collection.data).is_registered_by_hw}}</td>
            <td>{{JSON.parse(collection.data).registered_mm_name}}</td>
            <td>{{JSON.parse(collection.data).diff_names_consent}}</td>
            <td>{{JSON.parse(collection.data).kyc_verification}}</td>
            <td>{{collection.sync_date}}</td>
           
           
            
            </tr>
          
        </tbody>
</table>
        
        
         
         
         </section>
       </div>
       <!-- /.row (main row) -->
     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
 </div>
 <script>
  var app = new Vue({
  el: '#app',
  data: {
    collections: "",

  },
  mounted: function () {
    
    this.records()
    
  },
  methods: {
    records: function(){

      axios.get('<?php echo base_url() ?>data/collections')
      .then(function (response) {
          app.collections = response.data;
         console.log(response.data);
      })
      .catch(function (error) {
         console.log(error);
      });
    },
    
   
    }
  }
)
</script>