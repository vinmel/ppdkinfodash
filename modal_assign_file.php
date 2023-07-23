<?php include 'db_connect.php' ?>
<div class="form-row">
	<form action="assign_file">
		<b> Select the document recipient</b>
		<div class="col-md-6">
			<div class="form-group">

				<select class="form-control" name="recipient" id="recipient">
					<option selected="selected" value="">Select</option>

					<?php

					//Get all unions from database
					$qry = $conn->query("SELECT * FROM users WHERE type='3'");
					while ($row = $qry->fetch_assoc()) { ?>
						<option value="<?php echo $row['id'] ?>"> <?php echo $row['firstname'] . ' ' . $row['lastname']; ?>
						</option>
						<?php
					}
					?>
				</select>
			</div>
		</div>
	</form>
</div>
<div class="modal-footer display p-0 m-0">
	<button type="submit" class="btn bg-gradient-primary" type="button" onclick="assign_file()"><i
			class="fa fa-copy"></i> Assign</button>
	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<style>
	#uni_modal .modal-footer {
		display: none
	}

	#uni_modal .modal-footer.display {
		display: flex
	}
</style>