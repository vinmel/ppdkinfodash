<?php

require_once('db_connect.php');

$sql = "SELECT * FROM staff_info";
$result = $conn->query($sql);

$data = $result->fetch_assoc();

print_r($data);

?>


<style>
	.container {
		display: grid;
		place-items: center;
		/* Add additional styles as needed */
	}
</style>

<div class="col-lg-4">
	<div class="container">
		<div class="card">
			<div class="card-body">
				<div class="card-tools">
					<!-- <small class="text-muted">
						Last Updated:
						 <?= $data['date_updated'] ?> 
					</small> --->
				</div>
				<form action="" id="manage_staffs">
					<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '1' ?>">
					<div class="row">
						<div class="align-content-lg-center">
							<b class="text-muted">Total of PPD Kuching staff based on Grade</b>
							<div class="form-group align-self-auto">
								<label for="" class="control-label"> DG = stands for Education officer scheme
									code</label>
								<input type="text" name="edu" class="form-control form-control-sm"
									value="<?= $data['edu'] ?>">
							</div>
							<div class="form-group">
								<label for="" class="control-label"> N = stands for Administrator officer scheme
									code</label>
								<input type="text" name="adm" class="form-control form-control-sm"
									value="<?= $data['adm'] ?>">
							</div>
							<div class="form-group">
								<label for="" class="control-label"> F = stands for IT officer scheme code</label>
								<input type="text" name="it" class="form-control form-control-sm"
									value="<?= $data['it'] ?>">
							</div>
							<div class="form-group">
								<label for="" class="control-label"> J = stands for Engineering officer scheme
									code</label>
								<input type="text" name="eng" class="form-control form-control-sm"
									value="<?= $data['eng'] ?>">
							</div>
						</div>
					</div>
					<hr>
					<div class="col-lg-12 text-right justify-content-center d-flex">
						<button  class="btn btn-primary mr-2">Update</button>
						<button class="btn btn-secondary" type="button" onclick="location.href = './'">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$('#manage_staffs').submit(function (e) {
	start_load();
	
	$.ajax({
		url: 'ajax.php?action=update_staffs',
		method:'POST',
			data: data,
			error: function(xhr, status, error) {
				console.error(error);
			},
		success: function (resp) {
			if (resp) {
				alert_toast('Data successfully updated', 'success');
				setTimeout(function () {
					location.href = 'index.php?page=manage_staffs_info';
				}, 2000);
			}
		},
		error: function (xhr, status, error) {
			alert_toast('Error updating data: ' + error, 'error');
			console.log(xhr.responseText);
		}
	});
});


</script>