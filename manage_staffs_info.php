<?php
//logic inside here
require_once ('db_connect.php');
$sql = "SELECT * FROM staff_info";
$result = $conn->query($sql);


$data = $result->fetch_assoc();
print_r($data) 
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
					<small class="text-muted">
							Last Updated: <?= $data['date_updated'] ?>
					</small>
			</div>
			<form action="" id="manage_staffs">
				<input type="hidden">
				<div class="row">
					<!-- <div class="col-md-6 border-right">
						<b class="text-muted">Total of schools and teaching staff in Kuching area</b>
						<div class="form-group">
							<label for="" class="control-label"> Total Secondary School</label>
							<input type="text" name="Secondary School" class="form-control form-control-sm" value="<?php echo isset($second_sch) ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label"> Total Primary School</label>
							<input type="text" name="Secondary School" class="form-control form-control-sm" value="<?php echo isset($primary_sch) ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label"> Total Teacher of Secondary School</label>
							<input type="text" name="Secondary School" class="form-control form-control-sm" value="<?php echo isset($second_th) ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label"> Total Teacher of Primary School</label>
							<input type="text" name="Secondary School" class="form-control form-control-sm" value="<?php echo isset($primary_th) ?>">
						</div>
					</div> -->
					<div class="align-content-lg-center">
						<b class="text-muted">Total of PPD Kuching staff based on Grade</b>
						<div class="form-group align-self-auto">
							<label for="" class="control-label"> DG = stands for Education officer scheme code</label>
							<input type="text" name="Secondary School" class="form-control form-control-sm" value="<?= $data['edu'] ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label"> N = stands for Administrator officer scheme code</label>
							<input type="text" name="Secondary School" class="form-control form-control-sm" value="<?= $data['adm'] ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label"> F = stands for IT officer scheme code</label>
							<input type="text" name="Secondary School" class="form-control form-control-sm" value="<?= $data['it'] ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label"> J = stands for Engineering officer scheme code</label>
							<input type="text" name="Secondary School" class="form-control form-control-sm" value="<?= $data['eng'] ?>">
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
