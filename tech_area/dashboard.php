
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->        
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
             
              <?php 
                  $query = "SELECT * FROM requests WHERE request_status='OPEN' AND workteam_id = '$workteam_id'";
                  $select_depts = mysqli_query($con, $query);

                  $post_counts = mysqli_num_rows ($select_depts);
              ?>

              <h3><?php echo $post_counts; ?></h3>
              <h4>Open Requests</h4>
              <br>
              <br>
            </div>
            <div class="icon">
              <i class="fa fa-spinner"></i>
            </div>
            <a href="index.php?view_requests=OPEN" class="small-box-footer">Click to View <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->        
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
             
              <?php 
                  $query = "SELECT * FROM requests WHERE request_status = 'PENDING' AND workteam_id = '$workteam_id'";
                  $select_depts = mysqli_query($con, $query)
                  ;

                  $post_counts = mysqli_num_rows ($select_depts);
              ?>

              <h3><?php echo $post_counts; ?></h3>
              <h4>Pending Requests</h4>
              <br>
              <br>
            </div>
            <div class="icon">
              <i class="fa fa-indent"></i>
            </div>
            <a href="index.php?view_requests=PENDING" class="small-box-footer">Click to View <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->        
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
             
              <?php 
                  $query = "SELECT * FROM requests WHERE request_status = 'RESOLVED' AND workteam_id = '$workteam_id'";
                  $select_depts = mysqli_query($con, $query)
                  ;

                  $post_counts = mysqli_num_rows ($select_depts);
              ?>

              <h3><?php echo $post_counts; ?></h3>
              <h4>Resolved Requests</h4>
              <br>
              <br>
            </div>
            <div class="icon">
              <i class="fa fa-check-square-o"></i>
            </div>
            <a href="index.php?view_requests=RESOLVED" class="small-box-footer">Click to View <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->


      <!-- =========================================================== -->
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <aside class="col-lg-12 col-sm-8 connectedSortable">
          <!-- Chat box -->
          <div class="box box-purple">
            <div class="box-header">
              <i class="fa fa-comments-o"></i>

                <h3 class="box-title">Request Comments</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-responsive">
                    <thead>
                      <th>S/N</th>
                      <th>Comment</th>
                      <th>Time</th>
                      <th>Date</th>
                      <th>View</th>
                    </thead>
                    <?php 
                    $i = 0;
                    $request_q = mysqli_query($con, "SELECT * FROM requests WHERE workteam_id = '$workteam_id'");
                      while($row = mysqli_fetch_assoc($request_q)){
                        $request_id = $row['request_id'];
                        $comment_query = "SELECT * FROM comments WHERE request_id = '$request_id' ORDER BY comment_id DESC LIMIT 10";
                            $comment_q = mysqli_query($con,$comment_query);

                            while ($row = mysqli_fetch_assoc($comment_q)) {
                                $comment_id = $row['comment_id'];
                                $comment_text = substr($row['comment_text'],0,50);
                                $comment_date = $row['comment_date'];
                                $comment_time = $row['comment_time'];
                                $comment_status = $row['comment_status'];
                                $request_id = $row['request_id'];
                                $customer_id = $row['customer_id'];
                                $staff_id = $row['staff_id'];
                            $i++;
                  ?>


                <!-- chat item -->
                <tbody>
                  <tr>
                    <td><?=$i; ?></td>
                    <td><?=$comment_text; ?>...</td>
                    <td><?=$comment_time; ?></td>
                    <td><?=$comment_date; ?></td>
                    <td><a href="index.php?request_id=<?=$request_id; ?>"><i class="fa fa-arrow-circle-right"></i></a></td>
                  </tr>
                  <tr>
                  </tr>
                </tbody>
               <!-- /.item -->
              <!-- /.chat -->
  <?php } }?>
            </table>
          </div>
          <!-- /.box (chat box) -->        
        </aside>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->