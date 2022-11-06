          <!DOCTYPE html>
          <html lang="en">

          <head>
            <meta charset="UTF-8">
            <title>MOH DIGITAL FINANCE CAMPAIGN DATA</title>
            <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/login.css">

          </head>

          <body>
            <!-- partial:index.partial.html -->
            <div class="login-page">
              <li class="nav-item" style="list-style-type: none;">
                <a href="<?php echo base_url() ?>assets/MoH_iHRIS_Update_Toolv1-4.apk" target="_blank" class="nav-link">

                  <p>
                    Download iHRIS Update Tool Application
                  </p>
                </a>
              </li>
              <img src="<?php echo base_url(); ?>assets/img/MOH.png" width="120" height="120">
              <p style="color:blue;"><?php echo $this->session->flashdata('msg'); ?></p>
              <div class="form">
                <form class="login-form">
                  <input type="text" name="username" placeholder="username" />
                  <input type="password" name="password" placeholder="password" />
                  <button>login</button>
                  <p class="message">Not registered? <a href="#">Create an account</a></p>
                </form>
              </div>
            </div>
            <!-- partial -->
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
            <script>
              $('.message a').click(function() {
                $('form').animate({
                  height: "toggle",
                  opacity: "toggle"
                }, "slow");
              });
            </script>

          </html>