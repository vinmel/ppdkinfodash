<?php
require_once('db_connect.php');

$sql = "SELECT * FROM schools_info";
$result = $conn->query($sql);
$data = $result->fetch_array();
print_r($data)
?>

<style>
    .form-control-sm {
        height: 30px;
        padding: 0.125rem 0.75rem;
        font-size: 0.875rem;
    }
</style>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="card-tools">
                <small class="text-muted">
                    Last Updated:
                    <?= $data['date_updated'] ?>
                </small>
            </div>
            <form action="" id="manage_sch">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '1' ?>">
                <div class="row">
                    <div class="col-md-6 border-right">
                        <b class="text-muted">Type of schools in the area</b>
                        <b class="text-muted"></b>
                        <div class="form-group align-self-auto">
                            <label for="" class="control-label">SK</label>
                            <input type="text" name="SK" class="form-control form-control-sm" value="<?= $data['total'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">SJK(C)</label>
                            <input type="text" name="SJK(C)" class="form-control form-control-sm" value="<?=  $data['total'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">SK(M)</label>
                            <input type="text" name="SK(M)" class="form-control form-control-sm" value="<?= $data['total'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">SK(A)</label>
                            <input type="text" name="SK(A)" class="form-control form-control-sm" value="<?= $data['total'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">SKPK</label>
                            <input type="text" name="SKPK" class="form-control form-control-sm" value="<?= $data['total'] ?>">
                        </div>
                        <div class="form-group align-self-auto">
                            <label for="" class="control-label">SMK</label>
                            <input type="text" name="SMK" class="form-control form-control-sm" value="<?= $data['total'] ?>">
                        </div>                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">SMK(M)</label>
                            <input type="text" name="SMK(M)" class="form-control form-control-sm" value="<?= $data['total'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">SMK(A)</label>
                            <input type="text" name="SMK(A)" class="form-control form-control-sm" value="<?= $data['total'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">KOLEJ(Asrama)</label>
                            <input type="text" name="KOLEJ(A)" class="form-control form-control-sm" value="<?= $data['total'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">SEKOLAH SENI</label>
                            <input type="text" name="SEKOLAH SENI" class="form-control form-control-sm" value="<?= $data['total'] ?>">
                        </div>
                        <div class="form-group align-self-auto">
                            <label for="" class="control-label">KOLEJ VOKASIONAL</label>
                            <input type="text" name="KOLEJ" class="form-control form-control-sm" value="<?= $data['total'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">SMT</label>
                            <input type="text" name="smt" class="form-control form-control-sm" value="<?= $data['total'] ?>">
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

<script>
    $('#manage_sch').submit(function(e) {
        e.preventDefault();
        start_load();
        $.ajax({
            url: 'ajax.php?action=update_staffs',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp) {
                if (resp) {
                    alert_toast('Data successfully updated', "success");
                    setTimeout(function() {
                        location.href = 'index.php?page=manage_staffs_info'
                    }, 2000)
                }
            }
        })
    })
</script>