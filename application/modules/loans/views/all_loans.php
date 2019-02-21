<?php 
            $success = $this->session->flashdata("success_message");
            $error = $this->session->flashdata("error_message");

            if (!empty($success)) { ?>
<div class="alert alert-success" role="alert">
	<?php
                echo $success; ?>
</div>
<?php
            }

            if (!empty($error)) { ?>
<div class="alert alert-dark" role="alert">
	<?php
                echo $error; ?>
</div>
<?php
            }
        ?>
<h1>Available loans </h1>
<!-- <div class = "form-group">
            <input class="form-control form-control-dark w-10 col-md-3" type="text" name = "search" placeholder="Search by name" aria-label="Search">
        </div>
        <div class = "form-group">
            <input type = "submit" value="Search" class="btn btn-primary">
        </div> -->
		
	<?php
		   
		   echo form_open('loans/execute_search');

			?>
			<div class = 'form-group'>
			<?php
            echo form_input(array('name' => 'search', 'placeholder' => 'search', 'aria-label'=>'Search','class'=>'form-control form-control-dark w-10 col-md-3'));
			?>
			</div>
						
			<div class = 'form-group'>
			<?php
			echo form_submit('search_submit', 'Search', array('class'=>'btn-secondary btn-sm'));

            ?> 
			</div>
			
<?php echo anchor("loans/new_loan", "Add loan"); ?>
<div class="table-responsive">
<table class="table table-sm w-auto">
	<tr>
		<th>#</th>
		<th>member</th>
		<th>status</th>
		<th>loan stage</th>
		<th>loan amount</th>
		<th>approved amount</th>		
		<th>disbursed amount</th>		
		<th>interest amount</th>		
		<th>repayment amount</th>
		<th>installment amount</th>
		<th>installment period</th>
		<th>grace period</th>
		<th>app date</th>
		<th>approved date</th>
		<th>disbursed date</th>
		<th>approved by</th>
		<th>loan number</th>
		<th>member salary</th>			
		<th>Actions</th>
	</tr>
	<?php
	
			$count = $page;
			if($all_loans->num_rows() > 0){
			foreach ($all_loans->result() as $row) {
			$count++;
			$id = $row->loan_id;
			$name = $row->loan_name;
			$max_loan = $row->maximum_loan_amount;
			$min_loan = $row->minimum_loan_amount;
			$custom_loan = $row->custom_loan_amount;
			$max_instal = $row->maximum_number_of_installments;
			$min_instal = $row->minimum_number_of_installments;
			$custom_instal = $row->custom_number_of_installments;
			$max_guar = $row->maximum_number_of_guarantors;
			$min_guar = $row->minimum_number_of_guarantors;
			$custom_guar = $row->custom_number_of_guarantors;
			$interest = $row->interest_rate;
			$check = $row->loan_status;
			?>
	<tr>
		<td>
			<?php echo $count; ?>
		</td>
		<td>
			<?php echo $name; ?>
		</td>
		<td>
		<?php 
				if($check == '1'){ ?>
					<div class="badge badge-primary">
					<?php
					echo "Active";
					?>
					</div>
					<?php
				}						
				else
				{ ?>
				<div class="badge badge-danger">
				<?php
				echo "Inactive";
				?>
				</div>
				<?php
				}				
				?>
		</td>
		<td>
			<?php echo $max_loan; ?>
		</td>
		<td>
			<?php echo $min_loan; ?>
		</td>
		<td>
			<?php echo $custom_loan; ?>
		</td>
		<td>
			<?php echo $max_instal; ?>
		</td>
		<td>
			<?php echo $min_instal; ?>
		</td>
		<td>
			<?php echo $custom_instal; ?>
		</td>
		<td>
			<?php echo $max_guar; ?>
		</td>
		<td>
			<?php echo $min_guar; ?>
		</td>
		
		<td>
			<?php echo $custom_guar; ?>
		</td>
		<td>
			<?php echo $interest; ?>
		</td>
		
		<td>
			<?php echo anchor("loans/edit/" . $id, "Edit", array('onclick' => "return confirm('Are you sure you want to edit?')", 'class' => "btn btn-info btn-sm")); ?>
		</td>
		<td>
			<?php 
				if($check == '1'){
					echo anchor("loans/deactivate/" . $id, "Deactivate", array('onclick' => "return confirm('Do you want to deactivate this record')", 'class' => "btn btn-danger btn-sm"));
				}else{
				echo anchor("loans/activate/" . $id, "Activate", array('onclick' => "return confirm('Do you want to activate this record')", 'class' => "btn btn-success btn-sm"));
				} ?>
		</td>
		<td>
			<?php echo anchor("loans/delete/" . $id, "Delete", array('onclick' => "return confirm('Do you want to delete this record')", 'class' => "btn btn-danger btn-sm"),img('assets/images/lock.png')); ?>
		</td>
	</tr>
	<?php }} ?>
</table>
</div>
<?php echo $links;?>
