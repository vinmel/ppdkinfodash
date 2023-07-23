<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./db_connect.php');
$sql = "SELECT * FROM staff_info";
// $sql2 = "SELECT * FROM users;";
$result = $conn->query($sql);
// $resultUsers = $conn -> query($sql2)
$data = $result->fetch_assoc();
// print_r($data)

$sql2 = "SELECT MAX(date_updated) AS latest_date FROM schools_info;";
$resultUsers = $conn->query($sql2);
$data2 = $resultUsers->fetch_assoc();
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

  .btn-close {
    position: absolute;
    right: 0;
    padding: 1em;
    color: #fff;
    opacity: 1;
  }


  .modal-content {
    width: 80%;
    margin: 0 auto;
  }

  .modal-body {
    padding: 0;
  }

  .myform {
    padding: 2em;
    max-width: 100%;
    color: #fff;
    box-shadow: 0 4px 6px 0 rgba(22, 22, 26, 0.18);
  }

  /* .tr {
   line-height: 10px;
   min-height: 10px;
   height: 10px;
} */
  .message-container {
    background-color: #f2f2f2;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .message {
    font-size: 16px;
    line-height: 1.6;
    color: #333;
    margin: 0;
  }

  .phone-number {
    color: #008080;
    font-weight: bold;
  }
  .password-container {
  position: relative;
}

.toggle-password {
  position: absolute;
  top: 75%;
  right: 10px;
  transform: translateY(-50%);
  cursor: pointer;
  z-index: 1;
}

/* Adjust the icon size as needed */
#eye-icon {
  font-size: 10px;
}

</style>

<body class="custom-background">
  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="font-weight-bolder breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
        </ol>
        <h4 class="font-weight-bolder mb-0">Kuching District Education Office Information Dashboard</h4>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <a class="nav-link text-body font-weight-bold px-0">
            <!-- <i class="fa fa-user me-sm-1"></i> -->
            <!-- <button class="open-button" onclick="openForm()">Login</button> -->
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#myForm">
              <i class="fa fa-user me-sm-1"></i>Login</button>
          </a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Modal login-form -->

  <div class=" modal fade" id="myForm" tabindex="-1" aria-labelledby="ModalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="myform bg-white">
            <h5 class="text-dark-blue text-center "><b>Kuching District Education Office Information Management
                Dashboard Sign In</b></h5>
            <form id="login-form">
              <div class="mb-3 mt-4">
                <label for="email" class="control-label text-dark">Email</label>
                <input type="text" id="email" name="email" class="form-control form-control-sm">
              </div>
              <div class="password-container">
                <label for="password" class="control-label text-dark">Password</label>
                <input type="password" id="password" name="password" class="form-control form-control-sm">
                  <span class="toggle-password" onclick="togglePasswordVisibility()">
                    <i class="far fa-eye" id="eye-icon"></i>
                  </span>
              </div>
              <br>
              <center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
              <a href="#" class="nav-link text-body font-weight-bold px-0" data-bs-toggle="modal"
                data-bs-target="#myForm1">
                <center><span class="d-sm-inline d-none">Forgot password ?</span></center>
              </a>
            </form>
          </div>          
        </div>
      </div>
    </div>
  </div>
<!-- Forgot password modal-body -->
<div class="modal fade" id="myForm1" tabindex="-1" aria-labelledby="MyForm1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="MyForm1">Forgot Password</h5>
        </div>
        <div class="modal-body">
          <div class="message-container">
            <p class="message">Please contact the system administrator to reset your password online at <span
                class="phone-number">082-456789</span>. Thank you.</p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>     
     <!-- forgot password modal body end -->
  

  <!-- End Navbar -->
  <div class="container-fluid py-2">
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4"> <!--Bahagian Card pertama-->
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div
              class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
              <i class="material-icons opacity-10">domain</i>
            </div>
            <div class="text-end pt-1">
              <p class="text-sm mb-0 text-capitalize">Total Schools in the Area</p>
              <h4 class="mb-0">
                <?php
                $result = $conn->query("SELECT SUM(total) AS total_sum FROM schools_info WHERE id >= 1 AND id <= 12");
                $row = $result->fetch_assoc();
                echo $row['total_sum'];
                ?>
              </h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0">Last Updated: <span class="text-success text-sm font-weight-bolder">
                <?= $data2['latest_date'] ?>
            </p></span>
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
              <p class="text-sm mb-0 text-capitalize">Total Student's Enrollment</p>
              <h4 class="mb-0">
                <?php
                $result = $conn->query("SELECT tot_student FROM staff_info");
                $row = $result->fetch_assoc();
                echo $row['tot_student'];
                ?>
              </h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0">Last Updated: <span class="text-success text-sm font-weight-bolder">
                <?= $data['date_updated'] ?>
            </p></span>
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
              <p class="text-sm mb-0 text-capitalize">Total Teachers in the Area</p>
              <h4 class="mb-0">
                <?php
                $result = $conn->query("SELECT ID,SUM(tcsec_schl+tcpm_schl) as total FROM staff_info");
                // id(0), total(1)
                echo $result->fetch_column(1);
                ?>
              </h4>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0">Last Updated: <span class="text-success text-sm font-weight-bolder">
                <?= $data['date_updated'] ?>
            </p></span>
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
            <p class="mb-0">Last Updated: <span class="text-success text-sm font-weight-bolder">
                <?= $data['date_updated'] ?>
              </span>
            </p>
          </div>
        </div>
      </div> <!--Bahagian Card ke4-->
    </div> <!--Bahagian Card ke 1-4-->

    <!-- Piechart # -->
    <div class="row mt-4">
      <div class="col-lg-6">
        <div class="card mb-4" width="10%">
          <div class="card-header">
            <i class="fas fa-chart-pie me-1"></i>
            Total of Kuching District Education Office Staff By Grade
          </div>
          <div class="card-body"><canvas id="myPieChart" width="80%" height="30"></canvas></div>
          <div class="card-footer small text-muted">Updated since:
            <?= $data['date_updated'] ?>
          </div>
        </div>
      </div>
      <!-- Table list type of schools -->
      <div class="col-lg-6">
        <div class="card mb-4">
          <div class="card-header">
            <i class="fas fa-table"></i>
            List type of schools
          </div>
          <div class="card-body">
            <div class="row">
              <!-- <canvas id="myPieChart2" width="80%" height="30"></canvas>
              </div> -->
              <!-- table_order = 1 -->
              <div class="col-md-6 ">
                <table class="table tabe-hover table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th>Type of schools</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    $qry = $conn->query("SELECT * FROM schools_info WHERE id >= 1 AND id <= 6 AND table_no = 1");
                    // Loop through each row and display the data
                    while ($row = $qry->fetch_assoc()):
                      ?>
                      <tr>
                        <td class="text-center">
                          <?php echo $i++ ?>
                        </td>
                        <td class="text-center">
                          <?php echo $row['schools_type'] ?>
                        </td>
                        <td class="text-center">
                          <?php echo $row['total'] ?>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
              <!-- table order = 2 -->
              <div class="col-md-6">
                <table class="table tabe-hover table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th>Type of schools</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 7;
                    $qry = $conn->query("SELECT * FROM schools_info WHERE id >= 7 AND id <= 12 AND table_no = 2");
                    // Loop through each row and display the data
                    while ($row = $qry->fetch_assoc()):
                      ?>
                      <tr>
                        <td class="text-center">
                          <?php echo $i++ ?>
                        </td>
                        <td class="text-center">
                          <?php echo $row['schools_type'] ?>
                        </td>
                        <td class="text-center">
                          <?php echo $row['total'] ?>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <small class=" text-muted">Updated since:
              <?= $data2['latest_date'] ?>
            </small>
          </div>
        </div>
      </div>


      <footer class="">
        <!-- <div class="float-right d-none d-sm-inline-block"> -->
        <b class="float-right d-none d-sm-inline-block"><i class="float fa fa-copyright" aria-hidden="true"></i> Kuching
          District Education Office</b>

      </footer>
    </div>
  </div>

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


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




  <!-- Use this to put inside the form -->
  <div class="card-body">

  </div>

</body>

<script>
  // function openForm() {
  //   document.getElementById("myForm").style.display = "block";
  // }

  // function closeForm() {
  //   document.getElementById("myForm").style.display = "none";
  // }
  //incase my code dont work use these

  //below login script
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
        // window.alert(resp); 
        if (resp == 1) {
          location.href = 'index.php?page=home';
        } else if (resp == 4) {

          $('#login-form').prepend('<div class="alert alert-danger">User is not active.</div>')
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

  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }

  function togglePasswordVisibility() {
  var passwordInput = document.getElementById("password");
  var eyeIcon = document.getElementById("eye-icon");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    eyeIcon.classList.remove("fa-eye");
    eyeIcon.classList.add("fa-eye-slash");
  } else {
    passwordInput.type = "password";
    eyeIcon.classList.remove("fa-eye-slash");
    eyeIcon.classList.add("fa-eye");
  }
}

</script>

</html>