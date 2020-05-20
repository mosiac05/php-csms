
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
                      <th>WORKTEAM TITLE:</th>
                      <?php 
                       $workteam_query = "SELECT workteam_title FROM workteams WHERE workteam_id = '$workteam_id'";
                        $workteam_q = mysqli_query($con,$workteam_query);
                        $row = mysqli_fetch_assoc($workteam_q);
                      ?>
                      <td><?=$row['workteam_title']; ?></td>
                    </tr>
                    
                    <?php $last_login = date('g:ia\, l jS F\, Y', strtotime($last_login)); ?>
                    <tr>
                      <th>LAST LOGIN:</th>
                      <td><?=$last_login; ?></td>
                    </tr>
                    <!-- <tr>
                      <td colspan="2">
                        <div class="box-tools">
                      <button type="button" class="btn btn-flat btn-primary col-md-4 col-md-offset-4" title="Edit" data-toggle="modal" data-target="#modal-edit-details">
                        <i class="fa fa-edit"> <b>Edit</b></i>
                      </button>
                  </div>
                      </td>
                    </tr> -->
                  </tbody>                  
                </table>
              </div>            
          </div>
      </div>
      <!-- End of box -->
    </section>
  </div>