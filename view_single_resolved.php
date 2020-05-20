<!--=============================================== -->        
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Resolved Request
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Resolved Request</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">View Resolved Request</h3>

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
        $resolved_id = $_GET['resolved_id'];

        $resolved_query = mysqli_query($con, "SELECT * FROM resolved_requests WHERE resolved_id = '$resolved_id'");

        $row = mysqli_fetch_assoc($resolved_query);
            $resolved_id = $row['resolved_id'];
            $resolved_subject = $row['resolved_subject'];
            $resolved_message = substr($row['resolved_message'],0,150);
            $resolved_address = $row['resolved_address'];
            $resolved_time = $row['resolved_time'];
            $resolved_date = $row['resolved_date'];
            $resolved_attachment = $row['resolved_attachment'];
            $request_id = $row['request_id'];
            $request_code = $row['request_code'];
            $customer_id = $row['customer_id'];
            $request_assignee = $row['request_assignee'];

            $resolved_date = date('l jS F\, Y', strtotime($resolved_date));
            $resolved_time = date('g:iA', strtotime($resolved_time));


        echo "<tr><th>ID</th><td><strong>{$request_code}</strong></td></tr>";
        echo "<tr><th>SUBJECT</th><td>{$resolved_subject}</td></tr>";
        echo "<tr><th>DATE</th><td>{$resolved_date}</td></tr>";
        echo "<tr><th>TIME</th><td>{$resolved_time}</td></tr>";
        echo "<tr><th>REQUEST</th><td>{$resolved_message}</td></tr>";
        if($resolved_attachment != ''){
          echo "<tr><th>ATTACHMENT</th><td><a href='../attachments/{$resolved_attachment}' target='_blank' class='btn btn-sm bg-purple'>Click to View</a></td></tr>";
        } else{
        echo "<tr><th>ATTACHMENT</th><td><em>No attachments</em></td></tr>";
        }
          $staff_q = mysqli_query($con, "SELECT staff_name FROM staffs WHERE staff_code = '$request_assignee'");

          $staff = mysqli_fetch_assoc($staff_q);
        echo "<tr><th>ASSIGNER:</th><td>{$staff['staff_name']}</td></tr>";
        ?>

                  
                </table>
                  
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
                    <?php 
                      $comment_q = mysqli_query($con, "SELECT * FROM comments WHERE request_id = '$request_id'");
        
                      while($row = mysqli_fetch_array($comment_q)){
                        $comment_id = $row['comment_id'];
                        $comment_text = $row['comment_text'];
                        $comment_date = $row['comment_date'];
                        $comment_time = $row['comment_time'];
                        $request_id = $row['request_id'];
                        $customer_id = $row['customer_id'];
                        $staff_id = $row['staff_id'];

                    ?>
                    <?php 
                          if($staff_id != NULL){
                            $staff_query = mysqli_query($con, "SELECT * FROM staffs WHERE staff_id = '$staff_id'");

                            $row = mysqli_fetch_assoc($staff_query);
                              $staff_code = $row['staff_code'];
                              $staff_name = $row['staff_name'];

                              // $workteam_member_query = mysqli_query($con, "SELECT * FROM workteam_members WHERE workteam_member = '$staff_code'");

                              // $row = mysqli_fetch_assoc($workteam_member_query);
                              //   $workteam_q_id = $row['workteam_id'];

                              // $workteam_query = mysqli_query($con, "SELECT * FROM workteams WHERE workteam_id = '$workteam_q_id'");

                              // $row = mysqli_fetch_assoc($workteam_query);
                              //   $workteam_title = $row['workteam_title'];
                         ?>
                    <div class="direct-chat-msg">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left"><?=$staff_name; ?></span>
                        <span class="direct-chat-timestamp pull-right"><?=$comment_date . ' | ' . $comment_time; ?></span>
                      </div>
                      <!-- /.direct-chat-info -->
                      <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        <?=$comment_text; ?>
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->
                    <?php 

                          } else {
                            $customer_query = mysqli_query($con, "SELECT * FROM customers WHERE customer_id = '$customer_id'");

                            $row = mysqli_fetch_assoc($customer_query);
                              $customer_name = $row['customer_name'];
                       ?>
                    <!-- Message to the right -->
                    <div class="direct-chat-msg right">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-right"><?=$customer_name; ?></span>
                        <span class="direct-chat-timestamp pull-left"><?=$comment_date . ' | ' . $comment_time; ?></span>
                      </div>
                      <!-- /.direct-chat-info -->
                      <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        <?php echo $comment_text; ?>
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->
                  <?php } } ?>
                  </div>
                  <!--/.direct-chat-messages-->
                </div>
                <!-- /.box-body -->
                <!-- <div class="box-footer">
                  <form action="#" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                      <input type="text" name="comment" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-btn">
                            <input type="submit" name="comment_submit" value="Send" class="btn btn-warning btn-flat">
                          </span>
                    </div>
                  </form>
                </div> -->
                <!-- /.box-footer-->
              </div>
              <!--/.direct-chat -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
      </div>
      <!-- End of box -->
    </section>
  </div>