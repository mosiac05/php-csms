  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Staff Account
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Create Staff Account</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">New Staff Account</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"> Collapse</i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
              <div class="col-md-offset-2 col-md-8">
                <form class="form" action="" id="staff_form" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="name">Full Name:</label>                
                    <input type="text" name="name" id="name" placeholder="Enter name here..." class="form-control" required="">
                  </div>

                  <div class="form-group">
                    <label for="code">Staff Code:</label>                
                    <input type="text" name="code" id="code" placeholder="Enter staff code here..." class="form-control" required="">
                  </div>

                  <div class="form-group">
                    <label for="email">Email Address:</label>                
                    <input type="email" name="email" id="email" placeholder="Enter email address here..." class="form-control" required="">
                  </div>

                  <div class="form-group">
                    <label for="phone_num">Phone Number:</label>                
                    <input type="text" name="phone_num" id="phone_num" placeholder="Enter phone number here..." class="form-control" required="">
                  </div>
                  <input type="hidden" name="staff_creator" id="staff_creator" value="<?=$staff_code; ?>">
                  <div class="form-group">
                    <label for="role">Role</label>                
                    <select name="role" id="role" class="form-control" required="">
                      <option selected="" disabled="">Select staff role:</option>
                      <?php 
                        $role_query = mysqli_query($con, "SELECT role_id, role_name FROM roles");
                        while($row = mysqli_fetch_array($role_query)){
                          $role_id = $row['role_id'];
                          $role_name = $row['role_name'];
                       ?>
                      <option value="<?=$role_id; ?>"><?=$role_name; ?></option>
                    <?php } ?>
                    </select>
                  </div>

                  <hr>
                  <div class="form-group">                
                    <input type="submit" name="stt" id="staff_submit" value="Create Account" class="btn bg-purple col-md-offset-5">
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
      <!-- End of box -->
    </section>
  </div>
<script type="text/javascript">
  $(document).ready(function(){

    $('#staff_form').submit(function(e){
      e.preventDefault();

      $.ajax({
        url: 'custom_docs/staffs.php',
        type: 'POST',
        data: $('#staff_form').serialize(),
        success: function()
        {
          Swal.fire('Submitted Successfully!','','success');
          $('#staff_form')[0].reset();
        }
      });
    });
  });
</script>