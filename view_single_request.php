<!--=============================================== -->        
<?php 
  if(isset($_GET['request_id'])){
    $the_request_id = $_GET['request_id'];

      $request_q = mysqli_query($con, "SELECT * FROM requests WHERE request_id = '".$_GET['request_id']."'");

      $req_count = mysqli_num_rows($request_q);

      if($req_count < 1){
        #echo "<script>alert('Wrong')</script>";
        echo "<script>window.open('index.php?view_requests=NEW', '_self')</script>";
      }
      else{

        $request_query = mysqli_query($con, "select * from requests where request_id = '$the_request_id'");

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
                  $request_assignee = $row['request_assignee'];
                  $customer_id = $row['customer_id'];
                  $workteam_id = $row['workteam_id'];
                  
                  $request_date = date('l jS F\, Y', strtotime($request_date));
                  $request_time = date('g:iA', strtotime($request_time));


                  if($request_status == 'NEW'){
                    $status_display = 'New';
                  }
                  if($request_status == 'OPEN'){
                    $status_display = 'Open';
                  }
                  elseif($request_status == 'PENDING'){
                    $status_display = 'Pending';
                  }
                  elseif($request_status == 'RESOLVED'){
                    $status_display = 'Resolved';
                  }

                if(($workteam_id != NULL) && ($request_status != 'NEW')){

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
              <div class="col-md-12">
                <table class="table table-bordered table-striped">
          <?php


        echo "<tr><th>ID</th><td><strong>{$request_code}</strong></td></tr>";
        echo "<tr><th>SUBJECT</th><td>{$request_subject}</td></tr>";
        echo "<tr><th>DATE</th><td>{$request_date}</td></tr>";
        echo "<tr><th>TIME</th><td>{$request_time}</td></tr>";
        echo "<tr><th>REQUEST</th><td>{$request_message}</td></tr>";
        if($request_attachment != ''){
        echo "<tr><th>ATTACHMENT</th><td><a href='attachments/{$request_attachment}' class='btn btn-warning' target='_blank'>{$request_attachment}</a></td></tr>";
        } else{
        echo "<tr><th>ATTACHMENT</th><td><em>No attachments</em></td></tr>";
        }
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
        if($request_status == 'RESOLVED'){
          echo "<tr><th>DELETE</th><td><button type='button' id='{$request_id}' class='btn bg-red delete_submit'><i class='fa fa-trash'></i> Delete</button></td></tr>";
        }
        ?>
                  
                </table>
                  <?php 
                    if(($workteam_id == NULL) && ($request_status == 'NEW')){
                   ?>
                  <div class="box-tools">
                      <button type="button" class="btn btn-flat btn-primary" title="Edit" data-toggle="modal" data-target="#modal-edit">
                        <i class="fa fa-edit"> <b>Edit</b></i>
                      </button>
                      <button type="button" id="<?=$request_id; ?>" class="btn btn-sm bg-red pull-right delete_submit"><i class="fa fa-trash"></i> Delete</button>
                  </div>
                <?php 
                    }
                    else{
                ?>
                <?php 
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
                <?php 
                  }

                } ?>
              </div>            
          </div>
          <br>
          <?php 
            if($request_status != 'NEW'){
          ?>
          <div class="row">
            <div class="col-md-12">
              <!-- DIRECT CHAT -->
              <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Direct Chat</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages">
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
                      <input type="hidden" name="request_id" id="request_id" value="<?=$the_request_id; ?>">
                      <input type="text" name="comment" id="comment" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-btn">
                            <input type="button" name="ct" id="comment_submit" value="Send" class="btn btn-warning btn-flat">
                          </span>
                    </div>
                  </form>
                </div>
                <?php } ?>
                <script type="text/javascript">
                    $(document).ready(function(){
                      $('#comment_submit').click(function(){
                        var comment_text = $('#comment').val();
                        var request_id = $('#request_id').val();
                        if($.trim(comment_text) != '')
                        {
                          $.ajax({
                            url:'inc/customer_comment.php',
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
                        $('.direct-chat-messages').load('admin_area/custom_docs/fetch_customer_comments.php?request_id=<?=$the_request_id; ?>').fadeIn('slow');
                      }, 5000);

                      $('.delete_submit').click(function(){
                          var request_id = $(this).attr('id');
                          var status = 'deleted';

                          $.ajax({
                            url: 'admin_area/custom_docs/status_submit.php',
                            type: 'POST',
                            data:
                            {
                              request_id:request_id,
                              status:status
                            },
                            success:function(data)
                            {
                              requestStatus = '<?php echo $request_status; ?>';
                              Swal.fire('Deleted Successfully!','','success' );
                              window.open('index.php?view_requests='+requestStatus, '_self');
                            }
                          });
                        });

                      $('#pending_submit').click(function(){
                        var request_id = $('.request_id').attr('id');
                        var status = 'pending';

                        $.ajax({
                          url: 'admin_area/custom_docs/status_submit.php',
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
                          url: 'admin_area/custom_docs/status_submit.php',
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
                      
                      $('#resolved_submit').click(function(){
                        var request_id = $('.request_id').attr('id');
                        var status = 'resolved';

                        $.ajax({
                          url: 'admin_area/custom_docs/status_submit.php',
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

                    });
                  </script>
                <!-- /.box-footer-->
              </div>
              <!--/.direct-chat -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
                <?php 
                    if($request_status != 'NEW'){
                   ?>
                   <div class="box-tools text-center">
                    <!-- <button type="button" class="btn btn-flat btn-primary pull-left" title="Click to Add Comment" data-toggle="modal" data-target="#modal-add-comment">
                        <i class="fa fa-plus"> <b>Click to Add Comment</b></i>
                    </button> -->
                    <input type="submit" name="resolve_submit" class="col-md btn btn-success pull-right sr-only" value="Confirm Resolved">
                  </div>
                <?php } ?>
        <?php } } ?>
      </div>
      <!-- End of box -->
    </section>
  </div>


<!--/********************************************************************************************************************************/ -->
  <div class="modal modal-default fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-purple">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Your Request</h4>
        </div>
        <div class="modal-body">
          <form class="form" action="#" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="subject">Request Subject:</label>                
              <input type="text" name="subject" id="subject" value="<?=$request_subject; ?>" placeholder="Enter Subject here..." class="form-control" required="">
            </div>

            <div class="form-group">
              <label for="">Make Request:</label>                
              <textarea name="message" id="editor1" placeholder="Enter Request..." rows="10" class="form-control" required=""><?=$request_message; ?></textarea>
            </div>

             <div class="form-group">
              <label for="address">Your Address:</label>                
              <input type="text" name="address" id="address" value="<?=$request_address; ?>" placeholder="Enter Address..." class="form-control" required="">
            </div>

            <div class="form-group">
              <label for="attachment">Attach a document <span style="color: red;">(optional, reselect file)</span>:</label>                
              <input type="file" name="attachment" id="attachment" class="btn btn-warning form-control">
              <br>
              <a href="attachments/<?=$request_attachment; ?>" target="_blank"><?=$request_attachment; ?></a>
            </div>

            <hr>
            <div class="form-group">                
              <input type="submit" name="request_edit" value="Click to Update" class="btn bg-purple col-md-offset-5 col-xs-offset-4">
            </div>
          </form>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->



  <div class="modal modal-default fade" id="modal-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete Request?</h4>
        </div>
        <div class="modal-body">
          <form class="form" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">                
              <input type="submit" name="request_delete" value="Yes" class="btn btn-danger pull-left col-md-offset-4 col-xs-offset-4">
              <input type="button" data-dismiss="modal" value="No" class="btn btn-primary col-md-offset-2 col-xs-offset-2">
            </div>
          </form>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--/********************************************************************************************************************************/ -->

<?php   include 'form_submission.php'; ?>