
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        New Requests
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">New Requests</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Add New Request</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"> Collapse</i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
              <div class="col-md-offset-2 col-md-8">
                <form class="form" action="" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="subject">Request Subject:</label>                
                    <input type="text" name="subject" id="subject" placeholder="Enter Subject here..." class="form-control" required="">
                  </div>

                  <div class="form-group">
                    <label for="">Make Request:</label>                
                    <textarea name="message" id="editor1" placeholder="Enter Request..." rows="10" class="form-control" required=""></textarea>
                  </div>

                   <div class="form-group">
                    <label for="address">Your Adrress:</label>                
                    <input type="text" name="address" id="address" placeholder="Enter Address..." class="form-control" required="">
                  </div>

                  <div class="form-group">
                    <label for="attachment">Attach a document <span style="color: red;">(optional)</span>:</label>                
                    <input type="file" name="attachment" id="attachment" class="btn btn-warning">
                  </div>

                  <hr>
                  <div class="form-group">                
                    <input type="submit" name="request_submit" value="Submit Request" class="btn btn-primary col-md-offset-4">
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
      <!-- End of box -->
    </section>
  </div>

  <?php 
      if(isset($_POST['request_submit'])){
        $subject = mysqli_real_escape_string($con, $_POST['subject']);
        $message = mysqli_real_escape_string($con, $_POST['message']);
        $address = mysqli_real_escape_string($con, $_POST['address']);

        $attachment = $_FILES['attachment']['name'];

        $temp_name = $_FILES['attachment']['tmp_name'];

        move_uploaded_file($temp_name,"attachments/$attachment");

        $run_request_insert = mysqli_query($con, "INSERT INTO requests(request_address,request_subject,request_message,request_attachment, request_date,request_time,request_status,customer_id,workteam_id) VALUES ('$address','$subject','$message','$attachment',NOW(),NOW(),'NEW','$customer_id',NULL)");

        if($run_request_insert){
          echo "<script>         
                    Swal.fire(
                      'Submitted Successfully!',
                      'We will get back to you soon',
                      'success'
                    )      
                    </script>";

          #echo "<script>window.open('index.php?view_blogs', '_self')</script>";
        }
      }
?>
