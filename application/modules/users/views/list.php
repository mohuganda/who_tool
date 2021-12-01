<div class="card r-0 shadow">
                            <div class="table-responsive">
                                <form>
                                    <table class="table table-striped table-hover r-0">
                                        <thead>
                                        <tr>
                                            <th><?php echo "Sl_no"; ?></th>
                                           
                                            <th><?php echo "Username"; ?></th>
                                        
                                            <th><?php echo "Last_login"; ?></th>
                                            <th><?php echo "last logout"; ?></th>
                                            <th><?php echo "ip_address"; ?></th>
                                            <th><?php echo "Status"; ?></th>
                                            <th><?php echo "Action"; ?></th> 
                                         </tr>
                                        </thead>

                                        <tbody>
                                        <?php if (!empty($user)) ?>
                                        <?php $sl = 1; ?>
                                        <?php foreach ($user as $value) { ?>

                                        <tr>
                                        <td><?php echo $sl++; ?></td>
                                                                              <td>
                                                <div class="avatar avatar-md mr-3 mt-1 float-left">
                                                    <span class="avatar-letter avatar-letter-<?php echo substr(strtolower($value->fullname), 0, 1); ?> avatar-md circle"></span>
                                                </div>
                                                <div>
                                                    <div>
                                                        <strong><?php echo $value->fullname; ?></strong>
                                                    </div>
                                                    <small><?php echo $value->email; ?></small>
                                                </div>
                                        </td>

                                        <td><?php echo $value->last_login; ?></td>
                                        <td><?php echo $value->last_logout; ?></td>
                                        <td><?php echo $value->ip_address; ?></td>
                                        <td><?php echo (($value->status==1)?"Active":"Inactive"); ?></td>
                                        <td>
                                        <?php if ($value->is_admin == 0) { ?>
                                        <a href="<?php echo base_url("users/form/$value->id") ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="Update"><i class="icon-pencil"></i></a>
                                        <a href="<?php echo base_url("users/delete/$value->id") ?>" onclick="return confirm( 'Are you sure')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete "><i class="icon icon-trash-can"></i></a>
                                        <?php } else { ?> 
                                        <button class="btn btn-info btn-sm" title="<?php echo 'Admin' ?>"><?php echo 'Admin' ?></button>
                                        <?php } ?>
                                        </td>
                            </tr>
                            <?php } ?>


                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>