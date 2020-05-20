<?php
    $request_id = $_GET['request_id'];

      $request_q = mysqli_query($con, "SELECT * FROM requests WHERE request_id = '".$_GET['request_id']."'");
      $request = mysqli_fetch_assoc($request_q);
      $req_count = mysqli_num_rows($request_q);


      if($req_count < 1)
      {
        echo "<script>
                alert('Request has been deleted!');
                window.open('index.php?view_requests=OPEN', '_self');
              </script>";
      }
      elseif($request['request_status'] == "DELETED" && $role_id != 1)
      {
        echo "<script>
                window.open('index.php?view_requests=OPEN', '_self');
                alert('Request has been deleted!');
              </script>";
      }
      else
      {
      $comment_update = mysqli_query($con, "UPDATE comments SET comment_status = 'Y' WHERE request_id = '".$_GET['request_id']."'");

        $request_query = mysqli_query($con, "SELECT * FROM requests WHERE request_id = '$request_id'");

              $row = mysqli_fetch_assoc($request_query);
                  $request_id = $row['request_id'];
                  $request_code = $row['request_code'];
                  $request_subject = $row['request_subject'];
                  $request_message = $row['request_message'];
                  $request_address = $row['request_address'];
                  $request_time = $row['request_time'];
                  $request_date = $row['request_date'];
                  $request_attachment = $row['request_attachment'];
                  $request_status = $row['request_status'];
                  $customer_id = $row['customer_id'];
                  $workteam_id = $row['workteam_id'];
                  $request_assignee = $row['request_assignee'];
                  $request_cat_id = $row['request_cat_id'];

                  $request_date = date('l jS F\, Y', strtotime($request_date));
                  $request_time = date('g:iA', strtotime($request_time));


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
        <?=$status_display; ?> Request
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?=$status_display; ?> Request</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">View <?=$status_display; ?> Request</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"> Collapse</i></button>
          </div>
        </div>

          <div class="row">
              <div class="col-md-offset-2 col-md-8">
                <table class="table table-bordered table-striped">
          <?php


        echo "<tr><th>ID</th><td><strong>{$request_code}</strong></td></tr>";
        echo "<tr><th>SUBJECT</th><td>{$request_subject}</td></tr>";
        echo "<tr><th>DATE</th><td>{$request_date}</td></tr>";
        echo "<tr><th>TIME</th><td>{$request_time}</td></tr>";
        echo "<tr><th>REQUEST</th><td>{$request_message}</td></tr>";
        if($request_attachment != ''){
        echo "<tr><th>ATTACHMENT</th><td><a href='../attachments/{$request_attachment}' class='btn btn-warning' target='_blank'>{$request_attachment}</a></td></tr>";
        } else{
        echo "<tr><th>ATTACHMENT</th><td><em>No attachments</em></td></tr>";
        }
        if($request_assignee != NULL)
        {
          $staff_q = mysqli_query($con, "SELECT staff_name FROM staffs WHERE staff_code = '$request_assignee'");

          $staff = mysqli_fetch_assoc($staff_q);
          echo "<tr><th>ASSIGNER:</th><td>{$staff['staff_name']}</td></tr>";
        }
        if($workteam_id != NULL)
        {
          $workteam_q = mysqli_query($con, "SELECT workteam_id, workteam_title FROM workteams WHERE workteam_id = '$workteam_id'");

          $workteam = mysqli_fetch_assoc($workteam_q);
          echo "<tr><th>WORKTEAM:</th><td>{$workteam['workteam_title']}</td></tr>";
        }
        ?>
        
                  
                </table>
                  <!-- <?php 
                    if(($workteam_id == NULL) && ($request_status == 'NEW')){
                   ?>
                  <div class="box-tools">
                      <button type="button" class="btn btn-flat btn-primary" title="Edit" data-toggle="modal" data-target="#modal-edit">
                        <i class="fa fa-edit"> <b>Edit</b></i>
                      </button>
                      <button type="button" class="btn btn-flat btn-danger pull-right" title="Delete" data-toggle="modal" data-target="#modal-delete">
                          <i class="fa fa-trash"> <b>Delete</b></i>
                        </button>
                  </div>
                <?php 
                    }
                    else{
                ?>
                  <div class="box-tools text-center">
                    <?php 
                      if($request_status != 'PENDING'){
                    ?>
                    <form class="form" action="#" method="POST" enctype="multipart/form-data">
                    <input type="submit" name="pending_submit" class="btn btn-warning pull-left" value="Set As Pending">
                    </form>
                  <?php } ?>
                    <form class="form" action="#" method="POST" enctype="multipart/form-data">
                      <input type="submit" name="resolve_submit" class="btn btn-success pull-right" value="Confirm Resolved">
                    </form>
                  </div>
                <?php } ?> -->
              </div>            
          </div>
          <br>
          <?php 
            if($request_status != 'NEW'){
          ?>
          <div class="row">
            <div class="col-md-12">
              <!-- DIRECT CHAT -->
              <div class="box box-black direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Direct Chat</h3>
                  <div class="box-tools text-center">
                    <form action="#" method="POST" enctype="multipart/form-data">
                      
                    <input type="button" name="rt" class="btn bg-purple-light pull-right view_customer" id="<?=$customer_id; ?>" value="Customer Details">
                    </form>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages comments-area">
                    <!-- Message. Default to the left -->
                    
                  </div><!--/.direct-chat-messages-->
                </div>
                <!-- /.box-body -->
                <?php 
                if($request_status != 'RESOLVED')
                {
                 ?>
                <div class="box-footer">
                  <form action="#" id="comment_form" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                      <input type="hidden" name="request_id" id="request_id" value="<?=$request_id; ?>">
                      <input type="text" name="comment" id="comment" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-btn">
                            <input type="button" name="ct" id="comment_submit" value="Send" class="btn btn-warning btn-flat">
                          </span>
                    </div>
                  </form>                 
                </div>
              <?php } ?>
                <!-- /.box-footer-->
              </div>
              <!--/.direct-chat -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        <?php } } ?>
      </div>
      <!-- End of box -->
    </section>
  </div>


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


<script type="text/javascript">
  $(document).ready(function(){

    $('#comment_submit').click(function(){
      var comment_text = $('#comment').val();
      var request_id = $('#request_id').val();
      if($.trim(comment_text) != '')
      {
        $.ajax({
          url:'tech_custom_docs/insert_tech_comments.php',
          method:'POST',
          data:{comment:comment_text,request_id:request_id},
          dataType:"text",
          success:function(data)
          {
            $('#comment').val('');
          }
        });
      }
    });

  setInterval(function(){
    $('.comments-area').load('tech_custom_docs/fetch_tech_comments.php?request_id='+<?php echo $request_id; ?>).fadeIn('slow');
  }, 1000);

  $('.view_customer').click(function(){
    var customer_id = $(this).attr("id");

    $.ajax({
      url:"../admin_area/custom_docs/select_customer.php",
      method:"post",
      data:{customer_id:customer_id},
      success:function(data){
       $('#customer_detail').html(data);
       $('#view_customer').modal("show");

        }
      });
    });

});
</script>