<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM documents where document_id = '{$_GET['id']}' ")->fetch_array();
foreach ($qry as $k => $v) {
	if ($k == 'title')
		$k = 'ftitle';
	$$k = $v;
}
?>

<div class="col-lg-12">
	<?php if (isset($_SESSION['login_id'])): ?>
		<div class="row">
			<?php if ($_SESSION['login_type'] == 2): ?>
				
				<div class="col-md-12 mb-2">
					<button class="btn bg-light border float-right" type="button" id="assign"
						data-docid="<?php $document_id ?>"><i class="fas fa-share-alt"></i> Assign This Document</button>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<div class="row">
		<div class="col-md-7">
			<div class="card card-outline card-info">
				<div class="card-header">
					<div class="card-tools">
						<small class="text-muted">
							Date Uploaded:
							<?php echo date("d/m/Y H:i:s", strtotime($date_created)) ?>
						</small>
					</div>
				</div>
				<div class="card-body">
					<div class="callout callout-info">
						<dl>
							<dt>Title</dt>
							<dd>
								<?php echo $ftitle ?>
							</dd>
						</dl>
					</div>
					<div class="callout callout-info">
						<dl>
							<dt>Description</dt>
							<dd>
								<?php echo html_entity_decode($description) ?>
							</dd>
						</dl>
					</div>
					<?php if ($_SESSION['login_type'] == 3): ?>
						<div class="card-tools">
							<small class="text-muted">
								Latest document updated:
								<?php
								if (isset($updated_at) && $updated_at !== '0000-00-00 00:00:00') {
									echo date("d/m/Y H:i:s", strtotime($updated_at));
								} else {
									echo "No Latest Updated";
								}
								?>
							</small>
						</div>
					<?php endif ?>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3><b>File/s</b></h3>
					<?php if ($_SESSION['login_type'] == 3): ?>
						<small class="text-muted">
							Please download the file within 30 days after assigned date.
						</small>

					<?php endif; ?>
				</div>
				<div class="card-body">
					<div class="col-md-12">
						<div class="alert alert-info px-2 py-1"><i class="fa fa-info-circle"></i> Click the file to
							download.</div>
						<div class="row">
							<?php
							if (isset($file_json) && !empty($file_json)):
								foreach (json_decode($file_json) as $k => $v):
									if (is_file('assets/uploads/' . $v)):
										$_f = file_get_contents('assets/uploads/' . $v);
										$dname = explode('_', $v);
										?>

										<div class="col-sm-3">
											<a href="download.php?f=<?php echo $v ?>" target="_blank"
												class="text-white border-rounded file-item p-1">
												<span
													class="img-fluid bg-dark border-rounded px-2 py-2 d-flex justify-content-center align-items-center"
													style="width: 100px;height: 100px">
													<h3 class="bg-dark"><i class="fa fa-download"></i></h3>
												</span>
												<span class="text-dark">
													<?php echo $dname[1] ?>
												</span>
											</a>
										</div>
									<?php endif; ?>
							<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--Assign record table-->
		<?php if ($_SESSION['login_type'] == 2): ?>
			<div class="cold-md-7">
				<div class="card card-outline card-info">
					<div class="card-header">
						<h6><b>Recipient Assigned Record</b></h6>
						<p>This table contains recipient has been assigned to this document.</p>
					</div>

					<div class="card-body">
						<table class="table tabe-hover table-bordered" id="list">
							<colgroup>
								<col width="10%">
								<col width="25%">
								<col width="45%">
							</colgroup>

							<thead>
								<tr>
									<th class="text-center">No</th>
									<th>Recipient</th>
									<th>Date Assigned</th>
								</tr>
							</thead>

							<tbody>
								<?php
								$i = 1;
								$where = '';

								$qrySharedFiles = $conn->query("SELECT * FROM shared_files WHERE is_deleted = 0 AND document_id = '{$_GET['id']}'");

								while ($row = $qrySharedFiles->fetch_assoc()):
									$user = $conn->query("SELECT CONCAT(firstname,' ', lastname) as fullname FROM users WHERE id = '{$row['recipient']}'")->fetch_assoc();
									$document = $conn->query("SELECT * FROM documents WHERE document_id = '{$row['document_id']}'")->fetch_assoc();
									?>

									<tr>
										<th class="text-center">
											<?php echo $i++ ?>
										</th>
										<td>
											<?php echo isset($user['fullname']) ? $user['fullname'] : "" ?>
										</td>
										<td>
											<?php echo date($row['assigned_date']) ?>
										</td>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
<script>
	$('.file-item').hover(function () {
		$(this).addClass("active")
	})
	$('file-item').mouseout(function () {
		$(this).removeClass("active")
	})
	$('.file-item').click(function (e) {
		e.preventDefault()
		_conf("Are you sure to download this file?", "dl", ['"' + $(this).attr('href') + '"'])
	})
	function dl($link) {
		start_load()
		window.open($link, "_blank")
		end_load()
	}
	$('#assign').click(function () {
		var documentId = $(this).data('docid');
		uni_modal("<i class='fa fa-assign'></i> Assign This Document", "modal_assign_file.php?did=" + documentId);
	});

	
	function assign_file() {
		start_load();
		const data = {
			document_id: <?php echo $_GET['id'] ?>,
			recipient: $("#recipient option:selected").val(),
			user_id: <?php echo $_SESSION['login_id'] ?>
		};
		console.log(JSON.stringify(data));
		$.ajax({
			url: 'ajax.php?action=assign_file',
			method: 'POST',
			data: data,
			error: function (xhr, status, error) {
				console.error(error);
			},
			success: function (resp) {

				if (resp) {
					alert_toast("Data successfully assigned", 'success');
					// location.reload(3500);
					setTimeout(function () {
						location.reload();
					}, 2000);

				}
			}
		});
	}



</script>