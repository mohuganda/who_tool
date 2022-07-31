<?php
date_default_timezone_set('Africa/Kampala');
require_once("includes/header.php");
require_once("includes/navtop.php");
require_once("includes/sidenav.php");

//db connection
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h4><?php if (!empty($uptitle)) {
                echo urldecode($uptitle);
              } ?></h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url() ?><?php echo $this->uri->segment(1) ?>"><?php echo ucwords($this->uri->segment(1)); ?></a></li>
            <li class="breadcrumb-item active"> <?php if (!empty($uptitle)) {
                                                  echo urldecode($uptitle);
                                                } ?></li>
          </ol>
        </div>
      </div>
    </div>



  </section>
  <!-- /.container-fluid -->

  <!-- Main content -->
  <div id="preloader">
    <div id="status">
    </div>
  </div>
  <section class="content">

    <div class="container-fluid" style="font-size:12px; min-height:940px; margin-top:40px;">

      <div class="row">
        <div class="col-12" style="margin-bottom:3px;">
          <div class="card">
            <div class="">

            </div>
            <div class="card-body">


              <?php

              $this->load->view($module . "/" . $view);

              ?>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer-->
          </div>


        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
require_once("includes/footer.php");
?>