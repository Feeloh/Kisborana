<div class="card">
	<div class="card-body">
		<?php echo form_open_multipart($this->uri->uri_string()); ?>
		<div class="form-group" style  = "margin-top: 10px;">
			<div class="form-group col-sm-2">
				<label for='member_details'>Member:</label>
			</div>
			<div class="form-group col-sm-5">
				<select class="form-control select2-single" name="member_name" id="member_details">
					<?php 
						foreach($member_details->result() as $row)
						{
							$member_first_name = $row->member_first_name;
							$member_last_name = $row->member_last_name;
							$member_id = $row->member_id;
							
					
						
					?>
					<option value = "<?php echo $member_id; ?>">
					<?php echo $member_first_name. " ".$member_last_name;?>
					</option>
					<?php  } ?>
				</select>
			</div>
			</div>

			<div class="form-group" style  = "margin-top: 10px;">
			<div class="form-group col-sm-2">
				<label for='loan_type_details'>Loan Type:</label>
			</div>
			<div class="form-group col-sm-5">
				<select class="form-control" name="loan_type_name"  id="loan_type_details" >
					<?php 
					foreach($loan_type_details->result() as $row){
						$loan_type_name = $row->loan_type_name;
						$loan_type_id = $row->loan_type_id;
						$loan_amnt = $row->maximum_loan_amount;
						?>
						<option value="<?php echo $loan_type_id; ?>"><?php echo $loan_type_name;?></option>
						
					<?php
					}
					?>

				</select>
				<!-- <ul>
					<li ><?php //echo $loan_amnt;?></li>
				</ul> -->
				
			</div>
		</div>


		<div class="form-group" style  = "margin-top: 10px;">
			<div class="form-group col-md-2">
				<label for='loan_amount'>Loan amount: </label>
				</div>
				<div class="form-group col-sm-5">
				<input type="number" name="loan_amount" class="form-control">
			</div>
			</div> 

			<div class="form-group" style  = "margin-top: 10px;">
			<div class="form-group col-md-2">
				<label for='loan_amount'>Installment Period: </label>
				</div>
				<div class="form-group col-sm-5">
				<input type="number" name="installment_period" class="form-control">
			</div>
			</div> 

			<div class="form-group" style  = "margin-top: 10px;">
			<div class="form-group col-md-2">
				<label for='loan_amount'>Loan Number: </label>
				</div>
				<div class="form-group col-sm-5">
				<input type="number" name="loan_number" class="form-control">
			</div>
			</div> 

			<div class="form-group" style  = "margin-top: 10px;">
			<div class="form-group col-md-2">
				<label for='loan_amount'>Member Salary: </label>
				</div>
				<div class="form-group col-sm-5">
				<input type="number" name="member_salary" class="form-control">
			</div>
			</div> 

			<div class="form-group" style  = "margin-top: 10px;">
			<div class="form-group col-md-2">
				<label for='loan_amount'>Guarantor: </label>
				</div>
				<div class="form-group col-sm-5">
				<input type="number" name="member_salary" class="form-control">				
			</div>
			<div class="form-group col-md-2">
			<?php 
			
			$class = 'd-none';
			?>
            <button type="button" class="btn btn-dark" onclick = "<?php $class = 'd-block';?>">Add Guarantors</button>
					
					
			</div> 			
			</div>
			
					<!-- input more guarantors -->
			<div class="form-group d-none" style  = "margin-top: 10px;">
			<div class="form-group col-md-2">
			</div>
			<div class="form-group col-sm-5">
			<input type="number" name="member_salary" class="form-control ">	
				</div>
			</div>

			<div class="form-group d-none" style  = "margin-top: 10px;">
			<div class="form-group col-md-2">
			</div>
			<div class="form-group col-sm-5">
			<input type="number" name="member_salary" class="form-control">	
				</div>
			</div>

			<div class="form-group d-none" style  = "margin-top: 10px;">
			<div class="form-group col-md-2">
			</div>
			<div class="form-group col-sm-5">
			<input type="number" name="member_salary" class="form-control">	
				</div>
			</div>

			<div class="form-group d-none" style  = "margin-top: 10px;">
			<div class="form-group col-md-2">
			</div>
			<div class="form-group col-sm-5">
			<input type="number" name="member_salary" class="form-control">	
				</div>
			</div>
			<!-- end of input guarantors -->
		
			<div class="form-group" style  = "margin-top: 10px;">
			<input type="submit" value="Add Loan" class="btn btn-primary">
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
</div>


