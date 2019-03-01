<div class="card">
	<div class="card-body">
		<?php echo form_open_multipart($this->uri->uri_string()); ?>
		<div class="form-group" style  = "margin-top: 10px;">
			<div class="form-group col-sm-2">
				<label for='member_details'>Member:</label>
			</div>
			<div class="form-group col-sm-8">
			


				<select class="form-control custom-select2" name="member_name" single id="member_details">
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
			<div class="form-group col-sm-8">
				<select class="form-control" name="loan_type_name"  id="loan_type_details" >
					<?php 
					foreach($loan_type_details->result() as $row){
						$loan_type_name = $row->loan_type_name;
						$loan_type_id = $row->loan_type_id;
						
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
			<div class="form-group col-sm-2">
				<label for='loan_stage_details'>Loan Stage:</label>
			</div>
			<div class="form-group col-sm-8">
			


				<select class="form-control" name="loan_stage" single id="loan_stage">
					
				<?php 
					foreach($loan_stage_details->result() as $row){
						$loan_stage_name = $row->loan_stage_name;
						$loan_stage_id = $row->loan_stage_id;
						
						?>
						<option value="<?php echo $loan_stage_id; ?>"><?php echo $loan_stage_name;?></option>
						
					<?php
					}
					?>
				</select>
			</div>
			</div>

		<div class="form-group" style  = "margin-top: 10px;">
			<div class="form-group col-md-2">
				<label for='loan_amount'>Loan amount: </label>
				</div>
				<div class="form-group col-sm-8">
				<input type="number" name="loan_amount" class="form-control">
			</div>
			</div> 

			<div class="form-group" style  = "margin-top: 10px;">
			<div class="form-group col-md-2">
				<label for='installment_period'>Installment Period: </label>
				</div>
				<div class="form-group col-sm-8">
				<input type="number" name="installment_period" class="form-control">
			</div>
			</div> 

			<!-- <div class="form-group" style  = "margin-top: 10px;">
			<div class="form-group col-md-2">
				<label for='loan_number'>Loan Number: </label>
				</div>
				<div class="form-group col-sm-8">
				<input type="number" name="loan_number" class="form-control">
			</div>
			</div>  -->

			<div class="form-group" style  = "margin-top: 10px;">
			<div class="form-group col-md-2">
				<label for='member_salary'>Member Salary: </label>
				</div>
				<div class="form-group col-sm-8">
				<input type="number" name="member_salary" class="form-control">
			</div>
			</div> 

			
			<div class="form-group" style  = "margin-top: 10px;">
			<div class="form-group col-sm-2">
				<label for='member_details'>Guarantor 1:</label>
			</div>
			<div class="form-group col-sm-3">
				<select class="form-control custom-select2" name="guarantor_name" single id="guarantor_details">
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
			<div class="form-group col-md-2">
				<label for='loan_amount'>Guaranteed Amount: </label>
				</div>
				<div class="form-group col-sm-3">
				<input type="number" name="guaranteed_amount" class="form-control">				
			</div>			
			</div>
			
			
			<div class="form-group" style  = "margin-top: 10px;">
			<input type="submit" value="Next" class="btn btn-primary">
		</div>
		<?php echo form_close(); ?>
	</div>
</div>
</div>


