<?php
include('db_connect.php');
session_start();
if (isset($_GET['id'])) {
	$user = $conn->query("SELECT * FROM users where id =" . $_GET['id']);
	foreach ($user->fetch_array() as $k => $v) {
		$meta[$k] = $v;
	}
}
?>

<div class="container-fluid">
	<div id="msg"></div>

	<form action="" id="manage-user">
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id'] : '' ?>">
		<div class="form-group">
			<label for="name">First Name</label>
			<input type="text" name="firstname" id="firstname" class="form-control"
				value="<?php echo isset($meta['firstname']) ? $meta['firstname'] : '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Middle Name</label>
			<input type="text" name="middlename" id="middlename" class="form-control"
				value="<?php echo isset($meta['middlename']) ? $meta['middlename'] : '' ?>">
		</div>
		<div class="form-group">
			<label for="name">Last Name</label>
			<input type="text" name="lastname" id="lastname" class="form-control"
				value="<?php echo isset($meta['lastname']) ? $meta['lastname'] : '' ?>" required>
		</div>
		<div class="form-group">
			<label for="username">Email</label>
			<input type="text" name="email" id="email" class="form-control"
				value="<?php echo isset($meta['email']) ? $meta['email'] : '' ?>" required autocomplete="off">
		</div>
		
		<div class="form-group">
			<label for="" class="control-label">Avatar</label>
			<div class="custom-file">
				<input type="file" class="custom-file-input" id="customFile" name="img"
					onchange="displayImg(this,$(this))">
				<label class="custom-file-label" for="customFile">Choose file</label>
			</div>
		</div>
		<div class="form-group d-flex justify-content-center">
			<img src="<?php echo isset($meta['avatar']) ? 'assets/uploads/' . $meta['avatar'] : '' ?>" alt="" id="cimg"
				class="img-fluid img-thumbnail">
		</div>
		<div class="password-container">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" class="form-control"  value=""
				autocomplete="off">
			<span class="toggle-password" onclick="togglePasswordVisibility()">
				<i class="far fa-eye" id="eye-icon"></i>
			</span>
			<small><i>Please re-enter current password or you can enter new password after you've made any changes.</i></small>
		</div>


	</form>
</div>
<style>
	img#cimg {
		max-height: 15vh;
		/*max-width: 6vw;*/
	}

	.password-container {
		position: relative;
	}

	.toggle-password {
		position: absolute;
		top: 45%;
		right: 10px;
		transform: translateY(-50%);
		cursor: pointer;
		z-index: 1;
	}
</style>
<script>
	function displayImg(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#cimg').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}
	$('#manage-user').submit(function (e) {
		e.preventDefault();
		start_load()
		$.ajax({
			url: 'ajax.php?action=update_user',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function (resp) {
				if (resp == 1) {
					alert_toast("Data successfully saved", 'success')
					setTimeout(function () {
						location.reload()
					}, 1500)
				} else {
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_load()
				}
			}
		})
	})

	// password visibilty function
	function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var eyeIcon = document.getElementById("eye-icon");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      eyeIcon.classList.remove("fa-eye");
      eyeIcon.classList.add("fa-eye-slash");
    } else {
      passwordInput.type = "password";
      eyeIcon.classList.remove("fa-eye-slash");
      eyeIcon.classList.add("fa-eye");
    }
  }

</script>