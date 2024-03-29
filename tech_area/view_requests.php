
  <!-- =============================================== -->
<?php 
	if (isset($_GET['view_requests'])){
		$request_status = $_GET['view_requests'];
	}

	if($request_status == 'NEW'){
		$status_display = 'New';
	}
	if($request_status == 'OPEN'){
		$status_display = 'Assigned';
	}
	elseif($request_status == 'PENDING'){
		$status_display = 'Pending';
	}
	elseif($request_status == 'RESOLVED'){
		$status_display = 'Resolved';
	}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View <?=$status_display; ?> Requests
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View <?=$status_display; ?> Requests</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">View <?=$status_display; ?> Requests</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="20%">ID</th>
                  <th width="60%">SUBJECT</th>
                  <th width="200%">ACTIONS</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                      $request_query = mysqli_query($con, "SELECT * FROM requests WHERE request_status = '$request_status' AND workteam_id = '$workteam_id'");

                      while($row = mysqli_fetch_array($request_query)){
                          $request_id = $row['request_id'];
                          $request_code = $row['request_code'];
                          $request_subject = $row['request_subject'];
                          $request_address = $row['request_address'];
                          $request_time = $row['request_time'];
                          $request_date = $row['request_date'];
                          $customer_id = $row['customer_id'];

                          $request_date = date('l jS F\, Y', strtotime($request_date));
                          $request_time = date('g:iA', strtotime($request_time));

                          // $customer_query = mysqli_query($con, "SELECT * FROM customers WHERE customer_id = '$customer_id'");
                          //   $row = mysqli_fetch_assoc($customer_query);
                          //   $customer_name = $row['customer_name'];

                    ?>
                <tr>
                  <td><strong><?=$request_code; ?></strong></td>
                  <td><?=$request_subject . "<br /><span class='small'>" . $request_date . " " . $request_time . "</span>"; ?></td>
                  <td><a href="index.php?request_id=<?=$request_id; ?>" class="btn bg-purple">View</a></td>
                </tr>
              <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>SUBJECT</th>
                  <!-- <th>MESSAGE</th> -->
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