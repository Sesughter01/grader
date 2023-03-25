<?php include('db_connect.php') ?>
<!-- Info boxes -->
<?php if($_SESSION['login_user_type'] == 1): ?>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Students</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM students")->num_rows; ?>
                </span>
              </div>
            </div>
          </div>
           <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-th-list"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Results</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM modules")->num_rows; ?>
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Modules</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM modules")->num_rows; ?>
                </span>
              </div>
            </div>
          </div>
      </div>

<?php else: ?>
	 <div class="col-12">
          <div class="card">
          	<div class="card-body">
          		Welcome <?php echo $_SESSION['login_name'] ?>!
          	</div>
          </div>
      </div>
          
<?php endif; ?>
