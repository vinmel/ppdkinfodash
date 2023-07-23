<?php

include ('db_connect.php');

$totals = array();
// Loop through the ids from 1 to 12
for ($id = 1; $id <= 12; $id++) {
    // Prepare the SQL query with the WHERE clause to fetch data for the current id
    $sql = "SELECT total FROM schools_info WHERE id = $id";

    $result = $conn->query($sql);

    // Check if the query was successful and if a row was found
    if ($result && $result->num_rows > 0) {
        // Fetch the data from the result
        $data = $result->fetch_assoc();
        // Store the total value in the array using the id as the key
        $totals[$id] = $data['total'];
    } else {
        // Handle the case when no row is found or query fails
        $totals[$id] = 0; // Default value if no data found or query fails
    }
}

// Query for latest_date
$sql = "SELECT MAX(date_updated) AS latest_date FROM schools_info;";
$resultUsers = $conn->query($sql);
$data = $resultUsers->fetch_assoc();
?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="card-tools">
                <small class="text-muted">
                    Last Updated:
                    <?= $data['latest_date'] ?>
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
                            <!-- Input field for schools_type with value from $totals[id no] -->
                            <input type="text" name="sk" class="form-control form-control-sm" 
                            value="<?= $totals[1] ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">SJK(C)</label>
                            <input type="text" name="sjkc" class="form-control form-control-sm"
                                value="<?= $totals[2] ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">SK(M)</label>
                            <input type="text" name="skm" class="form-control form-control-sm"
                                value="<?= $totals[3] ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">SK(A)</label>
                            <input type="text" name="ska" class="form-control form-control-sm"
                                value="<?= $totals[4] ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">SKPK</label>
                            <input type="text" name="skpk" class="form-control form-control-sm"
                                value="<?= $totals[5] ?>">
                        </div>
                        <div class="form-group align-self-auto">
                            <label for="" class="control-label">SMK</label>
                            <input type="text" name="smk" class="form-control form-control-sm"
                                value="<?= $totals[6] ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="control-label">SMK(M)</label>
                            <input type="text" name="smkm" class="form-control form-control-sm"
                                value="<?= $totals[7] ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">SMK(A)</label>
                            <input type="text" name="smka" class="form-control form-control-sm"
                                value="<?= $totals[8] ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">KOLEJ(Asrama)</label>
                            <input type="text" name="klj_a" class="form-control form-control-sm"
                                value="<?= $totals[9] ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">SEKOLAH SENI</label>
                            <input type="text" name="sk_s" class="form-control form-control-sm"
                                value="<?= $totals[10] ?>">
                        </div>
                        <div class="form-group align-self-auto">
                            <label for="" class="control-label">KOLEJ VOKASIONAL</label>
                            <input type="text" name="kv" class="form-control form-control-sm"
                                value="<?= $totals[11] ?>">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">SMT</label>
                            <input type="text" name="smt" class="form-control form-control-sm"
                                value="<?= $totals[12] ?>">
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

<script>
    $(document).ready(function(){
        
        $('#manage_sch').submit(function (e) {
            // window.alert(totals);
            e.preventDefault();
            const totals ={
                // fetch value from input  above
            1: $("input[name='sk']").val(),

            };
            start_load();
            $.ajax({
                url: 'ajax.php?=update_sch',
                method : 'POST',
                data : totals,
                success:function(resp){
                    if (resp) {
						alert_toast('Data successfully updated', 'success');
						setTimeout(function () {
							location.href = 'index.php?page=manage_schools_info';
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