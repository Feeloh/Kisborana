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
<h1>My friends </h1>
<?php
            echo form_open('friends/execute_search');

            echo form_input(array('name' => 'search'));

            echo form_submit('search_submit', 'Submit');

            ?>
<?php echo anchor("friends/new_friend", "Add Friend"); ?>
<table class="table">
	<tr>
		<th>#</th>
		<th>Name</th>
		<th>Age</th>
		<th>Gender</th>
		<th>Picture</th>
		<th>Status</th>
		<th colspan="4">Actions</th>
	</tr>
	<?php
			$count = $page;
			foreach ($all_friends as $row) {
			$count++;
			$id = $row->friend_id;
			$name = $row->friend_name;
			$age = $row->friend_age;
			$gender = $row->friend_gender;
			$picture = $row->friend_picture;
			$check = $row->friend_status;
			?>
	<tr>
		<td>
			<?php echo $count; ?>
		</td>
		<td>
			<?php echo $name; ?>
		</td>
		<td>
			<?php echo $age; ?>
		</td>
		<td>
			<?php echo $gender; ?>
		</td>
		<td>
			<!-- <?php echo $picture; ?> -->
			<img style="height: 100px; width: 100px;" src="<?php echo site_url().'uploads/'.$picture?>" class="img-responsive">

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
			<!-- Button trigger modal -->
			<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
				Launch demo modal
			</button> -->
			<a href="#individualfriend<?php echo $id;?>" class="btn btn-primary" data-toggle="modal" data-target="#individualfriend<?php echo $id;?>">View Friend</a>
			<!-- Modal -->
			<div class="modal fade" id="individualfriend<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			 aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">
								<?php echo $name?>
							</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<table class="table">
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Age</th>
									<th>Gender</th>
									<th>Picture</th>
									<th>Status</th>
									<th colspan="4">Actions</th>
								</tr>
								<tr>
									<td>
										<?php echo $count; ?>
									</td>
									<td>
										<?php echo $name; ?>
									</td>
									<td>
										<?php echo $age; ?>
									</td>
									<td>
										<?php echo $gender; ?>
									</td>
									<td>
										<!-- <?php echo $picture; ?> -->
										<img style="height: 100px; width: 100px;" src="<?php echo site_url().'uploads/'.$picture?>" class="img-responsive">

									</td>
									<td>

									</td>
									<td>
										<?php echo anchor("friends/edit/" . $id, "Edit"); ?>
									</td>
									<td>
										<?php 
									if($check == '1'){
										echo anchor("friends/deactivate/" . $id, "Deactivate", array('onclick' => "return confirm('Do you want to deactivate this record')"));
									}else{
									echo anchor("friends/activate/" . $id, "Activate", array('onclick' => "return confirm('Do you want to activate this record')"));
									} ?>
									</td>
									<td>
										<?php echo anchor("friends/delete/" . $id, "Delete",array('onclick' => "return confirm('Do you want to delete this record')")); ?>
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
			<?php echo anchor("friends/edit/" . $id, "Edit"); ?>
		</td>
		<td>
			<?php 
				if($check == '1'){
					echo anchor("friends/deactivate/" . $id, "Deactivate", array('onclick' => "return confirm('Do you want to deactivate this record')"));
				}else{
				echo anchor("friends/activate/" . $id, "Activate", array('onclick' => "return confirm('Do you want to activate this record')"));
				} ?>
		</td>
		<td>
			<?php echo anchor("friends/delete/" . $id, "Delete", array('onclick' => "return confirm('Do you want to delete this record')"),img('assets/images/lock.png')); ?>
		</td>
	</tr>
	<?php } ?>
</table>
<?php echo $links;?>
