<div class="row">
    <div class="col-lg-12">
        <h1>Saving Type <small>Overview</small></h1>
        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-list"></i> Import saving types</li>
        </ol>            
    </div>
</div><!-- /.row -->

        <?php
       
            $validation_errors = validation_errors();
            if(!empty($validation_errors)){
                echo $validation_errors;
        }
        ?>

<?php
$output = '';
$output .= form_open_multipart('saving_type/import/save');
$output .= '<div class="row">';
$output .= '<div class="col-lg-12 col-sm-12"><div class="form-group">';
$output .= form_label('Import Saving Types', 'image');

 echo anchor("saving_type/import/download", "Download Template", array("class"=>"btn btn-primary btn-sm")); ?><br></br>
<?php
$data = array(
    'name' => 'userfile',
    'id' => 'userfile',
    'class' => 'form-control filestyle',
    'value' => '',
    'data-icon' => 'false'
);
$output .= form_upload($data);
$output .= '</div> <span style="color:red;">*Please choose an Excel file(.csv) as Input</span></div>';
$output .= '<div class="col-lg-12 col-sm-12"><div class="form-group text-right">';
$data = array(
    'name' => 'importfile',
    'id' => 'importfile-id',
    'class' => 'btn btn-primary btn-sm',
    'value' => 'Import',
);
$output .= form_submit($data, 'Import Data');
$output .= '</div>
                        </div></div>';
$output .= form_close();
echo $output;
?>
<?php echo anchor("saving_type/saving_type", "Back", array("class"=>"btn btn-primary btn-sm")); ?><br></br>
