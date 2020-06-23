<!-- =============================================== -->
<?php 
if($role_id != 1)
  {
    echo "<script>window.open('logout.php', '_self')</script>";
  }
  else
  {
 ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Staff Roles
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Staff Roles</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Staff Roles</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"> Collapse</i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
              <div class="col-md-6 role_form">
                <form class="form" id="role_form" action="" method="post">
                  <div class="form-group">
                  <label for="role_name">Role:</label>                
                    <input type="text" name="role_name" id="role_name" placeholder="Enter New role..." class="form-control">
                  </div>
                  <div class="form-group">                
                    <input type="submit" name="rt" id="role_submit" value="Add New Role" class="btn bg-purple">
                  </div>
                </form>
              </div>
              <div class="col-md-6">
                <table class="table table-bordered table-striped" id="role_table">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Role</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i=0;
                      $role_query = mysqli_query($con, "SELECT role_id,role_name FROM roles");
                      while($role = mysqli_fetch_array($role_query)){
                        $role_edit_id = $role['role_id'];
                        $i++;
                     ?>
                    <tr>
                      <td><?=$i; ?></td>
                      <td><?=$role['role_name']; ?></td>
                      <td><a href="#" id="<?=$role_edit_id; ?>" class="btn btn-sm btn-warning edit_role"><i class="fa fa-edit"></i></a></td>
                      <td><a href="#" id="<?=$role['role_id']; ?>" class="btn btn-sm btn-danger delete_role" /><i class="fa fa-trash"></i></a></td>
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
          <h4 class="modal-title">Edit Role Account?</h4>
        </div>
        <div class="modal-body" id="role_delete">
          <form class="form" id="role_edit_form" action="" method="post">
            <div class="form-group">
              <label for="role_name">Role:</label>                
              <input type="text" name="role_name_edit" id="role_name_edit" placeholder="Enter New role..." class="form-control">
            </div>
            <input type="hidden" name="role_id" id="role_id" />
            <div class="form-group">                
              <input type="submit" name="ret" id="role_edit" value="Edit Role" class="btn bg-purple">
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



  <script>
    $(document).ready(function(){
        $('.edit_role').click(function(e){
          e.preventDefault();
          var role_id = $(this).attr('id');

          $.ajax({
            url: 'custom_docs/roles.php',
            method: 'POST',
            data: {role_id:role_id},
            dataType: "json",
            success:function(data)
            {
              $('#role_name_edit').val(data.role_name);
              $('#role_id').val(data.role_id);
              $('#edit_Modal').modal('show');
            }
          });
        });

        $('#role_edit_form').submit(function(e){
          e.preventDefault();

          $.ajax({
            url: 'custom_docs/roles.php',
            type: 'POST',
            data: $('#role_edit_form').serialize(),
            success:function()
            {
              alert('Edited Successfully!');
              $('#edit_Modal').modal('hide');
              $('.modal-backdrop').remove();
              window.open('index.php?roles', '_self');
            }
          });
        });


        $('#role_form').submit(function(e){
          e.preventDefault();

          $.ajax({
            url: 'custom_docs/roles.php',
            type: 'POST',
            data: $('#role_form').serialize(),
            success: function()
            {
              Swal.fire('Added Successfully!','','success');
              window.open('index.php?roles', '_self');
            }
          });
        });

        $('.delete_role').click(function(e){
          e.preventDefault();
          var role_id = $(this).attr('id');
          var role_delete = '';

          $.ajax({
            url: 'custom_docs/roles.php',
            type: 'POST',
            data: {
              role_id: role_id,
              role_delete: role_delete
            },
            success: function(data)
            {
              var jsonData = JSON.parse(data);

              if(jsonData == '1')
              {
                Swal.fire('Deleted Successfully', '', 'success');
                window.open('index.php?roles', '_self');
              }
              else
              {
                alert('Unsuccessful, ensure no staff is assigned that role');
              }
            }
          });
        });
      });
  </script>
<?php } ?>