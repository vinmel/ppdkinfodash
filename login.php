<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./db_connect.php');

$sql = "SELECT * FROM staff_info";
$result = $conn->query($sql);

$data = $result->fetch_assoc();
print_r($data)

  ?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Main | Kuching District Education Office Information Dashboard</title>

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!---  Chart column -->
  <link rel="stylesheet" href="assets/css/chart-card.css" />

  <?php include('./header.php'); ?>
  <?php
  if (isset($_SESSION['login_id']))
    header("location:index.php?page=home");
  ?>
</head>
<style>
  body {
    width: 100%;
    height: calc(100%);
    position: absolute;
    top: 0;
    left: 0
      /*background: #007bff;*/
  }

  main#main {
    width: 100%;
    height: calc(100%);
    display: flex;
  }

  .custom-background {
    background: linear-gradient(to right, #64B5F6, #CE93D8, #EF9A9A);
  }

  .bg-modal {
    display: none;
  }
</style>

<body class="custom-background">
  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
        </ol>
        <h4 class="font-weight-bolder mb-0">Kuching District Education Office Information Dashboard</h4>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <a class="nav-link text-body font-weight-bold px-0">
            <i class="fa fa-user me-sm-1"></i>
            <!-- <button class="open-button" onclick="openForm()">Login</button> -->
            <button class="btn bg-light border" type="button" data-toggle="modal" data-target="#myForm"><i class="fa fa-user me-sm-1"></i>Login</button>
          </a>
        </div>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4"> <!--Bahagian Card pertama-->
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div
              class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">domain</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Jumlah Sekolah</p>
              <h4 class="mb-0">
                <?php echo $conn->query("SELECT * FROM users where type IN (1,2,3)")->num_rows; ?>
              </h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0">Last Updated <span class="text-success text-sm font-weight-bolder">
                <?php echo $conn->query("SELECT * FROM users WHERE date_created")->num_rows; ?>
              </span></p>
          </div>
        </div>
      </div> <!--Bahagian Card kedua-->
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4"> <!--Bahagian Card ke3-->
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div
              class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">face</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Jumlah Murid</p>
              <h4 class="mb-0">2,300</h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0">Last Updated <span class="text-success text-sm font-weight-bolder">+55%</p>
          </div>
        </div>
      </div> <!--Bahagian Card ke3-->
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div
              class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">person</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Jumlah Guru</p>
              <h4 class="mb-0">3,462</h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0">Last Updated <span class="text-success text-sm font-weight-bolder">+55%</p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6"> <!--Bahagian Card ke4-->
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div
              class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">group</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Total of PPD Kuching Staff</p>
              <h4 class="mb-0">
                <?php
                $result = $conn->query("SELECT ID,SUM(edu+adm+it+eng) as total FROM staff_info");
                // id(0), total(1)
                echo $result->fetch_column(1);
                ?>
              </h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0">Last Updated <span class="text-success text-sm font-weight-bolder">
                <?= $data['date_updated'] ?>
            </p>
          </div>
        </div>
      </div> <!--Bahagian Card ke4-->
    </div> <!--Bahagian Card ke 1-4-->

    <div class="row mt-4">
      <div class="col-lg-6">
        <div class="card mb-4" width="10%">
          <div class="card-header">
            <i class="fas fa-chart-pie me-1"></i>
            Percentage of Kuching District Education Office Staff By Grade
          </div>
          <div class="card-body"><canvas id="myPieChart" width="80%" height="30"></canvas></div>
          <div class="card-footer small text-muted">Updated since
            <?= $data['date_updated'] ?>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card mb-4">
          <div class="card-header">
            <i class="fas fa-chart-pie me-1"></i>
            Pie Chart Example
          </div>
          <div class="card-body"><canvas id="myPieChart2" width="80%" height="30"></canvas></div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
      </div>
    </div>

    <div class="row mb-4">
      <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © Kuching District Education Office
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  </div>
  </main>

  <div class="bg-modal" id="myForm">
    <div class="align-self-center w-100">
      <div id="login-center" class="bg-dark-5 row justify-content-center">
        <div class="card col-md-3">
          <div class="card-body">
            <h5 class="text-dark-blue text-center "><b>Kuching District Education Office Information Management
                Dashboard</b></h5>
            <form id="login-form">
              <div class="form-group">
                <label for="email" class="control-label text-dark">Email</label>
                <input type="text" id="email" name="email" class="form-control form-control-sm">
              </div>
              <div class="form-group">
                <label for="password" class="control-label text-dark">Password</label>
                <input type="password" id="password" name="password" class="form-control form-control-sm">
              </div>
              <center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
              <div>
                <center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary"
                    onclick="closeForm()">Close</button></center>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a> -->


  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--   Chart area   -->

  <script src="assets/js/material-dashboard.min.js?v=3.1.0"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>



</body>


<script>
  function openForm() {
    document.getElementById("myForm").style.display = "block";
  }

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }
  $('#login').click(function(){
		uni_modal("modal_login.php")
	})

  $('#login-form').submit(function (e) {
    e.preventDefault()
    $('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
    if ($(this).find('.alert-danger').length > 1)
      $(this).find('.alert-danger').remove();
    $.ajax({
      url: 'ajax.php?action=login',
      method: 'POST',
      data: $(this).serialize(),
      error: err => {
        console.log(err)
        $('#login-form button[type="button"]').removeAttr('disabled').html('Login');

      },
      success: function (resp) {
        if (resp == 1) {
          location.href = 'index.php?page=home';
        } else {
          $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
          $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
        }
      }
    })
  })
  $('.number').on('input', function () {
    var val = $(this).val()
    val = val.replace(/[^0-9 \,]/, '');
    $(this).val(val)
  })
  // JS Pie chart 
  var ctx = document.getElementById("myPieChart");
  //$data = [x,y,z] = 1(0),edu(1),adm(2),it(3),eng(4),timestamp(5) 
  //implode = 'x,y,z'
  //js.split = js[x,y,z]
  //js.splice = x,y,z

  const dataMap = '<?php echo implode(",", $data) ?>'.split(',');
  console.log(dataMap);
  var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ["DG", "N", "F", "J"],
      datasets: [{
        data: dataMap.splice(1, 4),
        backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
      }],
    },
  });

  var ctx = document.getElementById("myPieChart2");
  var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ["Blue", "Red", "Yellow", "Green"],
      datasets: [{
        data: dataMap.splice(1, 4),
        backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
      }],
    },
  });

  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>

</html>