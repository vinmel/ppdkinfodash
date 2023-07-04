<?php include'db_connect.php' ?>

<div class="form-row">
<div class="col-md-6">
<div class="form-group">
				<label for="">Select the document recipient</label>
				<select class="form-control" name="reciepent" id ="document">
				<option selected="selected" value="">Select</option>

					<?php

				//Get all unions from database
				$qry = $conn->query("SELECT * FROM users WHERE type='3'");
				while($row = $qry->fetch_assoc()){ ?>

					<option value="<?php echo $row['id'] ?>"> <?php echo $row['firstname']?> </option>
				<?php
				}

				?> </select>
	</div>
</div>
</div>
<div class="modal-footer display p-0 m-0">
        <button type="button" class="btn bg-gradient-primary" type="button" onclick="copyToClipboard('#link')"><i class="fa fa-copy"></i> Assign</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>
	