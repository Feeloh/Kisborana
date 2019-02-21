<h1 style="font-family: 'PT Serif', serif; font-size: 20pt;">Sacco Members</h1>
<!-- <?php //echo form_open($this->uri->uri_string()) ?>
        <div class = "form-group">
            <input class="form-control form-control-dark w-10 col-md-3" type="text" name = "search" placeholder="Search by name" aria-label="Search">
        </div>
        <div class = "form-group">
            <input type = "submit" value="Search" class="btn btn-secondary btn-sm">
        </div>
        <?php //echo form_close() ?> -->

        <?php echo anchor("member/new_member", "Add Member", array("class"=>"btn btn-primary btn-sm")); ?> <br></br>
        <table class="table table-condensed table-striped table-sm table-bordered" >
            <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">National ID</th>
                <th scope="col">Email</th>
                <th scope="col">Location</th>
                <th scope="col">Member Number</th>
                <th scope="col">Member Payroll Number</th>
                <th scope="col">Employer Name</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Status</th>
                <th scope="col">Registration Date</th>
                <th colspan="4" style="text-align:center">Actions</th>
                

            </tr>
            <?php
            if ($all_members->num_rows() > 0) {
                
                $count = 0;
                foreach ($all_members->result() as $row) {
                    $count++;
                    $id = $row->member_id;
                    $first_name = $row->member_first_name;
                    $last_name = $row->member_last_name;
                    $national_id = $row->member_national_id;
                    $email = $row->member_email;
                    $location = $row->member_location;
                    $member_number = $row->member_number;
                    $member_payroll_number = $row->member_payroll_number;
                    $employer_name = $row->employer_id;
                    $phone_number = $row->member_phone_number;
                    $status = $row->member_status;
                    $created_on = $row->created_on;
            ?>


            <tr>
            <td>
                <?php echo $count; ?>
            </td>
            <td>
                <?php echo $first_name; ?>
            </td>
            <td>
                <?php echo $last_name; ?>
            </td>
            <td>
                <?php echo $national_id; ?>
            </td>
            <td>
                <?php echo $email; ?>
            </td>
            <td>
                <?php echo $location; ?>
            </td>
            <td>
                <?php echo $member_number; ?>
            </td>
            <td>
                <?php echo $member_payroll_number; ?>
            </td>
            <td>
                <?php echo $employer_name; ?>
            </td>
            <td>
                <?php echo $phone_number; ?>
            </td>
            <td>
                <?php if($status  == 1){ ?>
                    <span class="badge badge-success">Active</span>
                <?php }
                else {?>
                    <span class="badge badge-danger">In Active</span>
                <?php }?>
            </td>
            <td>
                <?php echo $created_on; ?>
            </td>
            <td>
            <!-- Button trigger modal -->
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#individualFriend">
            View friend
            </button> -->
            <a href="#individualMember<?php echo $id;?>" class="btn btn-info btn-sm" data-toggle="modal" data-target="#individualMember<?php echo $id;?>">View</a>

            <!-- Modal -->
            <div class="modal fade" id="individualMember<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content modal-lg">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?php echo $first_name." ".$last_name; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-condensed table-striped table-sm table-bordered">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">National ID</th>
                                        <th scope="col">Member Number</th>
                                        <th scope="col">Employer Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Edit Member</th>
                                        <th scope="col">Activate Member</th>
                                        <th scope="col">Delete Member</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo $count;?>
                                        </td>
                                        <td>
                                            <?php echo $national_id; ?>
                                        </td>
                                        <td>
                                            <?php echo $member_number; ?>
                                        </td>
                                        <td>
                                            <?php echo $employer_name; ?>
                                        </td>
                                        <td>    
                                            <?php if($status  == 1){ ?>
                                            <span class="badge badge-success">Active</span>
                                            <?php }
                                            else {?>
                                                <span class="badge badge-danger">In Active</span>
                                            <?php }?>
                                        </td>
                                        <td>
                                            <?php if( $status  == 1){
                                            echo anchor("member/member/deactivate/" . $id, "Deactivate", "class ='btn btn-danger btn-sm'");
                                            }
                                            else{
                                                echo anchor("member/member/activate/" . $id, "Activate", "class ='btn btn-primary btn-sm'");
                                            }?>
                                        </td>
                                        
                                        <td>
                                            <?php echo anchor("member/member/display_edit_form/" . $id, "Edit", "class ='btn btn-info btn-sm'"); ?>
                                        </td>
                                        <td>
                                            <?php echo anchor("member/member/delete_member/" . $id, "Delete", array("onclick" => "return confirm('Are you sure you want to delete?')", "class" => "btn btn-danger btn-sm")); ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
                 <td>
                    <?php if( $status  == 1){
                        echo anchor("member/member/deactivate/" . $id, "Deactivate", "class ='btn btn-danger btn-sm'");
                    }
                    else{
                        echo anchor("member/member/activate/" . $id, "Activate", "class ='btn btn-primary btn-sm'");
                    }?>
                </td>
                 <td>
                    <?php echo anchor("member/member/display_edit_form/" . $id, "Edit", "class ='btn btn-info btn-sm'"); ?>
                 </td>
                 <td>
                    <?php echo anchor("member/member/delete_member/" . $id, "Delete", array("onclick" => "return confirm('Are you sure you want to delete?')", "class" => "btn btn-danger btn-sm")); ?>
                 </td>
                </tr>


                <?php
                }
                }

                ?>
            </table>

       <!-- pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
        <!-- end of pagination -->
    </div>

</body>
</html>
