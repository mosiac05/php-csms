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
                  <th width="20">Subject</th>
                  <th width="60">Message</th>
                  <th width="10">Date</th>
                  <th width="10">View</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                      $resolved_query = mysqli_query($con, "SELECT * FROM resolved_requests WHERE workteam_id = '$workteam_id'");

                      while($row = mysqli_fetch_array($resolved_query)){
                          $resolved_id = $row['resolved_id'];
                          $resolved_subject = $row['resolved_subject'];
                          $resolved_message = substr($row['resolved_message'],0,150);
                          $resolved_address = $row['resolved_address'];
                          $resolved_time = $row['resolved_time'];
                          $resolved_date = $row['resolved_date'];
                          $customer_id = $row['customer_id'];


                          $customer_query = mysqli_query($con, "SELECT * FROM customers WHERE customer_id = '$customer_id'");
                            $row = mysqli_fetch_assoc($customer_query);
                            $customer_name = $row['customer_name'];

                    ?>
                <tr>
                  <td><?=$resolved_subject; ?></td>
                  <td><?=$resolved_message; ?>...</td>
                  <td><?=$resolved_date; ?></td>
                  <td><a href="index.php?view_single_resolved=<?=$resolved_id; ?>" class="btn btn-primary">View</a></td>
                </tr>
              <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Date</th>
                  <th>View</th>
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