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
        Areas
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Areas</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Areas</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"> Collapse</i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
              <div class="col-md-6">
                <form class="form" id="area_form" action="" method="post">
                  <div class="form-group">
                    <label for="area_name">Area:</label>                
                    <input type="text" name="area_name" id="area_name" placeholder="Enter new area here..." class="form-control" required="">
                  </div>
                  <div class="form-group">
                    <label for="area_eprt">Expected Power Restore time:</label>     
                    <input type="text" name="area_eprt" id="area_eprt" placeholder="Enter area EPRT here..." class="form-control" required="">
                  </div>
                  <div class="form-group">                
                    <input type="submit" name="area_submit" id="area_submit" value="Add New Area" class="btn bg-purple">
                  </div>
                </form>
              </div>
              <div class="col-md-6">
                <table class="table table-bordered table-striped" id="area_table">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Area</th>
                      <th>EPRT</th>
                      <th>Edit</th>
                      <!-- <th>Delete</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i=0;
                      $area_query = mysqli_query($con, "SELECT area_id,area_name,area_text FROM areas");
                      while($area = mysqli_fetch_array($area_query)){
                        $i++;
                     ?>
                    <tr>
                      <td><?=$i; ?></td>
                      <td><?=$area['area_name']; ?></td>
                      <td><?=$area['area_text']; ?></td>
                      <td><input type="submit" name="edit_area" value="Edit" id="<?=$area['area_id']; ?>" class="btn btn-warning edit_area" /></td>
                      <!-- <td><input type="submit" name="delete_area" value="Delete" id="<?=$area['area_id']; ?>" class="btn btn-danger delete_area" /></td> -->
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
          <h4 class="modal-title">Edit Area Details</h4>
        </div>
        <div class="modal-body" id="customer_edit">
          <form class="form" id="area_edit_form" action="" method="post">
            <div class="form-group">
              <label for="name_edit">Area:</label>                
              <input type="text" name="name_edit" id="name_edit" placeholder="Enter new area here..." class="form-control" required="">
            </div>
            <div class="form-group">
              <label for="eprt_edit">Expected Power Restore time:</label>     
              <input type="text" name="eprt_edit" id="eprt_edit" placeholder="Enter area EPRT here..." class="form-control" required="">
            </div>
            <input type="hidden" name="area_edit_id" id="area_id" />
            <div class="form-group">                
              <input type="submit" name="aet" id="area_edit" class="btn bg-purple">
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

        $(document).on('click', '.edit_area', function(){
          var area_id = $(this).attr("id");

          $.ajax({
            url:'custom_docs/areas.php',
            method:'post',
            data:{area_id:area_id},
            dataType:"json",
            success:function(data){
              $('#name_edit').val(data.area_name);
              $('#eprt_edit').val(data.area_text);
              $('#area_id').val(data.area_id);
              $('#area_edit').val('Edit Area');
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

        $('#area_edit_form').submit(function(e){
          e.preventDefault();

          $.ajax({
            url: 'custom_docs/areas.php',
            type: 'POST',
            data: $('#area_edit_form').serialize(),
            success:function()
            {
              Swal.fire('Edited Successfully!','','success');
              $('#area_edit_form')[0].reset();
              $('.modal-backdrop').remove();
              window.open('index.php?areas', '_SELF');
            }
          });
        });


        $('#area_form').submit(function(e){
          e.preventDefault();

          $.ajax({
            url: 'custom_docs/areas.php',
            type: 'POST',
            data: $('#area_form').serialize(),
            success: function()
            {
              Swal.fire('Added Successfully!','','success');
              window.open('index.php?areas', '_SELF');    
            }
          });
        });
    });
  </script>
<?php } ?>