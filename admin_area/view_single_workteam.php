<!-- =============================================== -->
<?php 
  if(isset($_GET['workteam_id'])){
    $the_workteam_id = $_GET['workteam_id'];

    $query = mysqli_query($con, "SELECT workteam_title FROM workteams WHERE workteam_id = '$the_workteam_id'");

    $title_q = mysqli_fetch_array($query);
    $delete_btn = '';
    $display_msg = '';
    if($role_id != 1)
    {
      $delete_btn = 'hidden';
    }
  }
 ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Workteam <?php echo $title_q['workteam_title']; ?> Members
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Workteam <?php echo $title_q['workteam_title']; ?> Members</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Workteam <?php echo $title_q['workteam_title']; ?> Members</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"> Collapse</i></button>
          </div>
        </div>
        <div class="box-body">
          <?php 
          if($role_id == 1)
          {
           ?>
          <div class="row">
            <?php 
              $staff_query = mysqli_query($con, "SELECT staff_code, staff_name FROM staffs WHERE role_id > 2 AND staff_code NOT IN (SELECT workteam_member FROM workteam_members)");
              $staff_count = mysqli_num_rows($staff_query);
              if($staff_count == 0)
              {
                $display_msg = '<span class="alert alert-danger col-md-offset-3 col-md-6 col-xs-offset-2 col-xs-8">All technicians have been assigned to workteams!<i class="fa fa-times pull-right" data-dismiss="alert" ></i>
         </span><br><br><br><br>';
              }
             ?>
             <div id="msg_area"><?=$display_msg; ?></div>
              <div class="col-md-offset-3 col-md-6">
                <form class="form alert bg-gray" id="member_form" action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                  <label for="member">New Workteam Member:</label>               
                    <select name="member" id="member" class="form-control" required="">
                      <option selected="" disabled="">Select workteam member:</option>
                      <?php
                      //Display staff technician not assigned to any workteam
                        while($row = mysqli_fetch_array($staff_query)){
                          $staff_code = $row['staff_code'];
                          $staff_name = $row['staff_name'];
                       ?>
                      <option value="<?=$staff_code; ?>"><?=$staff_name; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <input type="hidden" name="workteam_id" value="<?=$the_workteam_id; ?>" />
                  <div class="form-group">                
                    <input type="submit" name="ms" id="member_submit" value="Add New Member" class="btn bg-purple col-md-offset-4">
                  </div>
                </form>
              </div>           
          </div>
        <?php } ?>
          <div class="row">
             <div class="col-md-12">
                <table class="table table-responsive table-bordered table-hover" id="area_table">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Name</th>
                      <th>Staff Code</th>
                      <th>View Details</th>
                      <th class="<?=$delete_btn; ?>">Delete</th>
                      <!-- <th>Delete</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i=0;
                      $workteam_query = mysqli_query($con, "SELECT workteam_member FROM workteam_members WHERE workteam_id = '$the_workteam_id'");

                      while($row = mysqli_fetch_array($workteam_query)){
                        $staff_query = mysqli_query($con, "SELECT * FROM staffs WHERE staff_code = '".$row['workteam_member']."'");
                        $staff = mysqli_fetch_array($staff_query);
                        $staff_id = $staff['staff_id'];
                        $i++;
                     ?>
                    <tr>
                      <td><?=$i; ?></td>
                      <td><?=$staff['staff_name']; ?></td>
                      <td><?=$staff['staff_code']; ?></td>
                      <td><input type="button" name="view" value="View" id="<?=$staff_id; ?>" class="btn bg-purple view_member"></td>
                      <td class="<?=$delete_btn; ?>"><input type="submit" name="delete_member" value="Delete" id="<?=$row['workteam_member']; ?>" class="btn btn-danger delete_member" /></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                  
                </table>
              </div> 
          </div>
      </div>
      <!-- End of box -->
    </section>
  </div>


<div id="view_staff" class="modal modal-default fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Staff Details</h4>
        </div>
        <div class="modal-body" id="staff_detail">
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

  <script>
    $(document).ready(function(){
      function get_page(){
        var id = <?=$the_workteam_id; ?>;
        $.ajax({
          type: "GET",
          url: 'custom_docs/page_load.php',
          data: "workteam_id=" + id, // appears as $_GET['id'] @ your backend side
          success: function(data)
          {
            $('.content-wrapper').html(data);
            history.pushState(null, null, '?workteam_id='+id);
          }
        });
      }

      $('#member_form').submit(function(e){
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "custom_docs/add_workteam.php",
          data: $('#member_form').serialize(),
          success:function(response)
          {
            var jsonData = JSON.parse(response);

            if(jsonData == "1")
            {
              Swal.fire('Added Successfully!','','success');
              window.open('index.php?workteam_id=<?=$the_workteam_id; ?>', '_SELF');
            }
            else
            {
              $('#msg_area').html(jsonData);
            }
          }
        });
      });


      $(document).on('click', '.edit_workteam', function(){
        var workteam_id = $(this).attr("id");

        $.ajax({
          url:'custom_docs/fetch_workteam.php',
          method:'post',
          data:{workteam_id:workteam_id},
          dataType:"json",
          success:function(data){
            $('#edit_title').val(data.workteam_title);
            $('#edit_head').val(data.workteam_head);
            $('#workteam_id').val(data.workteam_id);
            $('#workteam_edit').val('Edit Workteam');
            $('#edit_Modal').modal('show');
          }
        });
      });


      $('.view_member').click(function(){
        var staff_id = $(this).attr("id");

        $.ajax({
          url:"custom_docs/select_staff.php",
          method:"post",
          data:{staff_id:staff_id},
          success:function(data){
           $('#staff_detail').html(data);
           $('#view_staff').modal("show");
          }
        });      
      });

      $('.delete_member').click(function(){
        var delete_member = $(this).attr("id");

        $.ajax({
          url:'custom_docs/workteams.php',
          method:'post',
          data:{delete_member:delete_member},
          success:function()
          {
            Swal.fire('Deleted!','','success');
            window.open('index.php?workteam_id=<?=$the_workteam_id; ?>', '_SELF');
          }
        });
      });
    });
  </script>