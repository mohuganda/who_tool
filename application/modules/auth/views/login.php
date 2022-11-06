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

              <div class="form">
                <form class="login-form" action="<?php echo base_url() ?>auth/login" method="post">
                  <div class="items" style="display:flex; text-align:center; justify-content:center;">

                    <img src="<?php echo base_url(); ?>assets/img/MOH.png" width="120" height="120">

                  </div>
                  <li class="nav-item" style="list-style-type: none;">
                    <a href="<?php echo base_url() ?>assets/MoH_iHRIS_Update_Toolv1-4.apk" target="_blank" class="nav-link">

                      <p>
                        Download iHRIS Update Tool Application
                      </p>
                    </a>
                  </li>
                  <p style="color:red;"><?php echo $this->session->flashdata('msg'); ?></p>
                  <input type="text" name="username" placeholder="username" />
                  <input type="password" name="password" placeholder="password" />
                  <button>login</button>
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