<?php
include('db_connect.php');
$sql = "SELECT * FROM staff_info";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
// print_r($data);
?>

<div class="col-lg-12">
	<div class="container">
		<div class="card">
			<div class="card-body">
				<div class="card-tools">
					<small class="text-muted">
						Last Updated:
						<?= $data['date_updated'] ?>
					</small>
				</div>
				<form action="" id="manage_staffs">
					<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '1' ?>">
					<div class="row">
						<div class="col-md-6 border-right">
							<b class="text-muted">Total of PPD Kuching staff based on Grade</b>
							<div class="form-group ">
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
						<div class="col-md-6">
							<b class="text-muted">General information about schools</b>
							<div class="form-group">
								<label for="numericInput" class="control-label"> Total Secondary School</label>
								<input type="" name="tsec_schl" class="form-control form-control-sm"
									value="<?= $data['tsec_schl'] ?>">
							</div>
							<div class="form-group">
								<label for="" class="control-label"> Total Primary School</label>
								<input type="text" name="tpm_schl" class="form-control form-control-sm"
									value="<?= $data['tpm_schl'] ?>">
							</div>
							<div class="form-group">
								<label for="" class="control-label"> Total Teacher of Secondary School</label>
								<input type="text" name="tcsec_schl" class="form-control form-control-sm"
									value="<?= $data['tcsec_schl'] ?>">
							</div>
							<div class="form-group">
								<label for="" class="control-label"> Total Teacher of Primary School</label>
								<input type="text" name="tcpm_schl" class="form-control form-control-sm"
									value="<?= $data['tcpm_schl'] ?>">
							</div>
							<div class="form-group">
								<label for="" class="control-label"> Total Students in Kuching area</label>
								<input type="text" name="tot_student" class="form-control form-control-sm"
									value="<?= $data['tot_student'] ?>">
							</div>
						</div>
					</div>
					<hr>
					<div class="col-lg-12 text-right justify-content-center d-flex">
						<button class="btn btn-primary mr-2">Update</button>
						<button class="btn btn-secondary" type="button" onclick="location.href = './'">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		
		$('#manage_staffs').submit(function (e) {
			e.preventDefault();
			const data = {
				id: $("input[name='id']").val(),
				edu: $("input[name='edu']").val(),
				adm: $("input[name='adm']").val(),
				it: $("input[name='it']").val(),
				eng: $("input[name='eng']").val(),
				tsec_schl: $("input[name='tsec_schl']").val(),
				tpm_schl: $("input[name='tpm_schl']").val(),
				tcsec_schl: $("input[name='tcsec_schl']").val(),
				tcpm_schl: $("input[name='tcpm_schl']").val(),
				tot_student: $("input[name='tot_student']").val(),
			};
			start_load();
			$.ajax({
				url: 'ajax.php?action=update_staffs',
				method: 'POST',
				data: data,
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
	});

</script>