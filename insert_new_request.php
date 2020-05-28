
  <?php 
      if(isset($_POST['request_submit'])){
        $subject = mysqli_real_escape_string($con, $_POST['subject']);
        $message = mysqli_real_escape_string($con, $_POST['message']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $request_cat_id = $_POST['request_cat'];

        $attachment = $_FILES['attachment']['name'];
        $type = $_FILES['attachment']['type'];
        $temp_name = $_FILES['attachment']['tmp_name'];

        $extension = substr($attachment, strpos($attachment, '.') + 1);
        $extension = strtolower($extension);

        $accepted_extensions = ['doc','docx','pdf','txt','csv','xlsx','xls','xl','jpg','jpeg','png'];

        if(($attachment == '') || (in_array($extension, $accepted_extensions)))
        {
        	if($attachment != '')
        	{
	          move_uploaded_file($temp_name,"attachments/$attachment");
        	}
        	else
        	{
        		$attachment = NULL;
        	}

          $last_id_q = mysqli_query($con, "SHOW TABLE STATUS WHERE Name = 'requests'");
          $id = mysqli_fetch_assoc($last_id_q);
          $next_req_id = $id['Auto_increment'];
          $today = date('dm');

          $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $random_string = '';

          for($i = 0; $i < 3; $i++)
          {
            $index = rand(0, strlen($characters) - 1);
            $random_string .= $characters[$index];
          }
          $request_code = '#'.$random_string.$today.'-'.$next_req_id;

          $run_request_insert = mysqli_query($con, "INSERT INTO requests(request_code,request_address,request_subject,request_message,request_attachment, request_date,request_time,request_status,customer_id,workteam_id,request_cat_id,request_assignee) VALUES ('$request_code','$address','$subject','$message','$attachment',NOW(),NOW(),'NEW','$customer_id',NULL,'$request_cat_id',NULL)");

          if($run_request_insert){
            echo "<script>         
                      Swal.fire(
                        'Submitted Successfully!',
                        'We will get back to you soon',
                        'success'
                      )      
                      </script>";

            echo "<script>document.getElementById('request_form').reset();</script>";
          }

        }
        else
        {
          echo "<script>alert('Only DOC, DOCX, PDF, TXT, CSV, XLSX, JPG, JPEG, PNG files are allowed!')</script>";
        }

      }
?>

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
                <form class="form" action="" id="request_form" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="request_cat">Request Category:</label>                
                    <select name="request_cat" id="request_cat" class="form-control" required="">
                      <option selected="" disabled="">Select request category:</option>
                      <?php 
                        $cat_query = mysqli_query($con, "SELECT request_cat_id, request_category FROM request_cats");
                        while($row = mysqli_fetch_array($cat_query)){
                          $request_cat_id = $row['request_cat_id'];
                          $request_category = $row['request_category'];
                       ?>
                      <option value="<?=$request_cat_id; ?>"><?=$request_category; ?></option>
                    <?php } ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="subject">Request Subject:</label>                
                    <input type="text" name="subject" id="subject" placeholder="Enter Subject here..." class="form-control" required="">
                  </div>

                  <div class="form-group">
                    <label for="">Make Request:</label>                
                    <textarea name="message" id="message" placeholder="Type Request here..." rows="6" class="form-control" required=""></textarea>
                  </div>

                   <div class="form-group">
                    <label for="address">Your Adrress:</label>                
                    <input type="text" name="address" id="address" placeholder="Enter Address..." class="form-control" required="">
                  </div>

                  <div class="form-group">
                    <label for="attachment">Attach a document <span style="color: red;">(optional)</span>:</label>
                    <p class="text-danger"><small>*Upload DOC, DOCX, PDF, TXT, CSV, XLSX, JPG, JPEG, PNG files only!</small><br></p>                
                    <input type="file" name="attachment" id="attachment" accept=".doc,.docx,.pdf,.txt,.csv,.xlsx,.xls,.xl,.jpg,.jpeg,.png" class="btn btn-warning">
                  </div>

                  <hr>
                  <div class="form-group">                
                    <input type="submit" name="request_submit" value="Submit Request" class="btn bg-purple col-md-offset-5 col-xs-offset-4">
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
      <!-- End of box -->
    </section>
  </div>
