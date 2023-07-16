<?php
?>
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
                data-dismiss="modal">Close</button></center>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
<style>
	#uni_modal .modal-footer {
		display: none
	}

	#uni_modal .modal-footer.display {
		display: flex
	}
</style>