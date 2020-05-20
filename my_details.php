<?php
  if(isset($_POST['details_edit']) && !empty($_POST)){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone_num = mysqli_real_escape_string($con, $_POST['phone_num']);
    $state = mysqli_real_escape_string($con, $_POST['state']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $area_id = $_POST['area_id'];

    $image = $_FILES['image']['name'];
    $size = $_FILES['image']['size'];
    $type = $_FILES['image']['type'];
    $tmp_name = $_FILES['image']['tmp_name'];

    $max_size = 1000000;
    $extension = substr($image, strpos($image, '.') + 1);
    $extension = strtolower($extension);

    if($extension == "jpg" || $extension == "jpeg" || $extension == 'png')
    {
      if($size<=$max_size)
      {
        move_uploaded_file($tmp_name, "customer_images/$image");

        $run_update_details = mysqli_query($con, "UPDATE customers SET 
      customer_name = '$name',customer_email = '$email',customer_phone_num = '$phone_num',customer_state = '$state',customer_city = '$city',customer_address = '$address',customer_image = '$image',area_id = '$area_id' WHERE customer_id = $customer_id");

        if($run_update_details)
        {
          echo "<script>         
                        Swal.fire(
                          'Updated Successfully!',
                          '',
                          'success'
                        )      
                        </script>

                        <script>window.open('index.php?my_details', '_SELF')</script>";
        }
      }
      else
      {
        $details_msg = '<span class="alert alert-danger col-md-offset-3 col-md-6 col-xs-offset-1 col-xs-10">Your file is more than 1MB!<i class="fa fa-times pull-right" data-dismiss="alert"></i></span>';
      }
    }
    else
    {
      $details_msg = '<span class="alert alert-danger col-md-offset-3 col-md-6 col-xs-offset-1 col-xs-10">Only PNG, JPEG, JPG files are allowed!<i class="fa fa-times pull-right" data-dismiss="alert"></i></span>';
    } 
  } 
 ?>

  <!-- =============================================== -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        My Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">My Details</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"> Collapse</i></button>
          </div>
        </div>
          <div class="row">
            <?php if(isset($details_msg)){ ?>
            <div class="col-md-12"><?=$details_msg; ?></div>
          <?php } ?>
            <div class="col-md-12">
              <img src="customer_images/<?=$customer_image; ?>" width="100" alt="<?=$customer_image; ?>" class="img img-responsive img-thumbnail col-md-offset-5 col-xs-offset-4">              
            </div>
              <div class="col-md-12">
                <table class="table table-bordered table-striped">
                  <tbody>
                    <tr>
                      <th>NAME:</th>
                      <td><?=$customer_name; ?></td>
                    </tr>
                    <tr>
                      <th>EMAIL ADDRESS:</th>
                      <td><?=$customer_email; ?></td>
                    </tr>
                    <tr>
                      <th>PHONE NUMBER:</th>
                      <td><?=$customer_phone_num; ?></td>
                    </tr>
                    <tr>
                      <th>RESIDENTIAL ADDRESS:</th>
                      <td><?=$customer_address; ?></td>
                    </tr>
                    <tr>
                      <?php 
                   $area_query = "SELECT * FROM areas WHERE area_id = '$area_id'";
                          $area_q = mysqli_query($con,$area_query);

                          $row = mysqli_fetch_assoc($area_q);
                              $area_id = $row['area_id'];
                              $area_name = $row['area_name'];
                       ?>
                       <th>AREA:</th>
                       <td><?=$area_name; ?></td>
                    </tr>
                    <tr>
                      <th>CITY:</th>
                      <td><?=$customer_city; ?></td>
                    </tr>
                    <tr>
                      <th>STATE:</th>
                      <td><?=$customer_state; ?></td>
                    </tr>
                     <?php $last_login = date('g:ia\, l jS F\, Y', strtotime($last_login)); ?>
                    <tr>
                      <th>LAST LOGIN:</th>
                      <td><?=$last_login; ?></td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <div class="box-tools">
                      <button type="button" class="btn btn-flat bg-purple col-md-4 col-md-offset-4 col-xs-4 col-xs-offset-4" title="Edit" data-toggle="modal" data-target="#modal-edit-details">
                        <i class="fa fa-edit"> <b>Edit</b></i>
                      </button>
                  </div>
                      </td>
                    </tr>
                  </tbody>                  
                </table>
              </div>            
          </div>
          <div>
        </div>
      </div>
      <!-- End of box -->
    </section>
  </div>



  <div class="modal modal-default fade" id="modal-edit-details">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-purple">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Your Details</h4>
        </div>
        <div class="modal-body">
          <form class="form" action="#" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name">Your Name:</label>                
              <input type="text" name="name" id="name" value="<?=$customer_name; ?>" placeholder="Enter your name here..." class="form-control" required="">
            </div>

            <div class="form-group">
              <label for="email">Your Email Address:</label>              
              <input type="email" name="email" id="email" value="<?=$customer_email; ?>" placeholder="Enter your email Address..." class="form-control" required="">
            </div>

            <div class="form-group">
              <label for="phone_num">Your Phone Number:</label>             
              <input type="text" name="phone_num" id="phone_num" value="<?=$customer_phone_num; ?>" placeholder="Enter your phone number..." class="form-control" required="">
            </div>

             <div class="form-group">
              <label for="address">Your Residential Address:</label>        
              <input type="text" name="address" id="address" value="<?=$customer_address; ?>" placeholder="Enter Address..." class="form-control" required="">
            </div>

            <div class="form-group">
              <label for="city">Your City:</label>                
              <input type="text" name="city" id="city" value="<?=$customer_city; ?>" placeholder="Enter your city..." class="form-control" required="">
            </div>

            <div class="form-group">
              <label for="area_id">Your Area:</label>                
              <select class="form-control" name="area_id" required="">
                <option disabled="">Select your area:</option>
                <?php 
                   $area_query = "SELECT * FROM areas";
                          $area_q = mysqli_query($con,$area_query);

                          while($row = mysqli_fetch_assoc($area_q)){
                              $area_id = $row['area_id'];
                              $area_name = $row['area_name'];
                       ?>
                       <option value="<?=$area_id; ?>"><?=$area_name; ?></option>
                     <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label for="state">Your State:</label>                
              <input type="text" name="state" id="state" value="<?=$customer_state; ?>" placeholder="Enter your state..." class="form-control" required="">
            </div>

            <div class="form-group">
              <label for="image">Select your image:</label>
              <p class="text-danger"><small>*Upload PNG, JPG, JPEG files only, not more than 1MB!</small></p>
              <input type="file" name="image" id="image" accept=".jpeg,.jpg,.png" class="btn btn-warning form-control" required="">
              <br>
              <img src="customer_images/<?=$customer_image; ?>" width="50" alt="<?=$customer_image; ?>">
            </div>

            <hr>
            <div class="form-group">                
              <input type="submit" name="details_edit" value="Click to Update" class="btn bg-purple col-md-offset-4 col-xs-offset-4">
            </div>
          </form>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
