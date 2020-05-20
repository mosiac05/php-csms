<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Customers
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Customers</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Customers</h3>
                <!-- <button type="button" name="insert" id="insert" data-toggle="modal" data-target="#insert_Modal" class="btn btn-lg btn-warning pull-right">Create New Account</button> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body customers">
              <table id="example1" class="table table-responsive table-bordered table-striped">
                <thead>
                <tr>
                  <th class="hidden-sm hidden-xs">Name</th>
                  <th>Meter No.</th>
                  <th class="hidden-sm hidden-xs">Email Address</th>
                  <th class="hidden-sm hidden-xs">Phone Number</th>
                  <th>View</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                      $customer_query = mysqli_query($con, "SELECT customer_id, customer_name,customer_email,customer_phone_num,customer_meter_num FROM customers");

                      while($row = mysqli_fetch_array($customer_query)){
                          $customer_id = $row['customer_id'];
                          $customer_name = $row['customer_name'];
                          $customer_email = $row['customer_email'];
                          $customer_phone_num = $row['customer_phone_num'];
                          $customer_meter_num = $row['customer_meter_num'];
                    ?>
                <tr>
                  <td class="hidden-sm hidden-xs"><?=$customer_name; ?></td>
                  <td><?=$customer_meter_num; ?></td>
                  <td class="hidden-sm hidden-xs">
                    <?=$customer_email; ?>
                  </td>
                  <td class="hidden-sm hidden-xs">
                    <?=$customer_phone_num; ?>
                    </td>
                  <td>
                    <button id="<?=$customer_id; ?>" class="btn btn-sm btn-primary view_data"><i class="fa fa-eye"></i></button>
                  </td>
                  <td>
                    <button id="<?=$customer_id; ?>" class="btn btn-sm btn-warning edit_data"><i class="fa fa-edit"></i></button>
                  </td>
                  <td>
                    <button id="<?=$customer_id; ?>" class="btn btn-sm btn-danger delete_data"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
              <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th class="hidden-sm hidden-xs">Name</th>
                  <th>Meter No.</th>
                  <th class="hidden-sm hidden-xs">Email Address</th>
                  <th class="hidden-sm hidden-xs">Phone Number</th>
                  <th>View</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </tfoot>
              </table>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<div id="view_customer" class="modal modal-default fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-purple">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Customer Details</h4>
        </div>
        <div class="modal-body" id="customer_detail">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div id="delete_customer" class="modal modal-default fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-purple">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete Customer Account?</h4>
        </div>
        <div class="modal-body" id="customer_delete">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  <div id="edit_Modal" class="modal modal-default fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-purple">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Customer Account</h4>
        </div>
        <div class="modal-body" id="customer_edit">
          <form class="form" id="edit_form" action="" method="POST" enctype="multipart/form-data">
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
                    <label for="area">Area</label>                
                    <select name="area" id="area" class="form-control" required="">
                      <option disabled="">Select customer area:</option>
                      <?php 
                        $area_query = mysqli_query($con, "SELECT area_id, area_name FROM areas");
                        while($row = mysqli_fetch_array($area_query)){
                          $area_id = $row['area_id'];
                          $area_name = $row['area_name'];
                       ?>
                      <option selected="" value="<?=$area_id; ?>"><?=$area_name; ?></option>
                    <?php } ?>
                    </select>
                  </div>

                   <div class="form-group">
                    <label for="address">Residential Address:</label>             
                    <input type="text" name="address" id="address" placeholder="Enter home address here..." class="form-control" required="">
                  </div>

                  
                  <input type="hidden" name="customer_id" id="customer_id" />
                  <hr>
                  <div class="form-group">                
                    <input type="submit" name="cet" id="customer_edit" value="Edit Account" class="btn btn-primary col-md-offset-5">
                  </div>
                </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <script>
    $(document).on('click', '.edit_data', function(){
      var customer_id = $(this).attr("id");

      $.ajax({
        url:'custom_docs/fetch.php',
        method:'post',
        data:{customer_id:customer_id},
        dataType:"json",
        success:function(data){
          $('#name').val(data.customer_name);
          $('#email').val(data.customer_email);
          $('#meter_num').val(data.customer_meter_num);
          $('#phone_num').val(data.customer_phone_num);
          $('#state').val(data.customer_state);
          $('#city').val(data.customer_city);
          $('#address').val(data.customer_address);
          $('#area').val(data.customer_area);
          $('#customer_id').val(data.customer_id);
          $('#customer_edit').val("Edit Account");
          $('#edit_Modal').modal('show');
        }
      });
    });

    function get_page(page_name){
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

    $('#edit_form').submit(function(e){
      e.preventDefault();
      
      $.ajax({
        url: 'custom_docs/edit_customer.php',
        type: 'POST',
        data: $('#edit_form').serialize(),
        success: function(data)
        {
          Swal.fire('Updated Successfully!','','success');
          $('#edit_form')[0].reset();
          $('.modal-backdrop').remove();
          window.open('index.php?view_customers', '_self')
        }
      });
    });


    $('.view_data').click(function(){
      var customer_id = $(this).attr("id");

      $.ajax({
        url:"custom_docs/select_customer.php",
        method:"post",
        data:{customer_id:customer_id},
        success:function(data){
         $('#customer_detail').html(data);
         $('#view_customer').modal("show");

        }
      });
      
    });

    $('.delete_data').click(function(){
      var customer_id = $(this).attr("id");

      $.ajax({
        url:"custom_docs/delete_customer.php",
        method:"post",
        data:{customer_id:customer_id},
        success:function(data){
          Swal.fire('Deleted!','','success');
          window.open('index.php?view_customers', '_self')
        }
      });      
    });
</script>