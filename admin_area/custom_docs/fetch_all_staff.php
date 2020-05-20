<?php
include '../../inc/head.php';
include 'shared_files/info.php';
?>

      <table id="example1" class="table table-responsive table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Email Address</th>
                  <th>Phone Number</th>
                  <th>View</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                      $staff_query = mysqli_query($con, "SELECT staff_id, staff_name,staff_email,staff_phone_num FROM staffs");

                      while($row = mysqli_fetch_array($staff_query)){
                          $staff_id = $row['staff_id'];
                          $staff_name = $row['staff_name'];
                          $staff_email = $row['staff_email'];
                          $staff_phone_num = $row['staff_phone_num'];

                    ?>
                <tr>
                  <td><?=$staff_name; ?></td>
                  <td><?=$staff_email; ?>...</td>
                  <td><?=$staff_phone_num; ?></td>
                  <td><input type="button" name="view" value="View" id="<?=$staff_id; ?>" class="btn btn-primary view_data"></td>
                  <td><input type="button" name="edit" value="Edit" id="<?=$staff_id; ?>" class="btn btn-warning edit_data"></td>
                  <td><input type="button" name="delete" value="Delete" id="<?=$staff_id; ?>" class="btn btn-danger delete_data"></td>
                </tr>
              <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>View</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </tfoot>
              </table>
  <div id="view_staff" class="modal modal-default fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-purple">
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


  <div id="delete_staff" class="modal modal-default fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete staff Account?</h4>
        </div>
        <div class="modal-body" id="staff_delete">
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


  <div id="edit_Modal" class="modal modal-default fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-purple">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit staff Account</h4>
        </div>
        <div class="modal-body" id="staff_edit">
          <form class="form" action="" id="staff_edit_form" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="name">Full Name:</label>                
                    <input type="text" name="name_edit" id="name" placeholder="Enter name here..." class="form-control" required="">
                  </div>

                  <div class="form-group">
                    <label for="code">Staff Code:</label>                
                    <input type="text" name="code_edit" id="code" placeholder="Enter staff code here..." class="form-control" required="">
                  </div>

                  <div class="form-group">
                    <label for="email">Email Address:</label>                
                    <input type="email" name="email_edit" id="email" placeholder="Enter email address here..." class="form-control" required="">
                  </div>

                  <div class="form-group">
                    <label for="phone_num">Phone Number:</label>                
                    <input type="text" name="phone_num_edit" id="phone_num" placeholder="Enter phone number here..." class="form-control" required="">
                  </div>

                  <div class="form-group">
                    <label for="role">Role</label>                
                    <select name="role_edit" id="role" class="form-control" required="">
                      <option disabled="">Select staff role:</option>
                      <?php 
                        $role_query = mysqli_query($con, "SELECT role_id, role_name FROM roles");
                        while($row = mysqli_fetch_array($role_query)){
                          $role_id = $row['role_id'];
                          $role_name = $row['role_name'];
                       ?>
                      <option value="<?=$role_id; ?>"><?=$role_name; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <div>
                    <input type="hidden" name="staff_id" id="staff_id" value="<?=$staff_id; ?>" />
                    <input type="hidden" name="staff_edit" id="staff_edit">
                  </div>
                  <hr>
                  <div class="form-group">                
                    <input type="submit" name="set" id="staff_edit_btn" value="Edit Account" class="btn bg-purple col-md-offset-5">
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


    $(document).on('click', '.edit_data', function(){
      var staff_id = $(this).attr("id");

      $.ajax({
        url:'custom_docs/fetch_staff.php',
        method:'post',
        data:{staff_id:staff_id},
        dataType:"json",
        success:function(data){
          $('#name').val(data.staff_name);
          $('#code').val(data.staff_code);
          $('#email').val(data.staff_email);
          $('#phone_num').val(data.staff_phone_num);
          $('#role').val(data.staff_role);
          $('#staff_id').val(data.staff_id);
          $('#staff_edit').val("Edit Account");
          $('#edit_Modal').modal('show');
        }
      });
    });


    function get_page(page_name){
      $.ajax({
        url: 'custom_docs/page_load.php',
        method: 'get',
        data: {page_name:page_name},
        success:function(data)
        {
          $('.content-wrapper').html(data);
          history.pushState(null, null, '?'+page_name);
        }
      });
    }

    $('#staff_edit_btn').click(function(e){
      e.preventDefault();

      var staff_id = $('#staff_id').val();
      var name_edit =  $('#name').val();
      var email_edit = $('#email').val();
      var phone_num_edit = $('#phone_num').val();
      var code_edit = $('#code').val();
      var role_edit = $('#role').val();
      var staff_edit = "staff_edit";

      $.ajax({
        url: 'custom_docs/staffs.php',
        type: 'POST',
        data:
        {
          staff_id:staff_id,
          name_edit:name_edit,
          email_edit:email_edit,
          phone_num_edit:phone_num_edit,
          code_edit:code_edit,
          role_edit:role_edit,
          staff_edit:staff_edit
        },
        success: function()
        {
          Swal.fire('Edited Successfully!','','success');
          $('#staff_edit_form')[0].reset();
          $('.modal-backdrop').remove();
          window.open('index.php?view_staffs', '_self');
        }
      });
    });

    $('.view_data').click(function(){
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

    $('.delete_data').click(function(){
      var staff_id = $(this).attr("id");
      var delete_staff = 'delete';

      $.ajax({
        url:'custom_docs/staffs.php',
        type:'POST',
        data:{staff_id:staff_id,delete_staff:delete_staff},
        success: function()
        {
          Swal.fire('Deleted!','','success');
          window.open('index.php?view_staffs', '_self');
        }
      });
    });
  });
</script>

<?php 
  include 'shared_files/scripts.php';
 ?>