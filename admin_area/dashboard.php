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

    <?php
    $new_requests_q = mysqli_query($con, "SELECT * FROM requests WHERE request_status = 'NEW'");
    $new_count = mysqli_num_rows($new_requests_q);

    $open_requests_q = mysqli_query($con, "SELECT * FROM requests WHERE request_status = 'OPEN'");
    $open_count = mysqli_num_rows($open_requests_q);

    $pending_requests_q = mysqli_query($con, "SELECT * FROM requests WHERE request_status = 'PENDING'");
    $pending_count = mysqli_num_rows($pending_requests_q);

    $resolved_requests_q = mysqli_query($con, "SELECT * FROM requests WHERE request_status = 'RESOLVED'");
    $resolved_count = mysqli_num_rows($resolved_requests_q);

    $total_requests = $new_count + $open_count + $pending_count + $resolved_count;
if($total_requests != 0){
    $open = ($open_count/$total_requests)*100;
    $pending = ($pending_count/$total_requests)*100;
    $new = ($new_count/$total_requests)*100;
    $resolved = ($resolved_count/$total_requests)*100;

      $dataPoints = array( 
        array("label"=>"New", "y"=>$new),
        array("label"=>"Pending", "y"=>$pending),
        array("label"=>"Open", "y"=>$open),
        array("label"=>"Resolved", "y"=>$resolved)
      );
/**********************************************************************************************/       

    $workPoints = array();

    $workteam_q = mysqli_query($con, "SELECT * FROM workteams");
      while($row = mysqli_fetch_array($workteam_q)){
            $workteam_id = $row['workteam_id'];
            $workteam_title = $row['workteam_title'];

            $requests_q = mysqli_query($con, "SELECT * FROM requests WHERE workteam_id = '$workteam_id'");
            $req_count = mysqli_num_rows($requests_q);

    $workPoints[] = array('y' => $req_count , "label" => $workteam_title );
  }
    ?>

    <script>
      window.onload = function() {
       
       
      var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
          text: "Requests Percentage by Status"
        },
        subtitles: [{
          text: " "
        }],
        data: [{
          type: "pie",
          showInLegend: "true",
          legendText: "{label}",
          indexLabelFontSize: 15,
          yValueFormatString: "#,##0.00\"%\"",
          indexLabel: "{label} ({y})",
          dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart.render();


      var workChart = new CanvasJS.Chart("workChartContainer", {
          animationEnabled: true,
          title:{
            text: "Workteams Requests Handled"
          },
          axisY: {
            title: "No. of Resolved Requests",
            prefix: "",
            suffix:  ""
          },
          data: [{
            type: "bar",
            yValueFormatString: "#,##0",
            indexLabel: "{y}",
            indexLabelPlacement: "inside",
            indexLabelFontWeight: "bolder",
            indexLabelFontColor: "white",
            dataPoints: <?php echo json_encode($workPoints, JSON_NUMERIC_CHECK); ?>
          }]
        });
        workChart.render();
         
      }
    </script>
<?php } ?>
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="index.php?view_requests=NEW"><span class="info-box-icon bg-purple"><i class="fa fa-plus"></i></span></a>
            <?php 
                  $query = "SELECT * FROM requests WHERE request_status='NEW'";
                  $select_depts = mysqli_query($con, $query)
                  ;

                  $post_counts = mysqli_num_rows ($select_depts);
              ?>
            <div class="info-box-content">
              <span class="info-box-text">New Requests</span>
              <span class="info-box-number"><?=$post_counts; ?></span>
            <a href="index.php?view_requests=NEW" class="small-box-footer btn-flat bg-purple pull-right">&nbsp;<i class="fa fa-arrow-circle-right"></i>&nbsp;</a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="index.php?view_requests=OPEN"><span class="info-box-icon bg-purple"><i class="fa fa-spinner"></i></span></a>
              <?php 
                  if($role_id == 1)
                  {
                  $query = "SELECT * FROM requests WHERE request_status='OPEN'";
                  }
                  else
                  {
                  $query = "SELECT * FROM requests WHERE request_status='OPEN' AND request_assignee = '$staff_code'";
                  }
                  $select_depts = mysqli_query($con, $query)
                  ;

                  $post_counts = mysqli_num_rows ($select_depts);
              ?>
            <div class="info-box-content">
              <span class="info-box-text">Open Requests</span>
              <span class="info-box-number"><?=$post_counts; ?></span>
            </div>
            <a href="index.php?view_requests=OPEN" class="small-box-footer btn-flat bg-purple pull-right">&nbsp;<i class="fa fa-arrow-circle-right"></i>&nbsp;</a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="index.php?view_requests=PENDING"><span class="info-box-icon bg-purple"><i class="fa fa-indent"></i></span></a>
            <?php 
                  if($role_id == 1)
                  {
                  $query = "SELECT * FROM requests WHERE request_status='PENDING'";
                  }
                  else
                  {
                  $query = "SELECT * FROM requests WHERE request_status='PENDING' AND request_assignee = '$staff_code'";
                  }
                  $select_depts = mysqli_query($con, $query)
                  ;

                  $post_counts = mysqli_num_rows ($select_depts);
              ?>
            <div class="info-box-content">
              <span class="info-box-text">Pending Requests</span>
              <span class="info-box-number"><?=$post_counts; ?></span>
            </div>
            <a href="index.php?view_requests=PENDING" class="small-box-footer btn-flat bg-purple pull-right">&nbsp;<i class="fa fa-arrow-circle-right"></i>&nbsp;</a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <a href="index.php?view_requests=RESOLVED"><span class="info-box-icon bg-purple"><i class="fa fa-check-square-o"></i></span></a>
            <?php 
                  if($role_id == 1)
                  {
                  $query = "SELECT * FROM requests WHERE request_status='RESOLVED'";
                  }
                  else
                  {
                  $query = "SELECT * FROM requests WHERE request_status='RESOLVED' AND request_assignee = '$staff_code'";
                  }
                  $select_depts = mysqli_query($con, $query)
                  ;

                  $post_counts = mysqli_num_rows ($select_depts);
              ?>
            <div class="info-box-content">
              <span class="info-box-text">Resolved Requests</span>
              <span class="info-box-number"><?=$post_counts; ?></span>
            </div>
            <a href="index.php?view_requests=RESOLVED" class="small-box-footer btn-flat bg-purple pull-right">&nbsp;<i class="fa fa-arrow-circle-right"></i>&nbsp;</a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Requests Report</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                </div>
                <br class="hidden-md hidden-lg">
                <br class="hidden-md hidden-lg">
                <!-- /.col -->
                <div class="col-md-6">
                  <div id="workChartContainer" style="height: 370px; width: 100%;"></div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


      <!-- =========================================================== -->
      <!-- /.row -->
      <!-- Main row -->
      <?php 
       #$total_comment from nav.php page
        if($total_comment != 0)
        {
       ?>
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
                              $comment_query = "SELECT * FROM comments ORDER BY comment_id DESC LIMIT 5";
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
                        <td><a href="index.php?request_id=<?=$request_id; ?>" class="btn-xs bg-purple" id="<?=$request_id; ?>">View</a></td>
                      </tr>
                      <tr>
                      </tr>
                    </tbody>
                   <!-- /.item -->
                  <!-- /.chat -->
      <?php } ?>
                </table>
                <!-- <script type="text/javascript">
                  $(document).ready(function(){

                   $('.single-request').click(function(e){
                      e.preventDefault();
                      var id = $(this).attr("id");
                      $.ajax({
                        type: "GET",
                        url: 'custom_docs/page_load.php',
                        data: "request_id=" + id, // appears as $_GET['id'] @ your backend side
                        success: function(data)
                        {
                          $('.content-wrapper').html(data);
                          history.pushState(null, null, '?request_id='+id);
                        }
                      });
                    });
                  });
                </script> -->
              </div>
                <!-- /.col -->
            </div>
              <!-- /.row -->
          </div>
            <!-- ./box-body -->
        </div>
          <!-- /.box (chat box) -->        
      </aside>
    </div>
  <?php } ?>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->

<script src="inc/canvasjs.min.js"></script>