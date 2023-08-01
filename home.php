<?php include('db_connect.php') ?>
<?php 
$type = array('',"Admin","User Level 1","User Level 2");
$qry = $conn->query ("SELECT * FROM users where id ");
$row = $qry->fetch_assoc();
?>
<!-- Info boxes -->
<?php if($_SESSION['login_type'] == 1): ?>
      <div class="col-8">
          <div class="card">
          	<div class="card-body">
          		Welcome <?php echo $_SESSION['login_name'] ?>! You are log in as <?php echo $type[$_SESSION['login_type']] ?>
          	</div>
          </div>
      </div>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Users</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM users where type IN (1,2,3)")->num_rows; ?> 
                  <!-- used to fetch the users with type 1, 2 and 3. 
                  The IN operator allows you to specify multiple values to match against the type column.-->
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
           <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-folder"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Documents</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM documents  where user_id ")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-share-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Document Assigned</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM shared_files where is_deleted=0")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
      </div>

      <?php elseif ($_SESSION['login_type']==2): ?>
	    <div class="col-12">
          <div class="card">
          	<div class="card-body">
            Welcome <?php echo $_SESSION['login_name'] ?>! You are log in as <?php echo $type[$_SESSION['login_type']] ?>
          	</div>
          </div>
      </div>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-folder"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Document</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM documents  where user_id = {$_SESSION['login_id']}")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-share-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Assigned Document</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM shared_files where created_by = {$_SESSION['login_id']} AND is_deleted=0")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div> 
        <!-- <div class="row"> -->
          
          <!-- /.col -->
        <!-- </div>       -->
        
        <?php elseif ($_SESSION['login_type']==3): ?>
	    <div class="col-12">
          <div class="card">
          	<div class="card-body">
            Welcome <?php echo $_SESSION['login_name'] ?>! You are log in as <?php echo $type[$_SESSION['login_type']] ?>
          	</div>
          </div>
      </div>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-share-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Assigned Document</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM shared_files where recipient = {$_SESSION['login_id']} AND is_deleted=0")->num_rows; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>      
<?php endif; ?>
