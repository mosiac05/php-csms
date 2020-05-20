  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Customer Account
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Create Customer Account</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">New Customer Account</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"> Collapse</i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
              <div class="col-md-offset-2 col-md-8">
                <form class="form" action="#" id="customer_insert" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="name">Full Name:</label>                
                    <input type="text" name="name" id="name" placeholder="Enter name here..." class="form-control" required="">
                  </div>

                  <div class="form-group">
                    <label for="email">Email Address:</label>                
                    <input type="email" name="email" id="email" placeholder="Enter email address here..." class="form-control" required="">
                  </div>

                  <div class="form-group">
                    <label for="meter_num">Meter Number:</label>                
                    <input type="text" name="meter_num" id="meter_num" placeholder="Enter meter number here..." class="form-control" required="">
                  </div>

                  <div class="form-group">
                    <label for="phone_num">Phone Number:</label>                
                    <input type="text" name="phone_num" id="phone_num" placeholder="Enter phone number here..." class="form-control" required="">
                  </div>

                  <div class="form-group">
                    <label for="state">State of Residence:</label>              
                    <input type="text" name="state" id="state" placeholder="Enter state here..." class="form-control" required="">
                  </div>

                  <div class="form-group">
                    <label for="city">City of Residence</label>                
                    <input type="text" name="city" id="city" placeholder="Enter city here..." class="form-control" required="">
                  </div>

                   <div class="form-group">
                    <label for="address">Residential Address:</label>             
                    <input type="text" name="address" id="address" placeholder="Enter home address here..." class="form-control" required="">
                  </div>

                  <div class="form-group">
                    <label for="area">Area</label>                
                    <select name="area" id="area" class="form-control" required="">
                      <option selected="" disabled="">Select customer area:</option>
                      <?php 
                        $area_query = mysqli_query($con, "SELECT area_id, area_name FROM areas");
                        while($row = mysqli_fetch_array($area_query)){
                          $area_id = $row['area_id'];
                          $area_name = $row['area_name'];
                       ?>
                      <option value="<?=$area_id; ?>"><?=$area_name; ?></option>
                    <?php } ?>
                    </select>
                  </div>

                  <hr>
                  <div class="form-group">                
                    <input type="submit" name="cst" id="customer_submit" value="Create Account" class="btn bg-purple col-md-offset-5">
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

        function insert_customer(){
          var page_name = 'insert_customer';

          $.ajax({
            url: 'custom_docs/page_load.php',
            method: 'get',
            data: {page_name:page_name},
            success:function(data)
            {
              $('.content-wrapper').html(data);
              history.pushState(null, null, '?'+page_name);
            }
          });
        }

        $('#customer_insert').submit(function(e){
          e.preventDefault();

          $.ajax({
            url: 'custom_docs/add_customer.php',
            type: 'POST',
            data: $('#customer_insert').serialize(),
            success: function(data)
            {
              Swal.fire('Submitted Successfully!','','success');
              $('#customer_insert')[0].reset();
          });
        });
      });
    </script>