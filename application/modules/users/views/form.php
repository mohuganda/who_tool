<div class="card mb-3 shadow no-b r-0">
                        <div class="card-header white">
                            <h6><?php echo  $title; ?></h6>
                        </div>
                        <div class="card-body">
                            <?php if(!empty($this->session->flashdata('message'))){?>
                        <div role="alert" class="alert alert-success"><?php echo $this->session->flashdata('message');?></div><?php } ?>
                <?php echo form_open_multipart("users/form/$user->id") ?>
                    
                    <?php echo form_hidden('id',$user->id) ?>
                    <div class="form-group row">
                        <label for="lastname" class="col-sm-3 col-form-label"><?php echo 'Firstname' ?> *</label>
                        <div class="col-sm-9">
                            <input name="firstname" class="form__field" type="text" placeholder="<?php echo 'Firstname' ?>" id="lastname" value="<?php echo $user->firstname ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lastname" class="col-sm-3 col-form-label"><?php echo 'Lastname' ?> *</label>
                        <div class="col-sm-9">
                            <input name="lastname" class="form__field" type="text" placeholder="<?php echo 'Lastname' ?>" id="lastname" value="<?php echo $user->lastname ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label"><?php echo 'Email' ?> *</label>
                        <div class="col-sm-9">
                            <input name="email" class="form__field" type="text" placeholder="<?php echo 'Email' ?>" id="email_id" value="<?php echo $user->email ?>">
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label"><?php echo 'Password' ?> *</label>
                        <div class="col-sm-9">
                            <input name="password" class="form__field" type="password" placeholder="<?php echo 'Password' ?>" id="password">
                            <input name="oldpassword" class="form__field" type="hidden" value="<?php echo $user->password ?>">
                        </div>
                    </div>

                

                    <div class="form-group row">
                    
                        <div class="col-sm-9">
                            <input type="hidden" name="image" id="image" aria-describedby="fileHelp">
                            <small id="fileHelp" class="text-muted"></small>
                             <input type="hidden" name="old_image" value="<?php echo $user->image ?>">
                        </div>
                    </div> 

         
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Status *</label>
                        <div class="col-sm-9">
                            <label class="radio-inline">
                                                    <?php echo form_radio('status', '1', (($user->status==1 || $user->status==null)?true:false), 'id="status"'); ?>Active
                                                    <?php echo form_radio('status', '0', (($user->status=="0")?true:false) , 'id="status"'); ?>Inactive
                            </label> 
                        </div>
                    </div>
         
                    <div class="card-footer white">
                        <button type="submit" class="btn btn-primary btn-md">Save</button>
                        <button class="btn btn-danger btn-md">Reset</button>
                    </div>
                <?php echo form_close() ?>
</div>
</div>

   


 