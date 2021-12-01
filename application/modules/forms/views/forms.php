<div class="row">
    <div class="col-md-12">
                <div class="card ">
                    <div class="card-header white">
                        <i class="icon icon-wpforms light-green-text s-18"></i>
                        <strong> Forms </strong>
                    </div>
                
                    <form method="post" action="<?php echo base_url()?>forms/updateforms">   
                    <div class="card-footer white"> 
                      <button  type="submit" class="btn btn-primary btn-md">Save Data</button>
                      <button type="button" class="btn btn-success btn-md"><i class="icon-plus_one"></i>Add</button>
               
                    </div>
                    <div class="slimScrollDiv" style="position: relative; overflow: auto; width: auto; height: 500px;">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <!-- Table heading -->
                                <tbody>
                                <tr class="no-b">
                                   
                                    <th>Form ID</th>
                                    <th>Form</th>
                                    <th>Form Description</th>
                                    <th>Parent</th>
                                   
                                </tr>
                                <?php  $forms=Modules::run('forms/forms'); ?>
                                <tr>
                                    
                                    <?php foreach($forms as $form):
                                       // print_r($form);
                                        ?>

                                      <td><input type="text" class="form__field" name="id" value="<?php echo $form['id'];?>" readonly></td>
                                      <td><input type="text" class="form__field" name="id" value="<?php echo $form['form_title'];?>"></td>
                                      <td><input type="text" class="form__field" name="id" value="<?php echo $form['description'];?>"></td>
                                      <td><input type="text" class="form__field" name="id" value="<?php echo $form['parent_form'];?>""></td>
                                     
                                    
                                   
                                </tr>
                                <?php endforeach; ?>
                               
                                </tbody>
                            </table>
                        </form>
                      
                    </div><div class="slimScrollBar" style="background: rgba(0, 0, 0, 0.95); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 259.366px;"></div><div class="slimScrollRail" style="width: 5px; height: 300%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                    <div class="card-footer white">
                        
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="card ">
                <div class="card my-12 shadow no-b r-0">
                    <div class="card-header white">
                        <i class="icon-clipboard-edit blue-text"></i>
                        <strong> Fields </strong>
                    </div>
                    <form id="form_advanced_validation" method="<?php echo base_url()?>forms/updatefields" class="form-material" method="POST" novalidate="novalidate">

                    <div class="card-footer white"> 
                      <button  class="btn btn-primary btn-md">Save Data</button>
                      <button type="button" class="btn btn-success btn-md"><i class="icon-plus_one"></i>Add</button>
               
                    </div>
                    <div class="slimScrollDiv" style="position: relative; overflow: auto; width: auto; height: 600px;">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <!-- Table heading -->
                                <tbody>
                                <tr>
                                   
                                    <th>#</th>
                                    <th>Form id</th>
                                    <th>Form Field</th>
                                    <th>Label</th>
                                    <th>Default Data</th>
                                    <th>Prompts</th>
                                    <th>Data Type</th>
                                    <th>Description</th>
                                </tr>
                            <div class="card my-3 shadow no-b r-0">
                           
                        

                                <?php  $fields=Modules::run('forms/fields'); 
                                 foreach($fields as $field):
                                 
                                ?>
                                
                                <tr>
                                   
                                    <!-- Page name -->

                                    <td><input type="text" class="form__field" name="id" value="<?php echo $field['id']; ?>" readonly></td>
                                    <td><input type="text" class="form__field" name="form_id" value="<?php echo $field['form_id']; ?>" ></td>
                                    <td><input type="text" class="form__field" name="form_field" value="<?php echo $field['form_field']; ?>"></td>
                                    <td><input type="text" class="form__field" name="label" value="<?php echo $field['label']; ?>"></td>
                                    <td><textarea class="form__field" name="default_data" ><?php echo $field['default_data']; ?></textarea></td>
                                    <td><input class="form__field" type="text" name="prompts" value="<?php echo $field['prompts']; ?>"></td>
                                    <td><input class="form__field" type="text" name="data_type" value="<?php echo $field['data_type']; ?>"></td>
                                    <td><input class="form__field" type="text" name="description" value="<?php echo $field['description']; ?>"></td>

                                   
                                </tr>
                                <?php  endforeach; ?>
                               
                                </tbody>
                            </table>
                         </form>
                        </div>
                        </div>
                    </div>
                   
                    </div><div class="slimScrollBar" style="background: rgba(0, 0, 0, 0.95); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 259.366px;"></div><div class="slimScrollRail" style="width: 5px; height: 300%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                   
                </div>
    </div>
</div>