<!--=============================================== -->   
<?php
    $request_id = $_GET['request_id'];

      $request_q = mysqli_query($con, "SELECT * FROM requests WHERE request_id = '".$_GET['request_id']."'");
      $request = mysqli_fetch_assoc($request_q);
      $req_count = mysqli_num_rows($request_q);


      if($req_count < 1)
      {
        echo "<script>
                alert('Request has been deleted!');
                window.open('index.php?view_requests=NEW', '_self');
              </script>";
      }
      elseif($request['request_status'] == "DELETED" && $role_id != 1)
      {
        echo "<script>
                window.open('index.php?view_requests=NEW', '_self');
                alert('Request has been deleted!');
              </script>";
      }
      elseif($request['request_assignee'] != NULL && $request['request_assignee'] != $staff_code && $role_id != 1)
      {
        echo "<script>
                alert('Request has been assigned already!');
                window.open('index.php?view_requests=NEW', '_self');
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
                    if($workteam_id == NULL AND $request_assignee == $staff_code)
                    {
                      $status_display = 'Accepted';
                    }
                    else
                    {
                      $status_display = 'Assigned';
                    }
                  }
                  elseif($request_status == 'PENDING'){
                    $status_display = 'Pending';
                  }
                  elseif($request_status == 'RESOLVED'){
                    $status_display = 'Resolved';
                  }
                  elseif($request_status == 'DELETED'){
                    $status_display = 'Deleted';
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
          <?php 
            if(($workteam_id == NULL) && ($request_status == 'NEW'))
            {
          ?>
            <form class="form" action="#" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="request_id" id="request_id" value="<?=$request_id; ?>"> 
              <input type="hidden" name="staff_code" id="staff_code" value="<?=$staff_code; ?>" />
              <input type="button" name="at" id="accept_submit" class="btn btn-md bg-purple" value="Click to Accept!">
            </form>
          <?php } ?>
          </div>
        </div>
        <br>
        <br>

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
          echo "<tr><th>ATTACHMENT</th><td><a href='../attachments/{$request_attachment}' target='_blank' class='btn btn-sm bg-purple'>Click to View</a></td></tr>";
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
        if($request_status == 'DELETED'){
          echo "<tr><th>DELETE</th><td><button type='button' id='{$request_id}' class='btn bg-red delete_request'><i class='fa fa-trash'></i> Delete</button></td></tr>";
        }
        ?>
                  
                </table>
              </div>                 
          </div>
          <?php 
            if(($workteam_id == NULL) && ($request_status == 'NEW')){
          ?>
          <div class="row">
              <div class="col-md-12">
                <br>
                <br>
                <div id="msg_area"></div>
                <form class="form alert bg-gray col-md-offset-3 col-md-6" id="workteam_form" action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                  <label for="workteam_id">Assign to Workteam:</label>               
                    <select id="the_workteam_id" class="form-control" required="">
                      <option selected="" disabled="">Select workteam:</option>
                      <?php 
                        $workteam_query = mysqli_query($con, "SELECT workteam_id, workteam_title FROM workteams");
                        while($row = mysqli_fetch_array($workteam_query)){
                          $workteam_id = $row['workteam_id'];
                          $workteam_title = $row['workteam_title'];

                          $request_q = mysqli_query($con, "SELECT * FROM requests WHERE workteam_id = '$workteam_id' AND (request_status = 'OPEN' OR request_status = 'PENDING')");

                          $count_requests = mysqli_num_rows($request_q);
                       ?>
                      <option value="<?=$workteam_id; ?>"><?=$workteam_title . ": " . $count_requests; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <input type="hidden" id="the_staff_code" value="<?=$staff_code; ?>" />
                  <input type="hidden" id="the_request_id" value="<?=$request_id; ?>" />
                  <div class="form-group">                
                    <input type="button" name="ast" id="assign_submit" value="Click to Assign" class="btn bg-purple col-md-offset-4">
                  </div>
                </form>
              </div>
          </div>
        <?php } ?>
          <br>
          <?php 
            if($request_status != 'NEW')
            {
              if($request_status != 'RESOLVED')
              {
          ?>
          <div class="box-tools text-center">
            <span class="request_id" id="<?=$request_id; ?>"></span>
              <button type="button" id="resolved_submit" class=" btn col-md-2 bg-purple pull-left">Confirm Resolved</button> <?php 
              if($request_status != 'PENDING'){
            ?>
              <input type="hidden" name="request_id" id="request_id" value="<?=$request_id; ?>"> 
              <input type="button" name="pst" id="pending_submit" class="btn col-md-2 bg-yellow pull-right" value="Set As Pending">
          <?php } else{ ?>
              <input type="hidden" name="request_id" id="request_id" value="<?=$request_id; ?>">
              <input type="button" name="ost" id="open_submit" class="btn col-md-2 bg-green pull-right" value="Open Request">
          <?php } ?> 
          </div>
        <?php } ?>
          <br>
          <br>
          <div class="row">
            <div class="col-md-12">
              <!-- DIRECT CHAT -->
              <div class="box box-black direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Direct Chat</h3>
              <div class="box-tools text-center">
                <button id="<?=$customer_id; ?>" class="btn bg-purple pull-right edit_customer"><i class="fa fa-edit"></i></button>
                
                <input type="button" name="rt" class="btn bg-gray pull-right view_customer" id="<?=$customer_id; ?>" value="Customer Details">
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
        <?php } ?>
      </div>
      <!-- End of box -->
    </section>
  <?php } ?>
  </div>

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
                        $area_id = $row["area_id"];
                        $area_name = $row["area_name"];
                     ?>
                    <option value="<?=$area_id; ?>"><?=$area_name; ?></option>
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
                  <input type="submit" name="cet" id="customer_edit" value="Edit Account" class="btn bg-purple col-md-offset-5 col-xs-offset-4">
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

    $('.edit_customer').click(function(e){
      e.preventDefault();
      var customer_id = $(this).attr("id");

      $.ajax({
        url:"custom_docs/fetch.php",
        method:"post",
        data:{customer_id:customer_id},
        dataType:"json",
        success:function(data){
          $("#name").val(data.customer_name);
          $("#email").val(data.customer_email);
          $("#meter_num").val(data.customer_meter_num);
          $("#phone_num").val(data.customer_phone_num);
          $("#state").val(data.customer_state);
          $("#city").val(data.customer_city);
          $("#address").val(data.customer_address);
          $("#area").val(data.customer_area);
          $("#customer_id").val(data.customer_id);
          $("#customer_edit").val("Edit Account");
          $("#edit_Modal").modal("show");
        }
      });
    });

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
          $("#edit_Modal").modal("hide");
          $('.modal-backdrop').remove();
        }
      });
    });

    $('#comment_submit').click(function(){
      var comment_text = $('#comment').val();
      var request_id = $('#request_id').val();
      if($.trim(comment_text) != '')
      {
        $.ajax({
          url:'custom_docs/insert_comment.php',
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

  // setInterval(function()
  // {
  //   var request_id = $('#request_id').val();

  //   $.ajax({
  //     url: 'custom_docs/fetch_comments.php',
  //     type: 'POST',
  //     data: {request_id:request_id},
  //     success: function(data)
  //     {
  //       var jsonData = JSON.parse(data)
  //       $('.comments-area').html(jsonData).fadeIn('fast');
  //     }
  //   });
  // }, 10000);

  setInterval(function(){
    $('.comments-area').load('custom_docs/fetch_staff_comments.php?request_id='+<?php echo $request_id; ?>).fadeIn('slow');
  }, 1000);

  $('.view_customer').click(function(){
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

  function open_single(response){
    $.ajax({
      type: "GET",
      url: 'custom_docs/page_load.php',
      data: "request_id=" + response, // appears as $_GET['id'] @ your backend side
      success: function(data)
      {
        $('.content-wrapper').html(data);
        history.pushState(null, null, '?request_id='+response);
      }
    });
  }

  $('#accept_submit').click(function(){
    var request_id = $('#request_id').val();
    var staff_code = $('#staff_code').val();
    var status = 'accept';

    $.ajax({
      url: 'custom_docs/status_submit.php',
      type: 'POST',
      data:
      {
        request_id:request_id,
        staff_code:staff_code,
        status:status
      },
      success:function(data)
      {
        var jsonData = JSON.parse(data);

        if(jsonData == '1')
        {
          alert('Request has been assigned!');
          window.open('index.php?view_requests=NEW', '_self');
        }
        else
        {
        Swal.fire('Opened Successfully!','','success' );
        window.open('index.php?request_id=<?=$request_id; ?>', '_self');
        }
      }
    });
  });


  $('#pending_submit').click(function(){
    var request_id = $('.request_id').attr('id');
    var status = 'pending';

    $.ajax({
      url: 'custom_docs/status_submit.php',
      type: 'POST',
      data:
      {
        request_id:request_id,
        status:status
      },
      success:function(data)
      {
          Swal.fire('Pending Successful!','','success' );
          window.open('index.php?request_id=<?=$request_id; ?>', '_self');
      }
    });
  });
  

  $('#open_submit').click(function(){
    var request_id = $('.request_id').attr('id');
    var status = 'open';

    $.ajax({
      url: 'custom_docs/status_submit.php',
      type: 'POST',
      data:
      {
        request_id:request_id,
        status:status
      },
      success:function(data)
      {
          Swal.fire('Opened Successfully!','','success' );
          window.open('index.php?request_id=<?=$request_id; ?>', '_self');
      }
    });
  });
  

  function resolved_single(response){
    $.ajax({
      type: "GET",
      url: 'custom_docs/page_load.php',
      data: "resolved_id=" + response, // appears as $_GET['id'] @ your backend side
      success: function(data)
      {
        $('.content-wrapper').html(data);
        history.pushState(null, null, '?resolved_id='+response);
      }
    });
  }

  $('#resolved_submit').click(function(){
    var request_id = $('.request_id').attr('id');
    var status = 'resolved';

    $.ajax({
      url: 'custom_docs/status_submit.php',
      type: 'POST',
      data:
      {
        request_id:request_id,
        status:status
      },
      success:function(data)
      {
          Swal.fire('Resolved Successfully!','','success' );
          window.open('index.php?request_id=<?=$request_id; ?>', '_self');
      }
    });
  });

  $('#assign_submit').click(function(e){
    e.preventDefault();

    var assign_workteam_id = $('#the_workteam_id').val();
    var assign_staff_code = $('#the_staff_code').val();
    var assign_request_id = $('#the_request_id').val();

    $.ajax({
      url: 'custom_docs/status_submit.php',
      type: 'POST',
      data:
      {
        assign_workteam_id:assign_workteam_id,
        assign_staff_code:assign_staff_code,
        assign_request_id:assign_request_id
      },
      success: function(data)
      {
        var jsonData = JSON.parse(data);

        if(jsonData == "1")
        {
          Swal.fire('Assigned Successfully!','','success');
          window.open('index.php?request_id=<?=$request_id; ?>', '_self');
        }
        else
        {
          $('#msg_area').html(jsonData);
        }
      }
    });
  });
  
  $('.delete_request').click(function(){
    var request_id = $(this).attr('id');
    var status = 'delete';

    $.ajax({
      url: 'custom_docs/delete_request.php',
      type: 'POST',
      data:
      {
        request_id:request_id,
        status:status
      },
      success:function(data)
      {
          Swal.fire('Deleted Successfully!','','success' );
          window.open('index.php?view_requests=DELETED', '_self');
      }
    });
  });
});
</script>