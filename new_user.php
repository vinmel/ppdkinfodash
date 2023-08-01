<?php
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form action="" id="manage_user">
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-6 border-right">
						<b class="text-muted">Personal Information</b>
						<div class="form-group">
							<label for="" class="control-label">Salutation</label>
							<select name="salutation" class="form-control form-control-sm" required>
								<option value="Mr" <?php echo (isset($salutation) && $salutation === 'Mr') ? 'selected' : '' ?>>Mr</option>
								<option value="Mrs" <?php echo (isset($salutation) && $salutation === 'Mrs') ? 'selected' : '' ?>>Mrs</option>
								<option value="Ms" <?php echo (isset($salutation) && $salutation === 'Ms') ? 'selected' : '' ?>>Ms</option>
								<option value="Miss" <?php echo (isset($salutation) && $salutation === 'Miss') ? 'selected' : '' ?>>Miss</option>
								<option value="Dr" <?php echo (isset($salutation) && $salutation === 'Dr') ? 'selected' : '' ?>>Dr</option>
								<option value="Prof" <?php echo (isset($salutation) && $salutation === 'Prof') ? 'selected' : '' ?>>Prof</option>
							</select>
						</div>
						<div class="form-group">
							<label for="" class="control-label">First Name</label>
							<input type="text" name="firstname" class="form-control form-control-sm" required
								value="<?php echo isset($firstname) ? $firstname : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Middle Name</label>
							<input type="text" name="middlename" class="form-control form-control-sm"
								value="<?php echo isset($middlename) ? $middlename : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Last Name</label>
							<input type="text" name="lastname" class="form-control form-control-sm" required
								value="<?php echo isset($lastname) ? $lastname : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Gender</label>
							<select name="gender" class="form-control form-control-sm" required>
								<option value="Male" <?php echo (isset($gender) && $gender === 'Male') ? 'selected' : '' ?>>Male</option>
								<option value="Female" <?php echo (isset($gender) && $gender === 'Female') ? 'selected' : '' ?>>Female</option>
							</select>
						</div>
						<div class="form-group">
							<label for="dob">Date of Birth</label>
							<input type="text" id="dob" name="dob" class="form-control form-control-sm" required
								value="<?php echo isset($dob) ? $dob : ''; ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Contact No.</label>
							<input type="text" name="contact" class="form-control form-control-sm" required
								value="<?php echo isset($contact) ? $contact : '' ?>">
						</div>
						<div class="form-group">
							<label class="control-label">Address</label>
							<textarea name="address" id="" cols="30" rows="4" class="form-control"
								required><?php echo isset($address) ? $address : '' ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">Avatar</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="customFile" name="img"
									onchange="displayImg(this,$(this))">
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="control-label">Job Grade</label>
								<small>
								<i>Fill in the Grade such as DG41,N29,FA29/FT19/FT22 or J29 based on the particluar given.</i>
								</small>
							<input type="text" name="grade" class="form-control form-control-sm" required
								value="<?php echo isset($grade) ? $grade : '' ?>">
						</div>
						<div class="form-group d-flex justify-content-center">
							<img src="<?php echo isset($avatar) ? 'assets/uploads/' . $avatar : '' ?>" alt="" id="cimg"
								class="img-fluid img-thumbnail">
						</div>
						<b class="text-muted">System Credentials</b>
						<?php if ($_SESSION['login_type'] == 1): ?>
							<div class="form-group">
								<label for="" class="control-label">User Role</label>
								<select name="type" id="type" class="custom-select custom-select-sm">
									<option value="3" <?php echo isset($type) && $type == 3 ? 'selected' : '' ?>>User Level 2
									</option>
									<option value="2" <?php echo isset($type) && $type == 2 ? 'selected' : '' ?>>User Level 1
									</option>
									<option value="1" <?php echo isset($type) && $type == 1 ? 'selected' : '' ?>>Admin
									</option>
								</select>
							</div>
						<?php else: ?>
							<input type="hidden" name="type" value="3">
						<?php endif; ?>
						<div class="form-group">
							<label class="control-label">Email</label>
							<input type="email" class="form-control form-control-sm" name="email" required
								value="<?php echo isset($email) ? $email : '' ?>">
							<small id="#msg"></small>
						</div>
						<div class="password-container">
							<label class="control-label">Password</label>
							<input type="password" class="form-control form-control-sm" name="password" <?php echo isset($id) ? "" : 'required' ?>>
							<small><i>
									<?php echo isset($id) ? "Please reset to default password and inform it to user after a few changes." : '' ?>
								</i></small>
						</div>
						<div class="form-group">
							<label class="label control-label">Confirm Password</label>
							<input type="password" class="form-control form-control-sm" name="cpass" <?php echo isset($id) ? 'required' : '' ?>>
							<small id="pass_match" data-status=''></small>
						</div>

						<div class="form-group">
							<label class="checkbox">
								<input type="checkbox" id="isActive" class="form-checkbox"
									value="<?php echo (isset($isActive) && $isActive == 0 ? 0 : 1) ?>" name="isActive"
									<?php echo (isset($isActive) && $isActive == 0 ? "" : "checked") ?>>
								Is Active
							</label>
						</div>
					</div>
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-primary mr-2">Save</button>
					<button class="btn btn-secondary" type="button"
						onclick="location.href = 'index.php?page=user_list'">Cancel</button>
				</div>
			</form>
		</div>
	</div>
</div>
<style>
	img#cimg {
		max-height: 15vh;
		/*max-width: 6vw;*/
	}
</style>
<!-- Include JavaScript for jQuery and jQuery UI datepicker -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	$(document).ready(function () {
		// Set date format as 'yy-mm-dd' (adjust as per your preference)
		$("#dob").datepicker({
			dateFormat: 'yy-mm-dd',
			maxDate: new Date() // Optional: Restrict selection to a maximum date (e.g., no future dates)
		});
	});


	//logic process for matching password and confirm password box 
	$('[name="password"],[name="cpass"]').keyup(function () {
		var pass = $('[name="password"]').val()
		var cpass = $('[name="cpass"]').val()
		if (cpass == '' || pass == '') {
			$('#pass_match').attr('data-status', '')
		} else {
			if (cpass == pass) {
				$('#pass_match').attr('data-status', '1').html('<i class="text-success">Password Matched.</i>')
			} else {
				$('#pass_match').attr('data-status', '2').html('<i class="text-danger">Password does not match.</i>')
			}
		}
	})
	function displayImg(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#cimg').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#isActive").click(function () {
		const val = $(this).val();
		$("#isActive").val(val == 1 ? 0 : 1);
	});

	$('#manage_user').submit(function (e) {
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		if ($('#pass_match').attr('data-status') != 1) {
			if ($("[name='password']").val() != '') {
				$('[name="password"],[name="cpass"]').addClass("border-danger")
				end_load()
				return false;
			}
		}
		$.ajax({
			url: 'ajax.php?action=save_user',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function (resp) {
				console.log(resp);
				if (resp == 1) {
					alert_toast('Data successfully saved.', "success");
					setTimeout(function () {
						location.replace('index.php?page=user_list')
					}, 750);
				} else if (resp == 2) {
					$('#msg').html("<div class='alert alert-danger'>Email already exist.</div>");
					$('[name="email"]').addClass("border-danger")
					end_load()
				}
			}
		})
	})

</script>