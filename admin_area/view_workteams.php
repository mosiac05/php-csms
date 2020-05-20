<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Workteams
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Workteams</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Workteams</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"> Collapse</i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <?php 
              $table_class = '';
              if($role_id == 1)
              {
             ?>
              <div class="col-md-6">
                <form class="form" id="workteam_form" action="" method="post">
                  <div class="form-group">
                    <label for="workteam_title">Workteam Title:</label>             
                    <input type="text" name="workteam_title" id="workteam_title" placeholder="Enter title here..." class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label for="workteam_head">Workteam Head:</label>               
                    <select name="workteam_head" id="workteam_head" class="form-control" required="">
                      <option selected="" disabled="">Select workteam head:</option>
                      <?php 
                        $staff_query = mysqli_query($con, "SELECT staff_id, staff_name FROM staffs WHERE role_id > 2 AND staff_id NOT IN (SELECT workteam_head FROM workteams)");
                        $workteam_head_query = mysqli_query($con, "SELECT workteam_head FROM workteams");
                        
                        while($staff_row = mysqli_fetch_array($staff_query)){
                          $staff_id = $staff_row['staff_id'];
                          $staff_name = $staff_row['staff_name'];
                       ?>
                      <option value="<?=$staff_id; ?>"><?=$staff_name; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">                
                    <input type="submit" name="wst" id="workteam_submit" value="Add New Workteam" class="btn bg-purple">
                  </div>
                </form>
              </div>
            <?php }

              if($role_id != 1)
              {
                $table_class = 'hidden';
             ?>
              <div class="col-md-12">
            <?php
            } 
            else
              { 
                ?>
              <div class="col-md-6">
            <?php } ?>
                <table class="table table-bordered table-striped" id="area_table">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Workteam Title</th>
                      <th>Head</th>
                      <th>View Members</th>
                      <th class="<?=$table_class; ?>">Edit</th>
                      <!-- <th>Delete</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i=0;
                      $workteam_query = mysqli_query($con, "SELECT workteam_id,workteam_title,workteam_head FROM workteams");
                      while($workteam = mysqli_fetch_array($workteam_query)){
                        $staff_query = mysqli_query($con, "SELECT staff_name FROM staffs WHERE staff_id = '".$workteam["workteam_head"]."'");
                        $staff = mysqli_fetch_array($staff_query);
                        $i++;
                     ?>
                    <tr>
                      <td><?=$i; ?></td>
                      <td><?=$workteam['workteam_title']; ?></td>
                      <td><?=$staff['staff_name']; ?></td>
                      <td><a href="index.php?workteam_id=<?=$workteam['workteam_id']; ?>" class="btn btn-sm bg-purple workteam_btn" id="<?=$workteam['workteam_id']; ?>">View</a></td>
                      <td class="<?=$table_class; ?>"><input type="submit" name="edit_workteam" value="Edit" id="<?=$workteam['workteam_id']; ?>" class="btn btn-sm btn-warning edit_btn" /></td>
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


<div id="edit_Modal" class="modal modal-default fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-purple">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Workteam</h4>
        </div>
        <div class="modal-body" id="workteam_edit">
          <form class="form" id="workteam_edit_form" action="" method="post">
            <div class="form-group">
              <label for="edit_title">Workteam Title:</label>             
              <input type="text" name="edit_title" id="edit_title" placeholder="Enter title here..." class="form-control" required="">
            </div>
            <div class="form-group">
              <label for="edit_head">Workteam Head:</label>               
              <select name="edit_head" id="edit_head" class="form-control" required="">
                <option selected="" disabled="">Select workteam head:</option>
                <?php 
                  $staff_query = mysqli_query($con, "SELECT staff_id, staff_name FROM staffs WHERE role_id > 2 AND staff_id NOT IN (SELECT workteam_head FROM workteams)");
                  while($row = mysqli_fetch_array($staff_query)){
                    $staff_id = $row['staff_id'];
                    $staff_name = $row['staff_name'];
                 ?>
                <option value="<?=$staff_id; ?>"><?=$staff_name; ?></option>
              <?php } ?>
              </select>
            </div>
            <div>
              <input type="hidden" name="workteam_id" id="workteam_id">
            </div>
            <div class="form-group">                
              <input type="submit" name="wst" id="edit_submit" value="Edit Workteam" class="btn bg-purple">
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

<script type="text/javascript">
  $(document).ready(function(){

    // function get_page(page_name){
    //   $.ajax({
    //     url: 'custom_docs/page_load.php',
    //     method: 'get',
    //     data: {page_name:page_name},
    //     success:function(data)
    //     {
    //       $('.content-wrapper').html(data);
    //       history.pushState(null, null, '?'+page_name);
    //     }
    //   });
    // }

    // $('.workteam_btn').click(function(e){
    //   e.preventDefault();

    //   var id = $(this).attr("id");
    //   $.ajax({
    //     type: "GET",
    //     url: 'custom_docs/page_load.php',
    //     data: "workteam_id=" + id, // appears as $_GET['id'] @ your backend side
    //     success: function(data)
    //     {
    //       $('.content-wrapper').html(data);
    //       history.pushState(null, null, '?workteam_id='+id);
    //     }
    //   });
    // });

    $('#workteam_form').submit(function(e){
      e.preventDefault();

      $.ajax({
        url: 'custom_docs/workteams.php',
        type: 'POST',
        data: $('#workteam_form').serialize(),
        success: function()
        {
          Swal.fire('Submitted Successfully','','success');
          window.open('index.php?view_workteams', '_self');
        }
      });
    });

    $('.edit_btn').click(function(e){
      e.preventDefault();

      var workteam_id = $(this).attr('id');

      $.ajax({
        url: 'custom_docs/workteams.php',
        type: 'POST',
        data: {workteam_id:workteam_id},
        dataType: "json",
        success: function(data)
        {
          $('#edit_title').val(data.workteam_title);
          $('#edit_head').val(data.workteam_head);
          $('#workteam_id').val(data.workteam_id);
          $('#edit_Modal').modal('show');
        }
      });
    });

    $('#workteam_edit_form').submit(function(e){
      e.preventDefault();

      var title = $('#edit_title').val();
      var head = $('#edit_head').val();
      var workteam_edit_id = $('#workteam_id').val();

      $.ajax({
        url: 'custom_docs/workteams.php',
        type: 'POST',
        data: {title:title,head:head,workteam_edit_id:workteam_edit_id},
        success: function(response)
        {
          Swal.fire('Edited Successfully','','success');
          $('#workteam_edit_form')[0].reset();
          $('.modal-backdrop').remove();
          window.open('index.php?view_workteams', '_self');
        }
      });
    });
  });
</script>
