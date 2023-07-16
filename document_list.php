<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_document"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list"> 
			     <?php if($_SESSION['login_type'] == 1 ): ?> 
				<colgroup>
					<col width="10%">
					<col width="25%">
					<col width="35%">
					<col width="12%">
					<col width="10%">
				</colgroup>
			    <?php else: ?>
				<colgroup>
					<col width="10%">
					<col width="25%">
					<col width="35%">
					<col width="10%">
				</colgroup>
			    <?php endif; ?>

				<thead>
					<tr>
						<th class="text-center">No</th>
						<th>Title</th>
						<th>Description</th>
					     <?php if($_SESSION['login_type'] == 1): ?>
						<th>Upload By</th>
					    <?php endif; ?>
						<th>Date Created</th>
						<th>Date Updated</th>
						<th>Action</th>
					</tr>
				</thead>

				
				<tbody> 
					<!-- query table for crud data-->
					<?php
						$i = 1;
						$where = '';
						if($_SESSION['login_type'] == 1 ):
						$user = $conn->query("SELECT * FROM users where id in (SELECT user_id FROM documents) ");
						while($row = $user->fetch_assoc()){
							$uname[$row['id']] = ucwords($row['firstname'].', '.$row['middlename'].' '.$row['lastname']);
						}
						else:
							$where = " where user_id = '{$_SESSION['login_id']}' ";
						endif;

						if ($_SESSION['login_type'] == 1 ) {
							$qry = $conn->query("SELECT * FROM documents WHERE is_deleted = 0 order by unix_timestamp(date_created) desc");
						} else {
							$qry = $conn->query("SELECT * FROM documents WHERE is_deleted = 0 AND user_id = '{$_SESSION['login_id']}' order by unix_timestamp(date_created) desc");
						}
						
						
						// $qry = $conn->query("SELECT * FROM documents $where order by unix_timestamp(date_created) desc "); //Query for calling data from document
						while($row= $qry->fetch_assoc()):
							$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
							unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
							$desc = strtr(html_entity_decode($row['description']),$trans);
							$desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th> 
						<td><b><?php echo ucwords($row['title']) ?></b></td>
						<td><b class="truncate"><?php echo strip_tags($desc) ?></b></td>
						  <?php if($_SESSION['login_type'] == 1 ): ?>
						<td><?php echo isset($uname[$row['user_id']]) ? $uname[$row['user_id']] : "Deleted User" ?></td>
					    <?php endif; ?>
						<td><?php echo date("d/m/Y H:i:s", strtotime($row['date_created'])) ?></td>
						<!-- <td><?php echo date("d/m/Y H:i:s",strtotime($row['updated_at'])) ?></td> -->
						<td><?php
								if (isset($row['updated_at']) && $row['updated_at'] !== '0000-00-00 00:00:00') {
									echo date("d/m/Y H:i:s", strtotime($row['updated_at']));
								} else {
									echo "No Latest Updated";
								}
								?>
						</td> 
						<td class="text-center">
		                    <div class="btn-group">
		                        <a href="./index.php?page=edit_document&id=<?php echo $row['document_id'] ?>" class="btn btn-primary btn-flat">
		                          <i class="fas fa-edit"></i>
		                        </a>
		                        <a  href="./index.php?page=view_document&id=<?php echo $row['document_id'] ?>" class="btn btn-info btn-flat">
		                          <i class="fas fa-eye"></i>
		                        </a>
		                        <button type="button" class="btn btn-danger btn-flat delete_document" data-id="<?php echo $row['document_id'] ?>">
		                          <i class="fas fa-trash"></i>
		                        </button>
	                      </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.delete_document').click(function(){
	_conf("Are you sure to delete this document?","delete_document",[$(this).attr('data-id')])
	})
	})
	function delete_document($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_file',
			method:'POST',
			data:{
				id:$id
			},
			error: function(xhr, status, error) {
				window.alert(error);
			},
			success:function(resp){
				if(resp){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>