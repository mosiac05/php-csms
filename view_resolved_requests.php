    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Resolved Requests
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Resolved Requests</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Resolved Requests</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-responsive table-bordered table-striped">
                <thead>
                <tr>
                  <th width="20">ID</th>
                  <th width="60">SUBJECT</th>
                  <th width="20">ACTIONS</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                      $resolved_query = mysqli_query($con, "SELECT * FROM resolved_requests WHERE customer_id = '$customer_id'");

                      while($row = mysqli_fetch_array($resolved_query)){
                          $resolved_id = $row['resolved_id'];
                          $request_code = $row['request_code'];
                          $resolved_subject = $row['resolved_subject'];
                          $resolved_message = substr($row['resolved_message'],0,150);
                          $resolved_address = $row['resolved_address'];
                          $resolved_time = $row['resolved_time'];
                          $resolved_date = $row['resolved_date'];
                          $customer_id = $row['customer_id'];
                          
                          $resolved_date = date('l jS F\, Y', strtotime($resolved_date));
                          $resolved_time = date('g:iA', strtotime($resolved_time));

                          $customer_query = mysqli_query($con, "SELECT * FROM customers WHERE customer_id = '$customer_id'");
                            $row = mysqli_fetch_assoc($customer_query);
                            $customer_name = $row['customer_name'];

                    ?>
                <tr>
                  <td><strong><?=$request_code; ?></strong></td>
                  <td><?=$resolved_subject."<br><span class='small'>".$resolved_date." | ".$resolved_time."<span>"; ?></td>
                  <td><a href="index.php?view_single_resolved=<?=$resolved_id; ?>" class="btn btn-sm bg-purple">View</a>&nbsp;
                      <!-- <input type="hidden" name="delete_id" value="<?=$resolved_id; ?>">  -->
                      <button type="button" name="" id="<?=$resolved_id; ?>" class="btn btn-sm bg-red pull-right delete_resolved"><i class="fa fa-trash"></i></button> 
                  </td>
                </tr>
              <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>SUBJECT</th>
                  <th>ACTIONS</th>
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
<script type="text/javascript">
  $(document).ready(function(){
    $('.delete_resolved').click(function(e){
      e.preventDefault();

      var delete_resolved_id = $(this).attr("id");

      $.ajax({
        url: 'admin_area/custom_docs/move_delete.php',
        type: 'POST',
        data: {delete_resolved_id:delete_resolved_id},
        success: function()
        {
          Swal.fire('Deleted!', '', 'success');
          window.open('index.php?view_resolved_requests', '_SELF');
        }
      });
    });
  });
</script>