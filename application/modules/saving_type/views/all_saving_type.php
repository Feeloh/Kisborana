<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel ="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/custom/style.css">
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css "rel="stylesheet">

</head>
<body>
    <div class ="container">

        <?php
$success = $this->session->flashdata("success_message");
$error = $this->session->flashdata("error_message");
if (!empty($success)) {
    ?>
            <div class ="alert alert-success" role = "alert">
            <?php
echo $success;
    ?>
            </div>
            <?php
}
if (!empty($error)) {
    ?>
            <div class ="alert alert-danger" role = "alert">
            <?php
echo $error;
    ?>
            </div>
            <?php
}
?>
        </div>
        <h1 style="font-family: 'PT Serif', serif; font-size: 20pt;" >Saving Types</h1>
        <!-- <?php //echo form_open($this->uri->uri_string()) ?>
        <div class = "form-group ">
            <input class="form-control form-control-dark w-10 col-md-3" type="text" name = "search" placeholder="Search by name" aria-label="Search">
        </div>
        <div class = "form-group">
            <input type = "submit" value="Search" class="btn btn-secondary btn-sm">
        </div>
        <?php //echo form_close() ?> -->

        <?php echo anchor("saving_type/new_saving_type", "Add Saving Type", array("class"=>"btn btn-primary btn-sm")); ?><br></br>
        <?php echo anchor("saving_type/import", "Import Saving Types", array("class"=>"btn btn-primary btn-sm")); ?><br></br>

        <table class="table table-sm table-condensed table-striped table-sm table-bordered">
            <tr>
                <!-- <th width="50px"><input type="checkbox" id="master"></th> -->
                <th scope="col">#</th>
                <th scope="col">Saving Type Name</th>
                <th scope="col">Status</th>
                <th colspan="4" style = "text-align: center;">Action</th>
                

            </tr>
            <?php
if ($all_saving_type->num_rows() > 0) {
    $count = 0;

    foreach ($all_saving_type->result() as $row) {
        $count++;
        $id = $row->saving_type_id;
        $name = $row->saving_type_name;
        $check = $row->saving_type_status;
        $delete = $row->deleted;

        ?>


                 <tr>
                <!-- <td><input type="checkbox" class="sub_chk" data-id="<?php //echo $delete ?>"></td> -->
                 <td>
                        <?php echo $count; ?>
                 </td>
                 <td>
                        <?php echo $name; ?>
                 </td>

                 <td>
                        <?php
if ($check == 0) {
            echo "<button class='badge badge-danger'>Inactive</button>";
        } else {
            echo "<button class='badge badge-success'>Active</button>";
        }
        ?>
                 </td>
                 <td>
                      <!-- <?php //echo anchor("friends/welcome/".$id,"view","class ='btn btn-info'");?> -->
                      <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  View friend
</button> -->

        <a href="#individualSaving_type<?php echo $id; ?>" class="btn btn-info btn-sm" data-toggle="modal" data-target="#individualSaving_type<?php echo $id; ?>">View</a>
        <!-- Modal -->
        <div class="modal fade" id="individualSaving_type<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $name; ?>'s Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <!-- modal body -->
            <table class="table table-sm">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Saving Type Name</th>
                <th scope="col">Status</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                <th scope="col">Activate/Deactivate</th>



            </tr>
            <tr>
                 <td>
                        <?php echo $count; ?>
                 </td>
                 <td>
                        <?php echo $name; ?>
                 </td>


                 <td>
                <?php
if ($check == 0) {
            echo "<button class='badge badge-danger'>Inactive</button>";
        } else {
            echo "<button class='badge badge-success'>Active</button>";
        }
        ?>
                 </td>

                 <td>

                 <?php echo anchor("saving_type/saving_type/update_saving_type/" . $id, "Edit", "class ='btn btn-info'"); ?>

                 </td>
                 <td>
                    <?php echo anchor("saving_type/saving_type/delete_saving_type" . $id, "Delete", array("onclick" => "return confirm('Are you sure you want to delete?')", "class" => "btn btn-danger")); ?>

                 </td>

                 <td>
                    <?php echo anchor("friends/friends/deactivate_friend/" . $id, "Deactivate", array("onclick" => "return confirm('Are you sure you want to deactivate?')", "class" => "btn btn-danger")); ?>


                 </td>
            </table>
            <!-- end of modal body -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

            </div>
            </div>
        </div>
        </div>
                 </td>
                 <td>

                    <?php echo anchor("saving_type/saving_type/update_saving_type/" . $id, "Edit", "class ='btn btn-info btn-sm'"); ?>

                 </td>
                 <td>
                    <?php echo anchor("saving_type/saving_type/delete_saving_type/" . $id, "Delete", array("onclick" => "return confirm('Are you sure you want to delete?')", "class" => "btn btn-danger btn-sm")); ?>

                 </td>
                 <!-- <td>
                    <?php //echo //anchor("friends/friends/delete_friend/" . $id, "Activate", "class = 'btn btn-success'"); ?>

                 </td> -->
                 <td>
                    <?php
if ($check == 0) {
            echo anchor("saving_type/saving_type/activate_saving_type/" . $id, "Activate", array("onclick" => "return confirm('Are you sure you want to activate?')", "class" => "btn btn-success btn-sm"));
        } else {
            echo anchor("saving_type/saving_type/deactivate_saving_type/" . $id, "Deactivate", array("onclick" => "return confirm('Are you sure you want to deactivate?')", "class" => "btn btn-danger btn-sm"));
        }
        ?>



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