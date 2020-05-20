<?php
include '../../inc/head.php';
  $new_requests_q = mysqli_query($con, "SELECT * FROM requests WHERE request_status = 'NEW'");
  $new_count = mysqli_num_rows($new_requests_q);

  $open_requests_q = mysqli_query($con, "SELECT * FROM requests WHERE request_status = 'OPEN'");
  $open_count = mysqli_num_rows($open_requests_q);

  $pending_requests_q = mysqli_query($con, "SELECT * FROM requests WHERE request_status = 'PENDING'");
  $pending_count = mysqli_num_rows($pending_requests_q);

  $total_requests = $new_count + $open_count + $pending_count;
  
  if($total_requests != 0){
  $open = ($open_count/$total_requests)*100;
  $pending = ($pending_count/$total_requests)*100;
  $new = ($new_count/$total_requests)*100;

    $dataPoints = array( 
      array("label"=>"New", "y"=>$new),
      array("label"=>"Pending", "y"=>$pending),
      array("label"=>"Open", "y"=>$open)
    );
/**********************************************************************************************/       

  $workPoints = array();

  $workteam_q = mysqli_query($con, "SELECT * FROM workteams");
    while($row = mysqli_fetch_array($workteam_q)){
          $workteam_id = $row['workteam_id'];
          $workteam_title = $row['workteam_title'];

          $requests_q = mysqli_query($con, "SELECT * FROM resolved_requests WHERE workteam_id = '$workteam_id'");
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

  <div class="row">
    <div class="col-md-6">
      <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    </div>
    <!-- /.col -->
    <div class="col-md-6">
      <div id="workChartContainer" style="height: 370px; width: 100%;"></div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

<?php 
  include 'shared_files/scripts.php';
?>