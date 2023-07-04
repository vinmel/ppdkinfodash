<?php include 'db_connect.php'; ?>
<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <table class="table table-hover table-bordered" id="list">
                <?php if ($_SESSION['login_type'] == 1): ?>
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
                        <th class="text-center">#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <?php if ($_SESSION['login_type'] == 1): ?>
                            <th>User</th>
                        <?php endif; ?>
                        <th>Assigned by</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $where = '';
                    if ($_SESSION['login_type'] == 1) {
                        $user = $conn->query("SELECT * FROM users where id IN (SELECT user_id FROM documents)");
                        while ($row = $user->fetch_assoc()) {
                            $uname[$row['id']] = ucwords($row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']);
                        }
                    } else {
                        $where = " WHERE user_id = '{$_SESSION['login_id']}' ";
                    }
                    
                    // Retrieve documents based on document ID
                    //$documentId = $_GET['document_id'];
                    $qrySharedFiles = $conn->query("SELECT * FROM shared_files WHERE recipient = '{$_SESSION['login_id']}'");
                    $qry = $conn->query("SELECT * FROM documents" . $where . " ORDER BY unix_timestamp(date_created) DESC");

                    //
                    
                    while ($row = $qrySharedFiles->fetch_assoc()): //[{ id, recipient_id, document_id }, { id, recipient_id,  } ]
                        $document = $conn->query("SELECT * FROM documents WHERE document_id = '{$row['document_id']}'")->fetch_assoc();
						// $user = $conn->query("SELECT * FROM documents WHERE id = '{$row['recipient']}'")->fetch_assoc();
                        $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
                        unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                        $desc = strtr(html_entity_decode($document['description']), $trans);
                        $desc = str_replace(array("<li>", "</li>"), array("", ", "), $desc);
                    ?>
                        <tr>
                            <th class="text-center"><?php echo $i++ ?></th>
                            <td><b><?php echo ucwords($document['title']) ?></b></td>
                            <td><b class="truncate"><?php echo strip_tags($desc) ?></b></td>
                            <?php if ($_SESSION['login_type'] == 1): ?>
                                <td><?php echo isset($user['name']) ? ucwords($user['name']) : "Deleted User" ?></td>
                            <?php endif; ?>
                            <td class="text-center">
                                <!-- Button area -->
                                <div class="btn-group">
                                    <a href="./index.php?page=edit_document&id=<?php echo $document['document_id'] ?>" class="btn btn-primary btn-flat">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="./index.php?page=view_document&id=<?php echo $document['document_id'] ?>" class="btn btn-info btn-flat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-flat delete_document" data-id="<?php echo $document['document_id'] ?>">
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
        $('.delete_document').click(function() {
            _conf("Are you sure to delete this document?", "delete_document", [$(this).attr('data-id')]);
        });
    });

    function delete_document($id) {
        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_file',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            }
        });
    }

   
</script>
