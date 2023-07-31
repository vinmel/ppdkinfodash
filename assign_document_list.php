<?php include 'db_connect.php'; ?>
<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <table class="table table-hover table-bordered" id="list">
                <?php if ($_SESSION['login_type'] == 3): ?>
                    <colgroup>
                        <col width="10%">
                        <col width="25%">
                        <col width="35%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                <?php else: ?>
                    <colgroup>
                        <col width="10%">
                        <col width="30%">
                        <col width="30%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                <?php endif; ?>

                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Title</th>
                        <th>Description</th>
                       
                        <th>Assigned by</th>

                        <th>Assigned date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $where = '';
                    if ($_SESSION['login_type'] == 3) {
                        $user = $conn->query("SELECT * FROM users where id IN (SELECT user_id FROM documents)");
                        while ($row = $user->fetch_assoc()) {
                            $uname[$row['id']] = ucwords($row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']);
                        }
                    } else {
                        $where = " WHERE user_id = '{$_SESSION['login_id']}' ";
                    }
                 
                    // Retrieve documents based on document ID
                    $qrySharedFiles = $conn->query("SELECT * FROM shared_files WHERE is_deleted = 0 AND recipient = '{$_SESSION['login_id']}'");
                    $qry = $conn->query("SELECT * FROM documents" . $where . " ORDER BY unix_timestamp(date_created) DESC");

                    //
                    
                    while ($row = $qrySharedFiles->fetch_assoc()): //[{ id, recipient_id, document_id }, { id, recipient_id,  } ]
                        $document = $conn->query("SELECT * FROM documents WHERE document_id = '{$row['document_id']}'")->fetch_assoc();
						$user = $conn->query("SELECT CONCAT(firstname,' ', lastname) as fullname FROM users WHERE id = '{$row['created_by']}'")->fetch_assoc();
                        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                        $desc = strtr(html_entity_decode($document['description']), $trans);
                        $desc = str_replace(array("<li>", "</li>"), array("", ", "), $desc);
                    ?>
                        <tr>
                            <th class="text-center"><?php echo $i++ ?></th>
                            <td><b><?php echo ucwords($document['title']) ?></b></td>
                            <td><b class="truncate"><?php echo strip_tags($desc) ?></b></td>
                            <td><?php echo isset($user['fullname']) ? $user['fullname'] : "Deleted User" ?></td>
                            <td><?php echo date($row['assigned_date']) ?></td>
                            <td class="text-center">
                                <!-- Button area -->
                                <div class="btn-group">
                                    <?php if($_SESSION['login_type']==2): ?>
                                    <a href="./index.php?page=edit_document&id=<?php echo $document['document_id'] ?>" class="btn btn-primary btn-flat">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <?php endif; ?>
                                    <a href="./index.php?page=view_document&id=<?php echo $document['document_id'] ?>" class="btn btn-info btn-flat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-flat delete_file" data-id="<?php echo $row['id'] ?>">
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
    $(document).ready(function() {
        $('#list').DataTable();
        $('.delete_file').click(function() {
            _conf("Are you sure to delete this document?", "delete_file", [$(this).attr('data-id')]);
        });
    });

    function delete_file($id) {
        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_assign_file',
            method: 'POST',
            data: {
                id: $id
            },
            error: function(xhr, status, error) {
				window.alert(error);
			},
            success: function(resp) {
                if (resp) {
                    alert_toast("Data successfully deleted", 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            }
        });
    }

   
</script>
