
  <!-- =============================================== -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        My Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">My Details</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
                  <?php 
                    $staff_session = $_SESSION['admin_staff'];
        
                    $get_staff = "SELECT * FROM staffs WHERE staff_email='$staff_session'";
                    
                    $run_staff = mysqli_query($con,$get_staff);
                    
                    $row = mysqli_fetch_array($run_staff);
                    
                    $staff_id = $row['staff_id'];
                    $staff_name = $row['staff_name'];
                    $staff_code = $row['staff_code'];
                    $staff_email = $row['staff_email'];
                    $staff_phone_num  = $row['staff_phone_num'];
                    $staff_image = $row['staff_image'];
                    $last_login = $row['last_login'];
                    $role_id = $row['role_id'];

                    $last_login = date('g:ia\, l jS F\, Y', strtotime($last_login));
                    

                    if($staff_image == '' || $staff_image == NULL)
                    {
                      $staff_image = 'avatar.png';
                    }
                   ?>
        <div class="box-header with-border">
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"> Collapse</i></button>
          </div>
        </div>
          <div class="row">
            <div class="col-md-12">
              <img src="./../staff_images/<?=$staff_image; ?>" width="100" alt="<?=$staff_image; ?>" class="img img-responsive img-thumbnail col-md-offset-5 col-xs-offset-4">              
            </div>
              <div class="col-md-12">
                <table class="table table-bordered table-striped">
                  <tbody>
                    <tr>
                      <th>NAME:</th>
                      <td><?=$staff_name; ?></td>
                    </tr>
                    <tr>
                      <th>STAFF CODE</th>
                      <td><?=$staff_code; ?></td>
                    </tr>
                    <tr>
                      <th>EMAIL ADDRESS:</th>
                      <td><?=$staff_email; ?></td>
                    </tr>
                    <tr>
                      <th>PHONE NUMBER:</th>
                      <td><?=$staff_phone_num; ?></td>
                    </tr>
                    <tr>
                      <th>Last Login</th>
                      <td><?=$last_login; ?></td>
                    </tr>
                    </tbody>                  
                </table>
              </div>  
               <!--  <div class="col-md-12">
                  <div style="width: 60%; margin: auto; border-radius: 15px; background-color: powderblue; color: #000;">
                        <h1 style="text-align: center; font-weight: bold; text-transform: uppercase; padding: 5px;">
                        ACCOUNT CREATION SUCCESSFULL
                        </h1>
                        <hr style="border: 1px black solid; opacity: .2;">
                        <p style="padding: 10px; font-size: 18px;">
                        <b>Obute Moses</b>, your IBEDC account has been created successfully. You can login using your phone number.<br>It is advised that you change your password as soon as you receive this mail.
                        </p>
                        <footer style="background-color: #00004d; color: white; text-align: center; font-weight: bold;">&copy; IBEDC Inc. Ltd. 2020</footer>
                    </div>
                    
                </div>     -->      
          </div>
      </div>
      <!-- End of box -->
    </section>
  </div>
